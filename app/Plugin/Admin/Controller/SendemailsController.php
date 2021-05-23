<?php
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 900);
class SendemailsController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index()
    {
        $this->loadModel('Emailsetting');
        $this->loadModel('Emailtemplate');
        $this->loadModel('Client');
        $this->loadModel('Lead');
        $this->loadModel('Agent');
        $this->set('emailTemplate',$this->Emailtemplate->find('list',array('fields'=>array('description','name'),'conditions'=>array('status'=>'Published','type'=>NULL),'order'=>array('name'=>'asc'))));
        $emailSettingArr=$this->Emailsetting->findById(1);
        $settingType=$emailSettingArr['Emailsetting']['type'];
        if($this->request->is('post'))
        {
            try
            {
                $type=$this->request->data['Sendemail']['type'];
                $emailTemplate=$this->request->data['Sendemail']['email_template'];
                $clientId=$this->request->data['Sendemail']['client_id'];
                $leadId=$this->request->data['Sendemail']['lead_id'];
                $agentId=$this->request->data['Sendemail']['agent_id'];
                $anyEmail=$this->request->data['Sendemail']['any_email'];
                $subject=$this->request->data['Sendemail']['subject'];
                $message=$this->request->data['Sendemail']['message'];
                if($type==null)
                {
                    $this->Session->setFlash(__('Please select any type in the list.'),'flash',array('alert'=>'danger'));
                }
                elseif($type=='Any' && $anyEmail==null)
                {
                    $this->Session->setFlash(__('Please type any email.'),'flash',array('alert'=>'danger'));
                }
                else
                {
                    $toEmailArr=null;
                    if($type=="Client" && $clientId!=null)
                    {
                        $toEmailArr=explode(",",$clientId);
                    }
                    if($type=="Client" && $clientId==null)
                    {
                        $typeArr=$this->Client->find('all',array('fields'=>array('Client.email')));
                        foreach($typeArr as $value)
                        $toEmailArr[]=$value['Client']['email'];
                        unset($value);
                    }
                    if($type=="Lead" && $leadId!=null)
                    {
                        $toEmailArr=explode(",",$leadId);
                        
                    }
                    if($type=="Lead" && $leadId==null)
                    {
                        $typeArr=$this->Lead->find('all',array('fields'=>array('Lead.email')));
                        foreach($typeArr as $value)
                        $toEmailArr[]=$value['Lead']['email'];
                        unset($value);
                        
                    }
                    if($type=="Agent" && $agentId!=null)
                    {
                       $toEmailArr=explode(",",$agentId);
                        
                    }
                    if($type=="Agent" && $agentId==null)
                    {
                        $typeArr=$this->Agent->find('all',array('fields'=>array('Agent.email')));
                        foreach($typeArr as $value)
                        $toEmailArr[]=$value['Agent']['email'];
                        unset($value);                        
                    }
                    if($type=="Any")
                    {
                        $toEmailArr=explode(",",$anyEmail);
                        
                    }
                    if($toEmailArr)
                    {
                        foreach($toEmailArr as $toEmail)
                        {
                            if($toEmail)
                            {
                                $Email = new CakeEmail();
                                $Email->transport($this->emailSettype);
                                if($this->emailSettype=="Smtp")
                                $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
                                $Email->from(array($this->siteEmail =>$this->siteName));
                                $Email->to($toEmail);
                                $Email->template('default');
                                $Email->emailFormat('html');
                                $Email->subject($subject);
                                $Email->send($message);
                            }
                        }
                        $this->Session->setFlash(__('Email has been sent.'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    else
                    {
                        $this->Session->setFlash(__('No email to send!'),'flash',array('alert'=>'danger'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function clientsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Client');
        $term = $this->request->query['q'];
        $users = $this->Client->find('all',array('conditions' => array('Client.name LIKE' => '%'.$term.'%','Client.email <>'=>'')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = $user['Client']['email'];
            $result[$key]['text'] = $user['Client']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function leadsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Lead');
        $term = $this->request->query['q'];
        $users = $this->Lead->find('all',array('joins'=>array(array('table'=>'clients','alias'=>'Client','type'=>'LEFT','conditions'=>array('Lead.client_id=Client.id'))),
                                               'fields'=>array('Client.name','Client.email'),
                                               'conditions' => array('Client.name LIKE' => '%'.$term.'%','Client.email <>'=>'')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] =   $user['Client']['email'];
            $result[$key]['text'] = $user['Client']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function agentsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Agent');
        $term = $this->request->query['q'];
        $users = $this->Agent->find('all',array('conditions' => array('Agent.name LIKE' => '%'.$term.'%','Agent.ugroup_id'=>2,'Agent.email <>'=>'')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = $user['Agent']['email'];
            $result[$key]['text'] = $user['Agent']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
}
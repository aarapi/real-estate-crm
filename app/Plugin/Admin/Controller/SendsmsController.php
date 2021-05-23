<?php
ini_set('max_execution_time', 900);
class SendsmsController extends AdminAppController
{
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index()
    {
        $this->loadModel('Smssetting');
        $this->loadModel('Smstemplate');
        $this->loadModel('Client');
        $this->loadModel('Lead');
        $this->loadModel('Agent');
        $this->set('smsTemplate',$this->Smstemplate->find('list',array('fields'=>array('description','name'),'conditions'=>array('status'=>'Published','type'=>NULL),'order'=>array('name'=>'asc'))));
        $smsSettingArr=$this->Smssetting->findById(1);
        if($this->request->is('post'))
        {
            try
            {
                $type=$this->request->data['Sendsms']['type'];
                $emailTemplate=$this->request->data['Sendsms']['sms_template'];
                $clientId=$this->request->data['Sendsms']['client_id'];
                $leadId=$this->request->data['Sendsms']['lead_id'];
                $agentId=$this->request->data['Sendsms']['agent_id'];
                $anySms=$this->request->data['Sendsms']['any_sms'];
                $message=$this->request->data['Sendsms']['message'];
                if($type==null)
                {
                    $this->Session->setFlash(__('Please select any type in the list.'),'flash',array('alert'=>'danger'));
                }
                elseif($type=='Any' && $anySms==null)
                {
                    $this->Session->setFlash(__('Please type any email.'),'flash',array('alert'=>'danger'));
                }
                else
                {
                    $toSmsArr=null;
                    if($type=="Client" && $clientId!=null)
                    {
                        $toSmsArr=explode(",",$clientId);
                    }
                    if($type=="Client" && $clientId==null)
                    {
                        $typeArr=$this->Client->find('all',array('fields'=>array('Client.phone')));
                        foreach($typeArr as $value)
                        $toSmsArr[]=$value['Client']['phone'];
                        unset($value);
                    }
                    if($type=="Lead" && $leadId!=null)
                    {
                        $toSmsArr=explode(",",$leadId);
                        
                    }
                    if($type=="Lead" && $leadId==null)
                    {
                        $typeArr=$this->Lead->find('all',array('fields'=>array('Lead.phone')));
                        foreach($typeArr as $value)
                        $toSmsArr[]=$value['Lead']['phone'];
                        unset($value);
                        
                    }
                    if($type=="Agent" && $agentId!=null)
                    {
                       $toSmsArr=explode(",",$agentId);
                        
                    }
                    if($type=="Agent" && $agentId==null)
                    {
                        $typeArr=$this->Agent->find('all',array('fields'=>array('Agent.mobile')));
                        foreach($typeArr as $value)
                        $toSmsArr[]=$value['Agent']['mobile'];
                        unset($value);                        
                    }
                    if($type=="Any")
                    {
                        $toSmsArr=explode(",",$anySms);
                        
                    }
                    if($toSmsArr)
                    {
                        foreach($toSmsArr as $toSms)
                        {
                            if($toSms)
                            {
                                $this->CustomFunction->sendSms($toSms,$message,$smsSettingArr);
                            }
                        }
                        $this->Session->setFlash(__('Sms has been sent.'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                    else
                    {
                        $this->Session->setFlash(__('No sms to send!'),'flash',array('alert'=>'danger'));
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
        $users = $this->Client->find('all',array('conditions' => array('Client.name LIKE' => '%'.$term.'%','Client.mobile !=' =>'')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = $user['Client']['mobile'];
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
                                               'fields'=>array('Client.name','Client.mobile'),
                                               'conditions' => array('Client.name LIKE' => '%'.$term.'%','Client.mobile !=' =>'')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] =   $user['Client']['mobile'];
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
        $users = $this->Agent->find('all',array('conditions' => array('Agent.name LIKE' => '%'.$term.'%','Agent.ugroup_id'=>2,'Agent.mobile <>'=>'')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = $user['Agent']['mobile'];
            $result[$key]['text'] = $user['Agent']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
}
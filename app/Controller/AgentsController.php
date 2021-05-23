<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 300);

class AgentsController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg','CustomFunction');
    public $presetVars = true;
    var $paginate = array('joins'=>array(array('table'=>'ugroups','alias'=>'Ugroup','type'=>'LEFT','conditions'=>array('Ugroup.id=Agent.ugroup_id')),
                                         array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Property.user_id=Agent.id'))),
                          'page'=>1,'order'=>array('Agent.name'=>'asc'),'group'=>array('Agent.id'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
	$this->Agent->virtualFields= array('total_count' => 'Count(Property.id)');
        $this->Paginator->settings['fields']=array('Agent.*','total_count');
        $this->Paginator->settings['conditions'] = array('Ugroup.id'=>2);
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('agent', $this->Paginator->paginate());
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function view($id=null)
    {  
        $this->loadModel('User');
        $post = $this->User->findById($id);
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash', array('alert'=> 'danger'));
            $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
        }
        $agent = $this->User->find('all',array('conditions'=>array('User.id'=>$id),'fields'=>array('User.*')));
        $agent  =array_shift($agent);
        $this->set('agent',$agent);
	$this->loadModel('Property');
	$allProperty=$this->Property->find('all',array('order'=>array('Property.id'=>'desc'),'limit'=>5));
	$this->set('allProperty',$allProperty);
    }
    public function mail($id=null)
    {
	try
	{
	    $this->loadModel('User');
	    $post = $this->User->findById($id);
	    $email=$post['User']['email'];
	    if(!$post)
	    {
		$this->Session->setFlash(__('Invalid Post'),'flash', array('alert'=> 'danger'));
		$this->redirect(array('controller' => 'Agents', 'action' => 'index'));
	    }       
	    $message='<p>'.__('Name').': '.$this->request->data['name'].'</p>'.
	    '<p>'.__('Email').': '.$this->request->data['email'].'</p>'.
	    '<p>'.__('Subject').': '.$this->request->data['subject'].'</p>'.
	    '<p>'.__('Message').': '.$this->request->data['message'].'</p>';
	    $Email = new CakeEmail();
	    $Email->transport($this->emailSettype);
	    if($this->emailSettype=="Smtp")
	    $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
	    $Email->from(array($this->siteEmail =>$this->siteName));
	    $Email->to($email);
	    $Email->template('default');
	    $Email->emailFormat('html');
	    $Email->subject($this->request->data['subject']);
	    $Email->send($message);
	    /* End Email */
	    $this->Session->setFlash('E-mail successfully sent','flash',array('alert'=>'success'));
	    return $this->redirect(array('action' => 'view/',$id));           
	}
	catch(Exception $e)
	{
	    $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
	    return $this->redirect(array('action' => 'view/',$id));
	}
    }
}
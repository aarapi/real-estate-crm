<?php
App::uses('CakeTime', 'Utility');
class LeadsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Lead.id'=>'desc'));
    public function index($id=null)
    {
        $condition=$this->CustomFunction->userWisePermission($id,$this->luserId,$this->userType,$this->agencyId,'Lead.project_id','Lead.user_id');
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Lead->parseCriteria($this->Prg->parsedParams()),$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Lead', $this->Paginator->paginate());
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function propertysearch()
    {
        $this->autoRender = false;
	//$this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Property');
        $term = $this->request->query['q'];
        $cond=array();
        if($this->request->query['q1'])
        {
            $type=$this->request->query['q1'];
            $cond[]=array('Property.type_id' => $type);
        }
	if(isset($this->request->query['q2']) && strlen($this->request->query['q2'])>0)
        {
            $cond[]=array('Property.project_id' => $this->request->query['q2']);
        }
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Property.project_id');
        $users = $this->Property->find('all',array('conditions' => array('Property.name LIKE' => '%'.$term.'%','Property.status'=>'Available',$cond,$condition)));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Property']['id'];
            $result[$key]['text'] = $user['Property']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function clientsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Client');
        $term = $this->request->query['q'];
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Client.project_id');
        $users = $this->Client->find('all',array('fields'=>array('Client.id','Client.name'),'conditions' => array('Client.name LIKE' => '%'.$term.'%',$condition)));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Client']['id'];
            $result[$key]['text'] = $user['Client']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function add()
    {
        $this->loadModel('Property');
        $this->loadModel('Project');
        $this->loadModel('Type');
        $this->loadModel('Status');
        $this->loadModel('User');
        //$this->set('propertyId',$this->Property->find('list',array('fields'=>array('id','name'))));
	$this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('type',$this->Type->find('list'));
        $this->set('status',$this->Status->find('list',array('order'=>array('Status.name'=>'asc'))));
	$this->set('agencyId',$this->agencyId);
	$this->set('luserId',$this->luserId);
	$projectId=null;
	if($this->userType=='AGY'){
	    $this->set('agentList',$this->User->find('list',array('conditions'=>array('User.project_id'=>$this->agencyId,'User.ugroup_id'=>2))));		    
	}
	if ($this->request->is('post'))
        {
            $this->Lead->create();
            if($this->userType=='AGT' || $this->userType=='AGY'){
		$this->request->data['Lead']['project_id']=$this->agencyId;		    
	    }
	    if($this->userType=='AGT')
	    $this->request->data['Lead']['user_id']=$this->luserId;
	    try
            {
                if ($this->Lead->save($this->request->data))
                {
                    $this->Session->setFlash(__('Lead has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Please Select Property Name'),'flash',array('alert'=>'danger'));
            }
	    $projectId=$this->request->data['Lead']['project_id'];
        }
	$this->set('agentName',$this->User->find('list',array('conditions'=>array('User.project_id'=>$projectId,'User.ugroup_id'=>2))));
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
	$this->loadModel('User');
        $this->set('agencyId',$this->agencyId);
	foreach($ids as $k=>$id)
        {
            $k++;
            $post[$k]=$this->Lead->findByid($id);
            $this->set("agentName$k", $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('project_id'=>$post[$k]['Lead']['project_id'],'User.ugroup_id'=>2),'order'=>array('User.name'=>'asc'))));
        }
        $this->set('Lead',$post);
        if($this->userType=='AGY'){
	    $this->set('agentList',$this->User->find('list',array('conditions'=>array('User.project_id'=>$this->agencyId,'User.ugroup_id'=>2))));		    
	}
	if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->loadModel('Type');
        $this->loadModel('Project');
        $this->loadModel('Status');
        $this->set('type',$this->Type->find('list'));
        $this->set('status',$this->Status->find('list'));
        $this->set('agency',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        if ($this->request->is(array('post', 'put')))
        {
            $this->Lead->id = $id;
            try
            {
                if ($this->Lead->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Lead has been updated.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Please Select Client Name & Property Name.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        if ($this->request->is('post'))
        {
            foreach($this->data['Lead']['id'] as $key => $value)
            {
                $this->Lead->delete($value);
            }
            $this->Session->setFlash(__('Lead has been deleted.'),'flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Lead->findById($id);
        $this->set('post',$post);
    }
}

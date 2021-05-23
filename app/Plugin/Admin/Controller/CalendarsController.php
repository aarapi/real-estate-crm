<?php
class CalendarsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Calendar.id'=>'desc'));
    public function beforeFilter()
    {
	parent::beforeFilter();
	$this->repeatTypeArr=array('WEE'=>__('Weekly'),'MON'=>__('Monthly'),'ANU'=>__('Annually'));
    }
    public function index()
    {
        $condition=$this->CustomFunction->userWisePermission(null,$this->luserId,$this->userType,$this->agencyId,'User.project_id','Calendar.user_id');
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($condition,$this->Calendar->parseCriteria($this->Prg->parsedParams()));
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Calendar', $this->Paginator->paginate());
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        $this->loadModel('User');
	if($this->userType=='AGY'){
	    $this->set('agentList',$this->User->find('list',array('conditions'=>array('User.project_id'=>$this->agencyId,'User.ugroup_id'=>2))));		    
	}
	$this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('luserId',$this->luserId);
	$projectId=null;
	if ($this->request->is('post'))
        {
	    $isSave=true;
            $this->Calendar->create();
            try
            {
		if($this->userType=='AGT')
		$this->request->data['Lead']['user_id']=$this->luserId;
		if($this->request->data['Calendar']['repeat'])
		{
		    if(!$this->request->data['Calendar']['repeat_type'] || !$this->request->data['Calendar']['repeat_no'])
		    {
			$isSave=false;
			$this->Session->setFlash(__('Please fill repeat type and number of repeats.'),'flash',array('alert'=>'warning'));
		    }
		}
		if($isSave)
		{
		    if ($this->Calendar->save($this->request->data))
		    {
			$this->Session->setFlash(__('Calendar entry has been saved.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('action' => 'add'));
		    }
		}
		$projectId=$this->request->data['Lead']['project_id'];
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post','flash'),array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
	$this->set('agentName',$this->User->find('list',array('conditions'=>array('User.project_id'=>$projectId,'User.ugroup_id'=>2))));
	$this->set('repeatTypeArr',$this->repeatTypeArr);
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
	foreach($ids as $k=>$ide)
        {
	    $k++;
            $post[$k]=$this->Calendar->findByid($ide);
	    $this->set("agentName$k", $this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('project_id'=>$post[$k]['User']['project_id'],'User.ugroup_id'=>2),'order'=>array('User.name'=>'asc'))));
        }
        $this->set('Calendar',$post);
        if($this->userType=='AGY'){
	    $this->set('agentList',$this->User->find('list',array('conditions'=>array('User.project_id'=>$this->agencyId,'User.ugroup_id'=>2))));		    
	}
	if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('agency',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
		$isSave=true;
		foreach($this->request->data as $j=>$value)
		{
		    if($value['Calendar']['is_repeat'])
		    {
			if(!$value['Calendar']['repeat_type'] || !$value['Calendar']['repeat_no'])
			{
			    $isSave=false;
			    $this->Session->setFlash(__('Please fill repeat type and number of repeats.'),'flash',array('alert'=>'warning'));
			}
		    }
		}
		if($isSave)
		{
		    if ($this->Calendar->saveAll($this->request->data))
		    {
			$this->Session->setFlash(__('Calendar entry has been updated.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('action' => 'index'));
		    }
		}
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
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
	$this->set('repeatTypeArr',$this->repeatTypeArr);
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Calendar']['id'] as $key => $value)
                {
                    $this->Calendar->delete($value);
                }
                $this->Session->setFlash(__('Calendar has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Calendar->findById($id);
        $this->set('post',$post);
	$this->set('repeatTypeArr',$this->repeatTypeArr);
    }
}

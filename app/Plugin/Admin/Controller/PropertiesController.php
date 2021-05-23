<?php
class PropertiesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg','CustomFunction');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Property.id'=>'desc'));
    public function index($id=null)
    {
	$this->loadModel('Contract');
	$this->loadModel('Location');
	$this->loadModel('Type');
	$condition=array();
	if(isset($this->params['named']['type']) && strlen($this->params['named']['type'])>0)
	{
	    $condition[]=array('Property.type_id'=>$this->params['named']['type']);
	}
	if(isset($this->params['named']['contract']) && strlen($this->params['named']['contract'])>0)
	{
	    $condition[]=array('Property.contract_id'=>$this->params['named']['contract']);
	}
	if(isset($this->params['named']['location']) && strlen($this->params['named']['location'])>0)
	{
	    $condition[]=array('OR'=>array(array('Location.'.'name'.' LIKE'=>"%".$this->params['named']['location']."%"),
					   array('Property.'.'address'.' LIKE'=>"%".$this->params['named']['location']."%"),
					   ));
	}
	if(isset($this->params['named']['general']) && strlen($this->params['named']['general'])>0)
	{
	    $condition[]=array('OR'=>array(array('Property.'.'address'.' LIKE'=>"%".$this->params['named']['general']."%"),
					   array('Property.'.'name'.' LIKE'=>"%".$this->params['named']['general']."%"),
					   array('Property.uniq_id'=>$this->params['named']['general']),
					   array('Property.'.'description'.' LIKE'=>"%".$this->params['named']['general']."%")));
	}
	if(isset($this->params['named']['start_price']) && strlen($this->params['named']['start_price'])>0 && isset($this->params['named']['end_price']) && strlen($this->params['named']['end_price'])>0)
	{
	    $startDate=$this->params['named']['start_price'];
	    $endDate=$this->params['named']['end_price'];
	    $condition[]=array('Property.price BETWEEN ? AND ?'=>array($startDate,$endDate));
	}
	if(isset($this->params['named']['publish']) && strlen($this->params['named']['publish'])>0)
	{
	    $condition[]=array('published'=>$this->params['named']['publish']);
	}
	if(isset($this->params['named']['bedroom']) && strlen($this->params['named']['bedroom'])>0)
	{
	    $condition[]=array('bedroom >='=>$this->params['named']['bedroom']);
	}
	if(isset($this->params['named']['area']) && strlen($this->params['named']['area'])>0)
	{
	    $condition[]=array('area >='=>$this->params['named']['area']);
	}
	if(isset($this->params['named']['bathroom']) && strlen($this->params['named']['bathroom'])>0)
	{
	    $condition[]=array('bathroom >='=>$this->params['named']['bathroom']);
	}
	if(isset($this->params['named']['uniq_id']) && strlen($this->params['named']['uniq_id'])>0)
	{
	    $condition[]=array('uniq_id'=>$this->params['named']['uniq_id']);
	}
	if(isset($this->params['named']['agent']) && strlen($this->params['named']['agent'])>0)
	{
	    $condition[]=array('user_id'=>$this->params['named']['agent']);
	}
	if(isset($this->params['named']['agency']) && strlen($this->params['named']['agency'])>0)
	{
	    $condition[]=array('Property.project_id'=>$this->params['named']['agency']);
	}
	$this->set('contract',$this->Contract->find('list'));
	$this->set('location',$this->Location->find('list'));
	$this->set('type',$this->Type->find('list'));
        $condition[]=$this->CustomFunction->agencyWisePermission($id,$this->userType,$this->agencyId,'Property.project_id');
	$this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Property->parseCriteria($this->Prg->parsedParams()),$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Property', $this->Paginator->paginate());
	$this->set('luserId',$this->luserId);
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }	
    }    
    public function add()
    {
        $this->loadModel('Feature');
        $this->set('feature',$this->Feature->find('list'));
        $this->loadModel('Type');
        $this->set('type',$this->Type->find('list'));
        $this->loadModel('Contract');
        $this->set('contract',$this->Contract->find('list'));
        $this->loadModel('Project');
        $this->set('agency',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->loadModel('Location');
        $this->set('location',$this->Location->find('list'));
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
	$projectId=null;
        if ($this->request->is('post'))
        {
            $this->Property->create();
            try
            {
                $gId=$this->CustomFunction->generate_rand();
                $this->loadModel('PropertiesPhoto');
                $this->loadModel('PropertiesDocument');
                $this->loadModel('PropertiesFloorplan');
                $this->loadModel('PropertiesFeature');
                $this->request->data['Property']['uniq_id']=$this->siteShort.$gId;
		if($this->userType=='AGT' || $this->userType=='AGY'){
		    $this->request->data['Property']['project_id']=$this->agencyId;		    
		}
		$this->request->data['Property']['user_id']=$this->luserId;
                if ($this->Property->save($this->request->data))
                {
                    $prPhoto=array();
                    $dirName="propertiesphotos";
                    foreach($this->request->data['Pr']['PropertiesPhoto'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName,200,200);
                        if(strlen($fileName)>0)
                        {
                            $prPhoto[]=(array('property_id'=>$this->Property->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $prDocument=array();
                    $dirName="propertiesdocuments";
                    foreach($this->request->data['Pr']['PropertiesDocument'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName);
                        if(strlen($fileName)>0)
                        {
                            $prDocument[]=(array('property_id'=>$this->Property->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $prFloorplan=array();
                    $dirName="propertiesfloorplans";
                    foreach($this->request->data['Pr']['PropertiesFloorplan'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName,200,200);
                        if(strlen($fileName)>0)
                        {
                            $prFloorplan[]=(array('property_id'=>$this->Property->id,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $prFeature=array();
                    foreach($this->request->data['PropertiesFeature']['feature'] as $featureId)
                    {
			if($featureId!="multiselect-all"){
			    $prFeature[]=(array('property_id'=>$this->Property->id,'feature_id'=>$featureId));
			}
                    }                    
                    $this->PropertiesPhoto->saveAll($prPhoto);
                    $this->PropertiesDocument->saveAll($prDocument);                    
                    $this->PropertiesFloorplan->saveAll($prFloorplan);                    
                    $this->PropertiesFeature->saveAll($prFeature);                    
                    $this->Session->setFlash(__('Property has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('controller'=>'Properties','action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e,'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
	    $projectId=$this->request->data['Property']['project_id'];
        }
	$this->loadModel('User');
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
	foreach($ids as $k=>$id)
	{
	    $k++;
	    $post[$k]=$this->Property->findByid($id);
	    if($this->userType=='AGT') {
		if($post[$k]['Property']['user_id']!=$this->luserId) {
		    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
	    }
	    elseif($this->userType=='AGY') {
		if($post[$k]['Property']['project_id']!=$this->agencyId) {
		    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
	    }
	}
        $this->set('Property',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
	$propertiesFeature=null;
        $this->loadModel('Feature');
        $this->set('feature',$this->Feature->find('list'));
        $this->loadModel('Type');
        $this->set('type',$this->Type->find('list'));
        $this->loadModel('Contract');
        $this->set('contract',$this->Contract->find('list'));
        $this->loadModel('Project');
        $this->set('agency',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->loadModel('Location');
        $this->set('location',$this->Location->find('list'));
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        $this->loadModel('Feature');
        $this->set('featureId', $this->Feature->find('list',array('order'=>array('Feature.name'=>'asc'))));
        if ($this->request->is(array('post', 'put')))
        {
	    if(isset($this->request->data['multiselect'])) {
                array_shift($this->request->data);
                }
	    try
            {
                $isFeatureSave=false;
                if ($this->Property->saveAll($this->request->data))
                {
                    $this->loadModel('PropertiesFeature');
                    foreach($this->request->data as $k=> $value)
                    {
			$propertyId=$value['Property']['id'];
			if(is_array($value['PropertyFeature']['feature']))
			{
			    $isFeatureSave=true;
			    $this->PropertiesFeature->deleteAll(array('PropertiesFeature.property_id'=>$propertyId));
			    foreach($value['PropertyFeature']['feature'] as $featureId)
			    {
				if(is_numeric($featureId))
				$propertiesFeature[]=array('property_id'=>$propertyId,'feature_id'=>$featureId);
			    }
			}
			else
			{
			    $this->PropertiesFeature->deleteAll(array('PropertiesFeature.property_id'=>$propertyId));
			}
                    }
		    if($isFeatureSave)
		    {
			$this->PropertiesFeature->create();
			$this->PropertiesFeature->saveAll($propertiesFeature);
		    }
                    $this->Session->setFlash(__('Property has been updated.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }                
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Property']['id'] as $key => $value)
                {
		    if($value > 0) {
			$prop[$key]=$this->Property->findByid($value);
			if($this->userType=='AGT') {
			    if($prop[$key]['Property']['user_id']!=$this->luserId) {
				$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
				return $this->redirect(array('action' => 'index'));
			    }
			}
			elseif($this->userType=='AGY') {
			    if($prop[$key]['Property']['project_id']!=$this->agencyId) {
				$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
				return $this->redirect(array('action' => 'index'));
			    }
			}
			$this->Property->delete($value);
		    }
                }
		unset($prop);
                $this->Session->setFlash(__('Property has been deleted'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please Delete Deal First.'),'flash',array('alert'=>'danger'));
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
        $post = $this->Property->findById($id);
        $this->set('post',$post);
    }
    public function featured($id=null,$mode=null)
    {
        if (!$id || !$mode)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index',$propertyId));
        }
        $post = $this->Property->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index',$propertyId));
        }
        $this->Property->id = $id;
        try
        {
            $published="";
            if($mode=="Yes")
            $published="No";
            else
            $published="Yes";
            $userArr=array('id'=>$id,'bathroom'=>$post['Property']['bathroom'],'featured'=>$published);
            $this->Property->unbindValidation('keep', array('bathroom'), true);
            if ($this->Property->save($userArr))
            {
                $this->Session->setFlash(__("Record updated successfully"),'flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Something wrong.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));            
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Something wrong.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));            
        }
    }
    public function published($id=null,$mode=null)
    {
        if (!$id || !$mode)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index',$propertyId));
        }
        $post = $this->Property->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index',$propertyId));
        }
        $this->Property->id = $id;
        try
        {
            $published="";
            if($mode=="Yes")
            $published="No";
            else
            $published="Yes";
            $userArr=array('id'=>$id,'bathroom'=>$post['Property']['bathroom'],'published'=>$published);
            $this->Property->unbindValidation('keep', array('bathroom'), true);
            if ($this->Property->save($userArr))
            {
                $this->Session->setFlash(__("Record updated successfully"),'flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Something wrong.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));            
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Something wrong.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));            
        }
    }
}
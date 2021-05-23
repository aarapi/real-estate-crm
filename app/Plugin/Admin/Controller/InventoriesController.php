<?php
App::uses('CakeTime', 'Utility');
class InventoriesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Inventory.id'=>'desc'));
    public function index($id=null)
    {
        $condition=$this->CustomFunction->agencyWisePermission($id,$this->userType,$this->agencyId,'Inventory.project_id');
        $this->Prg->commonProcess();
        $this->Inventory->virtualFields= array('qty' => 'SELECT SUM(InventoriesBalance.qty) as Inventories__qty FROM `inventories_balances` as `InventoriesBalance` WHERE `InventoriesBalance`.`inventory_id`=`Inventory`.`id`');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Inventory->parseCriteria($this->Prg->parsedParams()),$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Inventory', $this->Paginator->paginate());      
		if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('agencyId',$this->agencyId);
	$this->loadModel('Vendor');
        $this->set('vendorList',$this->Vendor->find('list',array('conditions'=>array('project_id'=>$this->agencyId))));
        $this->set('agencyId',$this->agencyId);
	$this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->set('date',CakeTime::format($this->dtFormat,CakeTime::convert(time(),$this->siteTimezone)));
        $projectId=array();
	if ($this->request->is('post'))
        {
            $this->Inventory->create();
            try
            {
                if ($this->Inventory->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Inventory has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
	    $projectId=$this->request->data['Inventory']['project_id'];
        }
	$this->set('vendorName',$this->Vendor->find('list',array('conditions'=>array('Vendor.project_id'=>$projectId))));
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $this->loadModel('Vendor');
        $post=array();
        foreach($ids as $k=>$id)
        {$k++;
            $post[$k]=$this->Inventory->findByid($id);
	    $this->set("venderName$k", $this->Vendor->find('list',array('fields'=>array('id','name'),'conditions'=>array('project_id'=>$post[$k]['Inventory']['project_id']),'order'=>array('Vendor.name'=>'asc'))));
        }
        $this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->set('agencyId',$this->agencyId);
	$this->set('vendorList',$this->Vendor->find('list',array('conditions'=>array('project_id'=>$this->agencyId))));
        $this->set('Inventory',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Inventory->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Your Inventories has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
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
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Inventory']['id'] as $key => $value)
                {
                    $this->Inventory->delete($value);
                }
                $this->Session->setFlash(__('Your Inventories has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}

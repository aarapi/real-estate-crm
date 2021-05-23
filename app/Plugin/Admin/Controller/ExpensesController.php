<?php
App::uses('CakeTime', 'Utility');
class ExpensesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Expense.id'=>'desc'));
    public function index($id=null)
    {
        $condition=$this->CustomFunction->agencyWisePermission($id,$this->userType,$this->agencyId,'Expense.project_id');
        $this->Prg->commonProcess();
        $this->Expense->virtualFields= array('payment' => 'SELECT SUM(ExpensesPayment.amount) as Expenses__payment FROM `expenses_payments` as `ExpensesPayment` WHERE `ExpensesPayment`.`expense_id`=`Expense`.`id`');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Expense->parseCriteria($this->Prg->parsedParams()),$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Expense', $this->Paginator->paginate());
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        $this->loadModel('Project');
        $projectId=array();
	$this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        $this->loadModel('Vendor');
	$this->set('vendorList',$this->Vendor->find('list',array('conditions'=>array('project_id'=>$this->agencyId))));
        $this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->set('date',CakeTime::format($this->dtFormat,CakeTime::convert(time(),$this->siteTimezone)));
        $this->set('agencyId',$this->agencyId);
	if ($this->request->is('post'))
        {
            $this->Expense->create();
            try
            {
                if ($this->Expense->save($this->request->data))
                {
                    $this->Session->setFlash(__('Expense has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
	    $projectId=$this->request->data['Expense']['project_id'];
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
        $post=array();
        $this->loadModel('Vendor');
	foreach($ids as $k=>$id)
        {$k++;
            $post[$k]=$this->Expense->findByid($id);
	    $this->set("vendorName$k", $this->Vendor->find('list',array('fields'=>array('id','name'),'conditions'=>array('project_id'=>$post[$k]['Expense']['project_id']),'order'=>array('Vendor.name'=>'asc'))));
        }
        $this->loadModel('ExpenseCategory');
        $this->set('expenseCategory',$this->ExpenseCategory->find('list',array('conditions'=>array('status'=>'Active'))));
        $this->loadModel('Project');
        $this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
	if($this->userType=='AGY')
        $this->set('vendorList',$this->Vendor->find('list',array('conditions'=>array('project_id'=>$this->agencyId))));
        $this->set('Expense',$post);
        $this->set('agencyId',$this->agencyId);
	if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Expense->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Expense has been saved.'),'flash',array('alert'=>'success'));
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
                foreach($this->data['Expense']['id'] as $key => $value)
                {
                    $this->Expense->delete($value);
                }
                $this->Session->setFlash(__('Expense has been deleted.'),'flash',array('alert'=>'success'));
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

<?php
class AwalletHistoriesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
    }
    public function index($id=null)
    {
	$condition=$this->CustomFunction->userWisePermission($id,$this->luserId,$this->userType,$this->agencyId,'AwalletHistory.project_id','AwalletHistory.user_id');
        $conditionAwallet=$this->CustomFunction->userWisePermission($id,$this->luserId,$this->userType,$this->agencyId,'Awallet.project_id','Awallet.user_id');
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
	
        $cond=array();
        if($id)
        $cond=array('user_id'=>$id);
        $this->Paginator->settings['conditions'] = array($this->AwalletHistory->parseCriteria($this->Prg->parsedParams()),$cond,$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->loadModel('Awallet');
        if($cond)
        $this->set('aWallet',$this->Awallet->find('first',array('conditions'=>array($cond,$conditionAwallet))));
        else
        {
            $this->Awallet->virtualFields=array('credit'=>'SUM(credit)','debit'=>'SUM(debit)','balance'=>'SUM(balance)');
            $this->set('aWallet',$this->Awallet->find('first',array('conditions'=>array($cond,$conditionAwallet))));
        }
        $this->set('record', $this->Paginator->paginate());
	$this->set('id',$id);
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function view($id = null)
    {
        $this->layout = null;
        $this->loadModel('DealsPayment');
	$this->loadModel('PlansPayment');
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->DealsPayment->find('first',array('joins'=>array(array('table'=>'deals','alias'=>'Deal','type'=>'LEFT','conditions'=>array('DealsPayment.deal_id=Deal.id')),
                                                                       array('table'=>'clients','alias'=>'Client','type'=>'LEFT','conditions'=>array('Deal.client_id=Client.id')),
                                                                       array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Deal.property_id=Property.id')),
                                                                       array('table'=>'units','alias'=>'Unit','type'=>'LEFT','conditions'=>array('Property.unit_id=Unit.id')),
                                                                       array('table'=>'plans','alias'=>'Plan','type'=>'LEFT','conditions'=>array('Deal.plan_id=Plan.id')),
								       array('table'=>'paymenttypes','alias'=>'Paymenttype','type'=>'LEFT','conditions'=>array('DealsPayment.paymenttype_id=Paymenttype.id')),
                                                                       array('table'=>'plans_payments','alias'=>'PlansPayment','type'=>'LEFT','conditions'=>array('DealsPayment.plans_payment_id=PlansPayment.id'))),
                                                      'fields'=>array('DealsPayment.*','Deal.*','Client.*','Property.*','Unit.*','Plan.*','PlansPayment.*','Paymenttype.*'),
                                                      'conditions'=>array('DealsPayment.id'=>$id)));
        $dealId=$post['Deal']['id'];
        $dueDateArr = $this->PlansPayment->find('first',array('fields'=>array('PlansPayment.*'),
                                                             'conditions'=>array('PlansPayment.deal_id'=>$dealId,'PlansPayment.id >'=>$post['PlansPayment']['id']),
                                                             'order'=>array('PlansPayment.id'=>'asc')));
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if($dueDateArr)
        $dueDate=$dueDateArr['PlansPayment']['date'];
        else
        $dueDate=null;
        $this->set('dueDate',$dueDate);
        $this->set('post',$post);
    }
    
}

<?php
App::uses('CakeTime', 'Utility');
class InvpaidsController extends AdminAppController
{
    public $components = array('Session','Paginator','search-master.Prg');
    public $helpers=array('Paginator','Js'=> array('Jquery'));
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('PlansPayment.payment_date'=>'desc'));
    
    public function index()
    {
        if(isset($this->request->named['isSearch']))
        {
            $requestStartDate=$this->CustomFunction->dateFormatBeforeSave($this->request->named['start_date']);
            $requestEndDate=$this->CustomFunction->dateFormatBeforeSave($this->request->named['end_date']);
            $conditions=array();
            if(strlen($requestStartDate)>0 && strlen($requestEndDate)>0)
            $conditions=array('DealsPayment.payment_date BETWEEN ? AND ?'=>array($requestStartDate,$requestEndDate));            
        }
        else
        {
            $startDate=CakeTime::format('Y-m-01',CakeTime::convert(time(),$this->siteTimezone));
            $endDate=CakeTime::format('Y-m-31',CakeTime::convert(time(),$this->siteTimezone));
            $conditions=array('DealsPayment.payment_date BETWEEN ? AND ?'=>array($startDate,$endDate));
        }
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Property.project_id');
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['fields'] =array('Client.name','Client.phone','Property.name','Invpaid.invoice_no','DealsPayment.total_amount','DealsPayment.payment_date','DealsPayment.tax_amount','DealsPayment.amount','PlansPayment.name');
        $this->Paginator->settings['conditions'] = array($this->Invpaid->parseCriteria($this->Prg->parsedParams()),$conditions,$condition);
		$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('deal', $this->Paginator->paginate());
    	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
	}
}
<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 900);
class InvpastduesController extends AdminAppController
{
    public $components = array('Session','Paginator','search-master.Prg');
    public $helpers=array('NumToWord','Paginator','Js'=> array('Jquery'));
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Client.name'=>'asc'));
    var $fieldIdArr=array('Type.name','Client.id','Client.name','Client.phone','Client.address','Client.email','Property.name','Property.address','Project.name','Deal.id','Deal.plan_id','Deal.invoice_no','Invpastdue.id','Invpastdue.name','Invpastdue.date','Deal.total_amount','Invpastdue.amount');
    public function index()
    {
        if(isset($this->request->named['isSearch']))
        {
            $requestStartDate=$this->CustomFunction->dateFormatBeforeSave($this->request->named['start_date']);
            $requestEndDate=$this->CustomFunction->dateFormatBeforeSave($this->request->named['end_date']);
            $conditions=array();
            if(strlen($requestStartDate)>0 && strlen($requestEndDate)>0)
            $conditions=array('Invpastdue.date BETWEEN ? AND ?'=>array($requestStartDate,$requestEndDate));
        }
        else
        {
            $startDate=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
            $endDate=CakeTime::format('Y-m-31',CakeTime::convert(time(),$this->siteTimezone));
            $conditions=array('Invpastdue.date <='=>$startDate,'Invpastdue.date <='=>$endDate);
        }
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Property.project_id');
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['fields'] = $this->fieldIdArr;
        $this->Paginator->settings['conditions'] = array($this->Invpastdue->parseCriteria($this->Prg->parsedParams()),'DealsPayment.id IS NULL',$conditions,$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('deal', $this->Paginator->paginate());
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function printletter($clientId,$dealId,$plansPaymentId)
    {
        $this->layout=null;
        $deal=$this->Invpastdue->find('first',array('fields'=>$this->fieldIdArr,
                                                    'conditions'=>array('DealsPayment.id IS NULL','Deal.client_id'=>$clientId,'Deal.id'=>$dealId,'Invpastdue.id'=>$plansPaymentId)));
        $this->set('deal',$deal);
    }
    public function deleteall()
    {
        $action=$this->request->data['action'];
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Invpastdue']['id'] as $key => $value)
                {
                    if($value!=0)
                    {
                        $expArr=explode(",",$value);
                        if($action=="Email")
                        $this->sendmail($expArr[0],$expArr[1],$expArr[2]);
                        if($action=="SMS")
                        $this->sendsms($expArr[0],$expArr[1],$expArr[2]);
                    }
                }
                if($action=="Mail")
                $this->Session->setFlash(__('Email has been sent'),'flash',array('alert'=>'success'));
                if($action=="SMS")
                $this->Session->setFlash(__('SMS has been sent'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage,'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function invoicemail($clientId,$dealId,$plansPaymentId)
    {
        $this->sendmail($clientId,$dealId,$plansPaymentId);
        $this->redirect(array('action' => 'index'));
    }
    public function invoicesms($clientId,$dealId,$plansPaymentId)
    {
        $this->sendsms($clientId,$dealId,$plansPaymentId);
        $this->redirect(array('action' => 'index'));
    }
    public function sendmail($clientId,$dealId,$plansPaymentId)
    {
        $this->layout=null;
        try
        {
            $deal=$this->Invpastdue->find('first',array('fields'=>$this->fieldIdArr,
                                                        'conditions'=>array('DealsPayment.id IS NULL','Deal.client_id'=>$clientId,'Deal.id'=>$dealId,'Invpastdue.id'=>$plansPaymentId)));
            $area=array();
            $subject="Demand For Due Payment";
            $email=$deal['Client']['email'];
            $this->loadModel('Emailsetting');
            $emailSettingArr=$this->Emailsetting->findById(1);
            $settingType=$emailSettingArr['Emailsetting']['type'];
            if($email)
            {
                if($this->emailNotification)
                {                          
                    /* Send Email */
                    $Email = new CakeEmail();
                    $Email->transport($this->emailSettype);
                    if($this->emailSettype=="Smtp")
                    $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
                    $Email->from(array($this->siteEmail =>$this->siteName));
                    $Email->to($email);
                    $Email->viewVars(array('deal'=>$deal,'dateSep'=>$this->dateSep,'sysDay'=>$this->sysDay,'sysMonth'=>$this->sysMonth,'sysYear'=>$this->sysYear,'siteAccount'=>$this->siteAccount,'siteOrganization'=>$this->siteOrganization,'contact'=>$this->contact,'currencyName'=>$this->currencyName));
                    $Email->from(array($this->siteEmail =>$this->siteName));
                    $Email->to($email);
                    $Email->template('mailinvoice','default');
                    $Email->emailFormat('html');
                    $Email->subject($subject);
                    $Email->send();
                    $this->Session->setFlash(__('Email has been sent.'),'flash',array('alert'=>'success'));
                    return true;
                    /* End Email */
                }
            }
            else
            {
                $this->Session->setFlash(__('No email to send!'),'flash',array('alert'=>'danger'));
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return false;
        }
    }
    public function sendsms($clientId,$dealId,$plansPaymentId)
    {
        $this->layout=null;
        try
        {
            $deal=$this->Invpastdue->find('first',array('fields'=>$this->fieldIdArr,
                                                       'conditions'=>array('DealsPayment.id IS NULL','Deal.client_id'=>$clientId,'Deal.id'=>$dealId,'Invpastdue.id'=>$plansPaymentId)));
            $mobileNo=$deal['Client']['phone'];$siteName=$this->siteName;
            if($mobileNo)
            {
                if($this->smsNotification)
                {
                    /* Send Sms */
                    $this->loadModel('Smstemplate');
                    $smsTemplateArr=$this->Smstemplate->findByType('IDL');
                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                    {
                        $area=array();
                        $clientName=$deal['Client']['name'];
                        $dueDate=CakeTime::format($this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear,$deal['Invpastdue']['date']);
                        $amount=CakeNumber::format($deal['Invpastdue']['amount']);
                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                        $url="$this->siteDomain";
                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                        $this->Session->setFlash(__('Sms has been sent.'),'flash',array('alert'=>'success'));
                        return true;
                    }
                    /* End Sms */
                }
            }
            else
            {
                $this->Session->setFlash(__('No sms to send!'),'flash',array('alert'=>'danger'));
                return false;
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return false;
        }
    }
}
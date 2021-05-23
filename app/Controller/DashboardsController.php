<?php
App::uses('CakeTime', 'Utility');
App::uses('CakeNumber', 'Utility');
class DashboardsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->userId=$this->userValue['Client']['id'];
    }
    public function index()
    {
        $this->loadModel('DealsPayment');
        $currentDateTime=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        
        $dealsPayment=$this->DealsPayment->find('all',array('fields'=>array('DealsPayment.*','Paymenttype.name'),
                                                            'joins'=>array(array('table'=>'paymenttypes','alias'=>'Paymenttype','type'=>'INNER','conditions'=>array('DealsPayment.paymenttype_id=Paymenttype.id')),
                                                                           array('table'=>'deals','alias'=>'Deal','type'=>'INNER','conditions'=>array('DealsPayment.deal_id=Deal.id'))),
                                                            'conditions'=>array('Deal.client_id'=>$this->userId),
                                                            'order'=>array('id'=>'desc'),
                                                            'limit'=>5));
        $this->set('dealsPayment',$dealsPayment);
    }      
}
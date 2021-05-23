<?php
class MyInvpastduesController extends AppController
{
    public $components = array('Session','search-master.Prg');
    public function index()
    {
        $startDate=CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone));
        $endDate=CakeTime::format('Y-m-31',CakeTime::convert(time(),$this->siteTimezone));
        $deal=$this->MyInvpastdue->find('all',array('fields'=>array('Client.*','Property.*','Project.*','Deal.*','MyInvpastdue.*','Deal.*'),
                                                    'conditions'=>array('DealsPayment.id IS NULL','MyInvpastdue.date <='=>$startDate,'MyInvpastdue.date <='=>$endDate,'Deal.client_id'=>$this->userValue['Client']['id'])));
        $this->set('deal',$deal);
    }    
}
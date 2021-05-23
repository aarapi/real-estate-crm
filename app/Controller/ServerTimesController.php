<?php
App::uses('CakeTime', 'Utility');
class ServerTimesController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        $currentDateTime=CakeTime::format('M j, Y H:i:s O',CakeTime::convert(time(),$this->siteTimezone));
        $this->set('currentDateTime',$currentDateTime);
    }
}

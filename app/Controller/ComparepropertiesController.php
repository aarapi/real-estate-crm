<?php
class ComparepropertiesController extends AppController
{
    var $name="Property";
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','CustomFunction');
    public $presetVars = true;
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->userId=$this->userValue['Client']['id'];
    }
    public function index()
    {
        $conditions=array();
        $compProperty=$this->CustomFunction->readPackage();
        foreach($compProperty as $value)
        {
            $conditions[]=$value;
        }
        unset($value);
        $fProperty=$this->Property->find('all',array('conditions'=>array('Property.id'=>$conditions)));       
        if(!$fProperty)
        {
            $this->Session->setFlash(__('No record found'),'flash', array('alert'=> 'danger'));
        }
        else
        {
            $this->loadModel('Feature');
            $feature=$this->Feature->find('all');
            $this->set('feature',$feature);
        }
        $this->set('fProperty', $fProperty);
        $this->render('/Compareproperties/index');
    }
}
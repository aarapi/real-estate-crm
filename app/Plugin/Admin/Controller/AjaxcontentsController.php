<?php
class AjaxcontentsController extends AppController
{
    public $helpers = array('Html', 'Form');
    public function agent()
    {
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        $this->loadModel('User');
        $agentName=$this->User->find('list',array('conditions'=>array('project_id'=>$id,'User.ugroup_id'=>2),'order'=>array('User.name'=>'asc')));
        $this->set(compact('agentName'));
    }
    public function Vendor()
    {
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        $this->loadModel('Vendor');
        $vendorName=$this->Vendor->find('list',array('conditions'=>array('project_id'=>$id),'order'=>array('Vendor.name'=>'asc')));
        $this->set(compact('vendorName'));
    }
}

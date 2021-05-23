<?php
class MyPaymentsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->userId=$this->userValue['Client']['id'];
    }
    public function index()
    {
        $postArr=$this->MyPayment->find('all',array('joins'=>array(array('table'=>'deals','alias'=>'Deal','type'=>'LEFT','conditions'=>array('MyPayment.deal_id=Deal.id'))),
                                                    'conditions'=>array('Deal.client_id'=>$this->userId),
                                                    'order'=>array('MyPayment.id'=>'desc')));
        $this->set('postArr',$postArr);
    }
    public function printreceipt($id = null)
    {
        $this->layout = null;
        $this->loadModel('PlansPayment');
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->MyPayment->find('first',array('joins'=>array(array('table'=>'deals','alias'=>'Deal','type'=>'LEFT','conditions'=>array('MyPayment.deal_id=Deal.id')),
                                                                       array('table'=>'clients','alias'=>'Client','type'=>'LEFT','conditions'=>array('Deal.client_id=Client.id')),
                                                                       array('table'=>'properties','alias'=>'Property','type'=>'LEFT','conditions'=>array('Deal.property_id=Property.id')),
                                                                       array('table'=>'properties_flats','alias'=>'PropertiesFlat','type'=>'LEFT','conditions'=>array('Deal.properties_flat_id=PropertiesFlat.id')),
                                                                        array('table'=>'units','alias'=>'Unit','type'=>'LEFT','conditions'=>array('PropertiesFlat.unit_id=Unit.id')),
                                                                       array('table'=>'plans','alias'=>'Plan','type'=>'LEFT','conditions'=>array('Deal.plan_id=Plan.id')),
                                                                       array('table'=>'plans_payments','alias'=>'PlansPayment','type'=>'LEFT','conditions'=>array('MyPayment.plans_payment_id=PlansPayment.id'))),
                                                      'fields'=>array('MyPayment.*','Deal.*','Client.*','Property.*','PropertiesFlat.*','Unit.*','Plan.*','PlansPayment.*','Paymenttype.*'),
                                                      'conditions'=>array('MyPayment.id'=>$id,'Deal.client_id'=>$this->userId)));
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
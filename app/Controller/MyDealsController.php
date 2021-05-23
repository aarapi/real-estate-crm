<?php
class MyDealsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->userId=$this->userValue['Client']['id'];
    }
    public function index()
    {
        $postArr=$this->MyDeal->find('all',array('conditions'=>array('MyDeal.client_id'=>$this->userId),
                                                 'order'=>array('MyDeal.id'=>'desc')));
        $this->set('postArr',$postArr);
    }
    public function view($id = null)
    {
        $this->layout = null;        
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->MyDeal->find('first',array('conditions'=>array('MyDeal.id'=>$id,'MyDeal.client_id'=>$this->userId)));
        $this->set('post',$post);
    }
    public function printinvoice($id = null)
    {
        $this->layout = null;
        $this->loadModel('PlansPayment');
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('DealsPayment');
        $post = $this->MyDeal->findByIdAndClientId($id,$this->userId);
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('plansPaymentArr',$this->PlansPayment->find('all',array('conditions'=>array('PlansPayment.deal_id'=>$id))));
        $this->set('post',$post);
    }
}
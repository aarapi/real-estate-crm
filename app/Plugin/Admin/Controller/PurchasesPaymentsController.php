<?php
App::uses('CakeTime', 'Utility');
class PurchasesPaymentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Purchases','action' => 'index'));            
        }
        $this->loadModel('Purchase');
        $purchase=$this->Purchase->findById($id);
        if(!$purchase)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Purchases','action' => 'index'));  
        }
        $purchasePayment=$this->PurchasesPayment->findAllByPurchaseId($id,array(),array('PurchasesPayment.date'=>'asc'));
        $this->set('purchasePayment',$purchasePayment);
        $this->set('purchaseId',$id);
        $this->set('purchase',$purchase);
    }    
    public function add($id=null)
    {
        $this->loadModel('Paymenttype');
        $this->loadModel('Purchase');
        $this->set('paymentType',$this->Paymenttype->find('list',array('fields'=>array('id','name'))));
        $this->set('date',CakeTime::format('Y-m-d',CakeTime::convert(time(),$this->siteTimezone)));
        if ($this->request->is('post'))
        {
            $purchaseId=$id;
            try
            {
                $this->PurchasesPayment->create();
                $this->request->data['PurchasesPayment']['purchase_id']=$purchaseId;
                if ($this->PurchasesPayment->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Payment has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "add/$purchaseId"));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            }
        }
        $this->set('purchaseId',$id);
    }
    public function edit($id = null)
    {
        $this->loadModel('Paymenttype');
        $this->set('paymentType',$this->Paymenttype->find('list',array('fields'=>array('id','name'))));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->PurchasesPayment->findByid($id);
        }
        $this->set('PurchasesPayment',$post);
        $purchaseId=$post[0]['PurchasesPayment']['purchase_id'];
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $purchaseId=$this->data['purchaseId'];
            unset($this->request->data['purchaseId']);
            try
            {
                if ($this->PurchasesPayment->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Your Payment has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$purchaseId"));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
        $this->set('purchaseId',$purchaseId);
    }
    public function deleteall()
    {
        $purchaseId=$this->data['purchaseId'];
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['PurchasesPayment']['id'] as $key => $value)
                {
                    $this->PurchasesPayment->delete($value);
                }
                $this->Session->setFlash(__('Your Payment has been deleted.'),'flash',array('alert'=>'success'));                
            }
            $this->redirect(array('action' => "index/$purchaseId"));
            $this->set('purchaseId',$purchaseId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => "index/$purchaseId"));
        }
    }
}

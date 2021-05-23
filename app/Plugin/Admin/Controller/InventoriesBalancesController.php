<?php
App::uses('CakeTime', 'Utility');
class InventoriesBalancesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Expenses','action' => 'index'));            
        }
        $this->loadModel('Inventory');
        $expense=$this->Inventory->find('first',array('joins'=>array(array('table'=>'vendors','alias'=>'Vendor','type'=>'LEFT','conditions'=>array('Vendor.id=Inventory.vendor_id'))),
                                                    'fields'=>array('Vendor.name','Inventory.invoice_no','Inventory.invoice_date','Inventory.invoice_qty'),
                                                    'conditions'=>array('Inventory.id'=>$id)));
        if(!$expense)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Expenses','action' => 'index'));  
        }
        $expensePayment=$this->InventoriesBalance->findAllByInventoryId($id,array(),array('InventoriesBalance.date'=>'asc'));
        $this->set('expensePayment',$expensePayment);
        $this->set('inventoryId',$id);
        $this->set('expense',$expense);
    }    
    public function add($id=null)
    {
        $this->loadModel('Expense');
        $this->set('date',CakeTime::format($this->dtFormat,CakeTime::convert(time(),$this->siteTimezone)));
        if ($this->request->is('post'))
        {
            $inventoryId=$id;
            try
            {
                $this->InventoriesBalance->create();
                $this->request->data['InventoriesBalance']['inventory_id']=$inventoryId;
                if ($this->InventoriesBalance->save($this->request->data))
                {
                    $this->Session->setFlash(__('Entry has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "add/$inventoryId"));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            }
        }
        $this->set('inventoryId',$id);
    }
     public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->InventoriesBalance->findById($id);
        }
        $this->set('InventoriesBalance',$post);
        $inventoryId=$post[0]['InventoriesBalance']['inventory_id'];
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $inventoryId=$this->data['inventoryId'];
            unset($this->request->data['inventoryId']);
            try
            {
                if ($this->InventoriesBalance->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Entries has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$inventoryId"));
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
        $this->set('inventoryId',$inventoryId);
    }
    public function deleteall()
    {
        $inventoryId=$this->data['inventoryId'];
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['InventoriesBalance']['id'] as $key => $value)
                {
                    $this->InventoriesBalance->delete($value);
                }
                $this->Session->setFlash(__('Entries has been deleted.'),'flash',array('alert'=>'success'));                
            }
            $this->redirect(array('action' => "index/$inventoryId"));
            $this->set('inventoryId',$inventoryId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => "index/$inventoryId"));
        }
    }
}

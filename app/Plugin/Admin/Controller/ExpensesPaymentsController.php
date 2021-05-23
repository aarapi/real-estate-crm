<?php
App::uses('CakeTime', 'Utility');
class ExpensesPaymentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session');
    public function index($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Expenses','action' => 'index'));            
        }
        $this->loadModel('Expense');
        $expense=$this->Expense->find('first',array('joins'=>array(array('table'=>'vendors','alias'=>'Vendor','type'=>'LEFT','conditions'=>array('Vendor.id=Expense.vendor_id'))),
                                                    'fields'=>array('Vendor.name','Expense.invoice_no','Expense.invoice_date','Expense.invoice_amount'),
                                                    'conditions'=>array('Expense.id'=>$id)));
        if(!$expense)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Expenses','action' => 'index'));  
        }
        $expensePayment=$this->ExpensesPayment->findAllByExpenseId($id,array(),array('ExpensesPayment.date'=>'asc'));
        $this->set('expensePayment',$expensePayment);
        $this->set('expenseId',$id);
        $this->set('expense',$expense);
    }    
    public function add($id=null)
    {
        $this->loadModel('Paymenttype');
        $this->loadModel('Expense');
        $this->set('paymentType',$this->Paymenttype->find('list',array('fields'=>array('id','name'))));
        $this->set('date',CakeTime::format($this->dtFormat,CakeTime::convert(time(),$this->siteTimezone)));
        if ($this->request->is('post'))
        {
            $expenseId=$id;
            try
            {
                $this->ExpensesPayment->create();
                $this->request->data['ExpensesPayment']['expense_id']=$expenseId;
                if ($this->ExpensesPayment->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Payment has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "add/$expenseId"));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            }
        }
        $this->set('expenseId',$id);
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
            $post[]=$this->ExpensesPayment->findById($id);
        }
        $this->set('ExpensesPayment',$post);
        $expenseId=$post[0]['ExpensesPayment']['expense_id'];
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $expenseId=$this->data['expenseId'];
            unset($this->request->data['expenseId']);
            try
            {
                if ($this->ExpensesPayment->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Your Payment has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$expenseId"));
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
        $this->set('expenseId',$expenseId);
    }
    public function deleteall()
    {
        $expenseId=$this->data['expenseId'];
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['ExpensesPayment']['id'] as $key => $value)
                {
                    $this->ExpensesPayment->delete($value);
                }
                $this->Session->setFlash(__('Your Payment has been deleted.'),'flash',array('alert'=>'success'));                
            }
            $this->redirect(array('action' => "index/$expenseId"));
            $this->set('expenseId',$expenseId);
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => "index/$expenseId"));
        }
    }
    public function printreceipt($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->ExpensesPayment->findById($id);
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }        
        $this->loadModel('Client');
        $this->loadModel('Property');
        $post['Client']=$this->Client->findById($post['Expense']['client_id']);
        $post['Property']=$this->Property->findById($post['Expense']['property_id']);
        $ExpenseId=$post['ExpensesPayment']['Expense_id'];
        $this->ExpensesPayment->virtualFields['total'] = 'SUM(ExpensesPayment.amount)';
        $post['PaidAmount'] = $this->ExpensesPayment->find('all',array('fields'=>array('total'),'conditions'=>array('Expense_id'=>$ExpenseId)));
        $this->set('post',$post);
    }
}

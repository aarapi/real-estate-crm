<?php
class PlansPaymentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('PlansPayment.id'=>'asc'));
    public function index($id=null)
    {
        
        $post = $this->PlansPayment->findById($id);
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $cond=" 1=1 AND PlansPayment.deal_id=$id";
        $this->Paginator->settings['conditions'] =array($this->PlansPayment->parseCriteria($this->Prg->parsedParams()),$cond);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Plan', $this->Paginator->paginate());
        $this->set('id', $id);
		 if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add($id=null)
    {
        $this->loadModel('Deal');
        $this->set('id', $id);
        $dealArr=$this->Deal->find('first',array('fields'=>array('Plan.installment','Deal.total_amount','Deal.recurring','Deal.date','Deal.booking_amount'),
                                                         'joins'=>array(array('table'=>'plans','alias'=>'Plan','type'=>'Left','conditions'=>array('Deal.plan_id=Plan.id'))),
                                                         'conditions'=>array('Deal.id'=>$id)));
        
        $dealAmount=$dealArr['Deal']['total_amount'];
        $bookingAmount=$dealArr['Deal']['booking_amount'];
        $installment=$dealArr['Plan']['installment'];
        $installmentAmount=round(($dealAmount-$bookingAmount)/$installment);
        $installment++;
        $this->set('date',CakeTime::format($this->dtFormat,$dealArr['Deal']['date']));
        $this->set('installment',$installment);
        $this->set('installmentAmount',$installmentAmount);
        $this->set('bookingAmount',round($bookingAmount));
        $this->set('recurring',$dealArr['Deal']['recurring']);
        if ($this->request->is('post'))
        {
            $this->PlansPayment->create();
            try
            {
                $totalAmount=0;
                foreach($this->request->data as $k=> $value)
                {
                    $totalAmount=$totalAmount+ $this->request->data[$k]['PlansPayment']['amount'];
                    $this->request->data[$k]['PlansPayment']['deal_id']=$id;
                }                
                if($dealAmount==$totalAmount)
                {
                    if ($this->PlansPayment->saveAll($this->request->data))
                    {
                        $this->Session->setFlash(__('Plans Payment has been added!.'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('controller'=>'deals_payments','action' => 'add',$id));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('Deal Amount is not equal to installment amount'),'flash',array('alert'=>'danger'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'add',$id));
            }
        }
    }
    public function edit($id = null)
    {
        $this->set('id',$id);
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->PlansPayment->findById($id);
        }
        $this->set('PlansPayment',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->loadModel('Deal');
            $dealId=$post[0]['PlansPayment']['deal_id'];
            $dealArr=$this->Deal->find('first',array('fields'=>array('Plan.installment','Deal.total_amount','Deal.recurring'),
                                                         'joins'=>array(array('table'=>'plans','alias'=>'Plan','type'=>'Left','conditions'=>array('Deal.plan_id=Plan.id'))),
                                                         'conditions'=>array('Deal.id'=>$dealId)));
            $dealAmount=$dealArr['Deal']['total_amount'];
            try
            {
                $totalAmount=0;
                foreach($this->request->data as $k=> $value)
                {
                    $totalAmount=$totalAmount+ $this->request->data[$k]['PlansPayment']['amount'];
                }                
                if($dealAmount==$totalAmount)
                {
                    if ($this->PlansPayment->saveAll($this->request->data))
                    {
                        $this->Session->setFlash(__('Plans Payment has been saved!.'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index',$dealId));
                    }
                }
                else
                {
                    $this->Session->setFlash(__('Deal Amount is not equal to installment amount'),'flash',array('alert'=>'danger'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index',$dealId));
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
    }  
    public function deleteall($id=null)
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['PlansPayment']['id'] as $key => $value)
                {
                    $this->PlansPayment->delete($value);
                }
                $this->Session->setFlash(__('Payments has been deleted.'),'flash',array('alert'=>'danger'));
            }        
            $this->redirect(array('controller'=>'PlansPayments','action' => 'index',$id));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Delete releted options first'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'PlansPayments','action' => 'index',$id));
        }
    }
}

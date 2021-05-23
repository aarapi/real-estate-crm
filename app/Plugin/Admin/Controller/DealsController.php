<?php
class DealsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Deal.id'=>'desc'));
    public function index($id=null)
    {
        $cond=array();
        if($id!=null)
        $cond=array('Property.project_id'=>$id);
        $condition=$this->CustomFunction->agencyWisePermission($id,$this->userType,$this->agencyId,'Property.project_id');
        $this->Prg->commonProcess();
        $this->Deal->virtualFields= array('payment' => 'SELECT SUM(DealPayment.emi) as Deal__payment FROM `deals_payments` as `DealPayment` WHERE `DealPayment`.`deal_id`=`Deal`.`id`');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Deal->parseCriteria($this->Prg->parsedParams()),$cond,$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Deal', $this->Paginator->paginate());
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function select2()
    {
        $this->Client->recursive = 0;
        $this->set('clients', $this->paginate());
    }
    public function clientsearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Client');
        $term = $this->request->query['q'];
        $users = $this->Client->find('all',array('conditions' => array('Client.name LIKE' => '%'.$term.'%')));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Client']['id'];
            $result[$key]['text'] = $user['Client']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function propertysearch()
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        // get the search term from URL
        $this->loadModel('Property');
        $term = $this->request->query['q'];
        $cond=array();$cond1=array();
        if($this->request->query['q1'])
        {
            $cond=array('Property.type_id' => $this->request->query['q1']);
        }
        if($this->request->query['q2'])
        {
            $cond1=array('Property.contract_id' => $this->request->query['q2']);
        }
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Property.project_id');
        $users = $this->Property->find('all',array('fields'=>array('Property.id','Property.name'),
						   'conditions' => array('Property.name LIKE' => '%'.$term.'%',$cond,'Property.status'=>'Available',$cond1,$condition)));
        // Format the result for select2
        $result = array();
        foreach($users as $key => $user)
        {
            $result[$key]['id'] = (int) $user['Property']['id'];
            $result[$key]['text'] = $user['Property']['name'];
        }
        $users = $result;        
        echo json_encode($users);
    }
    public function propertydetails()
    {
	$this->layout=null;
        //$this->request->onlyAllow('ajax');
        $id=$this->request->query['id'];
        $this->loadModel('Property');
        $this->loadModel('User');
        $post=$this->Property->find('first',array('fields'=>array('Property.area','Property.price','Unit.name','Property.contract_id','Property.project_id'),
                                                        'conditions'=>array('Property.id'=>$id)));
	$agentName=$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.status'=>'Active','User.ugroup_id'=>'2','User.project_id'=>$post['Property']['project_id'])));
        $this->set('post',$post);
	$this->set(compact('agentName'));
    }
    public function plandetails()
    {
        $this->layout=null;
        $this->autoRender = false;
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id=$this->request->query['id'];
        $this->loadModel('Plan');
        $plan=$this->Plan->find('list',array('fields'=>array('Plan.id','Plan.name'),'conditions'=>array('Plan.properties_id'=>$id)));
        $this->set(compact('plan'));
        $this->render('showplan');
    }
    public function add()
    {
        $this->loadModel('Client');
        $this->loadModel('Property');
        $this->loadModel('Project');
        $this->loadModel('User');
        $this->loadModel('Plan');
        $this->loadModel('Type');
        $this->loadModel('Contract');
        $condition=$this->CustomFunction->agencyWisePermission(null,$this->userType,$this->agencyId,'User.project_id');
        $this->set('type',$this->Type->find('list'));
        $this->set('contract',$this->Contract->find('list'));
        $this->set('clientId',$this->Client->find('list',array('fields'=>array('id','name'))));
        $this->set('propertyId',$this->Property->find('list',array('fields'=>array('id','name'))));
        $this->set('projectName',$this->Project->find('list'));
        $this->set('plan',$this->Plan->find('list'));
        $this->set('agent',$this->User->find('list',array('fields'=>array('id','name'),'conditions'=>array('User.status'=>'Active','User.ugroup_id'=>'2',$condition),'order'=>array('User.name'=>'asc'))));
        $lastRecord=$this->Deal->find('first',array('fields' => array ('id'),'order' => array('id'=>'DESC')));
        $currYear=date('Y');
        if($lastRecord)
        $invoiceNo=$this->siteShort.'-'.$currYear.'-'.str_pad($lastRecord['Deal']['id']+1,4,"0",STR_PAD_LEFT);
        else
        $invoiceNo=$this->siteShort.'-'.$currYear.'-0001';
        $this->set('invoiceNo',$invoiceNo);
        if ($this->request->is('post'))
        {
            $this->Deal->create();
            try
            {
                $dealDiscount=0;
                $flatArr=$this->Property->findById($this->request->data['Deal']['property_id']);
                $dealAmount=$flatArr['Property']['price'];
                $dealArea=$flatArr['Property']['area'];
		$contractFetch=$this->Contract->findById($flatArr['Property']['contract_id']);
                $dealDiscount=$this->request->data['Deal']['discount'];
                $totalAmount=($dealAmount-$dealDiscount);
                $this->request->data['Deal']['area']=$dealArea;
                $this->request->data['Deal']['amount']=$dealAmount;
                $this->request->data['Deal']['total_amount']=$totalAmount;
		if(($contractFetch['Contract']['name']=='Rent' || $contractFetch['Contract']['id']==1)  && $this->request->data['Deal']['evocate_date']==null)
                {
                    $this->Session->setFlash(__('Please fill the evocate date'),'flash',array('alert'=>'danger'));
                }
                else
                {
                    $this->request->data['Deal']['evocate_date']=null;
                    if($this->Deal->save($this->request->data))
                    {
                        $this->Property->save(array('id'=>$flatArr['Property']['id'],'status' => 'Sold'));
                        $this->Session->setFlash(__('Deal has been saved.'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('controller'=>'plans_payments','action' => 'add',$this->Deal->id));
                    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $post = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$id)));
        $this->set('post',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            $this->Deal->id = $id;
            try
            {
                if ($this->Deal->save($this->request->data))
                {
                    $this->Session->setFlash(__('Deal has been updated.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e,'flash',array('alert'=>'danger'));
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
    }
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                $this->loadModel('Property');
                foreach($this->data['Deal']['id'] as $key => $value)
                {
                    $dealArr=$this->Deal->findById($value);
                    if($dealArr)
                    {
                        $propertyId=$dealArr['Deal']['property_id'];
                        $this->Property->save(array('id'=>$propertyId,'status' => 'Available'));
                    }
                    $this->Deal->delete($value);
                }
                $this->Session->setFlash(__('Deal has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please Delete Deals Payment first'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        $this->layout = null;        
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$id)));
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
        $post = $this->Deal->findById($id);
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('plansPaymentArr',$this->PlansPayment->find('all',array('conditions'=>array('PlansPayment.deal_id'=>$id))));
        $this->set('post',$post);
    }
}

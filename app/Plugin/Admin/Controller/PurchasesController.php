<?php
class PurchasesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Purchase.id'=>'desc'));
    public function index($id=null)
    {
        $condition=$this->CustomFunction->agencyWisePermission($id,$this->userType,$this->agencyId,'Purchase.project_id');
        $this->Prg->commonProcess();
        $this->Purchase->virtualFields= array('payment' => 'SELECT SUM(PurchasesPayment.amount) as Purchases__payment FROM `purchases_payments` as `PurchasesPayment` WHERE `PurchasesPayment`.`purchase_id`=`Purchase`.`id`');
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Purchase->parseCriteria($this->Prg->parsedParams()),$condition);
		$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Purchase', $this->Paginator->paginate());        
		 if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        $this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        $this->set('agencyId',$this->agencyId);
	if ($this->request->is('post'))
        {
            $this->Purchase->create();
            if($this->userType=='AGY')
	    $this->request->data['Purchase']['purchase_id']=$this->agencyId;
	    try
            {
                if ($this->Purchase->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Purchase has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
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
            $post[]=$this->Purchase->findByid($id);
        }
        $this->set('agencyId',$this->agencyId);
	$this->loadModel('Project');
        $this->set('projectName',$this->Project->find('list'));
        $this->loadModel('Unit');
        $this->set('unitName',$this->Unit->find('list'));
        $this->set('Purchase',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Purchase->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Your Purchase has been Updated.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
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
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Purchase']['id'] as $key => $value)
                {
                    $this->Purchase->delete($value);
                }
                $this->Session->setFlash(__('Your Purchase has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
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
        $post = $this->Purchase->findById($id);
        $this->set('post',$post);
    }
}

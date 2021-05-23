<?php
class VendorsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Vendor.name'=>'asc'));
    public function index()
    {
        $condition=$this->CustomFunction->agencyWisePermission(NULL,$this->userType,$this->agencyId,'Vendor.project_id');
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Vendor->parseCriteria($this->Prg->parsedParams()),$condition);
		$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Vendor', $this->Paginator->paginate());     
		 if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        $this->set('agencyId',$this->agencyId);
	$this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        if ($this->request->is('post'))
        {
            $this->Vendor->create();
            try
            {
                if ($this->Vendor->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Vendor has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $this->set('isError',true);
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
            $post[]=$this->Vendor->findByid($id);
        }
        $this->set('Vendor',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('agencyId',$this->agencyId);
	$this->set('projectName',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Vendor->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Your Vendor has been saved.'),'flash',array('alert'=>'success'));
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
                foreach($this->data['Vendor']['id'] as $key => $value)
                {
                    $this->Vendor->delete($value);
                }
                $this->Session->setFlash(__('Your Vendor has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please delete related entries first.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}

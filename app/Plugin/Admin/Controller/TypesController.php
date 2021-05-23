<?php
class TypesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Type.name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Type->parseCriteria($this->Prg->parsedParams());
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Type', $this->Paginator->paginate());  
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Type->create();
            try
            {
		$this->request->data['Type']['dirt']='type';
		if ($this->Type->save($this->request->data))
                {
                    $this->Session->setFlash(__('Type has been saved.'),'flash',array('alert'=>'success'));
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
        foreach($ids as $k=>$id)
        {
	    $k++;
            $post[$k]=$this->Type->findByid($id);
        }
        $this->set('Type',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
		if ($this->Type->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Type has been saved.'),'flash',array('alert'=>'success'));
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
                foreach($this->data['Type']['id'] as $key => $value)
                {
                    $this->Type->delete($value);
                }
                $this->Session->setFlash(__('Type has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please delete related record first.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function deletephoto($id)
    {
        try
        {
	    $post=$this->Type->findById($id);
	    if($post)
	    {
		$this->Type->unbindValidation('keep', array('photo'), true);
		$this->Type->save(array('id'=>$id,'photo'=>null));
		$fileName=$post['Type']['photo'];
		$dirName='type';
		$this->CustomFunction->fileDelete($fileName,$dirName);
		$this->Session->setFlash(__('Photo has been deleted.'),'flash',array('alert'=>'success'));
	    }
	    else
	    {
		$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
	    }
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}
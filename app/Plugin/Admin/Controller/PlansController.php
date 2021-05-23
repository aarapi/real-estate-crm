<?php
class PlansController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Plan.id'=>'desc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Plan->parseCriteria($this->Prg->parsedParams());
		$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Plan', $this->Paginator->paginate());  
		 if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function propertysearch()
    {
        $this->autoRender = false;
        // get the search term from URL
        $this->loadModel('Property');
        $term = $this->request->query['q'];
        $cond=array();$cond1=array();
        if(isset($this->request->query['q1']))
        {
            $type=$this->request->query['q1'];
            $cond=array('Property.type' => $type);
        }
        if($this->request->query['q2'])
        {
            $cond1=array('Property.project_id' => $this->request->query['q2']);
        }
        $users = $this->Property->find('all',array('conditions' => array('Property.name LIKE' => '%'.$term.'%','Property.status'=>'Availiable',$cond,$cond1)));
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
    public function add()
    {
        $this->loadModel('Property');
        $this->loadModel('Project');
        $this->set('propertyId',$this->Property->find('list',array('fields'=>array('id','name'))));
        $this->set('projectName',$this->Project->find('list'));
        if ($this->request->is('post'))
        {
            $this->Plan->create();
            try
            {
                if ($this->Plan->save($this->request->data))
                {
                    $this->Session->setFlash(__('Plan has been saved'),'flash',array('alert'=>'success'));
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
            $post[]=$this->Plan->findByid($id);
        }
        $this->set('Plan',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Plan->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Plan has been saved.'),'flash',array('alert'=>'success'));
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
                foreach($this->data['Plan']['id'] as $key => $value)
                {
                    $this->Plan->delete($value);
                }
                $this->Session->setFlash(__('Plan has been deleted.'),'flash',array('alert'=>'danger'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please delete related record first.'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }    
}

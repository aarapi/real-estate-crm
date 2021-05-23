<?php
class MypropertiesController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->userId=$this->userValue['Client']['id'];
        $this->loadModel('Deal');
        $dealCount=$this->Deal->find('count',array('conditions'=>array('Deal.client_id'=>$this->userId)));
        if($dealCount==0)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
    }
    public function index($id=null)
    {
        $this->layout = null;
        $this->loadModel('Property');
        $post = $this->Property->findById($id);
        $this->set('post',$post);
    }
    public function photo($id=null)
    {
        $this->layout = null;
        $this->loadModel('PropertiesPhoto');
        $propertiesPhoto=$this->PropertiesPhoto->findAllByPropertyId($id);
        $this->set('PropertiesPhoto',$propertiesPhoto);
    }
    public function photoview($id = null)
    {
        $this->layout = null;
        $this->loadModel('PropertiesPhoto');
        $post = $this->PropertiesPhoto->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        $photoImg=$post['PropertiesPhoto']['dir'].'/'.$post['PropertiesPhoto']['photo'];
        $this->set('photoImg',$photoImg);
        $this->set('id',$post['PropertiesPhoto']['property_id']);   
    }
    public function document($id=null)
    {
        $this->layout = null;
        $this->loadModel('PropertiesDocument');
        $propertiesDocument=$this->PropertiesDocument->findAllByPropertyId($id);
        $this->set('PropertiesDocument',$propertiesDocument);
    }
    public function documentview($id = null)
    {
        $this->layout = null;
        $this->loadModel('PropertiesDocument');
        $post = $this->PropertiesDocument->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('controller'=>'Dashboards','action' => 'index'));
        }
        $photoImg=$post['PropertiesDocument']['dir'].'/'.$post['PropertiesDocument']['photo'];
        $this->set('photoImg',$photoImg);
        $this->set('id',$post['PropertiesDocument']['property_id']);
    }
}
<?php
class PropertiesDocumentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session','CustomFunction');
    public function index($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Properties','action' => 'index'));            
        }
        $this->loadModel('Property');
        $post=$this->Property->findById($id);
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Properties','action' => 'index'));  
        }
        if($this->userType=='AGT') {
            if($post['Property']['user_id']!=$this->luserId) {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        elseif($this->userType=='AGY') {
            if($post['Property']['project_id']!=$this->agencyId) {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $propertiesPhoto=$this->PropertiesDocument->findAllByPropertyId($id);
        $this->set('PropertiesDocument', $propertiesPhoto);
        $this->set('propertyId',$id);
    }    
    public function add($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Properties','action' => 'index'));            
        }
        $this->loadModel('Property');
        $post=$this->Property->findById($id);
        if(!$post)
        {
            $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('controller'=>'Properties','action' => 'index'));  
        }
        if($this->userType=='AGT') {
            if($post['Property']['user_id']!=$this->luserId) {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        elseif($this->userType=='AGY') {
            if($post['Property']['project_id']!=$this->agencyId) {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        if ($this->request->is('post'))
        {
            if ($this->request->is('post'))
            {
                $this->PropertiesDocument->create();
                try
                {
                    $prPhoto=array();
                    $propertyId=$this->data['propertyId'];
                    $dirName="propertiesdocuments";
                    foreach($this->request->data['PropertiesDocument']['photo'] as $propertyPhoto)
                    {
                        $fileName=$this->CustomFunction->Upload($propertyPhoto['tmp_name'],$propertyPhoto['name'],$dirName,0,0,'',false,array('pdf','doc','docx','jpg','gif','png','jpeg','JPG'));
                        if(strlen($fileName)>0)
                        {
                            $prPhoto[]=(array('property_id'=>$propertyId,'photo' => $fileName,'dir'=>$dirName));
                        }
                    }
                    $this->PropertiesDocument->saveAll($prPhoto);
                    $this->Session->setFlash(__('Document has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => "index/$propertyId"));
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash(__('Something wrong'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }            
            $this->set('isError',true);
            $this->set('propertyId',$propertyId);
        }        
        else
        {
            $this->layout = null;
            $this->set('propertyId',$id);
            $this->set('isError',false);
        }
    }    
    public function deleteall()
    {
        if ($this->request->is('post'))
        {
            $propertyId=$this->data['propertyId'];
            $this->loadModel('Property');
            $post=$this->Property->findById($propertyId);
            if(!$post)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('controller'=>'Properties','action' => 'index'));  
            }
            if($this->userType=='AGT') {
                if($post['Property']['user_id']!=$this->luserId) {
                    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            elseif($this->userType=='AGY') {
                if($post['Property']['project_id']!=$this->agencyId) {
                    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            foreach($this->data['PropertiesDocument']['id'] as $key => $value)
            {
                $PropertiesDocument=$this->PropertiesDocument->findById($value);
                if($PropertiesDocument)
                {
                    $fileName=$PropertiesDocument['PropertiesDocument']['photo'];
                    $dirName=$PropertiesDocument['PropertiesDocument']['dir'];
                    $this->PropertiesDocument->delete($value);
                    $this->CustomFunction->fileDelete($fileName,$dirName);
                }
            }
            $this->Session->setFlash(__('Document has been deleted.'),'flash',array('alert'=>'success'));
        }
        $this->redirect(array('action' => "index/$propertyId"));
        $this->set('propertyId',$propertyId);
    }
}

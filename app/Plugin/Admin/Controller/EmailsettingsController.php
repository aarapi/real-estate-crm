<?php
class EmailsettingsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session','search-master.Prg');
    public function index()
    {
        
        $id=1;        
        $post = $this->Emailsetting->findById($id); 
        if ($this->request->is('post'))
        {
            $this->Emailsetting->id = $id;
            try
            {
                if($this->request->data['Emailsetting']['type']=="Mail")
                {
                    $this->request->data['Emailsetting']['host']=NULL;
                    $this->request->data['Emailsetting']['username']=NULL;
                    $this->request->data['Emailsetting']['password']=NULL;
                    $this->request->data['Emailsetting']['port']=NULL;
                }
                if ($this->Emailsetting->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your Setting has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Setting Problem.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }   
}

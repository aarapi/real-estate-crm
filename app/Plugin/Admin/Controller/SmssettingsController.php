<?php
class SmssettingsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session');
    public $components = array('Session','search-master.Prg');
    public function index()
    {
        
        $id=1;        
        $post = $this->Smssetting->findById($id); 
        if ($this->request->is('post'))
        {
            $this->Smssetting->id = $id;
            try
            {
                if ($this->Smssetting->save($this->request->data))
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

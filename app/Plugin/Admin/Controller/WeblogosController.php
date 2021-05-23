<?php
class WeblogosController extends AdminAppController {
    public $helpers = array('Html','Form','Session');
    public $components = array('Session','search-master.Prg');    
    public function index()
    {
        if ($this->request->is('post'))
        {
            try
            {
                $this->Weblogo->id = 1;
                if ($this->Weblogo->save($this->request->data))
                {
                    $this->Session->setFlash(__('Your logo has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('File type mismatch'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function weblogodel()
    {
        $post=$this->Weblogo->findById(1);
        $userResult=array('id'=>1,'photo'=>'');
        $file=APP.WEBROOT_DIR.DS.'img'.DS.$post['Weblogo']['photo'];
        try
        {
            if($this->Weblogo->save($userResult))
            {
                if(file_exists($file))
                {
                    unlink($file);
                }
                $this->Session->setFlash(__('Your logo has been deleted.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Something wrong.!'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Something wrong.!'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
?>
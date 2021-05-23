<?php
App::uses('CakeEmail', 'Network/Email');
class ContactsController extends AppController
{
    public function index()
    {
        $this->loadModel('Content');
	$contactValueArr=$this->Content->find('first',array('conditions'=>array('id'=>2)));
	$this->set('contactValue',$contactValueArr['Content']['main_content']);		
        if ($this->request->is('post'))
        {
            try
            {
		$toEmail=$this->siteEmail;
                if($toEmail)
                {
                    $subject=$this->request->data['Contact']['subject'];
		    $message=__('Name').': '.$this->request->data['Contact']['name'].'<br><br>'.__('Email').': '.$this->request->data['Contact']['email'].
		    '<br><br>'.__('Phone/Mobile').': '.$this->request->data['Contact']['phone'].'<br><br>'.__('Message').': '.$this->request->data['Contact']['message'].'<br><br>';		    
		    $Email = new CakeEmail();
		    $Email->transport($this->emailSettype);
		    if($this->emailSettype=="Smtp")
		    $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
		    $Email->from(array($this->request->data['Contact']['email'] =>$this->request->data['Contact']['name']));
		    $Email->to($toEmail);
		    $Email->template('default');
		    $Email->emailFormat('html');
		    $Email->subject($subject);
		    $Email->send($message);
                    $this->Session->setFlash(__('E-Mail send successfylly .'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('controller'=>'Contacts','action' => 'index'));
                }
		else
		{
		    $this->Session->setFlash(__('No email to send!'),'flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            }
        }
        
    }
}
<?php
App::uses('CakeEmail', 'Network/Email');
class EmailverificationsController extends AppController
{
    var $components = array('CustomFunction');    
    public function index()
    {
        if ($this->request->is(array('post', 'put')))
        {
            $id=$this->request->data['Emailverification']['vc'];
            $this->EmailVerify($id);            
        }
    }
    public function emailcode($id=null)
    {
        $this->EmailVerify($id);
    }
    public function EmailVerify($id)
    {
        $this->loadModel('Client');
        $post = $this->Client->findByRegCodeAndRegStatus($id,"Live");
        if($post)
        {
            $this->loadModel('Configuration');
            $post1=$this->Configuration->findById(1);
            $guest_login=$post1['Configuration']['guest_login'];
            if($guest_login==1)
            $this->request->data['Client']['reg_status']="Pending";
            else
            $this->request->data['Client']['status']="Active";
            $this->Client->id = $post['Client']['id'];
            $this->request->data['Client']['reg_code']="";
            $this->request->data['Client']['reg_status']="Done";
            if ($this->Client->save($this->request->data))
            {
                $this->Session->setFlash(__('Email verified successfully'),'flash',array('alert'=>'success'));
                $this->Redirect(array('controller' => 'Clients', 'action' => 'login'));
                exit();
            }
        }
        else
        {
            $this->Session->setFlash(__('Invalid Verification Code'),'flash',array('alert'=>'danger'));
        }
        $this->redirect(array('action' => 'index'));
    }
    public function resend()
    {
        
    }
    public function resendsub()
    {
        $this->loadModel('Client');
        $id=$this->request->data['Emailverification']['email'];
        $post = $this->Client->findByEmail($id);
        if($post)
        {
            if($post['Client']['reg_status']=="Live")
            {
                $memberName=$post['Client']['name'];
                $code=$post['Client']['reg_code'];
                $email=$post['Client']['email'];
                $mobileNo=$post['Client']['phone'];
                $rand1=$this->CustomFunction->generate_rand(35);
                $rand2=rand();
                $url="$this->siteDomain/Emailverifications/emailcode/$code/$rand1/$rand2";
                $siteName=$this->siteName;
                $siteEmailContact=$this->siteEmailContact;
                /* Send Email */
                if($this->emailNotification)
                {
                    $this->loadModel('Emailtemplate');
                    $emailTemplateArr=$this->Emailtemplate->findByType('RVN');
                    if($emailTemplateArr['Emailtemplate']['status']=="Published")
                    {
                        $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="Smtp")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword,'timeout'=>90));
                        $Email->from(array($this->siteEmail =>$this->siteName));
                        $Email->to($email);
                        $Email->template('default');
                        $Email->emailFormat('html');
                        $Email->subject($emailTemplateArr['Emailtemplate']['name']);
                        $Email->send($message);
                    }
                    /* End Email */
                }
                if($this->smsNotification)
                {
                    /* Send Sms */
                    $this->loadModel('Smstemplate');
                    $smsTemplateArr=$this->Smstemplate->findByType('RVN');
                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                    {
                        $url="$this->siteDomain";
                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                    }
                    /* End Sms */
                }
                $this->Session->setFlash(__('A verification Code send to your Email inbox or Spam'),'flash',array('alert'=>'success'));
                $this->Redirect(array('controller' => 'Emailverifications', 'action' => 'index'));
                exit();
            }
            else
            {
                $this->Session->setFlash(__('Email Id already verified'),'flash',array('alert'=>'success'));
                $this->Redirect(array('controller' => 'Clients', 'action' => 'login'));
                exit();
            }
        }
        else
        {
            $this->Session->setFlash(__('Email Id not registered in system'),'flash',array('alert'=>'danger'));
        }
        $this->redirect(array('action' => 'resend'));
    }
}

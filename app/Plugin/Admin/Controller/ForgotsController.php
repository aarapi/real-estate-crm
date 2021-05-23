<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class ForgotsController extends AdminAppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();        
    }
    public function password()
    {
        if ($this->request->is(array('post', 'put')))
        {
            $email=$this->request->data['Forgot']['email'];
            if($this->Forgot->find('count',array('conditions'=>array('Forgot.email'=>$email)))==0)
            {
                $this->Session->setFlash(__('Email id is not registered in system'),'flash', array('alert'=> 'danger'));
                $this->Redirect(array('controller' => 'Forgots', 'action' => 'password'));
            }
            else
            {
                $userValue=$this->Forgot->find('first',array('conditions'=>array('Forgot.email'=>$email)));
                $email=$userValue['Forgot']['email'];$name=$userValue['Forgot']['name'];
                $mobileNo=$userValue['Forgot']['mobile'];$contactNo=$this->contact;
                $code=rand();
                $this->Forgot->save(array('id'=>$userValue['Forgot']['id'],'presetcode'=>$code));
                try
                {
                    if($this->emailNotification)
                    {
                        /* Send Email */
                        $this->loadModel('Emailtemplate');
                        $emailTemplateArr=$this->Emailtemplate->findByType('AFP');
                        if($emailTemplateArr['Emailtemplate']['status']=="Published")
                        {
                            $rand1=$this->CustomFunction->generate_rand(35);
                            $rand2=rand();
                            $name=$userValue['Forgot']['name'];
                            $url="$this->siteDomain/admin/Forgots/presetcode/$code/$rand1/$rand2";
                            $siteName=$this->siteName;
                            $siteEmailContact=$this->siteEmailContact;
                            $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                            $Email = new CakeEmail();
                            $Email->transport($this->emailSettype);
                            if($this->emailSettype=="SMTP")
                            $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
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
                        $smsTemplateArr=$this->Smstemplate->findByType('AFP');
                        if($smsTemplateArr['Smstemplate']['status']=="Published")
                        {
                            $url="$this->siteDomain";
                            $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                            $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                        }
                        /* End Sms */
                    }
                    $this->Session->setFlash(__('Your password reset link is sent to your registered email id'),'flash', array('alert'=> 'success'));
                    $this->Redirect(array('controller' => 'Forgots', 'action' => 'presetcode'));
                }
                catch(Exception $e)
                {
                   $this->Session->setFlash($e->getMessage(),'flash',array('alert'=> 'danger'));
                }
            }
        }
    }
    public function presetcode($id=null)
    {
        try{
        if ($this->request->is(array('post', 'put')))
        {
           $id=$this->request->data['Forgot']['verificationcode'];
        }
        if($id)
        {        
            $post=$this->Forgot->find('first',array('conditions'=>array('Forgot.presetcode'=>$id)));
            if(!$post)
            {
              $this->Session->setFlash(__('Incorrect code'),'flash', array('alert'=> 'danger'));
              $this->Redirect(array('controller' => 'Forgots', 'action' => 'presetcode'));
            }
            else
            {
               $this->Session->write('Parc', $id);
               $this->Redirect(array('controller' => 'Forgots', 'action' => 'reset'));
            }
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'presetcode'));
        }
    }
     public function reset()
    {
        try
        {
            if($this->Session->read('Parc'))
            {
                if ($this->request->is(array('post', 'put')))
                {
                    $userValue=$this->Forgot->find('first',array('conditions'=>array('Forgot.presetcode'=>$this->Session->read('Parc'))));
                    $passwordValue=$this->request->data['Forgot']['password'];
                    $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                    $password=$passwordHasher->hash($passwordValue);
                    $this->Forgot->save(array('id'=>$userValue['Forgot']['id'],'password'=>$password,'presetcode'=>NULL));
                    session_unset('Parc');
                    $this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=> 'success'));
                    $this->Redirect(array('controller' => 'users', 'action' => 'login'));
                }
            }
            else
            {
             $this->Redirect(array('controller' => 'Forgots', 'action' => 'presetcode'));  
            }
        }
        catch(Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=> 'danger'));
            $this->Redirect(array('controller' => 'Forgots', 'action' => 'reset'));
        }
        
    }
    public function username()
    {
        try{
        if ($this->request->is(array('post', 'put')))
        {
            $email=$this->request->data['Forgot']['email'];
            if($this->Forgot->find('count',array('conditions'=>array('Forgot.email'=>$email)))==0)
            {
                $this->Session->setFlash(__('Email id is not registered in system'),'flash', array('alert'=> 'danger'));
                $this->Redirect(array('controller' => 'Forgots', 'action' => 'username'));
            }
            else
            {
                $userValue=$this->Forgot->find('first',array('conditions'=>array('Forgot.email'=>$email)));
                $email=$userValue['Forgot']['email'];$name=$userValue['Forgot']['name'];
                $mobileNo=$userValue['Forgot']['mobile'];$contactNo=$this->contact;
                if($this->emailNotification)
                {
                    /* Send Email */
                    $this->loadModel('Emailtemplate');
                    $emailTemplateArr=$this->Emailtemplate->findByType('AFU');
                    if($emailTemplateArr['Emailtemplate']['status']=="Published")
                    {
                        $userName=$userValue['Forgot']['username'];
                        $siteName=$this->siteName;
                        $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                        $Email = new CakeEmail();
                        $Email->transport($this->emailSettype);
                        if($this->emailSettype=="SMTP")
                        $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
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
                    $smsTemplateArr=$this->Smstemplate->findByType('AFU');
                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                    {
                        $url="$this->siteDomain";
                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                    }
                    /* End Sms */
                }
                $this->Session->setFlash(__('Your username is sent to your registered email id'),'flash', array('alert'=> 'success'));
                $this->Redirect(array('controller' => 'Users', 'action' => 'login'));
            }
        }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'username'));
        }
    }
}
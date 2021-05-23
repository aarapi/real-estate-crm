<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class RegistersController extends AppController
{
    var $components = array('CustomFunction');
    var $helpers = array('Captcha');
    
    public function captcha() {
        $this->autoRender = false;
        $this->layout='ajax';
        if(!isset($this->Captcha)) { //if Component was not loaded through $components array()
        $this->Captcha = $this->Components->load('Captcha', array(
        'width' => 150,
        'height' => 50,
        'theme' => 'random', //possible values : default, random ; No value means 'default'
        )); //load it
        }
        $this->Captcha->create();
    }
    public function index()
    {
        $this->Captcha = $this->Components->load('Captcha', array('captchaType'=>$this->captchaType, 'jquerylib'=>false, 'modelName'=>'Register', 'fieldName'=>'captcha')); //load it
        if(!isset($this->Captcha))
        {
            //if Component was not loaded throug $components array()
            $this->Captcha = $this->Components->load('Captcha'); //load it
        }
        if(isset($this->request->data['Register']['captcha']))
        {
            $plainPassword=$this->request->data['Register']['password'];
            if($this->request->data['Register']['captcha']==$this->Captcha->getVerCode())
            {
                if ($this->request->is('post'))
                {
                    try
                    { 
                            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                            $password=$this->request->data['Register']['password'];
                            $this->request->data['Register']['password'] = $passwordHasher->hash($password);
                            $this->request->data['Register']['reg_code']=$this->CustomFunction->generate_rand();
                            $this->request->data['Register']['reg_status']="Live";
			    $this->request->data['Register']['status']="Pending";
			    $this->request->data['Register']['category_id']=1;
                            if($this->Register->save($this->request->data))
                            {   
                                $memberName=$this->request->data['Register']['name'];
                                $code=$this->request->data['Register']['reg_code'];
                                $email=$this->request->data['Register']['email'];
                                $mobileNo=$this->request->data['Register']['mobile'];
                                $rand1=$this->CustomFunction->generate_rand(35);
                                $rand2=rand();
                                $url="$this->siteDomain/Emailverifications/emailcode/$code/$rand1/$rand2";
                                $siteName=$this->siteName;
                                $siteEmailContact=$this->siteEmailContact;
                                if($this->emailNotification)
                                {
                                    /* Send Email */
                                    $this->loadModel('Emailtemplate');
                                    $emailTemplateArr=$this->Emailtemplate->findByType('SRN');
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
                                    $smsTemplateArr=$this->Smstemplate->findByType('SRN');
                                    if($smsTemplateArr['Smstemplate']['status']=="Published")
                                    {
                                        $url="$this->siteDomain";
                                        $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                        
                                        $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                                    }
                                    /* End Sms */
                                }
                                $this->Session->setFlash(__('A verification Code send to your Email inbox or Spam'),'flash',array('alert'=>'success'));
                                return $this->redirect(array('controller'=>'Emailverifications','action' => 'index'));
                            }
                            $this->request->data['Register']['password']=$plainPassword;
                       
                    }
                    catch (Exception $e)
                    {
                        $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                    }
                }            
            }
            else
            {
                $this->Session->setFlash(__('Invalid Security Code'),'flash',array('alert'=>'danger'));
            }
        }
    }
}

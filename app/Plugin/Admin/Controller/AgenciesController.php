<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class AgenciesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $cond=array('Ugroup.type'=>'AGY');
        $this->Paginator->settings['conditions'] = array($this->Agency->parseCriteria($this->Prg->parsedParams()),$cond);
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Agency', $this->Paginator->paginate());
        if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
//    public function add()
//    {
//        $this->loadModel('Location');
//        $this->loadModel('Ugroup');
//        $this->loadModel('User');
//        $this->set('location',$this->Location->find('list'));
//        if ($this->request->is('post'))
//        {
//            $this->Agency->create();
//            try
//            {
//                $password=$this->request->data['Agency']['password'];
//                if ($this->Agency->save($this->request->data))
//                {
//                    $lastId=$this->Agency->id();
//                    $ugroupArr=$this->Ugroup->findByType('AGY');
//                    $userRecord=array('ugroup_id'=>$ugroupArr['Ugroup']['id'],'project_id'=>$lastId,'name'=>$this->request->data['Agency']['name'],'username'=>$this->request->data['User']['phone'],
//                                      'phone'=>$this->request->data['User']['phone'],'mobile'=>$this->request->data['User']['mobile']);
//                    $this->User->save($recordArr);
//                    $email=$this->request->data['User']['email'];$name=$this->request->data['User']['name'];$mobileNo=$this->request->data['User']['mobile'];
//		    $userName=$this->request->data['User']['username'];
//		    $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain.'/admin';
//		    if($email)
//		    {
//			if($this->emailNotification)
//			{
//			    /* Send Email */
//			    $this->loadModel('Emailtemplate');
//			    $emailSettingArr=$this->Emailtemplate->findByType('ULC');
//			    if($emailSettingArr['Emailtemplate']['status']=="Published")
//                            {
//				$message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
//				$Email = new CakeEmail();
//				$Email = new CakeEmail();
//                                $Email->transport($this->emailSettype);
//                                if($this->emailSettype=="Smtp")
//                                $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
//				$Email->from(array($this->siteEmail =>$this->siteName));
//				$Email->to($email);
//				$Email->template('default');
//				$Email->emailFormat('html');
//				$Email->subject($emailSettingArr['Emailtemplate']['name']);
//				$Email->send($message);
//				/* End Email */
//			    }
//			}
//		    }
//                    if($mobileNo)
//                    {
//                        if($this->smsNotification)
//                        {
//                            /* Send Sms */
//                            $this->loadModel('Smstemplate');
//                            $smsTemplateArr=$this->Smstemplate->findByType('ULC');
//                            if($smsTemplateArr['Smstemplate']['status']=="Published")
//                            {
//                                $url="$this->siteDomain";
//                                $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
//                                $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
//                            }
//                            /* End Sms */
//                        }
//                    }
//                    $this->Session->setFlash(__('Agency has been saved.'),'flash',array('alert'=>'success'));
//                    return $this->redirect(array('action' => 'add'));
//                }
//            }
//            catch (Exception $e)
//            {
//                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
//                return $this->redirect(array('action' => 'index'));
//            }
//        }
//    }
//    public function edit($id = null)
//    {
//        if (!$id)
//        {
//            throw new NotFoundException(__('Invalid post'));
//        }
//        $ids=explode(",",$id);
//        $post=array();
//        foreach($ids as $k=>$id)
//        {$k++;
//            $post[$k]=$this->Agency->findByid($id);
//        }
//        $this->set('Agency',$post);
//        if (!$post)
//        {
//            throw new NotFoundException(__('Invalid post'));
//        }
//        $this->loadModel('Location');
//        $this->set('location',$this->Location->find('list'));
//        if ($this->request->is(array('post', 'put')))
//        {
//            try
//            {
//                if ($this->Agency->saveAll($this->request->data))
//                {
//                    $this->Session->setFlash(__('Agency has been updated.'),'flash',array('alert'=>'success'));
//                    return $this->redirect(array('action' => 'index'));
//                }
//            }
//            catch (Exception $e)
//            {
//                $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
//                return $this->redirect(array('action' => 'index'));
//            }
//            $this->set('isError',true);
//        }
//        else
//        {
//            $this->layout = null;
//            $this->set('isError',false);
//        }
//        if (!$this->request->data)
//        {
//            $this->request->data = $post;
//        }
//    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
		$this->loadModel('User');
                foreach($this->data['User']['id'] as $key => $value)
                {
		    if($value){
			$user=$this->User->findById($value);
			$this->User->delete($value);
			$this->Agency->delete($user['User']['project_id']);
		    }
                }
                $this->Session->setFlash(__('Agency has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please delete all realted entry first'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Agency->findById($id);
        if(strlen($post['Agency']['photo'])>0)
        $std_img='agency_thumb/'.$post['Agency']['photo'];
        else
        $std_img='User.png';
        $this->set('std_img', $std_img);
        $this->set('post',$post);
    }
}

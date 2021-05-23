<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 900);
class ContactsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('Contact.id'=>'desc'));
    public function index($id=null)
    {
	$condition=$this->CustomFunction->agencyWisePermission($id,$this->userType,$this->agencyId,'Contact.project_id');
        $this->loadModel('Category');
        $this->set('category',$this->Category->find('list'));
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array($this->Contact->parseCriteria($this->Prg->parsedParams()),$condition);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('Contact', $this->Paginator->paginate());  
	$this->set('luserId',$this->luserId);
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }    
    public function add()
    {
        $this->loadModel('Category');
        $this->set('category',$this->Category->find('list',array('conditions'=>array('type'=>NULL))));
        $this->set('agency',$this->CustomFunction->agencyWiseList($this->userType,$this->agencyId));
        if ($this->request->is('post'))
        {
            $this->Contact->create();
            try
            {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                $password = rand();
                $this->request->data['Contact']['password'] = $passwordHasher->hash($password);
		if($this->userType=='AGT' || $this->userType=='AGY'){
		    $this->request->data['Contact']['project_id']=$this->agencyId;		    
		}
		$this->request->data['Contact']['user_id']=$this->luserId;
                if ($this->Contact->save($this->request->data))
                {
                    $email=$this->request->data['Contact']['email'];$clientName=$this->request->data['Contact']['name'];
                    $mobileNo=$this->request->data['Contact']['phone'];
                    $siteName=$this->siteName;$contactNo=$this->contact;$url=$this->siteDomain;
                    if($email)
                    {
                        if($this->emailNotification)
                        {                          
                            /* Send Email */
                            $this->loadModel('Emailtemplate');
                            $emailSettingArr=$this->Emailtemplate->findByType('CLC');
                            if($emailSettingArr['Emailtemplate']['status']=="Published")
                            {
                                $message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
                                $Email = new CakeEmail();
                                $Email->transport($this->emailSettype);
                                if($this->emailSettype=="Smtp")
                                $Email->config(array('host' => $this->emailHost,'port' =>  $this->emailPort,'username' => $this->emailUsername,'password' => $this->emailPassword));
                                $Email->from(array($this->siteEmail =>$this->siteName));
                                $Email->to($email);
                                $Email->template('default');
                                $Email->emailFormat('html');
                                $Email->subject($emailSettingArr['Emailtemplate']['name']);
                                $Email->send($message);
                                /* End Email */
                            }
                        }
                    }
                    if($mobileNo)
                    {
                        if($this->smsNotification)
                        {
                            /* Send Sms */
                            $this->loadModel('Smstemplate');
                            $smsTemplateArr=$this->Smstemplate->findByType('CLC');
                            if($smsTemplateArr['Smstemplate']['status']=="Published")
                            {
                                $url="$this->siteDomain";
                                $message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
                                $this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
                            }
                            /* End Sms */
                        }
                    }
                    $this->Session->setFlash(__('Your Contact Manager has been saved.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'add'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $k=>$id)
        {$k++;
            $post[$k]=$this->Contact->findByid($id);
	    if($this->userType=='AGT') {
		if($post[$k]['Contact']['user_id']!=$this->luserId) {
		    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
	    }
	    elseif($this->userType=='AGY') {
		if($post[$k]['Contact']['project_id']!=$this->agencyId) {
		    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
		    return $this->redirect(array('action' => 'index'));
		}
	    }
        }
        $this->set('Contact',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->loadModel('Category');
        $this->set('category',$this->Category->find('list'));
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Contact->saveAll($this->request->data))
                {
                    $this->Session->setFlash(__('Your Contact Manager has been Updated.'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }    
    public function deleteall()
    {
        try
        {
            if ($this->request->is('post'))
            {
                foreach($this->data['Contact']['id'] as $key => $value)
                {
		    if($value > 0) {
			$prop[$key]=$this->Contact->findByid($value);
			if($this->userType=='AGT') {
			    if($prop[$key]['Contact']['user_id']!=$this->luserId) {
				$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
				return $this->redirect(array('action' => 'index'));
			    }
			}
			elseif($this->userType=='AGY') {
			    if($prop[$key]['Contact']['project_id']!=$this->agencyId) {
				$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
				return $this->redirect(array('action' => 'index'));
			    }
			}
                    $this->Contact->delete($value);
		    }
                }
                $this->Session->setFlash(__('Your Contact Manager has been deleted.'),'flash',array('alert'=>'success'));
            }        
            $this->redirect(array('action' => 'index'));
        }
        catch (Exception $e)
        {
            $this->Session->setFlash(__('Please Delete Deal first.'),'flash',array('alert'=>'danger'));
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
        $post = $this->Contact->findById($id);
        $this->set('post',$post);
    }
    public function printclient($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Contact->findById($id);
        $this->set('post',$post);
    }
    public function changepass($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Contact->findById($id);
        if (!$post)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
	if($this->userType=='AGT') {
	    if($post['Contact']['user_id']!=$this->luserId) {
		$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
	}
	elseif($this->userType=='AGY') {
	    if($post['Contact']['project_id']!=$this->agencyId) {
		$this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
	}
        if ($this->request->is(array('post', 'put')))
        {
	    try
	    {
		$passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
		$this->Contact->id = $id;
		$this->request->data['Contact']['password'] = $passwordHasher->hash($this->request->data['Contact']['password']);
		if ($this->Contact->save($this->request->data,array('validate'=>false)))
		{
		    $this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=>'success'));
		    $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
		$this->redirect(array('action' => 'index'));
	    }
	    catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
}
<?php
App::uses('AdminAppController', 'Admin.Controller');
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('page'=>1,'order'=>array('User.name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
	$cond=array('Ugroup.type NOT IN'=>array('AGY','AGT'));
	if($this->luserId!=1)
	$cond=array('User.project_id'=>$this->agencyId);
        $this->Paginator->settings['conditions'] = array('deleted IS NULL',$this->User->parseCriteria($this->Prg->parsedParams()),$cond);
	$this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $this->set('User', $this->Paginator->paginate());  
	if ($this->request->is('ajax'))
        {
            $this->render('index','ajax'); // View, Layout
        }
    }
    public function add($type=null)
    {
	if(!$type && $this->userType!='ADR'){
	    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
	}
	elseif($type!='AY' && $type!='AT' && $this->userType!='ADR'){
	    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
	}
        elseif($type=='AY' && $this->userType!='ADR'){
	    $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'index'));
	}
        elseif($type=='AY'){
	    $this->set('type',$type);
	}
        elseif($type=='AT'){
	    $this->set('type',$type);
	    $this->set('pId',$this->agencyId);
	}
	$this->set('type',$type);
        $this->loadModel('Ugroup');
        $this->set('ugroup',$this->Ugroup->find('list',array('conditions'=>array('Ugroup.type NOT IN'=>array('AGY','AGT')))));
        $this->loadModel('Location');
        $this->set('location',$this->Location->find('list'));
        $this->loadModel('Project');
	$cond=array();
	if($this->luserId!=1)
	$cond=array('Project.id'=>$this->agencyId);
        $this->set('project',$this->Project->find('list',array('conditions'=>$cond)));
        if($this->request->is('post'))
        {
            $this->User->create();
            try
            {
                $password=$this->request->data['User']['password'];
		if(isset($this->request->data['User']['ugroup_id']) && $this->request->data['User']['ugroup_id']==4){
		    $projectRecord=array('name'=>$this->request->data['User']['name'],'email'=>$this->request->data['User']['email'],'phone'=>$this->request->data['User']['phone'],'mobile'=>$this->request->data['User']['mobile']);
		    $this->Project->save($projectRecord);
		    $lastId=$this->Project->id;
		    $this->request->data['User']['project_id']=$lastId;
		}
		if($this->userType=='AGY'){
		    $this->request->data['User']['ugroup_id']=2;
		    $this->request->data['User']['project_id']=$this->agencyId;
		}
		if ($this->User->save($this->request->data))
		{		    
		    $email=$this->request->data['User']['email'];$name=$this->request->data['User']['name'];$mobileNo=$this->request->data['User']['mobile'];
		    $userName=$this->request->data['User']['username'];
		    $siteName=$this->siteName;$siteEmailContact=$this->siteEmailContact;$url=$this->siteDomain.'/admin';
		    if($email)
		    {
			if($this->emailNotification)
			{
			    /* Send Email */
			    $this->loadModel('Emailtemplate');
			    $emailSettingArr=$this->Emailtemplate->findByType('ULC');
			    if($emailSettingArr['Emailtemplate']['status']=="Published")
			    {
				$message=eval('return "' . addslashes($emailSettingArr['Emailtemplate']['description']) . '";');
				$Email = new CakeEmail();
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
			    $smsTemplateArr=$this->Smstemplate->findByType('ULC');
			    if($smsTemplateArr['Smstemplate']['status']=="Published")
			    {
				$url="$this->siteDomain";
				$message=eval('return "' . addslashes($smsTemplateArr['Smstemplate']['description']) . '";');
				$this->CustomFunction->sendSms($mobileNo,$message,$this->smsSettingArr);
			    }
			    /* End Sms */
			}
		    }
		    if($type=='AY'){
			$this->Session->setFlash(__('Agency has been saved.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('controller'=>'Agencies','action' => 'Index'));
		    }
		    elseif($type=='AT'){
			$this->Session->setFlash(__('Agent has been saved.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('controller'=>'Agents','action' => 'Index'));
		    }
		    else{
			$this->Session->setFlash(__('User has been saved.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('action' => 'add'));
		    }
		}		
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function edit($id = null)
    {
	$this->set('luserId',$this->adminValue['User']['project_id']);
        $this->loadModel('Ugroup');
        $this->set('ugroup',$this->Ugroup->find('list'));
        $this->loadModel('Project');
        $this->set('project',$this->Project->find('list'));
        $this->loadModel('Location');
        $this->set('location',$this->Location->find('list'));
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $k=>$id)
        {
	    $k++;
            $post[$k]=$this->User->findById($id);
        }
        $this->set('User',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
	    $this->User->id = $id;
            try
            {
		$projectRecord=array();
		foreach($this->request->data as $key => $value)
                {
		    if(strlen($this->request->data[$key]['User']['project_id'])>0){
			$projectId=$this->request->data[$key]['User']['project_id'];
			$projectRecord[]=array('id'=>$projectId,'name'=>$this->request->data[$key]['User']['name'],'email'=>$this->request->data[$key]['User']['email'],'phone'=>$this->request->data[$key]['User']['phone'],'mobile'=>$this->request->data[$key]['User']['mobile']);
		    }
                }
                if ($this->User->saveAll($this->request->data))
                {
		    $this->Project->saveAll($projectRecord);
		    if($post[$k]['Ugroup']['type']=='AGY'){
			$this->Session->setFlash(__('Agency has been updated.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('controller'=>'Agencies','action' => 'index'));
		    }
		    elseif($post[$k]['Ugroup']['type']=='AGT'){
			$this->Session->setFlash(__('Agent has been updated.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('controller'=>'Agents','action' => 'index'));
		    }
		    else{
			$this->Session->setFlash(__('Users has been updated.'),'flash',array('alert'=>'success'));
			return $this->redirect(array('controller'=>'Users','action' => 'index'));
		    }
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash($e.__('Invalid Post'),'flash',array('alert'=>'danger'));
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
    public function editprofile()
    {
	$this->loadModel('Location');
	$id=$this->luserId;
        $post=$this->User->findById($id);
	$this->set('location',$this->Location->find('list',array('order'=>array('name'=>'asc'))));
        if ($this->request->is(array('post', 'put')))
        {
	    try
            {
		$projectRecord=array();
		if($this->userType=='AGY'){
		    $projectId=$post['User']['project_id'];
		    $projectRecord=array('id'=>$projectId,'name'=>$this->request->data['User']['name'],'email'=>$this->request->data['User']['email'],'phone'=>$this->request->data['User']['phone'],'mobile'=>$this->request->data['User']['mobile']);
		}
		$this->request->data['User']['id']=$id;
                if ($this->User->save($this->request->data['User']))
                {
		    if($this->userType=='AGY'){
			$this->loadModel('Project');
			$this->Project->save($projectRecord);
		    }
		    $this->Session->setFlash(__('User has been updated.'),'flash',array('alert'=>'success'));
		    return $this->redirect(array('controller'=>'Users','action' => 'myProfile'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Invalid Post'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'myProfile'));
            }
        }
	$this->set('post',$post);
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    public function deleteall()
    {
        if ($this->request->is('post'))
        {
            foreach($this->data['User']['id'] as $key => $value)
            {
                if($value!=1)
                $this->User->delete($value);
            }
            $this->Session->setFlash(__('User has been deleted.'),'flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
    }
    public function myProfile()
    {
        $userValue=$this->Session->read('User');
        $post = $this->User->findById($userValue['User']['id']);        
	if(strlen($post['User']['photo'])>0)
        $std_img='user_thumb/'.$post['User']['photo'];
        else
        $std_img='User.png';
        $this->set('std_img', $std_img);
	$this->set('post',$post);
    }
    public function assignrights()
    {
	if($this->adminValue['User']['id']!=1){
	    return $this->redirect(array('action' => 'index'));
	}
        $this->loadModel('Ugroup');
        $Ugroup=$this->Ugroup->find('all',array('conditions'=>array('id >'=>1),'order'=>'name asc'));
        $this->set('Ugroup',$Ugroup);
    }
    public function assignrightsedit($id=null)
    {
	if($this->adminValue['User']['id']!=1){
	    return $this->redirect(array('action' => 'index'));
	}
        $this->layout = null;
        $this->loadModel('Ugroup');
        $this->loadModel('PageRight');
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $isPost=$this->Ugroup->find('count',array('conditions'=>array('id'=>$id)));
        if($isPost==0)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $post=$this->User->assingPages($id);
        $this->set('PageRight',$post);
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->PageRight->deleteAll(array('ugroup_id'=>$id));
                foreach($this->request->data['PageRight']['id'] as $value)
                {
                    if($value>0)
                    {
                        $this->PageRight->create();
                        $this->PageRight->save(array('page_id'=>$value,'ugroup_id'=>$id,'view_right'=>1));
                        
                    }                    
                }
                $this->Session->setFlash(__('Permission update successfully'),'flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'assignrights'));
            }
            catch (Exception $e)
            {
                $this->Session->setFlash(__('Error in updation'),'flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'assignrights'));
            }
        }
        $this->set('id',$id);
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
    function login_form()
    {
        if (empty($this->data['User']['username']) == false)
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['User']['password']);
            $user = $this->User->find('first', array('conditions' => array('User.username' => $this->data['User']['username'],'User.password' =>$password,'User.status'=>'Active','User.deleted IS NULL')));
            if($user != false)
            {   
                $this->Session->setFlash(__('Thank you for logging in!'),'flash', array('alert'=> 'success'));
                $this->Session->write('User', $user);                
                $this->Redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                exit();
            }
            else
            {
                $this -> Session -> setFlash(__('Incorrect username/password!'),'flash', array('alert'=> 'danger'));
                $this -> Redirect(array('action' => 'login_form'));
                exit();
            }
        } 
    }
    function logout() {

        $this -> Session -> destroy();
        $this -> Session -> setFlash(__('You have logged out'),'flash', array('alert'=> 'success'));

        $this -> redirect(array('action' => 'login_form'));
        exit();
    }
    public function changePass()
    {
        if ($this->request->is(array('post', 'put')))
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $userValue=$this->Session->read('User');
            $post = $this->User->findById($userValue['User']['id']);
            if($post['User']['password']==$passwordHasher->hash($this->request->data['User']['oldPassword']))
            {
                $this->User->id = $userValue['User']['id'];
                $this->User->unbindValidation('remove', array('name','username','address','phone','mobile','email','skype','twitter','facebook','linkedin','description','photo'), true);
                if ($this->User->save($this->request->data))
                {
                    $this->Session->setFlash(__('Password Changed Successfully'),'flash',array('alert'=>'success'));
                }                
            }
            else
            {
                $this->Session->setFlash(__('Invalid Password.'),'flash',array('alert'=>'danger'));
            }
            $this->redirect(array('action' => 'changePass'));
        }
    }
    public function leveladd()
    {
	if($this->adminValue['User']['id']!=1){
	    return $this->redirect(array('action' => 'index'));
	}
        $this->loadModel('Ugroup');
        if ($this->request->is('post'))
        {
            $this->Ugroup->create();
            try
            {
                $this->request->data['Ugroup']['name']=$this->request->data['User']['name'];
		$this->Ugroup->unbindValidation('keep', array('name'), true);
                if ($this->Ugroup->save($this->request->data))
                {
                    $this->Session->setFlash(__('Level User has been saved'),'flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'leveladd'));
                }
            }
            catch (Exception $e)
	    {
		$this->Session->setFlash(__($e->getMessage()),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'index'));
	    }
        }
    }
    public function deletelevel()
    {
	if($this->adminValue['User']['id']!=1){
	    return $this->redirect(array('action' => 'index'));
	}
        $this->loadModel('Ugroup');
        if ($this->request->is('post'))
        {
            try
            {
		$del=false;
                foreach($this->data['Ugroup']['id'] as $key => $value)
                {
		    $this->Ugroup->deleteAll(array('Ugroup.id'=>$value,'Ugroup.type'=>NULL));
                }
		$this->Session->setFlash(__('Level user has been deleted'),'flash',array('alert'=>'success'));
            }
            catch (Exception $e)
	    {
		$this->Session->setFlash(__('Can not delete level user'),'flash',array('alert'=>'danger'));
		return $this->redirect(array('action' => 'assignrights'));
	    }
        }        
        $this->redirect(array('action' => 'assignrights'));
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash(__('Invalid Post.'),'flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->User->findById($id);
        if(strlen($post['User']['photo'])>0)
        $std_img='user_thumb/'.$post['User']['photo'];
        else
        $std_img='User.png';
        $this->set('std_img', $std_img);
        $this->set('post',$post);
    }
}
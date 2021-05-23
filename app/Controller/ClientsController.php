<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeTime', 'Utility');
class ClientsController extends AppController
{
    var $helpers = array('Form');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',CakeTime::convert(time(),$this->siteTimezone));
    }
    public function login()
    {
        if (empty($this->data['Client']['email']) == false)
        {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['Client']['password']);            
            $user = $this->Client->find('first', array('conditions' => array('Client.email' => $this->data['Client']['email'], 'Client.password' =>$password)));            
            if($user != false)
            {
                if($user['Client']['status']=="Active")
                {
                    $record_arr=array('Client'=>array('id'=>$user['Client']['id'],'last_login'=>$this->currentDateTime));
                    $this->Client->save($record_arr);
                    $this->Session->setFlash(__('Thank you for logging in!'),'flash', array('alert'=> 'success'));
                    $this->Session->write('frontUser', $user);                
                    $this->Redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                    exit();
                }
                else
                {
                    $status=$user['Client']['status'];
                    $this->Session->setFlash(__d('default',"You are %s Member! Please contact administrator",$status),'flash', array('alert'=> 'danger'));
                    $this->Redirect(array('action' => 'login'));
                    exit();
                }
            }
            else
            {
                $this->Session->setFlash(__('Incorrect username/password!'),'flash', array('alert'=> 'danger'));
                $this->Redirect(array('action' => 'login'));
                exit();
            }
        } 
    }
    public function logout()
    {
        $this -> Session -> destroy();
        $this -> Session -> setFlash(__('You have logged out'),'flash', array('alert'=> 'success'));
        $this -> Redirect(array('action' => 'login'));
        exit();
    }    
}

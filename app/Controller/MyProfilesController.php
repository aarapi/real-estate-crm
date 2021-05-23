<?php
class MyProfilesController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
        $this->userId=$this->userValue['Client']['id'];
    }
    public function index()
    {
        $post=$this->MyProfile->findById($this->userId);
        $this->set('post',$post);
    }
}

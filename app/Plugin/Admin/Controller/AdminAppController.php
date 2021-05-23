<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class AdminAppController extends AppController
{
    public $helpers = array('Html', 'Form','Session','Paginator','MenuBuilder.MenuBuilder');
    public $components = array('Session','Paginator');
    function authenticate()
    {
        // Check if the session variable User exists, redirect to loginform if not
        if(!$this->Session->check('User'))
        {
            $this->redirect(array('controller' => 'Users', 'action' => 'login_form'));
            exit();
        }
    } 
    public function beforeFilter()
    {
        parent::beforeFilter();
        $currAction=strtolower($this->action);
        $currController=strtolower($this->params['controller']);
        if($currController=="admin")
        {
            $this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
            exit();
        }
        if($currAction!='login_form' && $currController!='forgots')
        {
            $this->authenticate();            
        }
        if($currAction!='login_form' && $currAction!='myprofile' && $currAction!='editprofile' && $currController!='eldialogs' && $currAction!='changepass' && $currAction!='logout' && $currController!='forgots')
        {
            $userPermissionArr=$this->userPermission();
            $this->userPermissionArr=$userPermissionArr['PageRight'];
            $this->set('userPermissionArr',$this->userPermissionArr);
        }
        $menu=array();
        $mainMenu=array();
        $mainMenu=$this->userMenu('0');
        if($mainMenu)
        {
            $subMenu=array();$menu=array();$dropdownIcon=null;
            foreach($mainMenu as $value)
            {
                $menuPost=$this->userMenu($value['Page']['id']);
                if($menuPost)
                {
                    foreach($menuPost as $menuValue)
                    {
                        $subMenu[]=array(array('title' =>'<i class="'.$menuValue['Page']['icon'].'"></i><span>'.__($menuValue['Page']['page_name']).'</span>','url' => array('controller' => $menuValue['Page']['controller_name'], 'action' => $menuValue['Page']['action_name'])));
                    }
                    $subMenu=call_user_func_array('array_merge',$subMenu);
                }
                $menu[] = array(array('title' =>'<i class="'.$value['Page']['icon'].'"></i><span>'.__($value['Page']['page_name']).'</span>','url' => array('controller' => $value['Page']['controller_name'], 'action' => $value['Page']['action_name']),'children'=>$subMenu,'selName'=>$value['Page']['sel_name']));
                $subMenu=array();
            }
            $menu=array('slide-out' =>call_user_func_array('array_merge',$menu));
        }
        $this->set(compact('menu'));
        $this->luserId=$this->adminValue['User']['id'];
        $this->agencyId=$this->adminValue['User']['project_id'];
        $this->userType=$this->adminValue['Ugroup']['type'];
        $this->set('userType',$this->userType);
    }
    public function userPermission()
    {
        $this->loadModel('Page');
        $isPermission=true;
        $UserArr=$this->Session->read('User');
        if($UserArr['Ugroup']['type']!='ADR')
        {
            $userPermissionArr=$this->Page->find('first',array('joins'=>array(array
                                                                       ('table'=>'page_rights','alias'=>'PageRight','type'=>'Inner',
                                                                        'conditions'=>array('Page.id=PageRight.page_id'))),
                                                        'conditions'=>array('PageRight.ugroup_id'=>$UserArr['User']['ugroup_id'],'LOWER(Page.controller_name)'=>strtolower($this->params['controller'])),
                                                        'fields'=>array('Page.*','PageRight.*')));
            if(!isset($userPermissionArr['PageRight']['view_right']) || $userPermissionArr['PageRight']['view_right']==0)
            $isPermission=false;
            if($isPermission==false)
            {
                $this->Session->setFlash('No Permission!','flash',array('alert'=>'danger'));
                $this->redirect(array('controller'=>'','action' => 'Dashboards'));
            }
        }
    }
    public function userMenu($id)
    {
        $UserArr=$this->Session->read('User');
        $this->loadModel('Page');
        if($UserArr['User']['ugroup_id']==1)
        {
            $menuArr=$this->Page->find('all',array('conditions'=>array('parent_id'=>$id,'published'=>'Yes'),'order'=>array('ordering'=>'asc')));
        }
        else
        {
            $menuArr=$this->Page->find('all',array('joins'=>array(array
                                                                   ('table'=>'page_rights','alias'=>'PageRight','type'=>'Inner',
                                                                    'conditions'=>array('Page.id=PageRight.page_id'))),
                                                    'conditions'=>array('PageRight.ugroup_id'=>$UserArr['User']['ugroup_id'],'parent_id'=>$id,'published'=>'Yes'),
                                                    'order'=>array('Page.ordering'=>'asc')));
        }
        return$menuArr;
    }
}

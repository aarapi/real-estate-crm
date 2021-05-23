<?php
class FavouritepropertiesController extends AppController
{
    var $name="Property";
    public $helpers = array('Html', 'Form','Session','Paginator','Js'=> array('Jquery'));
    public $components = array('Session','Paginator','search-master.Prg','CustomFunction');
    public $presetVars = true;
    var $paginate = array('joins'=>array(array('table'=>'favourites','alias'=>'Favourite','type'=>'INNER','conditions'=>array('Property.id=Favourite.property_id')))
                          ,'page'=>1,'order'=>array('Favouriteproperty.id'=>'desc'));
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->userId=$this->userValue['Client']['id'];
    }
    public function index()
    {  
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        if($this->Session->check('frontUser'))
        $this->Paginator->settings['conditions'] =array('Favourite.client_id'=>$this->userId);
        else
        $this->Paginator->settings['conditions'] =array('Favourite.session_id'=>session_id());
        $this->Paginator->settings['limit']=$this->pageLimit;
        $this->Paginator->settings['maxLimit']=$this->maxLimit;
        $fProperty=$this->Paginator->paginate();
        if(!$fProperty)
        {
            $this->Session->setFlash(__('No record found'),'flash', array('alert'=> 'danger'));
            $searchRecord="No";
        }
        else
        {
            $searchRecord="Yes";
        }
        $this->set('searchRecord',$searchRecord);
        $this->set('fProperty', $fProperty);
        if ($this->request->is('ajax'))
        {
            $this->layout='ajax';
            $this->render('/Favouriteproperties/index','ajax'); // View, Layout
        }
        $this->render('/Favouriteproperties/index');
    }
}
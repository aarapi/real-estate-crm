<?php
class EldialogsController extends AdminAppController
{
    public $helpers = array('TinymceElfinder.TinymceElfinder');
    public $components = array('TinymceElfinder.TinymceElfinder');
    public function elfinder()
    {
        $this->TinymceElfinder->elfinder();
    }
    public function connector()
    {
        $this->TinymceElfinder->connector();
    }
}

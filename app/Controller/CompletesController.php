<?php
class CompletesController extends AppController {
    public function index()
    {
	$this->layout=null;
	if (!file_exists(TMP.'installed.txt'))
	{
            $this->redirect(array('controller'=>'Installers'));
        }	
    }    
}
?>
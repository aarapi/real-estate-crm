<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('ConnectionManager', 'Model');
ini_set('max_execution_time', 300);
class InstallersController extends AppController {
    var $uses = array();
		
    function beforeFilter() {
        if (file_exists(TMP.'installed.txt')) {
            echo __('Application already installed. Remove app/tmp/installed.txt to reinstall the application');
            exit();
        }
    }
		
    public function index()
    {
	$this->layout=null;
	ob_start(); 
	phpinfo(INFO_MODULES); 
	$info = ob_get_contents(); 
	ob_end_clean(); 
	$info = stristr($info, 'Client API version'); 
	preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
	$mysqlversion= @$match[0];
	$this->set('mysqlversion',$mysqlversion);
	$file = new File(APP.'/Config/database.php');
	if(!$file->writable())
	$this->set('dbfile','<span class="label label-danger">'.__('Unwritable').'</span>');
	else
	$this->set('dbfile','<span class="label label-success">'.__('Writable').'</span>');
	$file->close();
	$file = new File(TMP.'temp.txt',true,0777);
	if(!$file->writable())
	$this->set('tmpfile','<span class="label label-danger">'.__('Unwritable').'</span>');
	else
	$this->set('tmpfile','<span class="label label-success">'.__('Writable').'</span>');
	$file->delete();
	$file->close();	
    }
    public function step1()
    {
	$this->layout=null;
	if(!$this->request->is(array('post', 'put')))
	{
	    $this->redirect(array('action' => 'index'));
	}
	
    }
    public function step2()
    {
	$this->layout=null;
	$file = new File(APP.'/Config/database.php');
	$file->open('r');
	if(!$file->writable())
	{
	    $this->Session->setFlash(__("Unfortunately! File Permission Error<br>Please goto app/Config/database.php is in writable mode."),'flash', array('alert'=> 'danger'));
	    $this->redirect(array('action' => 'index'));
	    exit;
	}
	if($this->request->is(array('post', 'put')) || $file->size()>0)
	{
	    if($this->request->is(array('post', 'put')) && isset($this->request->data['Installer']['dbconnection']))
	    {
		$file = new File(APP.'Config/database.php');
		$default='$default';
		$dbLocalhost=$this->request->data['Installer']['hostname'];
		$dbName=$this->request->data['Installer']['dbname'];
		$dbUser=$this->request->data['Installer']['dbuser'];
		$dbPassword=$this->request->data['Installer']['dbpassword'];
		$dbType=$this->request->data['Installer']['dbtype'];
		$content="<?php
		class DATABASE_CONFIG {
		public $default = array(
			'datasource' => 'Database/$dbType',
			'persistent' => false,
			'host' => '$dbLocalhost',
			'login' => '$dbUser',
			'password' => '$dbPassword',
			'database' => '$dbName',
			'prefix' => '',
			'encoding' => 'utf8',
		);	
		}
		?>";
		$file->open('w',true);
		$file->write($content,'w',true);
		$file->close();
		try
		{
		    $db = ConnectionManager::getDataSource('default');		    
		}
		catch (Exception $e)
		{
		    $this -> Session -> setFlash($e->getMessage(),'flash', array('alert'=> 'danger'));
		    $this->redirect(array('action' => 'step2'));
		}
		$this->Session->setFlash(__("A connection was successfully established with the server."),'flash',array('alert'=>'success'));
		$this->redirect(array('action' => 'step3'));
	    }
	}	
	else
	{
	    $this->redirect('/installers');
	}
    }
    public function step3()
    {
	$this->layout=null;
	$file = new File(APP.'/Config/database.php');
	$file->open('r');
	if($file->size()==0)
	{
	    $this->redirect('/installers');
	}
	$file->close();
	if($this->request->is(array('post', 'put')) && isset($this->request->data['Installer']['step3']) && strlen($this->request->data['Installer']['timezone'])>0)
	{
	    $this->database($this->request->data['Installer']['installdata']);
	    $this->loadModel('Configuration');
	    $this->Configuration->id=1;
	    $this->Configuration->save($this->request->data['Installer']);
	    $this->thanks();
	    $this->redirect(array('controller'=>'/Completes'));
	}
    }
    function database($installdata)
    {
        try
	{
	    $db = ConnectionManager::getDataSource('default');
	    if(!$db->isConnected()) {
		echo __('Could not connect to database. Please check the settings in app/Config/database.php and try again');
		exit();
	    }
	    if($installdata==1)
	    $this->__executeSQLScript($db, TMP.DS.'app_data.sql');
	    else
	    $this->__executeSQLScript($db, TMP.DS.'app.sql');
	}
	catch (Exception $e)
	{
	    $this -> Session -> setFlash(__($e->getMessage()),'flash', array('alert'=> 'danger'));
	}
    }
		
    public function thanks()
    {
	try
	{
	    $file = new File(TMP.'installed.txt',true,0777);
	    if(!$file->writable())
	    {
		$this->Session->setFlash(__("Unfortunately! Folder Permission Error<br>Please tmp folder is in writable mode."),'flash', array('alert'=> 'danger'));
		$this->redirect(array('action' => 'step3'));
		exit;
	    }
	    $file->write(date('Y-m-d, H:i:s'),'w',true);
	    $file->close();
	}
	catch (Exception $e)
	{
	    $this->Session->setFlash(__("Unfortunately! Folder Permission Error<br>Please tmp folder is in writable mode."),'flash', array('alert'=> 'danger'));
	    $this->redirect(array('action' => 'step3'));
	    exit;
	}
    }
		
    function __executeSQLScript($db, $fileName) {
        $statements = file_get_contents($fileName);
        $statements = explode(';', $statements);
			
        foreach ($statements as $statement) {
            if (trim($statement) != '') {
                $db->query($statement);
            }
        }
    }    
}
?>
<?php
$config = array (
	'Elfinder' => array (
		'title' => __('File Manager'),
		'width' => 900,
		'height' => 500,
		'resizable' => 'yes',
			
/**
 * 
 * for urls
 * before cake 2.4 use FULL_BASE_URL
 * starting cake 2.4 Router::fullbaseUrl()
 * 
 * window_url - the url by which the elfinder window is called
 * if we set 'window_url' => Router::fullbaseUrl().'/posts/elfinderWindow',
 *  		 'connector_url' => Router::fullbaseUrl().'/posts/elfinderConnector',
 * than we should create actions elfinderWindow and elfinderConnector in posts controller like this
 * public function elfinderWindow() {
 * 		$this->TinymceElfinder->elfinder();
 * }
 * public function elfinderConnector() {
 * 		$this->TinymceElfinder->connector();
 * }
 *  			
 */			
		'window_url' => Router::url('/',true).'admin/Eldialogs/elfinder',		// call elfinder window
		'connector_url' => Router::url('/',true).'admin/Eldialogs/connector',	// connect to retrive files
		'locale' => Configure::read('Config.language'), 
			
/**
 * for full list of options as well as documentation 
 * visit https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
 *  		
 */		
		'options' => array(
			//'debug' => true,
			'roots' => array(
				array(
					'driver'        => 'LocalFileSystem',   					// driver for accessing file system (REQUIRED)
					'URL'   		=> Router::url('/',true).'img/Uploads',	// upload main folder
					'path'          => IMAGES.'Uploads',        				// path to files (REQUIRED)
					'accessControl' => 'access',            					// disable and hide dot starting files (OPTIONAL)
					'disabled' => array('mkfile', 'edit', 'rename','archive','extract'),
                                        'attributes' => array(
						array(
							'pattern' => '/\.(txt|html|php|py|pl|sh|xml|htm|asp|aspx)$/i',
							'hidden' => true
						)
					),
                                        'uploadAllow' => array('image/png', 'image/jpeg', 'image/gif','application/zip','application/pdf','application/msword','application/vnd.ms-word',
                                                               'application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-excel',
                                                               'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-powerpoint',
                                                               'application/vnd.openxmlformats-officedocument.presentationml.presentation','application/vnd.oasis.opendocument.text',
                                                               'application/vnd.oasis.opendocument.spreadsheet','text/csv','audio/mpeg','video/quicktime','video/mp4','audio/ogg'), 
                                        'uploadDeny'  => array('all'),
                                        'uploadOrder' => 'deny,allow',
					'tmbPath' => 'tumbnails',
					'uploadOverwrite' => false,
				)
			)
				
		)
	) 
);

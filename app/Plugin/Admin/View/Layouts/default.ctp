<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
  <html lang="<?php echo$configLanguage;?>" dir="<?php echo$dirType;?>">
    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	  <meta name="description" content="<?php echo$siteDescription;?>" />
	  <meta name="author" content="<?php echo$siteName;?>" />
	  <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f">
	  <?php echo $this->Html->charset();?>
	  <title><?php echo $siteTitle;?></title>
	<meta name="description" content="<?php echo$siteDescription;?>"/>
	
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('font-awesome.min');
		  echo $this->Html->css('/design2000/assets/css/bootstrap');
		  echo $this->Html->css('/design2000/assets/css/bootstrap.min');
		
		  echo $this->Html->css('/design2000/assets/css/core');
		  echo $this->Html->css('/design2000/assets/css/components');
		  echo $this->Html->css('/design2000/assets/icons/fontawesome/styles.min');
		  echo $this->Html->css('/design2000/lib/css/chartist.min');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->Html->css('bootstrap-multiselect');
		echo $this->Html->css('bootstrap-datetimepicker.min');
		echo $this->Html->css('style');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('/design800/js/plugins/jquery-1.11.2.min');
		 // echo $this->Html->script('/design2000/lib/js/jquery.min');
		 echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		
		  echo $this->Html->script('/design2000/lib/js/tether.min');
		  //echo $this->Html->script('/design2000/lib/js/bootstrap.min');
		  echo $this->Html->script('/design2000/lib/js/chartist.min');
		  echo $this->Html->script('/design2000/assets/js/app.min');
		
		echo $this->Html->script('bootstrap-multiselect');
		echo $this->Html->script('moment-with-locales');
		echo $this->Html->script('bootstrap-datetimepicker.min');
		echo $this->Html->script('waiting-dialog.min');
		echo $this->Html->script('main.custom.min');
		echo $this->Html->script("langs/$configLanguage");
		echo $this->Html->script('print');
		
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
		$UserArr=$this->Session->read('User');
?>
<?php if($translate>0){?>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
</head>
    <?php if($this->Session->check('User')){?>
     
     
     <body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-toggleable-md">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav">
            <span>
                <i class="fa fa-code-fork"></i>
            </span>
        </button>

        <button class="navbar-toggler navbar-toggler-left" type="button" id="toggle-sidebar">
            <span>
               <i class="fa fa-align-justify"></i>
            </span>
        </button>

        <a class="navbar-brand logo" href="javascript:void(0);">
	   <span style="color: white;font-weight: 600;"><?php echo $siteName;?></span>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <button class="sidebar-toggle btn btn-flat" id="toggle-sidebar-desktop">
                <span>
                    <i class="fa fa-align-justify"></i>
                </span>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-has-after" href="javascript:void(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <?php echo $UserArr['User']['name'];?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		        <?php echo $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;'.__('Profile'),array('controller' => 'Users','action' => 'myProfile'),array('escape' => false,'class'=>'dropdown-item'));?>
			<?php echo $this->Html->link('<i class="fa fa-cog"></i>&nbsp;'.__('Password'),array('controller' => 'Users','action' => 'changePass'),array('escape' => false,'class'=>'dropdown-item'));?>
			<?php echo $this->Html->link('<i class="fa fa-power-off"></i>&nbsp;'.__('Logout'),array('controller' => 'Users','action' => 'logout'),array('escape' => false,'class'=>'dropdown-item'));?>
			
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /NAVBAR -->

    <div class="page-container">
        <div class="page-content">
            <!-- inject:SIDEBAR -->

            <div id="sidebar-main" class="sidebar sidebar-default">
    <div class="sidebar-content">
        <ul class="navigation">
            <li class="navigation-header">
                <span><?php echo __('Main');?></span>
                <i class="icon-menu"></i>
            </li>
	</ul>
        <?php echo $this->MenuBuilder->build('slide-out');?>    
    </div>
</div>
<div class="content-wrapper">
                <div class="content">
            
            <!-- inject:/SIDEBAR -->
	    <?php echo $this->fetch('content');?></div></div>
        </div>
    </div>



     
     
     
     
     
  <!-- END FOOTER -->
        <?php } else{
	echo $this->Html->css('/design800/css/layouts/page-center');
	?>
	<body >
	  <div class="page-container"><br/><br/><br/>
	    <center><?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'responsive-img '));}?></center>
           
          
	   <?php  echo $this->fetch('content');?>
	   
    
	  <?php  }?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-content">        
</div>
</div>
</body>
</html>
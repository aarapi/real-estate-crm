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
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('/design800/css/materialize.min');
		echo $this->Html->css('/design800/css/style.min');		
                echo $this->Html->css('/design800/js/plugins/prism/prism');
		echo $this->Html->css('/design800/js/plugins/perfect-scrollbar/perfect-scrollbar');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->Html->css('bootstrap-multiselect');
		echo $this->Html->css('bootstrap-datetimepicker.min');
		echo $this->Html->css('style');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('/design800/js/plugins/jquery-1.11.2.min');
		echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design800/js/materialize.min');
		echo $this->Html->script('/design800/js/plugins/prism/prism');
		echo $this->Html->script('/design800/js/plugins/perfect-scrollbar/perfect-scrollbar.min');
		echo $this->Html->script('/design800/js/plugins.min');
		echo $this->Html->script('/design800/js/custom-script');
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
     <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
		  <ul class="left">                      
                      <li><h1 class="logo-wrapper">		      
		      <?php if(strlen($frontLogo)>0){echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'brand-logo darken-1 responsive-img valign profile-image'));} else{?><span class="logo-text"><?php echo $siteName;?></span><?php echo$siteName; }?>
		     </h1></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">
		     <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="user-detaildrop-dropdown"><?php echo $UserArr['User']['name'];?></a>
                      </li>
                       <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>                        
		    </ul>
		   <!-- translation-button -->
                    <ul id="user-detaildrop-dropdown" class="dropdown-content">
			    <li><?php echo $this->Html->link('<i class="fa fa-pencil"></i>&nbsp;'.__('Profile'),array('controller' => 'Users','action' => 'myProfile'),array('escape' => false));?></li>
			    <li><?php echo $this->Html->link('<i class="fa fa-cog"></i>&nbsp;'.__('Password'),array('controller' => 'Users','action' => 'changePass'),array('escape' => false));?></li>
			    <li><?php echo $this->Html->link('<i class="fa fa-power-off"></i>&nbsp;'.__('Logout'),array('controller' => 'Users','action' => 'logout'),array('escape' => false));?></li>
			  </ul>
		    
		 </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
	<?php echo $this->MenuBuilder->build('slide-out');?>
	<a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
	 </aside>
      
    
     <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
		<div class="mrg">
                <?php echo $this->fetch('content');?>
		</div>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
      
        <!--end container-->
      </section>
      <!-- END CONTENT -->

    </div>
  
    </div>
  
    
      
  <!-- END MAIN -->
    <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span><?php echo$siteName;?> &copy; <?php echo $this->Time->format('Y',$siteTimezone);?></span>
        <span class="right"> <strong><?php echo __('Powered by');?> <?php echo$this->Html->Link(__('Silver Syclops'),'http://www.silversyclops.net',array('class'=>'footer_link','target'=>'_blank'));?></strong></span>
        </div>
    </div>
  </footer>
  
  <!-- END FOOTER -->
        <?php } else{
	echo $this->Html->css('/design800/css/layouts/page-center');
	?>
	<body class="cyan">
	  <div id="login-page" class="row">
	    <div class="col s16 z-depth-4 card-panel">
       <div class="row">
          <div class="input-field col s12 center">
	    <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'responsive-img valign profile-image-login'));}?>
           <p class="center login-form-text"><?php echo __('%s Admin Panel',$siteName);?></p>
          </div>
       </div>	  
       
	   <?php  echo $this->fetch('content');?>
	   
    </div>
    </div>
	  <?php  }?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-content">        
</div>
</div>
</body>
</html>
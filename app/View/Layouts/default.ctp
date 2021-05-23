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
<?php if($this->Session->check('frontUser') && strtolower($this->params['controller'])!="properties" && strtolower($this->params['controller'])!="fronts"
	  && strtolower($this->params['controller'])!="registers" && strtolower($this->params['controller'])!="clients"
	  && strtolower($this->params['controller'])!="agents" && strtolower($this->params['controller'])!="favouriteproperties" && strtolower($this->params['controller'])!="contents"
	  && strtolower($this->params['controller'])!="contacts" && strtolower($this->params['controller'])!="agencies"){?>
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
	
		<?php echo $this->Html->meta('icon');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700&subset=latin,latin-ext');
		echo $this->Html->css('style');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('/design1000/assets/libraries/owl-carousel/owl.carousel.css');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('/design1000/assets/css/leaflet.css');
		echo $this->Html->css('/design1000/assets/css/leaflet.markercluster.css');
		echo $this->Html->css('/design1000/assets/css/leaflet.markercluster.default.css');
		echo $this->Html->css('/design1000/assets/css/magnific-popup.css');
		echo $this->Html->css('/design1000/assets/css/villareal-turquoise.css');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design1000/assets/js/jquery.js');
		echo $this->Html->script('/design1000/assets/js/tether.min.js');
		echo $this->Html->script('/design1000/assets/js/bootstrap.min.js');		
		echo $this->Html->script('/design1000/assets/js/leaflet.js');
		echo $this->Html->script('/design1000/assets/js/leaflet.markercluster.js');
		echo $this->Html->script('/design1000/assets/libraries/owl-carousel/owl.carousel.min.js');
		echo $this->Html->script('/design1000/assets/js/jquery.magnific-popup.min.js');
		echo $this->Html->script('http://maps.google.com/maps/api/js?key='.$mapKey);
		echo $this->Html->script('/design1000/assets/js/custom.js');
		echo $this->Html->script('waiting-dialog.min');
		echo $this->Html->script('custom.min');
		echo $this->Html->script("langs/$configLanguage");
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
		$UserArr=$this->Session->read('frontUser');
 ?>
<?php if($translate>0){?>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
</head>
   

<body class="">
	<div class="page-wrapper">
		<div class="dashboard-wrapper">
			<div class="dashboard-sidebar">
				<div class="dashboard-title">
					<a href="#">
					  <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'40'));} else{?>
						<span class="logo-shape"></span> <?php echo$siteName;
						}?>
					</a>

					<button class="navbar-toggler pull-xs-right hidden-lg-up" type="button" data-toggle="collapse" data-target=".dashboard-nav-primary">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>						
				</div><!-- /.dashboard-title -->

				<div class="dashboard-user hidden-md-down">
				<?php $photoUrl=$this->Html->url(array('controller'=>'img'));
				    if($UserArr['Client']['photo']==null){$urlPhoto=$photoUrl.'/user-icon.png';}else{$urlPhoto=$photoUrl.'/'.$UserArr['Client']['dir'].'_thumb/'.$UserArr['Client']['photo'];}?>
				     	<div class="dashboard-user-image" style="background-image: url(<?php echo $urlPhoto;?>)">
					</div><!-- /.dashboar-user-image -->
					<strong><?php echo $UserArr['Client']['name'];?></strong>
				</div><!-- /.dashboard-user -->

				<div class="dashboard-nav-primary collapse navbar-toggleable-md">
					<ul class="nav nav-stacked">

	      <?php foreach ($menuArr as $menu):
	      $menuIcon=$menu['Page']['icon'];$menuName=$menu['Page']['model_name'];?>
	      <li class="nav-item" <?php echo (strtolower($this->params['controller'])==strtolower($menu['Page']['controller_name']) || in_array(strtolower($this->params['controller']),explode(",",strtolower($menu['Page']['sel_name']))))?"class=\"active\"":"";?>><?php echo $this->Html->link("<i class=\"$menuIcon\"></i>&nbsp;<span>$menuName</span>",array('controller' => $menu['Page']['controller_name'],'action'=>$menu['Page']['action_name']),array('escape' => false,'class'=>'nav-link'));?></li>
	      <?php endforeach;unset($menu);?>					
					</ul>
				</div><!-- /.dashboard-nav-primary -->
				
			</div><!-- /.dashboard-sidebar -->

			<div class="dashboard-content">	
				<div class="container-fluid">
					<div class="dashboard-header">
						
					</div><!-- /.dashboard-header -->
                                       <?php echo $this->fetch('content');?>
					
				</div><!-- /.container -->						
			</div><!-- /.dashboard-content -->			
		</div><!-- /.dashboard -->
	</div><!-- /.page-wrapper -->
	<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-content">        
</div>
</div>
</body>   
    
    
</html>
        <?php } else{?>
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
		<?php echo $this->Html->meta('icon');
		echo $this->Html->css('https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700&subset=latin,latin-ext');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('/design1000/assets/libraries/owl-carousel/owl.carousel.css');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('/design1000/assets/css/leaflet.css');
		echo $this->Html->css('/design1000/assets/css/leaflet.markercluster.css');
		echo $this->Html->css('/design1000/assets/css/leaflet.markercluster.default.css');
		echo $this->Html->css('/design1000/assets/css/magnific-popup.css');
		echo $this->Html->css('/design1000/assets/css/villareal-turquoise.css');
		echo $this->Html->css('/design1000/assets/css/style.css');
		echo $this->Html->css('validationEngine.jquery');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');
		echo $this->Html->script('/design1000/assets/js/jquery.js');
		echo $this->Html->script('/design1000/assets/js/tether.min.js');
		echo $this->Html->script('/design1000/assets/js/bootstrap.min.js');		
		echo $this->Html->script('/design1000/assets/js/leaflet.js');
		echo $this->Html->script('/design1000/assets/js/leaflet.markercluster.js');
		echo $this->Html->script('/design1000/assets/libraries/owl-carousel/owl.carousel.min.js');
		echo $this->Html->script('/design1000/assets/js/jquery.magnific-popup.min.js');
		echo $this->Html->script('/design1000/assets/js/custom.js');
		echo $this->Html->script('waiting-dialog.min');
		echo $this->Html->script('custom.min');
		echo $this->Html->script("langs/$configLanguage");
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
?>   
	
</head>
    
<body class="<?php if($this->params['controller']=="fronts"){?>cover-pull-top header-transparent<?php }else{?>header-sticky<?php }?>">
<div class="page-wrapper">
  <?php if($this->params['controller']!="fronts"){?>
  <div class="header-wrapper">
	<div class="header">
	<ul class="nav nav-pills nav-topbar">
							<?php if(!$this->Session->check('frontUser')){ if($frontRegistration){?><li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-user-plus"></i> '.__('Register'),array('controller'=>'Registers','action'=>'index'),array('escape'=>false));?></li><?php }?>
							<li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-lock"></i> '.__('Login'),array('controller'=>'Clients','action'=>'login'),array('escape'=>false));?></li><?php }?>
							<li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-heart"></i> '.__('Favourite Properties'),array('controller'=>'Favouriteproperties','action'=>'index'),array('escape'=>false));?></li>
							<li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-balance-scale"></i> '.__('Compare Properties'),array('controller'=>'Compareproperties','action'=>'index'),array('escape'=>false));?></li>							
						</ul>
		<div class="header-inner">
			<div class="container">
					<div class="header-top">
					<div class="header-top-inner">
						<a class="header-logo" href="#">
							  <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'40'));} else{?>
							  <span class="header-logo-text"><?php echo $siteName;?></span>
							  <?php }?>
							
						</a><!-- /.header-logo -->

						<div class="header-information">
							<i class="fa fa-at"></i>
							<div class="header-information-block">
								<strong><?php echo $siteEmail;?></strong>
								<span><?php echo __('Ask Us Anything');?></span>
							</div><!-- /.header-information-block -->
						</div><!-- /.header-information -->

						<div class="header-information">
							<i class="fa fa-phone"></i>

							<div class="header-information-block">
								<strong><?php echo $contact;?></strong>
								<span><?php echo __('Call Us Monday To Friday');?></span>
							</div><!-- /.header-information-block -->
						</div><!-- /.header-information -->

						<button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target=".nav-primary-wrapper">
	                        <span></span>
	                        <span></span>
	                        <span></span>
	                    </button>							
					</div><!-- /.header-top-inner -->
				</div><!-- /.header-top -->

				<div class="header-bottom">
					<div class="header-bottom-inner">
						
<div class="nav-primary-wrapper collapse navbar-toggleable-sm">
	<ul class="nav nav-pills nav-primary">
	<?php if($this->Session->check('frontUser')){ foreach($frontmenuArr as $menuName=>$menu): $menuIcon=$menu['icon'];h($menuName);if($this->params['controller']=="pages"){$this->params['controller']="";}$isMenu=true;$activeMenu='nav-link';?>
		<?php if($isMenu==true && strtolower($this->params['controller'])==strtolower($menu['controller'])){$activeMenu="nav-link active";}else{$activeMenu="nav-link";}?>
	      <li class="nav-item"><?php echo $this->Html->link("<span class=\"$menuIcon\"></span>&nbsp;$menuName",array('controller' => $menu['controller'],'action'=>$menu['action']),array('class'=>$activeMenu,'escape' => false));?></li>
	      <?php endforeach;unset($menu);unset($menuName);unset($menuIcon);}?>
	      <?php foreach($contents as $menu): $menuName='<span class="'.h($menu['Content']['page_icon']).'"></span>&nbsp;'.$menu['Content']['link_name'];
	      if(($menu['Content']['url']!="{siteDomain}/Registers" || !$this->Session->check('frontUser') && $frontRegistration==1) && ($menu['Content']['url']!="{siteDomain}/Clients" || !$this->Session->check('frontUser'))){
	      if($menu['Content']['is_url']=="External")
	      $pageUrl=strtolower(str_replace("{siteDomain}/","",$menu['Content']['url']));
	      else
	      $pageUrl=strtolower($menu['Content']['page_url']);
	      if(strtolower($this->params['controller'])==strtolower($pageUrl)){$activeMenu="nav-link active";}else{$activeMenu="nav-link";}
	      if($menu['Content']['is_url']=="External"){?><li class="nav-item"><?php echo$this->Html->link('<span class="'.$menu['Content']['page_icon'].'"></span>&nbsp;'.$menu['Content']['link_name'],str_replace("{siteDomain}",$siteDomain,$menu['Content']['url']),array('class'=>$activeMenu,'target'=>$menu['Content']['url_target'],'escape'=>false));?></li><?php }
	      else{?><li <?php echo (strtolower($this->params['controller'])==strtolower($menu['Content']['page_url']))?>" class="nav-item"><?php echo $this->Html->link($menuName,array('controller' => 'Contents','action'=>'pages',$menu['Content']['page_url']),array('class'=>$activeMenu,'escape' => false));?></li><?php }}?>
	      <?php endforeach;unset($menu);unset($menuName);?>																	
	</ul><!-- /.nav -->
</div><!-- /.nav-primary -->


						
					</div><!-- /.header-bottom-inner -->
				</div><!-- /.header-bottom -->
			</div><!-- /.container -->
		</div><!-- /.header-inner -->
	</div><!-- /.header -->
</div><!-- /.header-wrapper-->
<?php }else{?>
<div class="header-wrapper">
	<div class="header header-small">
		<div class="header-inner">
			<div class="container">
				<div class="header-top">
					<div class="header-top-inner">
					<ul class="nav nav-pills nav-topbar">
							<?php if($frontRegistration){?><li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-user-plus"></i> '.__('Register'),array('controller'=>'Registers','action'=>'index'),array('escape'=>false));?></li><?php }?>
							<li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-lock"></i> '.__('Login'),array('controller'=>'Clients','action'=>'login'),array('escape'=>false));?></li>
							<li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-heart"></i> '.__('Favourite Properties'),array('controller'=>'Favouriteproperties','action'=>'index'),array('escape'=>false));?></li>
							<li class="nav-item"><?php echo $this->Html->link('<i class="fa fa-balance-scale"></i> '.__('Compare Properties'),array('controller'=>'Compareproperties','action'=>'index'),array('escape'=>false));?></li>							
						</ul>
						<a class="header-logo" href="#">
							  <?php if(strlen($frontLogo)>0){?><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'','height'=>'40'));} else{?>
							  <span class="header-logo-text"><?php echo $siteName;?></span>
							  <?php }?>
							
						</a><!-- /.header-logo -->

						
						
<div class="nav-primary-wrapper collapse navbar-toggleable-sm">
	<ul class="nav nav-pills nav-primary">
	<?php if($this->Session->check('frontUser')){ foreach($frontmenuArr as $menuName=>$menu): $menuIcon=$menu['icon'];h($menuName);if($this->params['controller']=="pages"){$this->params['controller']="";}$isMenu=true;$activeMenu='nav-link';?>
		<?php if($isMenu==true && strtolower($this->params['controller'])==strtolower($menu['controller'])){$activeMenu="nav-link active";}else{$activeMenu="nav-link";}?>
	      <li class="nav-item"><?php echo $this->Html->link("<span class=\"$menuIcon\"></span>&nbsp;$menuName",array('controller' => $menu['controller'],'action'=>$menu['action']),array('class'=>$activeMenu,'escape' => false));?></li>
	      <?php endforeach;unset($menu);unset($menuName);unset($menuIcon);}?>
	      <?php foreach($contents as $menu): $menuName=h($menu['Content']['link_name']);
	      if(strtolower($contentId)==strtolower($menu['Content']['page_url'])){$activeMenu="nav-link active";}else{$activeMenu="nav-link";}
	      if($menu['Content']['is_url']=="External"){?><li class="nav-item"><?php echo$this->Html->Link($menu['Content']['link_name'],str_replace("{siteDomain}",$siteDomain,$menu['Content']['url']),array('class'=>'nav-link','target'=>$menu['Content']['url_target']));?></li><?php }else{?><li <?php echo (strtolower($contentId)==strtolower($menu['Content']['page_url']))?>" class="nav-item"><?php echo $this->Html->link($menuName,array('controller' => 'Contents','action'=>'pages',$menu['Content']['page_url']),array('class'=>$activeMenu,'escape' => false));?></li><?php }?>
	      <?php endforeach;unset($menu);unset($menuName);?>																	
	</ul><!-- /.nav -->
</div><!-- /.nav-primary -->


						<button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target=".nav-primary-wrapper">
	                        <span></span>
	                        <span></span>
	                        <span></span>
	                    </button>						
					</div><!-- /.header-top-inner -->
				</div><!-- /.header-top -->
			</div><!-- /.container -->
		</div><!-- /.header-inner -->
	</div><!-- /.header -->
</div><!-- /.header-wrapper-->


<?php }?>
<?php echo $this->fetch('content');?>
<div class="footer-wrapper">
	<div class="container">
		<div class="footer-inner">
			
			<div class="footer-bottom">
				<div class="footer-left">
					<?php echo$siteName;?> &copy; <?php echo $this->Time->format('Y',$siteTimezone);?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo __('Time');?> <span><?php echo $this->Time->format('d-m-Y h:i:s A',$siteTimezone);?></span>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo __('Powered by');?> <?php echo$this->Html->Link(__('Silver Syclops'),'http://www.silversyclops.net',array('target'=>'_blank'));?>
							
				</div><!-- /.footer-left -->
			</div><!-- /.footer-bottom -->
		</div><!-- /.footer-inner -->
	</div><!-- /.container -->
</div><!-- /.footer-wrapper -->
</div><!-- /.page-wrapper -->
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

<?php if($this->params['controller']!="fronts"){echo $this->Html->script('/design1000/assets/js/scrollPosStyler.js');}?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-content">        
</div>
</div>
</body>
</html>
<?php }?>
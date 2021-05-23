<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>
	<?php echo __('Installation');?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
                echo $this->Html->css('style');
                echo $this->Html->css('validationEngine.jquery');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('html5shiv');
                echo $this->Html->script('respond.min');                
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.validationEngine-en');
                echo $this->Html->script('jquery.validationEngine');		
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
?>
</head>
  <body>
	<div class="container">
		<div class="row">	
			<div  class="col-md-12 mrg">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step1','name'=>'post_req','id'=>'post_req'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
						<p class="btn btn-primary"><?php echo __('Step 1 of 4');?></p>
						<h3><?php echo __('Server Configuration & Setup Requirements');?></h3>
						<div class="row">
						  <div class="col-md-6">
						    <div class="panel panel-default">
						      <div class="panel-heading"><span class="glyphicon glyphicon-wrench"></span><strong> <?php echo __('Setup Requirements');?></strong></div>
							<div class="panel-body">
							<?php echo __('Installing this software require certain server side extension and capability');?>,
							<?php echo __('please check below and compare with your server current statues on the right. You can click on the icon next to each technology for details.');?>
							  <div class="table-responsive">
							    <table class="table table-striped"> 
							      <thead>
								<tr>
								  <th><span class="text-primary"><?php echo __('Extensions &amp; Applications');?></span></th>
								  <th><span class="text-primary">&nbsp;</span></th>
								</tr>
							      </thead>
							      <tbody>
								<tr>
								  <td><?php echo __('HTTP Server. For example: Apache');?></td>
								  <td><span class="label label-success"><?php echo __('Require');?></span></td>
								</tr>
								<tr>
								  <td><?php echo __('PHP 5.2.8 or greater');?></td>
								  <td><span class="label label-success"><?php echo __('Require');?></span></td>
								</tr>
								<tr>
								  <td><?php echo __('Database Engine MySQL (4 or greater)');?></td>
								  <td><span class="label label-success"><?php echo __('Require');?></span></td>
								</tr>
								<tr>
								  <td><?php echo __('PDO Extension');?></td>
								  <td><span class="label label-success"><?php echo __('Require');?></span></td>
								</tr>
								<tr>
								  <td><?php echo __('GD Extension');?></td>
								  <td><span class="label label-warning"><?php echo __('Mandatory');?></span></td>
								</tr>
							      </tbody>							  
							  </table>
							</div>
						      </div>
						    </div>
						  </div>
						    <div class="col-md-6">
						    <div class="panel panel-default">
						      <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> <strong><?php echo __('Server Status');?></strong></div>
							<div class="panel-body">							  
							  <div class="table-responsive">
							    <table class="table table-striped">
							      <thead>
								<tr>
								  <th><span class="text-primary"><?php echo __('Extensions &amp; Applications');?></span></th>
								  <th><span class="text-primary">&nbsp;</span></th>
								</tr>
							      </thead>
							      <tbody>
								<tr>
								  <td><?php echo __('Web Server');?></td>
								  <td><span class="label label-default"><?php $wsarr=explode(" ",$_SERVER['SERVER_SOFTWARE']); echo$wsarr[0];?></span></td>
								</tr>
								<tr>
								  <td><?php echo __('PHP Version');?></td>
								  <td><?php $phpversion=phpversion(); if($phpversion>="5.2.8"){?><span class="label label-success"><?php echo phpversion();?></span><?php }else{?><span class="label label-warning"><?php echo $phpversion;?></span><?php }?></td>
								</tr>
								<tr>
								  <td><?php echo __('MYSQL Version');?></td>
								  <td><span class="label label-success"><?php echo$mysqlversion;?></span></td>
								</tr>
								<tr>
								  <td><?php echo __('PDO Extension');?></td>
								  <td><?php if (!defined('PDO::ATTR_DRIVER_NAME')){?><span class="label label-danger"><?php echo __('PDO Unavailable');?></span><?php }else{?><span class="label label-success"><?php echo __('PDO Available');?></span><?php }?></td>
								</tr>
								<tr>
								  <td><?php echo __('GD Extension');?></td>
								  <td><?php if (extension_loaded('gd') && function_exists('gd_info')) {?><span class="label label-success"><?php echo __('GD Availiable');?></span><?php } else{?><span class="label label-warning"><?php echo __('GD Unavailiable');?></span><?php }?></td>
								</tr>
							      </tbody>							  
							  </table>
							</div>
						      </div>
						    </div>
						  </div>
						</div>
						<div class="row">
						<div class="col-md-12">
						    <div class="panel panel-default">
						      <div class="panel-heading"><span class="glyphicon glyphicon-folder-open"></span> <strong>&nbsp;<?php echo __('Directory &amp; File Permission');?></strong></div>
						      <div class="panel-body">
							<p><?php echo __('These Folders of Files need to be');?> <span class="label label-success"><?php echo __('Writable');?></span> <?php echo __('for application to be installed.');?></p>
							  <div class="table-responsive">
							    <table class="table table-striped">
							      <thead>
								<tr>
								  <th><span class="text-primary"><?php echo __('Folders or Files');?></span></th>
								  <th><span class="text-primary">&nbsp;</span></th>
								</tr>
							      </thead>
							      <tbody>
								<tr>
								  <td><?php echo __('app/tmp/');?></td>
								  <td><?php echo $tmpfile;?></td>
								</tr>
								<tr>
								  <td><?php echo __('app/Config/database.php');?></td>
								  <td><?php echo $dbfile;?></td>
								</tr>													
							      </tbody>							  
							  </table>
							</div>
						      </div>
						    </div>
						  </div>
						</div>
						
						<?php echo$this->Html->Link(__('Refresh'),array('action'=>'index'),array('class'=>'btn btn-default'));?>
                                               <?php echo$this->Form->button(__("Let's Start"),array('class'=>'btn btn-success'));?>
                                                <?php echo$this->Form->end(null);?>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-footer">
				<div class="row">					
					<div class="col-md-12 text-center"><?php echo __('Visit our website');?> <?php echo$this->Html->link('Silver Syclops','http://www.silversyclops.net',array('target'=>'_blank'));?> <?php echo __('for documentation and support');?></div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
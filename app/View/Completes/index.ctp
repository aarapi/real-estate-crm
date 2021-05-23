<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>
	<?php echo __('Installation Complete');?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
                echo $this->Html->css('style');                
		echo $this->fetch('meta');		
		echo $this->fetch('css');
                echo $this->Html->script('jquery-1.8.2.min');
		echo $this->Html->script('html5shiv');
                echo $this->Html->script('respond.min');                
                echo $this->Html->script('bootstrap.min');
                echo $this->fetch('script');
                echo $this->Js->writeBuffer();		
?>
	<style>
	  .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
border-top: 0px solid #ddd;
}
	</style>
</head>
  <body>
	<div class="container">
		<div class="row">	
			<div  class="col-md-12 mrg">
				<div class="panel panel-default">					
                                        <div class="panel-body">						
						<div class="table-responsive">
						  <table class="table">
						  <boody>
						    <tr>
						      <td colspan="2" align="center">
							<?php echo$this->Html->image('logo-website.fw.png',array('alt'=>__('Elfemo'),'class'=>'img-responsive'));?>
						      </td>
						    </tr>
						    <tr>
						      <td colspan="2" align="center">
							<span class="text-muted"><h2><?php echo __('Aho! The System is installed  successfully');?>.</h2></span>
						      </td>
						    </tr>
						    <tr>
						      <td align="center"><?php echo$this->Html->link($this->Html->image('admin.png',array('alt'=>__('Admin'),'class'=>'responsive')),'../admin/',array('escape'=>false));?></td>
						      <td align="center"><?php echo$this->Html->link($this->Html->image('front.png',array('alt'=>__('Admin'),'class'=>'responsive')),'../',array('escape'=>false));?></td>
						  </tr>
						    <tr>
						      <td align="center"><span class="text-muted"><h4><strong><?php echo$this->Html->link(__('Go to Admin Interface'),'../admin/Dashboards');?></strong></h4></span></td>
						      <td align="center"><span class="text-muted"><h4><strong><?php echo$this->Html->link(__('Go to Front End/Client Interface'),'../');?></strong></h4></span></td>
						  </tr>
						    <tr>
						      <td align="center"><span class="text-danger"><strong><?php echo __('User');?> : admin</strong></span></td>
						      <td align="center"><span class="text-danger"><strong><?php echo __('User');?> : client@demo.com</strong></span></td>
						  </tr>
						    <tr>
						      <td align="center"><span class="text-danger"><strong><?php echo __('Password');?> : admin</strong></span></td>
						      <td align="center"><span class="text-danger"><strong><?php echo __('Password');?> : demo123</strong></span></td>
						  </tr>
						    </boody>
						  </table>
						</div>                                            
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
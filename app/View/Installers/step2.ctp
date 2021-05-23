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
<script>
	jQuery(document).ready(function(){
	// binds form submission and fields to the validation engine
	jQuery("#post_req").validationEngine();
	$("#checkme").click(function() {
        $("#submitaccept").attr("disabled", !this.checked);
      });
        });
	</script>
</head>
  <body>
	<div class="container">
		<div class="row">	
			<div  class="col-md-12 mrg">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'Edu Expression','class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step2','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
					  <p class="btn btn-primary"><?php echo __('Step 3 of 4');?></p>
					  <h4><?php echo __('Database Connection Settings');?></h4>
						<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Host Name');?></label>
								<div class="col-sm-10">
								  <div class="input-group">
								  <?php echo$this->Form->input('hostname',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Usually localhost')));?>
								  <div class="input-group-addon"><span class="glyphicon glyphicon-paperclip"></span></div>
								  </div>
							</div>
						</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Database Name');?></label>
								<div class="col-sm-10">
								  <div class="input-group">
								<?php echo$this->Form->input('dbname',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Database Name')));?>
								<div class="input-group-addon"><span class="glyphicon glyphicon-hdd"></span></div>
								  </div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Database User');?></label>
								<div class="col-sm-10">
								  <div class="input-group">
								<?php echo$this->Form->input('dbuser',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Database User Name')));?>
								<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
								  </div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Database Password');?></label>
								<div class="col-sm-10">
								  <div class="input-group">
								<?php echo$this->Form->password('dbpassword',array('class'=>'form-control','label'=>false,'placeholder'=>__('Database User Password')));?>
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
								  </div>
								</div>
							</div>
							<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Database Type');?></label>
							<div class="col-sm-10">
								<div class="row">
									<div class="radio-inline">                 
								      <?php echo $this->Form->radio('dbtype',array('Mysql'=>'Mysql','Mysqli'=>'Mysqli'),array('value'=>'Mysql','id'=>'qtype_id','legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
                                                                             'label'=>array('class'=>'radio-inline')));?>
								</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
								<?php echo$this->Form->hidden('dbconnection');?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <?php echo$this->Form->button(__('Test Connection'),array('class'=>'btn btn-success'));?>
								</div>
							</div>                                                
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
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
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'Rolftask','class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step3','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
					  <p class="btn btn-primary"><?php echo __('Step 4 of 4');?></p>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Site Name');?></label>
								<div class="col-sm-10">
								  <?php echo$this->Form->input('name',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Name of Your Website')));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label"><?php echo __('Domain Name');?></label>
								<div class="col-sm-10">
								  <?php echo$this->Form->input('domain_name',array('class'=>'form-control','label'=>false,'placeholder'=>__('http://yourdomain.com')));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Meta Keyword');?></label>
								<div class="col-sm-10">
								<?php echo$this->Form->input('meta_title',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Useful for SEO')));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Meta Description');?></label>
								<div class="col-sm-10">
								<?php echo$this->Form->input('meta_desc',array('class'=>'form-control','label'=>false,'placeholder'=>__('Meta Content for SEO')));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Time Zone');?></label>
								<div class="col-sm-10">
								<?php echo$this->Form->select('timezone',$this->Time->listTimezones(),array('empty'=>__('Please Select Timezone'),'required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Time Zone')));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Organization Name');?></label>
								<div class="col-sm-10">
								<?php echo$this->Form->input('organization_name',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Name of Your Organization/Company')));?>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Organization Email');?></label>
								<div class="col-sm-10">
								<?php echo$this->Form->input('email',array('required'=>true,'class'=>'form-control','label'=>false,'placeholder'=>__('Default Admin Email')));?>
								</div>
							</div>
							<div class="col-sm-4 col-sm-offset-2">
							    <?php echo$this->Form->input('installdata',array('type'=>'checkbox','label'=>__('Install Sample Data With Dummy Entries'),'hiddenField'=>false));?>							  
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
								<?php echo$this->Form->hidden('step3');?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <?php echo$this->Form->button(__('Install'),array('class'=>'btn btn-success'));?>
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
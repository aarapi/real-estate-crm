<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->charset(); ?>
	<title>
	Installation
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
					<div class="panel-heading"><?php echo$this->Html->image('logo-website.fw.png',array('alt'=>'Real Estate Portal','class'=>'img-responsive'));?></div>
					<?php echo $this->Form->create('Installer',array('controller' => 'Installer','action'=>'step2','name'=>'post_req','id'=>'post_req'));?>
                                        <div class="panel-body">
					  <?php echo $this->Session->flash();?>
						<p class="btn btn-primary"><?php echo __('Step 2 of 4');?></p>
						<div style="max-height:300px; overflow-y:auto"> 
						<h1><?php echo __('Installation Agreement');?></h1> 
						<p> &nbsp;</p>
						<p><strong> SILVER SYCLOPS INC. LICENSING </strong></p>
<p>This End User License Agreement is a binding legal agreement between you or your company and Silver Syclops Inc. Purchase, installation or use of Real Estate Portal provided on www.silversyclops.net signifies that you have read, understood, and agreed to be bound by the terms outlined below. </p>

<br>
	<p><strong>SILVER SYCLOPS INC. GPL LICENSING </strong></p> 

<p>All products/scripts including Real Estate Portal is released under the GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html). Specifically, the PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript are NOT GPL, and are released under the ownership rights of  Silver Syclops Inc. Use License v1.0 (See below) unless specifically authorized by Silver Syclops Inc. Elements of the extensions released under this proprietary license may not be redistributed or repackaged for use other than those allowed by the Terms of Service. </p>
<br>

<p> <strong>SILVER SYCLOPS INC. PROPRIETARY USE LICENSE (v1.0) </strong></p>
<p>The Silver Syclops Inc. Proprietary Use License covers any images, cascading style sheets, manuals and JavaScript files in any extensions produced and/or distributed by www.silversyclops.net. These files are copyrighted by Silver Syclops Inc. and cannot be redistributed in any form without prior consent from us.</p>
<br>
<p> <strong> USAGE TERMS </strong> </p>
<p>
You are not allowed to use the extension on more than one domain; we provide support only for the domain you've registered with us, for the length of your subscription. </p>
Our forum support will check that you have an active license before it allows you to post a forum question/read forum answers.<p>
<p>You are allowed to make any changes to the code; however modified code will not be supported by us. </p>
 <p> <strong>License renewals: </strong>we offer the ability to renew your license for an up to 40% discount of a new license price.
</p>
<br>
<p> <strong>MODIFICATION OF SOFTWARE PRODUCED BY SILVER SYCLOP INC. </strong> </p>
<p>
You are authorized to make any modification(s) to Silver Syclops Inc. extension PHP code. However, if you change any PHP code and it breaks functionality, support may not be available to you. </p>
<p>
Standard Licence holders must display the www.silversyclops.net back link in an un-alerted state. Sites with modified or removed back links will not be supported
<br></p>
<p>In accordance with the Silver Syclops Inc. Proprietary Use License v1.0, you may not release any proprietary files (modified or otherwise) under the GPL license. The terms of this license and the GPL v2 prohibit the removal of the copyright information from any file. <br> </p>
<p>Please contact us if you have any requirements that are not covered by these terms.
</p>

						</div>
						<div><?php echo$this->Form->input('accept',array('type'=>'checkbox','id'=>'checkme','label'=>__('I Accept to Proceed'),'hiddenField'=>false));?></div>
						<?php echo$this->Form->button(__('Submit'),array('class'=>'btn btn-success','id'=>'submitaccept','disabled'=>'disabled'));?>
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
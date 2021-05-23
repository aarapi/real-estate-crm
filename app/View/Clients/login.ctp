<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
		<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Login');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4"><?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Client', array( 'controller' => 'Clients', 'action' => 'login','name'=>'post_req','id'=>'post_req'));?>
				<div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label"><?php echo __('Email Id');?> :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <?php echo $this->Form->input('email',array('required'=>true,'label' => false,'class'=>'form-control validate[required]','placeholder'=>__('Email Id'),'div'=>false));?>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label for="pass" class="col-sm-12 control-label"><?php echo __('Password');?> :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<?php echo $this->Form->input('password',array('required'=>true,'label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15]]','placeholder'=>__('Password'),'div'=>false));?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">                                        
						<button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-sign-in"></span>&nbsp;<?php echo __('Login');?></button>
					</div>
					<div class="col-md-6">
						<?php echo$this->Html->link(__('Forgot Password'),array('controller'=>'Forgots','action'=>'password'),array('class'=>'btn btn-sm'));?>
					</div>
					<?php if($frontRegistration==1){?>
						<div class="col-sm-12">
							<?php echo$this->Html->link('<span class="glyphicon glyphicon-user"></span>&nbsp; '.__('New User? Create Account'),array('controller'=>'Registers','action'=>'index'),array('escape'=>false));?>
						</div>
						<div class="col-sm-12">
							<?php echo$this->Html->link('<span class="glyphicon glyphicon-share-alt"></span>&nbsp; '.__('Re-Send Email Verification'),array('controller'=>'Emailverifications','action'=>'resend'),array('escape'=>false));?>
						</div>
						<?php }?>
				</div>				
                        <?php echo$this->Form->end(null);?>
		</div><!-- /.col-* -->
	</div><!-- /.row -->
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->










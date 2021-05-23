<div class="page-wrapper">
<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
					<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Create Account');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
                        <?php echo $this->Session->flash();?>
            <?php echo $this->Form->create('Register', array( 'controller' => 'Register', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'','role'=>'form','type' => 'file'));?>
        	<div class="row">
			<div class="col-md-12 col-lg-8 col-lg-offset-2">
				<div class="row">	
					<div class="col-sm-6">
						<div class="form-group">
							<label for=""><?php echo __('Email');?></label>
                                                        <?php echo $this->Form->input('email',array('type'=>'email','label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
						</div><!-- /.form-group -->

						<div class="form-group">
							<label for=""><?php echo __('Password');?></label>
							<?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'minlength'=>'4','maxlength'=>'15','div'=>false));?>
						</div><!-- /.form-group -->
						<div class="form-group">
							<label for=""><?php echo __('Mobile');?></label>
							<?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
                				</div><!-- /.form-group -->
						
                                                
					</div><!-- /.col-* -->

					<div class="col-sm-6">	
						<div class="form-group">
							<label for=""><?php echo __('Name');?></label>
							<?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                				</div><!-- /.form-group -->
                				<div class="form-group">
							<label for=""><?php echo __('Address');?></label>
							<?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                				</div><!-- /.form-group -->
                				<div class="form-group">
							<label for=""><?php echo __('Security Code');?></label>
							<?php echo$this->Captcha->render($captchaSettings);?>
						</div><!-- /.form-group -->

                				
					</div><!-- /.col-* -->
				</div><!-- /.row -->			

				<div class="center">
					<div class="form-group-btn">
						<button type="submit" class="btn btn-primary"><?php echo __('Create Account');?></button>
					</div><!-- /.form-group-btn -->					
				</div><!-- /.center -->

				<div class="form-group-bottom-link">
                                <?php echo$this->Html->link(__('I already have an account').' <i class="fa fa-long-arrow-right"></i>',array('controller'=>'Clients','action'=>'login'),array('escape'=>false));?>
				</div><!-- /.form-group-bottom-link -->				
			</div><!-- /.col-* -->
		</div><!-- /.row -->
	<?php echo$this->Form->end();?>
			
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->
</div><!-- /.page-wrapper -->


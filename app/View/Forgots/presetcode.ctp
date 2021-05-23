<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
		<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Verification Code');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-4"><?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Forgot', array('name'=>'post_req','id'=>'post_req','class'=>'','role'=>'form'));?>
                                <div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label"><?php echo __('Verification Code');?> :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
                                                <?php echo $this->Form->input('verificationcode',array('autocomplete'=>'off','label' => false,'class'=>'form-control','required'=>true,'placeholder'=>__('Please Enter Verification Code in the Text Box'),'div'=>false));?>
            
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-4">                                        
						<button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-sign-in"></span>&nbsp;<?php echo __('Submit');?></button>
					</div>
					
				</div>				
                        <?php echo$this->Form->end(null);?>
		</div><!-- /.col-* -->
	</div><!-- /.row -->
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->










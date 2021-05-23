<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
		<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Email Verification');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
	<div class="row">
		<div class="col-lg-7 col-lg-offset-4"><?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Emailverification', array('name'=>'post_req','id'=>'post_req','class'=>'','role'=>'form'));?>
                                <div class="form-group">
					<div class="row">
						<label for="admin_id" class="col-sm-12 control-label"><?php echo __('Verification Code');?> :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
                                                <?php echo $this->Form->input('vc',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Please Enter Verification Code in the Text Box'),'div'=>false));?>
            
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-12 mrg">                                        
						<button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-sign-in"></span>&nbsp;<?php echo __('Submit');?></button>
					<?php echo$this->Html->link(' <span class="glyphicon glyphicon-share-alt"></span>&nbsp; '.__('Re-Send Email Verification'),array('controller'=>'Emailverifications','action'=>'resend'),array('escape'=>false));?>
                                        
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
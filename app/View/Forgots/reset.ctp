<script type="text/javascript">
$(document).ready(function(){
  $('#password').change(function(){validatePassword();});
  $('#con_password').keyup(function(){validatePassword();})
function validatePassword(){
  if($('#password').val() != $('#con_password').val()) {
    document.getElementById('con_password').setCustomValidity("Passwords Don't Match");
  } else {
   document.getElementById('con_password').setCustomValidity('');
  }
}
});
</script>
<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
		<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Reset Password');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4"><?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Forgot', array('name'=>'post_req','id'=>'post_req','class'=>'','role'=>'form'));?>
                              <div class="form-group">
					<div class="row">
						<label for="pass" class="col-sm-12 control-label"><?php echo __('Password');?> :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<?php echo $this->Form->input('password',array('id'=>'password','value'=>'','autocomplete'=>'off','label' => false,'required'=>true,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false));?>
            
					</div>
				</div>
                                <div class="form-group">
					<div class="row">
						<label for="pass" class="col-sm-12 control-label"><?php echo __('Confirm Password');?> :</label>
					</div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<?php echo $this->Form->input('password',array('value'=>'','id'=>'con_password','autocomplete'=>'off','label' => false,'required'=>true,'class'=>'form-control','placeholder'=>__('Confirm Password'),'div'=>false));?>
            
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










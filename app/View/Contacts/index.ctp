<script type="text/javascript">
$(document).ready(function(){
$(".inlinefancy").fancybox({
	'titlePosition'	: 'inside',
	'transitionIn'	: 'none',
	'transitionOut'	: 'none'
});
});
</script>

<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
	<div class="content-title">
                <div class="content-title-inner">
                        <div class="container">		
                                <h1><?php echo __('Contact Us');?></span></h1>	
                        </div><!-- /.container -->
                </div><!-- /.content-title-inner -->
        </div><!-- /.content-title -->
	            <div class="content">
	                <div class="container">
                                <div class="row">
					<div class="col-md-6 mrg"><?php echo $this->Session->flash();?>
					<?php echo $this->Form->create('Contact', array( 'controller' => 'Contacts', 'action' => 'index','class'=>'form-light mt-20','id'=>'post_req','role'=>'form'));?>
                			<div class="form-group">
								<label><?php echo __('Name');?></label>
								<?php echo $this->Form->input('name',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Your name'),'div'=>false));?>
                    							
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<label><?php echo __('Email');?></label>
									<?php echo $this->Form->input('email',array('required'=>true,'type'=>'email','label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
                    							</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label><?php echo __('Phone');?></label>
										<?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('phone/Mobile'),'div'=>false));?>
                    							
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><?php echo __('Subject');?></label>
								<?php echo $this->Form->input('subject',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Subject'),'div'=>false));?>
                    							
							</div>
							<div class="form-group">
								<label><?php echo __('Message');?></label>
								<?php echo $this->Form->textarea('message',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Write you message here...'),'div'=>false,'style'=>'100px'));?>
                    					</div>
							<button type="submit" class="btn btn-two"><?php echo __('Send message');?></button><p><br/></p>
						<?php echo$this->Form->end(null);?>
					</div>
					<?php echo$contactValue;?>
				</div>
			</div>
                        </div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    
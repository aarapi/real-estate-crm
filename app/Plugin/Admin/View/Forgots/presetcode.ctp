
            <div class="row h-70">
                <div class="col-lg-12">
                    <div class="login card auth-box mx-auto my-auto">
                        <div class="card-block text-center"><?php echo $this->Session->flash();?>
                            <div class="user-icon">
                                <i class="fa fa-user-circle"></i>
                            </div>

                            <h4 class="text-light"><?php echo __('Verification Code');?></h4>
                            <?php echo $this->Form->create('Forgot', array('id'=>'login','class'=>'login-form','role'=>'form'));?>

                            <div class="user-details">
                                <div class="form-group"> <label for="email"><?php echo __('Enter verification Code');?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-code"></i>
                                            </span>
					<?php echo $this->Form->input('verificationcode',array('label' => false,'required'=>true,'class'=>'form-control','autocomplete'=>'off','div'=>false));?>
	                               </div>
                                </div>

                                
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo __('Submit');?></button>
                            <?php echo$this->Form->end();?>
                            <div class="user-links">
			    <?php echo$this->Html->link(__('User Name'),array('controller'=>'Forgots','action'=>'username'),array('class'=>"pull-left"));?>
			    <?php echo$this->Html->link(__('Login'),array('controller'=>'Users','action'=>'login_form'),array('class'=>"pull-right"));?>
			    </div>

                        </div>
                    </div>
                </div>
            </div>
        
        <!-- /PAGE CONTENT -->
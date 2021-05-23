
            <div class="row h-70">
                <div class="col-lg-12">
                    <div class="login card auth-box mx-auto my-auto">
                        <div class="card-block text-center"><?php echo $this->Session->flash();?>
                            <div class="user-icon">
                                <i class="fa fa-user-circle"></i>
                            </div>

                            <h4 class="text-light"><?php echo __('Forgot');?> <span><?php echo __('Password');?></h4>
                            <?php echo $this->Form->create('Forgot', array( 'controller' => 'Forgots', 'action' => 'password','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form'));?>

                            <div class="user-details">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">
                                                <i class="fa fa-envelope"></i>
                                            </span>
					<?php echo $this->Form->input('email',array('id'=>'username','required'=>true,'label' => false,'class'=>'form-control','div'=>false));?>
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
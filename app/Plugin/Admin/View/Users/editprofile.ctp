<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Edit Profile');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
                <div class="panel-body">
                <?php echo $this->Form->create('User', array( 'controller' => 'User','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
					<?php $id=$post['User']['id'];?>
						
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __($post['Ugroup']['name'].' Name');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__($post['Ugroup']['name'].' Name'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('User Name');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('username',array('readonly'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Password');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->password('password',array('value'=>'','label' => false,'class'=>'form-control input-sm validate[minSize[4],maxSize[15]]','placeholder'=>__('Password'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Address').':';?></label>
								    <div class="col-sm-10">
								       <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
								    </div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Location').':';?></label>
								    <div class="col-sm-10">
								       <?php echo $this->Form->select('location_id',$location,array('label' => false,'class'=>'form-control','empty'=>__('Please select'),'div'=>false));?>
								    </div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Phone');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Mobile');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Email');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('email',array('readonly'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Skype ID');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('skype',array('label' => false,'class'=>'form-control','placeholder'=>__('Skype ID'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Twitter ID');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('twitter',array('label' => false,'class'=>'form-control','placeholder'=>__('Twitter ID'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Facebook ID');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input('facebook',array('label' => false,'class'=>'form-control','placeholder'=>__('Facebook ID'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Linkedin ID');?></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input('linkedin',array('label' => false,'class'=>'form-control','placeholder'=>__('Linkedin ID'),'div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Upload Photo');?></label>
								    <div class="col-sm-4">
									<?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'div'=>false));?>
								    </div>	    
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Description');?></label>
									<div class="col-sm-10">
									   <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group text-left">
									<div class="col-sm-offset-2 col-sm-7">
										<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
									</div>
								</div>
							
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Cancel'),array('controller'=>'Users','action'=>'myProfile'),array('escape'=>false,'class'=>'btn btn-danger'));?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
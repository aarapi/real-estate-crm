<?php $pageName=__('Edit User');
if($isError){echo $this->element('start-middle',array('pageName'=>$pageName));?><?php }?>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo$pageName;?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('User', array( 'controller' => 'User','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
					<?php foreach ($User as $k=>$post): if($userType=='ADR' || ($userType=='AGY' && $luserId==$post['User']['project_id'])) { $id=$post['User']['id']; $form_no=$k;?>
					<script type="text/javascript">
						    $(document).ready(function(){
							<?php if($post['User']['ugroup_id']==2){?>
							$('#UserAgency<?php echo$k;?>').show();<?php }else{?>
							$('#UserAgency<?php echo$k;?>').hide();<?php }?>
							$('#<?php echo$k;?>UserUgroupId').change(function(){if(this.value==2)($('#UserAgency<?php echo$k;?>')).show();else $('#UserAgency<?php echo$k;?>').hide();});
						    });
						</script>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><span class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></span></strong></div>
							<div class="panel-body">
								<?php if($userType!='AGY'){?>
								<div class="form-group">
									<?php if($id!=1){?>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('User Level');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->select("$k.User.ugroup_id",$ugroup,array('empty'=>null,'label' => false,'class'=>'form-control input-sm','div'=>false));?>
									</div>
									<?php }?>
									<div id="UserAgency<?php echo$k;?>">
									    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Agency');?></label>
									    <div class="col-sm-4">
									       <?php echo $this->Form->select("$k.User.project_id",$project,array('empty'=>__('Select'),'label' => false,'class'=>'form-control input-sm','div'=>false));?>
									    </div>
									</div>
								</div>
								 <?php } else {echo $this->Form->input("$k.User.project_id",array('value'=>$post['User']['project_id'],'type'=>'hidden'));}?>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __($post['Ugroup']['name'].' Name');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.name",array('label' => false,'class'=>'form-control','placeholder'=>__($post['Ugroup']['name'].' Name'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('User Name');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.username",array('label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Password');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->password("$k.User.password",array('value'=>'','label' => false,'class'=>'form-control input-sm validate[minSize[4],maxSize[15]]','placeholder'=>__('Password'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Address').':';?></label>
								    <div class="col-sm-10">
								       <?php echo $this->Form->input("$k.User.address",array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
								    </div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Location').':';?></label>
								    <div class="col-sm-10">
								       <?php echo $this->Form->select("$k.User.location_id",$location,array('label' => false,'class'=>'form-control','empty'=>__('Please select'),'div'=>false));?>
								    </div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Phone');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.phone",array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Mobile');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.mobile",array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Email');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.email",array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Skype ID');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.skype",array('label' => false,'class'=>'form-control','placeholder'=>__('Skype ID'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Twitter ID');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.twitter",array('label' => false,'class'=>'form-control','placeholder'=>__('Twitter ID'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Facebook ID');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.User.facebook",array('label' => false,'class'=>'form-control','placeholder'=>__('Facebook ID'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Linkedin ID');?></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.User.linkedin",array('label' => false,'class'=>'form-control','placeholder'=>__('Linkedin ID'),'div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><?php echo __('Upload Photo');?></label>
								    <div class="col-sm-4">
									<?php echo $this->Form->input("$k.User.photo",array('type' => 'file','label' => false,'div'=>false));?>
								    </div>	    
								</div>
								<?php if($id!=1){?>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Status');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->select("$k.User.status",array('Active'=>__('Active'),'Suspend'=>__('Suspend')),array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
									</div>
								</div>
								<?php }?>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Description');?></label>
									<div class="col-sm-10">
									   <?php echo $this->Form->input("$k.User.description",array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
									</div>
								</div>
								<div class="form-group text-left">
									<div class="col-sm-offset-2 col-sm-7">
										<?php echo $this->Form->input("$k.User.id", array('type' => 'hidden'));?>
									</div>
								</div>
							</div>	
						</div>						
                    <?php } endforeach;?>
                        <?php unset($post);?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
    </div>
<?php if($isError){echo $this->element('end-middle');?><?php }?>
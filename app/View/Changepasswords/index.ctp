<div class="dashboard-subheader">
<?php echo $this->Session->flash();?>
						<h2><?php echo __('Change');?> <span><?php echo __('Password');?></h2>
					</div><!-- /.dashboard-header -->

					<div class="row">
					<div class="panel">
						<div class="panel-body">
                <?php echo $this->Form->create('Changepassword', array( 'controller' => 'Changepasswords', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Old Password');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('oldPassword',array('type'=>'password','id'=>'oldPassword','value'=>'','label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15]]','placeholder'=>__('Old Password'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('password',array('id'=>'password','value'=>'','label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15]]','placeholder'=>__('Password'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Confirm Password');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('con_password',array('type'=>'password','value'=>'','label' => false,'class'=>'form-control validate[equals[password]]','placeholder'=>__('Confirm Password'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo __('Update');?></button>                            
                        </div>
                    </div>
                </form>
                </div>
					</div>
					</div><!-- /.row -->	
				</div><!-- /.container -->						
			</div><!-- /.dashboard-content -->			
		</div><!-- /.dashboard -->
	</div><!-- /.page-wrapper -->
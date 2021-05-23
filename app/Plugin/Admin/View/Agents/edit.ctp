<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div class="container">
<div class="row">
<?php echo $this->Session->flash();?>
    <div class="col-md-12">
        <div class="panel panel-default mrg">
            <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><span><?php echo __('Edit Agents');?></span></strong></h4><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div></div>
                <div class="panel-body">
					<?php echo $this->Form->create('Agent', array( 'controller' => 'Agents','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
					<?php foreach ($Agent as $k=>$post): $id=$post['Agent']['id'];$form_no=$k;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form').' '.$form_no;?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
			  <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Name').':';?></small></label>
			  <div class="col-sm-6">
			     <?php echo $this->Form->input("$k.Agent.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
			  </div>
		    </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Address').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.address",array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('E-Mail').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.email",array('label' => false,'class'=>'form-control','placeholder'=>__('E-Mail'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Skype ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.skype",array('label' => false,'class'=>'form-control','placeholder'=>__('Skype ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Facebook ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.facebook",array('label' => false,'class'=>'form-control','placeholder'=>__('Facebook ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Twitter ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.twitter",array('label' => false,'class'=>'form-control','placeholder'=>__('Twitter ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Linkedin ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.linkedin",array('label' => false,'class'=>'form-control','placeholder'=>__('Linkedin ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Phone').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.phone",array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Mobile').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.mobile",array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Description').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input("$k.Agent.description",array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Status').':';?></small></label>
                <div class="col-sm-6">
		<?php
		$option=array('Active'=>__('Active'),'Suspend'=>__('Suspend'));
		?>
                   <?php echo $this->Form->select("$k.Agent.status",$option,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Upload Photo');?></small></label>
                <div class="col-sm-6">
                    <?php echo $this->Form->input("$k.Agent.photo",array('type' => 'file','label' => false,'div'=>false));?>
                </div>	    
            </div>  
                <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.Agent.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancle');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
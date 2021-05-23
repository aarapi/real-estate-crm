<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Contact');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Contact', array( 'controller' => 'Contacts','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
					<?php foreach ($Contact as $k=>$post): $id=$post['Contact']['id'];$form_no=$k;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form').' '.$form_no?></small></strong></div>
							<div class="panel-body">
								<div class="panel panel-default">
            <div class="panel-heading"><strong><?php echo __('Contact Information');?></strong></div>
            <div class="panel-body">
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Category').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select("$k.Contact.category_id",$category,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Address").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.address",array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>    
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("District").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.district",array('label' => false,'class'=>'form-control','placeholder'=>__('District'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("State").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.state",array('label' => false,'class'=>'form-control','placeholder'=>__('State'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Pincode").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.pincode",array('label' => false,'class'=>'form-control','placeholder'=>__('Pincode'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Email").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.email",array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Cell Phone").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.mobile",array('label' => false,'class'=>'form-control','placeholder'=>__('Cell Phone'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Phone").':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Contact.phone",array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
            </div>
	   </div>
            </div>
                       
			<div class="form-group text-left">
			    <div class="col-sm-offset-3 col-sm-7">
			    <?php echo $this->Form->input("$k.Contact.id",array('type' => 'hidden'));?>
			    </div>
			</div>
							</div>
						</div>						
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
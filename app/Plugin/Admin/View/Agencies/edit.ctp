<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Agencies');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Agency', array( 'controller' => 'Agencies','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
		<?php foreach ($Agency as $k=>$post): $id=$post['Agency']['id'];$form_no=$k;?>
    <div class="panel panel-default">
	<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
	<div class="panel-body">
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency Name');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Agency.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Agency Name'),'div'=>false));?>
                </div>
            </div>            
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Location');?>:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->select("$k.Agency.location_id",$location,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Agency.address",array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Agency.phone",array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Mobile');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Agency.mobile",array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">   
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Email ID');?>:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input("$k.Agency.email",array('label' => false,'class'=>'form-control','placeholder'=>__('Email ID'),'div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Skype ID');?>:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input("$k.Agency.skype",array('label' => false,'class'=>'form-control','placeholder'=>__('Skype ID'),'div'=>false));?>
		</div>
	    </div>
            <div class="form-group">   
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Twitter ID');?>:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input("$k.Agency.twitter",array('label' => false,'class'=>'form-control','placeholder'=>__('Twitter ID'),'div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Facebook ID');?>:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input("$k.Agency.facebook",array('label' => false,'class'=>'form-control','placeholder'=>__('Facebook ID'),'div'=>false));?>
		</div>
	    </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Description');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Agency.description",array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Add Photo');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.Agency.photo", array('type' => 'file','label'=>false/*,'multiple'=>'multiple'*/,'class'=>'')); ?>
                </div>             
            </div>		    
	    <div class="form-group text-left">
		<div class="col-sm-offset-4 col-sm-6">
		    <?php echo $this->Form->input("$k.Agency.id",array('type' => 'hidden'));?>
		</div>
	    </div>
	</div>
      </div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
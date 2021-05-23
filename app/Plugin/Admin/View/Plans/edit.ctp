<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Plans');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Plan', array( 'controller' => 'Plans','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Plan as $k=>$post): $id=$post['Plan']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
			  <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Plan Name');?>:</small></label>
			  <div class="col-sm-6">
			     <?php echo $this->Form->input("$k.Plan.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Plan Name'),'div'=>false));?>
			  </div>
		    </div>
		     <div class="form-group">
			  <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Installment');?>:</small></label>
			  <div class="col-sm-6">
			     <?php echo $this->Form->input("$k.Plan.installment",array('label' => false,'class'=>'form-control','placeholder'=>__('Installment'),'div'=>false));?>
			  </div>
		    </div>
		    
	    <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Status');?>:</small></label>
                <div class="col-sm-6">
		<?php
		$option=array('Active'=>__('Active'),'Suspend'=>__('Suspend'));
		?>
                   <?php echo $this->Form->select("$k.Plan.status",$option,array('label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
            </div>
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.Plan.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
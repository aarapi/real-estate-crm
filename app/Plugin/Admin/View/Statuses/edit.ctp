<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Status');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Status', array( 'controller' => 'Statuses','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Status as $k=>$post): $id=$post['Status']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
			  <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Status Name');?>:</small></label>
			  <div class="col-sm-6">
			     <?php echo $this->Form->input("$k.Status.name",array('label' => false,'class'=>'form-control','placeholder'=>'Status Name','div'=>false));?>
			  </div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Color');?>:</small></label>
			<div class="col-sm-6">
			   <?php echo $this->Form->input("$k.Status.color",array('type'=>'color','label' => false,'class'=>'form-control','placeholder'=>'Color','div'=>false));?>
			</div>
		    </div>
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.Status.id",array('type' => 'hidden'));?>
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
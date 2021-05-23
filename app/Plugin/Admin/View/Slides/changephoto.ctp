<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Update Photo');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>                        
                <div class="panel-body"> <?php echo $this->Session->flash();?> 
                <?php echo $this->Form->create('Slide',array('class'=>'form-horizontal','type' => 'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Upload Slide (1350*550)');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'class'=>'','div'=>false));?>
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('id', array('type' => 'hidden'));?>                            
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
                         <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
		</div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
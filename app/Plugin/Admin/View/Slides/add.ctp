<div <?php if(!$isError){?>class="container"<?php }?>>
   
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Add Slides');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body"><?php echo $this->Session->flash();?> 
                <?php echo $this->Form->create('Slide', array( 'controller' => 'Slide', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Slide Name');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('slide_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Slide Name'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Ordering');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('ordering',array('label' => false,'class'=>'form-control','placeholder'=>__('Ordering'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Slide (1350*550)');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'class'=>'','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel')?></button><?php }else{
                            echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
		</div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
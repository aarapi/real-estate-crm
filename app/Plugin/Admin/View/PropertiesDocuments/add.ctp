<div <?php if(!$isError){?>class="container"<?php }?>>
<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Add Document');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
   <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('PropertiesDocument', array( 'controller' => 'properties_documents', 'action' => "add/$propertyId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Add Document');?>:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('photo.', array('type' => 'file','label'=>false,'multiple','class'=>'validate[required]')); ?>
                        </div>                                           
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-success"><span class="fa fa-plus"></span> <?php echo __('Save');?></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Close');?></button>
                            <?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
                </div>
            </div>
            </div>
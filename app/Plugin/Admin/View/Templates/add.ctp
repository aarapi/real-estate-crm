<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add  Template');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Template', array( 'controller' => 'Templates', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Type').':';?></small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->select('type',$typeArr,array('required'=>true,'empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name').':';?></small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Template').':';?></small></label>
                <div class="col-sm-10">
                    <?php echo $this->Tinymce->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Template'),'div'=>false),array('language'=>$configLanguage,'directionality'=>$dirType),'absolute');?>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('controller'=>'Templates','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
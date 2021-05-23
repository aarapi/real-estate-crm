<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Agents');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Agent', array( 'controller' => 'Agents', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Name').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Address').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('E-Mail').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('E-Mail'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Facebook ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('facebook',array('label' => false,'class'=>'form-control','placeholder'=>__('Facebook ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Skype ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('skype',array('label' => false,'class'=>'form-control','placeholder'=>__('Skype ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Twitter ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('twitter',array('label' => false,'class'=>'form-control','placeholder'=>__('Twitter ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Linkedin ID').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('linkedin',array('label' => false,'class'=>'form-control','placeholder'=>__('Linkedin ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Phone').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Mobile').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Description').':';?></small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Upload Photo');?></small></label>
                <div class="col-sm-6">
                    <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'div'=>false));?>
                </div>	    
            </div>  
                <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('controller'=>'Agents','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
                </div>
            </div>
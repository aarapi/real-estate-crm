<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Contact');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Contact', array( 'controller' => 'Clients', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
            <div class="panel panel-default">
            <div class="panel-heading"><strong><?php echo __('Contact Information');?></strong></div>
            <div class="panel-body">
            <?php if($userType!='AGT' && $userType!='AGY'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('project_id',$agency,array('label' => false,'class'=>'form-control','empty'=>__('No Agency'),'div'=>false));?>
                </div>                
            </div>
	    <?php }?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Category').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('category_id',$category,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('District').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('district',array('label' => false,'class'=>'form-control','placeholder'=>__('District'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('State').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('state',array('label' => false,'class'=>'form-control','placeholder'=>__('State'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Pincode').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('pincode',array('label' => false,'class'=>'form-control','placeholder'=>__('Pincode'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Email').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Cell Phone').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Cell Phone'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
            </div>
            </div>
            </div>           
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
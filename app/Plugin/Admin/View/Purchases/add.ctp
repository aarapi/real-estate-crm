<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Purchase');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Purchase', array( 'controller' => 'Purchases', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <?php if($userType!='AGY'){?>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('project_id',$projectName,array('label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
                <?php }else { echo $this->Form->hidden('project_id',array('value'=>$agencyId)); }?>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Seller Name');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Seller Name'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Seller Address');?>:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Seller Address'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Seller Mobile');?>:</small></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Seller Mobile'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Property Name');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('property_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Property Name'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Property Area');?>:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('area',array('label' => false,'class'=>'form-control','placeholder'=>__('Property Area'),'div'=>false));?>
                </div>
                <div class="col-sm-2">
		    <?php echo $this->Form->select('unit_id',$unitName,array('label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
		</div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Property Amount');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=>__('Property Amount'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Property Description');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Property Description'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Remarks');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>__('Remarks'),'class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Purchases','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
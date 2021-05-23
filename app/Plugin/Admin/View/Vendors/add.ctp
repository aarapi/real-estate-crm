<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add');?> <?php echo __('Vendors');?> / <?php echo __('Staff');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Vendor', array( 'controller' => 'Vendors', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                <div class="form-group">
                    <?php if($userType!='AGY'){?>
                    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Agency');?>:</small></label>
                    <div class="col-sm-6">
                       <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'agent'));
                       echo $this->Form->select('project_id',$projectName,array('id'=>'projectId','rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                    </div>
                    <?php }else {
                    echo $this->Form->hidden('project_id',array('value'=>$agencyId));
                    }?>
                </div>
		<div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Name');?>:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Address');?>:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Contact');?>:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('contact',array('label' => false,'class'=>'form-control','placeholder'=>__('Contact'),'div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Licence No.');?>:</small></label>
                    <div class="col-sm-6">
                       <?php echo $this->Form->input('licence_no',array('label' => false,'class'=>'form-control','placeholder'=>__('Licence No.'),'div'=>false));?>
                    </div>
                </div>
                <div class="form-group text-left">
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Vendors','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
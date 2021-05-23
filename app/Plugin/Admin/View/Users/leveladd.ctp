<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Level Users');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
    <?php echo $this->Form->create('User', array('class'=>'form-horizontal'));?>
    <div class="form-group">
        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Level User');?></small></label>
        <div class="col-sm-9">
           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Level User'),'div'=>false));?>
        </div>
    </div>
    <div class="form-group text-left">
        <div class="col-sm-offset-3 col-sm-7">
            <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'assignrights'),array('class'=>'btn btn-danger','escape'=>false));?>
        </div>
    </div>
    <?php echo $this->Form->end();?>
    </div>
</div>
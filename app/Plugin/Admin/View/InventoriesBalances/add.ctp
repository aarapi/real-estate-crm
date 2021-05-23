<script type="text/javascript">
    $(document).ready(function(){
        $('#paymentDate').datetimepicker({format:'<?php echo $dpFormat;?>'});
        });
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Entry');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('InventoriesBalance', array( 'controller' => 'InventoriesBalances', 'action' => "add/$inventoryId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Quantity');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('qty', array('label'=>false,'placeholder'=>__('Quantity'),'class'=>'form-control')); ?>
                </div>
            </div>
           <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Date');?>:</small></label>
                <div class="col-sm-4">
                   <div class="input-group date" id="paymentDate">                        
                    <?php echo $this->Form->input('date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Payment Date'),'div'=>false,'default'=>$date));?>
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                </div>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Remarks');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>__('Transaction Reference'),'class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'inventories_balances','action'=>'index',$inventoryId),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
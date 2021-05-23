<script type="text/javascript">
    $(document).ready(function(){
        $('#paymentDate').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        });
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Payment');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('PurchasesPayment', array( 'controller' => 'PurchasesPayments', 'action' => "add/$purchaseId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Amount');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('amount', array('label'=>false,'placeholder'=>__('Amount'),'class'=>'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Payment Type');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('paymenttype_id',$paymentType,array('empty'=>__('Please Select'),'label'=>false,'class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Payment Date');?>:</small></label>
                <div class="col-sm-4">
                <div class="input-group date" id="paymentDate">
			    <?php echo $this->Form->input('date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Payment Date'),'div'=>false));?>
                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
		 </div>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Transaction Reference');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>__('Transaction Reference'),'class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'purchases_payments','action'=>'index',$purchaseId),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#paymentDate').datetimepicker({format: '<?php echo$dpFormat;?>'});
        $('#DealsPaymentTaxId').change(function(){calculateAmount();})
        $('#DealsPaymentEmi').blur(function(){calculateAmount();})
        $('#DealsPaymentExtraPayment').change(function(){calculateAmount();})
        $("#paymentDate").on("dp.change", function (e) {
        dueDays=parseFloat($('#DealsPaymentDueDays').val());
        dueDate=$('#DealsPaymentDueDate').val();
        lateFees=parseFloat($('#DealsPaymentLateFees').val());
        currDate=e.date;
        var todayTarget = moment(dueDate);
        targetDueDate=moment(todayTarget).add('days', dueDays);
        if(targetDueDate<currDate)
        {
            lateDate=currDate.diff(dueDate, 'days');
            extraPayment=Math.round(((emi*lateFees)/100)*lateDate/365);
        }
        else
        extraPayment=0;
        $('#DealsPaymentExtraPayment').val(extraPayment);
        calculateAmount();});
        calculateAmount();
        });
    function calculateAmount()
    {
        emi=parseFloat($('#DealsPaymentEmi').val());
        extraPayment=parseFloat($('#DealsPaymentExtraPayment').val());
        totalAmount=emi+extraPayment;
        tax=parseFloat($('#DealsPaymentTaxId').find(':selected').text());
        if(isNaN(tax))
        tax=0;
        tax_amount=Math.round(parseFloat(totalAmount)*parseFloat(tax)/100);
        net_amount=tax_amount+totalAmount;
        $('#DealsPaymentTaxAmount').val(tax_amount);
        $('#DealsPaymentNetAmount').val(net_amount);
    }
</script>

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Payment');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('DealsPayment', array( 'controller' => 'DealsPayments', 'action' => "add/$dealId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name').':';?></small></label>
                <div class="col-sm-4">
                   <strong><?php echo$paymentName;?></strong>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Amount').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('emi', array('value'=>$emi,'label'=>false,'placeholder'=>__('Amount'),'class'=>'form-control','readonly'=>'readonly')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Extra/Late Amount').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('extra_payment', array('value'=>$extraPayment,'label'=>false,'placeholder'=>__('Extra/Late Amount'),'class'=>'form-control')); ?>
                </div>               
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Tax').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo$this->Form->select('tax_id',array($tax),array('empty'=>__('Select Tax if applicable'),'label'=>false,'class'=>'form-control'));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Taxable Amount').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('tax_amount', array('value'=>0,'label'=>false,'placeholder'=>__('Taxable Amount'),'class'=>'form-control','readonly'=>'readonly')); ?>
                </div>               
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Payable Amount').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('net_amount', array('value'=>$totalAmount,'label'=>false,'placeholder'=>__('Net Amount'),'class'=>'form-control','readonly'=>'readonly')); ?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Payment Type').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('paymenttype_id',$paymentType,array('empty'=>__('Please Select'),'label'=>false,'class'=>'form-control')); ?>
                </div>
               
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Payment Date').':';?></small></label>
                <div class="col-sm-4">
                   <div class="input-group date" id="paymentDate">                        
                    <?php echo $this->Form->input('payment_date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Payment Date'),'div'=>false,'default'=>$date));?>
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                    </div>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Transaction Reference').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>__('Transaction Reference'),'class'=>'form-control')); ?>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('controller'=>'deals_payments','action'=>'index',$dealId),array('class'=>'btn btn-danger','escape'=>false));?>
                    <?php echo$this->Form->input('dealId',array('type'=>'hidden','name'=>'dealId','value'=>$dealId));
                    echo $this->Form->hidden('due_days',array('value'=>$dueDays));echo $this->Form->hidden('due_date',array('value'=>$dueDate));echo $this->Form->hidden('late_fees',array('value'=>$lateFees));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
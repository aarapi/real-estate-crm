<script type="text/javascript">
    $(document).ready(function(){
        $('#paymentDate').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        });
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Inventory');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Inventory', array( 'controller' => 'Inventories', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <?php if($userType!='AGY'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Agency');?>:</small></label>
                <div class="col-sm-6">
                       <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'vendor'));
                       echo $this->Form->select('project_id',$projectName,array('id'=>'projectId','rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
            </div>
            <?php }else {
                    echo $this->Form->hidden('project_id',array('value'=>$agencyId));
                    }?>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Category Name');?>:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->select('expense_category_id',$expenseCategory,array('label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Vendor/Staff Name');?>:</small></label>
                <div class="col-sm-6">
                    <?php if($userType!='AGY'){echo $this->Form->select('vendor_id',$vendorName,array('id'=>'vendorId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}
		   else {echo $this->Form->select('vendor_id',$vendorList,array('id'=>'vendorId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Invoice No.');?>:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('invoice_no',array('label' => false,'class'=>'form-control','placeholder'=>__('Invoice No.'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Invoice Date');?>:</small></label>
                <div class="col-sm-6">
                   <div class="input-group date" id="paymentDate">                        
                    <?php echo $this->Form->input('invoice_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false,'default'=>$date));?>
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                </div>
                </div>                                           
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Quantity');?>:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('invoice_qty',array('label' => false,'class'=>'form-control','placeholder'=>__('Quantity'),'div'=>false));?>
                </div>
            </div>                     
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Remarks');?>:</small></label>
                <div class="col-sm-6">
                   <?php echo $this->Form->input('remarks', array('label'=>false,'placeholder'=>__('Remarks'),'class'=>'form-control')); ?>
                </div>                                           
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-4 col-sm-6">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Inventories','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
            <?php echo$this->Form->end();?>
        </div>
            </div>
            <script type="text/javascript">
$(document).ready(function(){
$('#projectId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#vendorId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
});
</script>
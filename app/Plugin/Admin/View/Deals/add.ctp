<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->Html->script('select2.min');
$clientUrl=$this->Html->url(array('controller'=>'Deals','action'=>'clientsearch'));
$propertyUrl=$this->Html->url(array('controller'=>'Deals','action'=>'propertysearch'));
$propertyFlat=$this->Html->url(array('controller'=>'Deals','action'=>'propertyflat'));
$flatDetails=$this->Html->url(array('controller'=>'Deals','action'=>'flatdetails'));
$propertyDetails=$this->Html->url(array('controller'=>'Deals','action'=>'propertydetails'));
$propertyPlans=$this->Html->url(array('controller'=>'Deals','action'=>'plandetails'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        calculateAmount();
        $('#startDate').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        $('#evocate_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        $('#recurring').hide();
        $('#rec_type').click(function () {$("#recurring").toggle(this.checked);});
        $('#DealDiscount').blur(function (){calculateAmount();});
        $('#clientId').select2({
        placeholder: "Search Client Name",
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$clientUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          
          results: function (data, page) {
            return { results: data };
          }
        }
      });
        $('#propertyId').select2({
        placeholder: "Search Property Name",
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$propertyUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term,
              //q1: $('input[name="typelead"]:checked').val(),
              //q2: $('input[name="availiable"]:checked').val(),
              q1: $('#typeId').val(),
              q2: $('#contractId').val()
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }
        }).on("change", function(e) {
          $.ajax({
      dataType: 'json',
      cache: false ,
      url: '<?php echo$propertyDetails;?>',
      data: {id: e.val}})
      .done(function(data) {
        $.each(data,function(index,item){
           if(index=="#agentName"){
            $('#agentName').html(item);
           }
           else{
            $(index).val(item);
           }
           });
        calculateAmount();
        if($('#contractId').val()==1){$('#EvocateDate').show();}else $('#EvocateDate').hide();
      });
        });        
        });
    function calculateAmount()
    {
        var discount=0;
        dealArea=$('#DealArea').val();
        dealAmount=$('#DealAmount').val();
        dealDiscount=$('#DealDiscount').val();
        if(dealDiscount!="")
        discount=dealDiscount;
        totalAmount=(parseFloat(dealAmount)-parseFloat(discount));
        if(isNaN(totalAmount))
        totalAmount=0;
        $('#totalAmount').html(getLocale('Area')+' : ' + dealArea+ '<br/>'+getLocale('Amount')+' : ' + dealAmount+ '<br/>'+getLocale('Discount')+' : ' + discount+ '<br/>'+getLocale('Payable Amount')+' : '+totalAmount);
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$('#EvocateDate').hide();
        //$('#DealAvailiableRent').click(function(){$('#EvocateDate').show();});
        //$('#DealAvailiableSale').click(function(){$('#EvocateDate').hide();});
        $('#EvocateDate').hide();
        $('#contractId').change(function(){ if(this.value==1)$('#EvocateDate').show();else $('#EvocateDate').hide();});
        if($('#contractId').val()==1){$('#EvocateDate').show();}else $('#EvocateDate').hide();
    });
</script>

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Deal');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Deal', array( 'controller' => 'Deals', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Deal On').':';?></small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('client_id',array('type'=>'text','id'=>'clientId','placeholder'=>__('Client Name'),'label' => false,'class'=>'form-control','div'=>false));?>
                </div>                        
            </div>
             <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Deal For').':';?></small></label>
                <div class="col-sm-3">
                   <?php echo $this->Form->select('type_id',$type,array('id'=>'typeId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                   </label>
                </div>
                <label for="group_name" class="col-sm-1 control-label"><small><?php echo __('Available For').':';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->select('contract_id',$contract,array('id'=>'contractId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                   </label>
                </div>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('property_id',array('type'=>'text','id'=>'propertyId','placeholder'=>__('Property Name'),'label' => false,'class'=>'form-control','div'=>false));?>
                </div>                         
            </div>
            <div class="form-group">
		<div id="EvocateDate">
		    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Evocate Date');?>:</small></label>
		    <div class="col-sm-4">
			<div class="input-group date" id="evocate_date">
			<?php echo $this->Form->input('evocate_date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Evocate Date'),'div'=>false));?>
			<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
			</div>
		    </div>
		</div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Invoice').' #:';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('invoice_no',array('value'=>$invoiceNo,'label' => false,'class'=>'form-control','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Invoice Date').':';?></small></label>
                <div class="col-sm-2">
                   <div class="input-group date" id="startDate">                        
                    <?php echo $this->Form->input('date',array('type'=>'text','label' => false,'placeholder'=>__('Invoice Date'),'class'=>'form-control','div'=>false));?>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Booking Amount').':';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('booking_amount',array('label' => false,'placeholder'=>__('Enter amount'),'class'=>'form-control','div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Area').':';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('area',array('label' => false,'class'=>'form-control','placeholder'=>__('Area'),'div'=>false,'readonly'=>'readonly'));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Amount').':';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=>__('Amount'),'div'=>false,'readonly'=>'readonly'));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Discount').':';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('discount',array('label' => false,'class'=>'form-control','placeholder'=>__('Discount'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Payment Plan').':';?></small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->select('plan_id',$plan,array('label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
                <div class="col-sm-2">
                   <?php echo$this->Form->select('recurring',array('M'=>__('Monthly'),'Q'=>__('Quarterly'),'H'=>__('Half Yearly'),'Y'=>__('Yearly'),'U'=>__('Manually')),array('empty'=>null,'label'=>false,'class'=>'form-control'));?>
                </div>                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agent if any').':';?></small></label>
                <div class="col-sm-4">
                    <?php //echo $this->Form->input('agentName',array('label' => false,'class'=>'form-control','div'=>false,'readonly'=>'readonly'));?>
                   <?php //echo $this->Form->input('user_id',array('label' => false,'type'=>'hidden'));?>
                   <?php echo $this->Form->select('user_id',array(),array('id'=>'agentName','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Comment/Remarks').':';?></small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>__('Comment/Remarks'),'div'=>false));?>
                </div>
                <div class="col-sm-offset-2 col-sm-4"><strong id="totalAmount"></strong></div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('controller'=>'Deals','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
               
            </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
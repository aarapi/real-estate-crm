<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
	$('.paymentDate').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        });
</script>
<?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'vendor')); ?>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Inventories');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Inventory', array( 'controller' => 'Inventories','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Inventory as $k=>$post): $id=$post['Inventory']['id'];$form_no=$k;$selvendorName="vendorName$k";?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		    <?php if($userType!='AGY'){?>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Agency');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->select("$k.Inventory.project_id",$projectName,array('id'=>"projectId$k",'rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                        </div>
                    </div>
		    <?php }else {
                    echo $this->Form->hidden("$k.Inventory.project_id",array('value'=>$agencyId));
                    }?>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Category Name');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->select("$k.Inventory.expense_category_id",$expenseCategory,array('label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Vendor/Staff Name');?>:</small></label>
                        <div class="col-sm-6">
			    <?php if($userType!='AGY'){echo $this->Form->select("$k.Inventory.vendor_id",$$selvendorName,array('id'=>"vendorId$k",'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}
			    else {echo $this->Form->select("$k.Inventory.vendor_id",$vendorList,array('id'=>'vendorId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Invoice No.');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Inventory.invoice_no",array('label' => false,'class'=>'form-control','placeholder'=>__('Invoice No.'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Invoice Date');?>:</small></label>
                        <div class="col-sm-6">
                           <div class="input-group date paymentDate" id="paymentDate">                        
                            <?php echo $this->Form->input("$k.Inventory.invoice_date",array('type'=>'text','value'=>$this->Time->format($dtFormat,$post['Inventory']['invoice_date']),'label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                        </div>
                        </div>                                           
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Quantity');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Inventory.invoice_qty",array('label' => false,'class'=>'form-control','placeholder'=>__('Quantity'),'div'=>false));?>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Remarks');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Inventory.remarks", array('label'=>false,'placeholder'=>__('Remarks'),'class'=>'form-control')); ?>
                        </div>                                           
                    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-4 col-sm-6">
			    <?php echo $this->Form->input("$k.Inventory.id",array('type' => 'hidden'));?>
			</div>
		    </div>
		  </div>
		</div>
		<script type="text/javascript">
		    $(document).ready(function(){
		    $('#projectId<?php echo$k;?>').change(function() {
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
							$('#vendorId<?php echo$k;?>').html(response);
						}
					},
					error: function(e) {
						
					}
				});
			});
		    });
		</script>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
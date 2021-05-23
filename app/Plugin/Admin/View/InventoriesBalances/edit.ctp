<script type="text/javascript">
    $(document).ready(function(){
        $('.paymentDate').datetimepicker({format:'<?php echo $dpFormat;?>'});
        });
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Entries');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('InventoriesBalance', array('controller' => 'InventoriesBalances','action'=>"edit/$inventoryId",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($InventoriesBalance as $k=>$post): $id=$post['InventoriesBalance']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
			<div class="form-group">
		    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Quantity');?>:</small></label>
		    <div class="col-sm-4">
		       <?php echo $this->Form->input("$k.InventoriesBalance.qty", array('label'=>false,'placeholder'=>__('Amount'),'class'=>'form-control')); ?>
		    </div>
		</div>
		<div class="form-group">
		    <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Date');?>:</small></label>
		    <div class="col-sm-4">
		       <div class="input-group date paymentDate">                        
			<?php echo $this->Form->input("$k.InventoriesBalance.date",array('type'=>'text','value'=>$this->Time->format($dtFormat,$post['InventoriesBalance']['date']),'label' => false,'class'=>'form-control','placeholder'=>__('Payment Date'),'div'=>false));?>
			<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
		    </div>
		    </div>                                           
		</div>
            <div class="form-group">
                <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Remarks');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input("$k.InventoriesBalance.remarks", array('label'=>false,'placeholder'=>__('Transaction Reference'),'class'=>'form-control')); ?>
                </div>                                           
            </div>
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.InventoriesBalance.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
		    <?php echo$this->Form->input('inventoryId',array('type'=>'hidden','name'=>'inventoryId','value'=>$inventoryId));?>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
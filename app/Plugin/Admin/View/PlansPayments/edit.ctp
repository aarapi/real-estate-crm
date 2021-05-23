<script type="text/javascript">
    $(document).ready(function(){
        $('.startDate').datetimepicker({format: '<?php echo$dpFormat;?>'});
    });
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Payments');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('PlansPayment', array( 'controller' => 'PlansPayments','action'=>"edit/$id",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
		<?php foreach ($PlansPayment as $k=>$post): $id=$post['PlansPayment']['id'];$form_no=$k+1;?>
		<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		  <div class="panel-body">
		 <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Installment Name');?>:</small></label>
            <div class="col-sm-6">
               <?php echo $this->Form->input("$k.PlansPayment.name",array('label' => false,'class'=>'form-control ','placeholder'=>__('Installment Name'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Amount');?>:</small></label>
            <div class="col-sm-6">
               <?php echo $this->Form->input("$k.PlansPayment.amount",array('label' => false,'class'=>'form-control','placeholder'=>__('Amount'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Due Date');?>:</small></label>
            <div class="col-sm-6">
               <div class="input-group startDate">                        
                <?php echo $this->Form->input("$k.PlansPayment.date",array('type'=>'text','value'=>$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['PlansPayment']['date']),'label' => false,'class'=>'form-control','div'=>false));?>
                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
            </div>
            </div>
        </div>
            <div class="form-group text-left">
			  <div class="col-sm-offset-3 col-sm-6">
			      <?php echo $this->Form->input("$k.PlansPayment.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		     </div>
		</div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
		  
		       <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
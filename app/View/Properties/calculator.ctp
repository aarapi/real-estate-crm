<?php echo $this->Html->script('calculator');?>
<div class="modal-dialog">
    <div class="modal-content">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Calculator');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Property', array( 'controller' => 'Properties','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                <div class="form-group">
                    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Amount');?>:</small></label>
                    <div class="col-sm-5">
                        <?php echo $this->Form->input("principal",array('type'=>'text','id'=>'principal','value'=>$amount,'onchange'=>'calcRepay();','readonly'=>true,'label' => false,'class'=>'form-control','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Interest Rate');?>:</small></label>
                    <div class="col-sm-5">
                        <?php echo $this->Form->input("int_rate",array('type'=>'text','id'=>'int_rate','value'=>'9.60','onchange'=>'calcRepay();','label' => false,'class'=>'form-control','div'=>false));?>
                    </div>
                    <div class="col-sm-3">% <?php echo __('per annum');?></div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Term');?>:</small></label>
                    <div class="col-sm-5">
                        <?php echo $this->Form->input("term",array('type'=>'text','id'=>'term','value'=>$amount,'onchange'=>'calcRepay();','label' => false,'class'=>'form-control','div'=>false));?>
                    </div>
                    <div class="col-sm-3"><?php echo __('years');?></div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Frequency');?>:</small></label>
                    <div class="col-sm-5">
                        <?php echo $this->Form->select("frequency",$frequencyArr,array('id'=>'freq','empty'=>null,'onchange'=>'calcRepay();','label' => false,'class'=>'form-control','div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Loan Type');?>:</small></label>
                    <div class="col-sm-5">
                        <?php echo $this->Form->select("type",$loanTypeArr,array('id'=>'type','empty'=>null,'onchange'=>'calcRepay();','label' => false,'class'=>'form-control','div'=>false));?>
                    </div>
                </div>
                <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">                            
                            <button type="button" class="btn btn-success" onClick="calcRepay();"><span class="fa fa-refresh"></span> <?php echo __('Calculate');?></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Close');?></button>
                        </div>
                </div>
                 <div class="form-group">
                    <label for="group_name" class="col-sm-3 control-label"><?php echo __('Repayment');?>:</label>
                    <div class="col-sm-5">
                        <?php echo $this->Form->input("repay",array('type'=>'text','id'=>'repay','readonly'=>true,'label' => false,'class'=>'form-control','div'=>false));?>
                    </div>
                </div>
        <?php echo$this->Form->end();?>
                </div>
        </div>
    </div>
</div>
<script language="JavaScript">calcRepay();</script>
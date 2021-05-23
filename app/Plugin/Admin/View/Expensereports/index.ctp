<script type="text/javascript">
    $(document).ready(function(){        
        $('#start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
	$('#end_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
});
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Expense Report');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
               <div class="row mrg">
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-4">
			<?php echo __('Total Expense Count this month');?>&nbsp;<span class="new badge"><?php echo$this->Number->format($monthExpenseCount);?></span>
	            </div>
		    <?php }?>
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-3">
			<div>
			<?php echo __('Total Expense this month');?>&nbsp;<span class="new badge"><?php echo$currency.$this->Number->format($expenseMonth);?></span></div>
		    </div>
		    <?php }?>
		   <div  class="col-sm-3">
			<div><?php if($dateBetween==false){?><?php echo __('Total');?><?php }?> <?php echo __('Expense Count');?>&nbsp;<span class="new badge"><?php echo$totalExpenseCount;?></span>
			</div>
		    </div>
                   <div  class="col-sm-2">
			<div>
			<?php if($dateBetween==false){?><?php echo __('Total');?><?php }?> <?php echo __('Expense');?>&nbsp;<span class="new badge"><?php echo$currency.$this->Number->format($totalExpense);?></span></div>
		    </div>
		</div>
		<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg">
		    <div  class="col-md-3 col-sm-offset-1">
			<?php if($userType!='AGY'){ echo $this->Form->select('project_id',$projectName,array('empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false)); } else { echo $this->Form->select('project_id',$projectName,array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));}?>
		    </div>
		    <div  class="col-md-4">
			<?php echo $this->Form->select('expense_category_id',$expenseCategory,array('empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		     <div  class="col-md-4">
			<?php echo $this->Form->select('vendor_id',$vendorName,array('empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		</div>
		<div class="row mrg">
		    <div  class="col-md-2 col-sm-offset-1">
			<?php echo $this->Form->input('date',array('dateFormat' => 'Y','minYear' => 2014,'maxYear' => date('Y') + 5 ,'empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <label for="group_name" class="col-sm-1 control-label"><strong><?php echo __('Date');?></strong></label>
		     <div class="col-md-2">
			<div class="input-group date start_date" id="start_date">                        
                            <?php echo $this->Form->input('start_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                        </div>
		    </div>
		    <div class="col-md-2">
			<div class="input-group date end_date" id="end_date">
                           <?php echo $this->Form->input('end_date',array('type'=>'text','id'=>'end_date','label' => false,'class'=>'form-control','div'=>false));?>
                           <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                        </div>
		    </div>
		    <div  class="col-md-4">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> <strong>&nbsp;<?php echo __('Search');?></button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('controller'=>'Expensereports','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
		    </div>
		</div>
		<?php echo$this->Form->end();?>
		<?php if($dateBetween==false){?>
		<div class="chart">
		    <div id="mywrapperdl"></div>
			<?php echo $this->HighCharts->render("My Chartdl");?>
		</div>		
             <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo __('Month');?></th>
                            <th><?php echo __('Expense Count');?></th>
                            <th><?php echo __('Expense');?></th>			    
                        </tr>
                        <?php $totCount=0;$totExpense=0;
			foreach ($expenseReport as $post):
			$totCount=$post['MonthArr']['ExpenseCount']+$totCount;
			$totExpense=$post['MonthArr']['expense']+$totExpense;?>
                        <tr>
                            <td><?php echo$post['MonthArr']['monthName'];?></td>
                            <td><?php echo$post['MonthArr']['ExpenseCount'];?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['expense']);?></td>			    
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
			<tr class="info">
			    <td><strong><?php echo __('Total');?></strong></td>
                            <td><strong><?php echo$totCount;?></strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totExpense);?></strong></td>
			</tr>
                        </table>
                </div>
		<?php }?>
                </div>
            </div>
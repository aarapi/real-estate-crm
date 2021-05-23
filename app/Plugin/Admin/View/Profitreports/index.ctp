<script type="text/javascript">
    $(document).ready(function(){        
        $('#start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
	$('#end_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
});
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Profit & Loss Report');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
		<div class="row mrg">
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-4">
			<?php echo __('Total Profit & Loss this month');?> <span class="new badge"><?php echo$currency.$this->Number->format($profitMonth);?></span>
	            </div>
		    <?php }?>
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-3">
			<div>
			<?php echo __('Profit & Loss');?> <span class="new badge"><?php echo$currency.$this->Number->format($totalProfit);?></span></div>
		    </div>
		    <?php }?>
		</div>
		<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg mrg-left">
		    <div  class="col-md-2">
			<?php if($userType!='AGY'){ echo $this->Form->select('project_id',$projectName,array('empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false)); } else { echo $this->Form->select('project_id',$projectName,array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));}?>
		    </div>
		    <div  class="col-md-2">
			<?php echo $this->Form->input('date',array('dateFormat' => 'Y','minYear' => 2014,'maxYear' => date('Y') + 5 ,'empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <label for="group_name" class="col-sm-1 control-label"><strong>Date</strong></label>
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
		    <div  class="col-md-3">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> <?php echo __('Search');?></button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('controller'=>'Profitreports','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
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
			    <th><?php echo __('Earning');?></th>
                            <th><?php echo __('Purchase');?></th>
                            <th><?php echo __('Expense');?></th>
			    <th><?php echo __('Profit/Loss');?></th>
                        </tr>
                        <?php $totEarning=0;$totExpense=0;$totPurchase=0;
			foreach ($profitReport as $post):
			$totEarning=$post['MonthArr']['earning']+$totEarning;
			$totExpense=$post['MonthArr']['expense']+$totExpense;
			$totPurchase=$post['MonthArr']['purchase']+$totPurchase;
			?>
                        <tr>
                            <td><?php echo$post['MonthArr']['monthName'];?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning']);?></td>
			    <td><?php echo$currency.$this->Number->format($post['MonthArr']['purchase']);?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['expense']);?></td>
			    <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning']-$post['MonthArr']['expense']-$post['MonthArr']['purchase']);?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
			<tr class="info">
			    <td><strong>Total</strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totEarning);?></strong></td>
			    <td><strong><?php echo$currency.$this->Number->format($totPurchase);?></strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totExpense);?></strong></td>
			    <td><strong><?php echo$currency.$this->Number->format($totEarning-$totExpense);?></strong></td>
			</tr>
                        </table>
                </div>
		<?php }?>

                </div>
            </div>
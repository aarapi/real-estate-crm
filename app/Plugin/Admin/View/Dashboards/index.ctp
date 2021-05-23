<?php
echo $this->Html->script('/design800/js/plugins/fullcalendar/js/fullcalendar.min.js');
echo $this->Html->script('/design800/js/plugins/fullcalendar/js/lang-all.js');
echo $this->Html->css('/design800/js/plugins/fullcalendar/css/fullcalendar.min.css');
$dateArr=array();
      foreach($Schedule as $value):
            if($value['Calendar']['is_repeat']) {
                if($value['Calendar']['repeat_type']=='WEE') {
                    $dueDays='1 week';$start=$value['Calendar']['start_date'];$end=$value['Calendar']['end_date'];
                    for($i=0;$i<$value['Calendar']['repeat_no'];$i++) {
                        if($value['Calendar']['end_date']!=null) {
                            $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
			    $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
                           
                            $start=date('Y-m-d H:i:s',strtotime($start."+$dueDays"));$end=date('Y-m-d H:i:s',strtotime($end."+$dueDays"));
                        }
                        else{
                            $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
			     $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
                           
                            $start=date('Y-m-d H:i:s',strtotime($start."+$dueDays"));
                        }
                    }
                }
                elseif($value['Calendar']['repeat_type']=='MON') {
                    $dueDays='1 month';$start=$value['Calendar']['start_date'];$end=$value['Calendar']['end_date'];
                    for($i=0;$i<$value['Calendar']['repeat_no'];$i++) {
                        if($value['Calendar']['end_date']!=null) {
                            $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
			     $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
                           
                            $start=date('Y-m-d H:i:s',strtotime($start."+$dueDays"));$end=date('Y-m-d H:i:s',strtotime($end."+$dueDays"));
                        }
                        else{
                            $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
			     $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
                           
                            $start=date('Y-m-d H:i:s',strtotime($start."+$dueDays"));
                        }
                    }
                }
                elseif($value['Calendar']['repeat_type']=='ANU') {
                    $dueDays='1 year';$start=$value['Calendar']['start_date'];$end=$value['Calendar']['end_date'];
                    for($i=0;$i<$value['Calendar']['repeat_no'];$i++) {
                        
                        if($value['Calendar']['end_date']!=null) {
                            $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
			     $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
                           
                            $start=date('Y-m-d H:i:s',strtotime($start."+$dueDays"));$end=date('Y-m-d H:i:s',strtotime($end."+$dueDays"));
                        }
                        else{
                            $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
			     $dateArr[]=array('id'=>$value['Calendar']['id'],'start'=>$start,'end'=>$end,'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
                           
                            $start=date('Y-m-d H:i:s',strtotime($start."+$dueDays"));
                        }
                    }
                }
            }
            elseif($value['Calendar']['end_date']!=null) {
                $dateArr[]=array('start'=>$value['Calendar']['start_date'],'end'=>$value['Calendar']['end_date'],'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
		$dateArr[]=array('start'=>$value['Calendar']['start_date'],'end'=>$value['Calendar']['end_date'],'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
		
		
            }
            else{
                $dateArr[]=array('start'=>$value['Calendar']['start_date'],'color'=>$value['Calendar']['color'],'title'=>$value['Calendar']['message_type'],'tip'=>$value['Calendar']['comments']);
		$dateArr[]=array('start'=>$value['Calendar']['start_date'],'color'=>$value['Calendar']['color'],'title'=>$value['User']['name'],'tip'=>$value['User']['name']);
            }
        endforeach; unset($value);
	foreach($leads as $value) :
	    $dateArr[]=array('start'=>$value['Lead']['follow_up'],'color'=>$value['Status']['color'],'title'=>$value['Client']['name'],'tip'=>$value['Lead']['remarks']);
	endforeach; unset($value);
        $dataArr=json_encode($dateArr);
	?>
<script type="text/javascript">
    $(document).ready(function() {
	var currentLangCode = '<?php echo$configLanguage;?>';
    /* initialize the calendar
    -----------------------------------------------------------------*/
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: '<?php echo$currentDateTime;?>',
      lang: currentLangCode,
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: <?php echo$dataArr; ?>,
       eventRender: function(event, element) {
      $(element).tooltip({title: '<h6>'+event.title+'</h6>'+event.tip,placement:'bottom',delay: 50,container:'body',html:true});             
  }
    });
      });
</script>
<style>
div.datepicker table {
    width: 915px;
    height: 500px;
}
thead {
    border-bottom: 0px solid #d0d0d0;
}
</style>
<?php echo $this->Session->flash();?>

<div class="row">
                        <div class="col-md-12">
                            <h3 class="page-title"><?php echo __('Dashboard');?> <small></small></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-primary-1">
                                <div class="inner">
                                    <h2><?php echo$propertyCount;?></h2>
                                    <p><?php echo __('Total Properties');?></p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-building-o"></i>
                                </div>

                                <div class="details bg-primary-3">
				<?php echo$this->Html->link('<span>View Details <i class="fa fa-arrow-right"></i></span>',array('controller'=>'Properties','action'=>'index'),array('style'=>'color:white;','escape'=>false));?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-info-1">
                                <div class="inner">
                                    <h2><?php echo$currency.' '.$totalExpenses;?></h2>
                                    <p><?php echo __('Total Expenses');?></p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>

                                <div class="details bg-info-3">
                                   <?php echo$this->Html->link('<span>View Details <i class="fa fa-arrow-right"></i></span>',array('controller'=>'Expenses','action'=>'index'),array('style'=>'color:white;','escape'=>false));?>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-success-1">
                                <div class="inner">
                                    <h2><?php echo$currency.' '.$totalSale;?></h2>
                                    <p><?php echo __('Total Sales');?></p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>

                                <div class="details bg-success-3">
                                   <?php echo$this->Html->link('<span>View Details <i class="fa fa-arrow-right"></i></span>',array('controller'=>'Salesreports','action'=>'index'),array('style'=>'color:white;','escape'=>false));?>
                                
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <div class="widget-overview bg-danger-1">
                                <div class="inner">
                                    <h2><?php echo$dealCount;?></h2>
                                    <p><?php echo __('Total Deals');?></p>
                                </div>

                                <div class="icon">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>

                                <div class="details bg-danger-3">
                                    <?php echo$this->Html->link('<span>View Details <i class="fa fa-arrow-right"></i></span>',array('controller'=>'Deals','action'=>'index'),array('style'=>'color:white;','escape'=>false));?>
                                
                                </div>
                            </div>
                        </div>
                    </div








			
		<p>&nbsp;</p>
		<div class="row">	
			
			<div class="col-sm-12">
				<div class="panel panel-midnightblue">
					<div class="panel-heading"><h4><?php echo __('Calender Schedules');?></h4></div>
					<div id="calendar"></div>
				</div>
			</div>
		</div>
		<?php if($userType!='AGT'){?>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-midnightblue">
					<div class="panel-heading"><h4><?php echo __('Chart Wise Report');?></h4></div>
					<div class="chart">
						<div id="mywrappersr"></div>
						<?php echo $this->HighCharts->render("My Chartsr");?>
					</div>
				</div>
			</div>
		</div>
		<?php } $show=false; if($show) {?>
		<div class="row">	
			
			<div class="col-sm-6">
				<div class="panel panel-midnightblue">
					<div class="panel-heading"><h4><?php echo __('New Leads');?></h4></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>
								<th><?php echo __('Name');?></th>
								<th><?php echo __('Contact');?></th>
								<th><?php echo __('For');?></th>
								<th><?php echo __('Followup Date');?></th>
							</tr>
							<?php foreach ($Lead as $post):?>
							<tr>
								<td><?php echo h($post['Client']['name']); ?></td>
								<td><?php echo h($post['Client']['phone']); ?></td>
								<td><?php echo h($post['Property']['name']); ?></td>
								<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,h($post['Lead']['follow_up'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
						</table>
					</div>				
				</div> 
			</div>
			
			<div class="col-sm-6">
				<div class="panel panel-midnightblue">
					<div class="panel-heading"><h4><?php echo __('New Deals');?></h4></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>
								<th><?php echo __('Name');?></th>
								<th><?php echo __('For');?></th>
								<th><?php echo __('Amount');?></th>
								<th><?php echo __('Date');?></th>
							</tr>
							<?php foreach ($Deal as $post):?>
							<tr>
								<td><?php echo h($post['Client']['name']); ?></td>
								<td><?php echo h($post['Property']['name']); ?></td>
								<td><?php echo $currency.$this->Number->format(h($post['Deal']['total_amount']));?></td>
								<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Deal']['date'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">	
			
			
			<div class="col-sm-6">
				<div class="panel panel-midnightblue">
					<div class="panel-heading"><h4><?php echo __('New Property');?></h4></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>
								<th><?php echo __('Name');?></th>
								<th><?php echo __('Type');?></th>
								<th><?php echo __('For');?></th>
							</tr>
							<?php foreach ($Property as $post):?>
							<tr>
								<td><?php echo h($post['Property']['name']);?></td>
								<td><?php echo h($post['Type']['name']);?></td>
								<td><?php echo h($post['Contract']['name']);?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
						</table>
					</div>				
				</div> 
			</div>
			
			<div class="col-sm-6">
				<div class="panel panel-midnightblue">
					<div class="panel-heading"><h4><?php echo __('New Expenses');?></h4></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tr>
								<th><?php echo __('Category');?></th>
								<th><?php echo __('Amount');?></th>
								<th><?php echo __('Date');?></th>
								<th><?php echo __('Remarks');?></th>
							</tr>
							<?php foreach ($Expense as $post):?>
							<tr>
								<td><?php echo h($post['ExpenseCategory']['name']); ?></td>
								<td><?php echo $currency.$this->Number->format(h($post['ExpensesPayment']['amount']));?></td>
								<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['ExpensesPayment']['date'])); ?></td>
								<td><?php echo h($post['ExpensesPayment']['remarks']); ?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
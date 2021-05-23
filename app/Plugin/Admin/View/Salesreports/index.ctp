<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
$clientUrl=$this->Html->url(array('controller'=>'Salesreports','action'=>'clientsearch'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#clientId').select2({
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
        },
	initSelection: function (element, callback) {
	    callback({"id": "<?php echo$clientId;?>", "text": "<?php echo$clientName;?>"});
	    }
      });
        $('#start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
	$('#end_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
});
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Sales Report');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
		<div class="row mrg">
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-3">
			<?php echo __('Total Sales Count this month');?> <span class="new badge"><?php echo$monthSalesCount;?></span>
	            </div>
		    <?php }?>
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-3">
			<div>
			<?php echo __('Total Earning this month');?> <span class="new badge"><?php echo$currency.$this->Number->format($earningMonth);?></span></div>
		    </div>
		    <?php }?>
		   <div  class="col-sm-3">
			<div><?php if($dateBetween==false){?><?php echo __('Total');?><?php }?> <?php echo __('Sales Count');?> <span class="new badge"><?php echo$totalSalesCount;?></span>
			</div>
		    </div>
                   <div  class="col-sm-3">
			<div>
			<?php if($dateBetween==false){?><?php echo __('Total');?><?php }?> <?php echo __('Earning');?> <span class=" new badge"><?php echo$currency.$this->Number->format($totalEearning);?></span></div>
		    </div>
		</div>
		<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg">
		     <div class="col-md-2 col-sm-offset-1">
			<?php if($userType!='AGY'){ echo $this->Form->select('project_id',$projectName,array('empty'=>__('All'),'label' => false,'class'=>'form-control','div'=>false)); } else { echo $this->Form->select('project_id',$projectName,array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));}?>
		    </div>
		    <div class="col-md-3">
			<?php echo $this->Form->input('client_id',array('type'=>'text','placeholder'=>__('Search Client Name'),'id'=>'clientId','label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		    <div class="col-md-3">
			<?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Commercial"=>__("Commercial"),"Residential"=>__("Residential")),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
		    </div>
		    <div class="col-md-3">
			<?php echo $this->Form->input('availiable',array('type'=>'radio','options'=>array("Sale"=>__("Sale"),"Rent"=>__("Rent")),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
		    </div>
		</div>
		<div class="row mrg">		    
		    <div class="col-md-2 col-sm-offset-1">
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
		    <div class="col-md-4">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> <?php echo __('Search');?></button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('controller'=>'Salesreports','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
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
                            <th><?php echo __('Sales Count');?></th>
                            <th><?php echo __('Earning');?></th>			    
                        </tr>
                        <?php $totCount=0;$totEarning=0;
			foreach ($salesReport as $post):
			$totCount=$post['MonthArr']['salesCount']+$totCount;
			$totEarning=$post['MonthArr']['earning']+$totEarning;?>
                        <tr>
                            <td><?php echo$post['MonthArr']['monthName'];?></td>
                            <td><?php echo$post['MonthArr']['salesCount'];?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning']);?></td>			    
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
			<tr class="info">
			    <td><strong><?php echo __('Total');?></strong></td>
                            <td><strong><?php echo$totCount;?></strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totEarning);?></strong></td>
			</tr>
                        </table>
                </div>
		<?php }?>

                </div>
            </div>
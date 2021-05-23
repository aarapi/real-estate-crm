<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Calendar Schedule');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Calendar', array( 'controller' => 'Calendars','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
		<?php foreach ($Calendar as $k=>$post): $id=$post['Calendar']['id'];$form_no=$k;$selagentName="agentName$k";?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#start_date<?php echo$k?>').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?> HH:mm'});
        $('#end_date<?php echo$k?>').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?> HH:mm',useCurrent: false});
        $("#start_date<?php echo$k;?>").on("dp.change", function (e) {
	    $('#end_date<?php echo$k;?>').data("DateTimePicker").minDate(e.date);
	});
	$("#end_date<?php echo$k;?>").on("dp.change", function (e) {
	    $('#start_date<?php echo$k;?>').data("DateTimePicker").maxDate(e.date);
	});
	<?php if($post['Calendar']['is_repeat']==1){?>
	$('#RepeatType<?php echo$k?>').show();$('#RepeatNumber<?php echo$k?>').show();
	<?php }else{?>
	$('#RepeatType<?php echo$k?>').hide(); $('#RepeatNumber<?php echo$k?>').hide();
	<?php }?>
        $('#<?php echo$k?>CalendarIsRepeat1').click(function(){$('#RepeatType<?php echo$k?>').show();$('#RepeatNumber<?php echo$k?>').show();});
        $('#<?php echo$k?>CalendarIsRepeat0').click(function(){$('#RepeatType<?php echo$k?>').hide();$('#RepeatNumber<?php echo$k?>').hide();});
	});
</script>
      <div class="panel panel-default">
	      <div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form').' '.$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Start Date Time');?>:</small></label>
			 <div class="col-sm-4">
			     <div class="input-group date" id="start_date<?php echo$k?>">
			     <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'agent'));
				echo $this->Form->input("$k.Calendar.start_date",array('type'=>'text','value'=>$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin,$post['Calendar']['start_date']),'label' => false,'class'=>'form-control','placeholder'=>__('Date Time'),'div'=>false));?>
			     <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
			     </div>
			 </div>
			 <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('End Date Time');?>:</small></label>
			 <div class="col-sm-4">
			     <div class="input-group date" id="end_date<?php echo$k?>">
			     <?php $dateVal=""; if($post['Calendar']['end_date']) {$dateVal=$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin,$post['Calendar']['end_date']);}
			     echo $this->Form->input("$k.Calendar.end_date",array('type'=>'text','value'=> $dateVal,'label' => false,'class'=>'form-control','placeholder'=>__('End Date Time'),'div'=>false));?>
			     <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
			     </div>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Repeative Event");?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Calendar.is_repeat",array('type'=>'radio','options'=>array("0"=>__("No"),"1"=>__("Yes")),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
			</div>
		    </div>
		    <div class="form-group">
			<div id="RepeatType<?php echo$k?>">
			    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Repeat Type').':';?></small></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->select("$k.Calendar.repeat_type",$repeatTypeArr,array('label' => false,'class'=>'form-control','empty'=>__('Repeat Type'),'div'=>false));?>
			    </div>
			</div>
			<div id="RepeatNumber<?php echo$k?>">
			    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Repeats').':';?></small></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input("$k.Calendar.repeat_no",array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Repeats'),'div'=>false));?>
			    </div>
			</div>
		    </div>
		    <?php if($userType!='AGT'){?>
		    <div class="form-group">
		    <?php if($userType!='AGY'){?>
			    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->select("$k.Calendar.project_id",$agency,array('id'=>"projectId$k",'rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
			    </div>
			    <?php }?>
			    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Representative's Name");?>:</small></label>
			    <div class="col-sm-4">
			       <?php if($userType!='AGY'){echo $this->Form->select("$k.Calendar.user_id",$$selagentName,array('id'=>"agentId$k",'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}
			       else {echo $this->Form->select("$k.Calendar.user_id",$agentList,array('id'=>'agentId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}?>
			    </div>
		    </div>
		    <?php }else{
		    echo $this->Form->hidden("$k.Lead.user_id",array());
		    }?>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Message Type').':';?></small></label>
			 <div class="col-sm-4">
			    <?php echo $this->Form->input("$k.Calendar.message_type",array('label' => false,'class'=>'form-control','placeholder'=>__('Message Type'),'div'=>false));?>
			 </div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Color');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Calendar.color",array('type'=>'color','label' => false,'class'=>'form-control','placeholder'=>'Color','div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Comment').':';?></small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Calendar.comments",array('label' => false,'class'=>'form-control','placeholder'=>__('Comment'),'div'=>false));?>
			</div>
		     </div>
		     <div class="form-group">			
			    <div class="col-sm-6">
				<?php echo $this->Form->input("$k.Calendar.id",array('type' => 'hidden'));?>
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
							    $('#agentId<?php echo$k;?>').html(response);
						    }
					    },
					    error: function(e) {
						    
					    }
				    });
			    });
			});
		    </script>
		  </div>
      </div>
                    <?php endforeach; ?>
                        <?php unset($post); ?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }?>
                        </div>
			</div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
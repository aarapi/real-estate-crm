<script type="text/javascript">
    $(document).ready(function(){        
        $('#start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?> HH:mm'});
        $('#end_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?> HH:mm',useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });	
        });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#RepeatType').hide(); $('#RepeatNumber').hide();
        $('#CalendarIsRepeat1').click(function(){$('#RepeatType').show();$('#RepeatNumber').show();});
        $('#CalendarIsRepeat0').click(function(){$('#RepeatType').hide();$('#RepeatNumber').hide();});
    });
</script>
    <h1 class="title"><?php echo __('Add Calendar details');?></h1>
    <div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Calendar', array( 'controller' => 'Calendars', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                <div class="form-group">
                    <div id="StartDate">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Start Date Time');?>:</small></label>
                        <div class="col-sm-4">
                            <div class="input-group date" id="start_date">
                            <?php echo $this->Form->input('start_date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Start Date Time'),'div'=>false));?>
                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                    <div id="EndDate">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('End Date Time');?>:</small></label>
                        <div class="col-sm-4">
                            <div class="input-group date" id="end_date">
                            <?php echo $this->Form->input('end_date',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('End Date Time'),'div'=>false));?>
                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Repeative Event");?>:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('is_repeat',array('type'=>'radio','options'=>array("0"=>__("No"),"1"=>__("Yes")),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                    </div>
                </div>
                <div class="form-group">
                    <div id="RepeatType">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Repeat Type').':';?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select('repeat_type',$repeatTypeArr,array('label' => false,'class'=>'form-control','empty'=>__('Repeat Type'),'div'=>false));?>
                        </div>
                    </div>
                    <div id="RepeatNumber">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Repeats').':';?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('repeat_no',array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Repeats'),'div'=>false));?>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="RepeatNumber">
                    
                </div>
                <?php if($userType!='AGT'){?>
                <div class="form-group">
                    <?php if($userType!='AGY'){?>
                    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
                    <div class="col-sm-4">
                       <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'agent'));
                       echo $this->Form->select('project_id',$projectName,array('id'=>'projectId','rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                    </div>
                    <?php }?>
                    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Representative's Name");?>:</small></label>
                    <div class="col-sm-4">
                       <?php if($userType!='AGY'){echo $this->Form->select('user_id',$agentName,array('id'=>'agentId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}
                       else {echo $this->Form->select('user_id',$agentList,array('id'=>'agentId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}?>
                    </div>
                </div>
                <?php }else{
                echo $this->Form->hidden('user_id',array('value'=>$luserId));
                }?>
                <div class="form-group">
                    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Message Type').':';?></small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('message_type',array('label' => false,'class'=>'form-control','placeholder'=>__('Message Type'),'div'=>false));?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Color');?>:</small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('color',array('type'=>'color','label' => false,'class'=>'form-control','placeholder'=>'Color','div'=>false));?>
                    </div>
                     <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Comment').':';?></small></label>
                    <div class="col-sm-4">
                       <?php echo $this->Form->input('comments',array('label' => false,'class'=>'form-control','placeholder'=>__('Comment'),'div'=>false));?>
                    </div>
                </div>
                <div class="form-group text-left">
                    <div class="col-sm-offset-2 col-sm-7">
                        <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span>&nbsp;<?php echo __('Save');?></button>
                        <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('controller'=>'Calendars','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                    </div>
                </div>
                </div>
        <?php echo$this->Form->end();?>
        </div>
            </div>
<script type="text/javascript">
$(document).ready(function(){
$('#projectId').change(function() {
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
                                    $('#agentId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
});
</script>
<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$clientUrl=$this->Html->url(array('controller'=>'Leads','action'=>'clientsearch'));
$propertyUrl=$this->Html->url(array('controller'=>'Leads','action'=>'propertysearch'));
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#startDate').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        $('#propertyId').select2({
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$propertyUrl?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term,
              //q1: $('input[name="typelead"]:checked').val(),
              q1: $('#typeId').val(),
	      q2: $('#projectId').val()
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }
      });
        $('#clientId').select2({
        minimumInputLength: 1,
        ajax: {
          url: '<?php echo$clientUrl?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }
      });
        });
</script>

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Lead');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Lead', array( 'controller' => 'Leads', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                <?php if($userType!='AGT'){?>
                <div class="form-group">
                <?php if($userType!='AGY'){?>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
                <div class="col-sm-4">
                   <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'agent'));
                   echo $this->Form->select('project_id',$projectName,array('id'=>'projectId','rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
                </div>
		<?php }else {
		echo $this->Form->hidden('project_id',array('value'=>$agencyId));
		}?>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Agent's Name");?>:</small></label>
                <div class="col-sm-4">
                   <?php if($userType!='AGY'){echo $this->Form->select('user_id',$agentName,array('id'=>'agentId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}
		   else {echo $this->Form->select('user_id',$agentList,array('id'=>'agentId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}?>
                </div>
                </div>
                <?php }else{
		echo $this->Form->hidden('project_id',array('value'=>$agencyId));
		echo $this->Form->hidden('user_id',array('value'=>$luserId));
                }?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Lead For');?>:</small></label>
                    <div class="col-sm-3">
                   <?php echo $this->Form->select('type_id',$type,array('id'=>'typeId','label' => false,'class'=>'form-control','empty'=>__('All'),'div'=>false));?>                   
                </div>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('property_id',array('type'=>'text','placeholder'=>__('Search Property Name'),'id'=>'propertyId','label' => false,'class'=>'form-control','div'=>false));?>
                </div>
                <div class="col-sm-3">
                   <?php echo $this->Form->input('client_id',array('type'=>'text','id'=>'clientId','placeholder'=>__('Search Client Name'),'label' => false,'class'=>'form-control','div'=>false));?>
                </div>                 
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Follow Up');?>:</small></label>
                <div class="col-sm-3">
                   <div class="input-group date" id="startDate">                        
                    <?php echo $this->Form->input('follow_up',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                </div>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('status_id',array('options'=>$status,'empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false,'default'=>1));?>
                </div>                        
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Comment/Remarks');?>:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>__('Comment/Remarks'),'div'=>false));?>
                </div>                        
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Leads','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
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
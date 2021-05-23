<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$clientUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'clientsearch'));
$leadUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'leadsearch'));
$agentUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'agentsearch'));
echo $this->Session->flash();?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#clientId').select2({
        minimumInputLength: 1,
	tags: true,
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
        }
      });
        $('#leadId').select2({
         minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$leadUrl;?>',
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
	$('#agentId').select2({
         minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$agentUrl;?>',
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
	$('#clients').hide();
	$('#leads').hide();
	$('#agents').hide();
	$('#any').hide();
    $('#SendsmsType').change(function(){
    if($('#SendsmsType').val()=="Client")
    {
	$('#clients').show();
	$('#leads').hide();
	$('#agents').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Lead")
    {
	$('#leads').show();
	$('#clients').hide();
	$('#agents').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Agent")
    {
	$('#agents').show();
	$('#leads').hide();
	$('#clients').hide();
	$('#any').hide();
    }
    else if($('#SendsmsType').val()=="Any")
    {
	$('#any').show();
	$('#clients').hide();
	$('#leads').hide();
	$('#agents').hide();	
    }
    else
    {
	$('#any').hide();
	$('#clients').hide();
	$('#leads').hide();
	$('#agents').hide();	
    }
    });
    $('#SendsmsSmsTemplate').change(function() {
    $('#SendsmsMessage').val($('#SendsmsSmsTemplate').val());
    sms_character_count();
    });
    $('#characterLeft').text(' 0 character (1 sms)');
    $('#SendsmsMessage').keyup(function () {
	sms_character_count();
    });
    $('#SendsmsMessage').focus(function () {
	sms_character_count();
    });
    });
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Send SMS');?></h1></div></div>
<?php echo $this->Session->flash();?>
   <div class="col-sm-12">    
        <div class="panel panel-default">
            <div class="panel-body">
		    <?php echo $this->Form->create('Sendsms', array('class'=>'form-horizontal'));?>                    
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Type');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('type',array('Client'=>__('Clients'),'Lead'=>__('Leads'),'Agent'=>__('Agents'),'Any'=>__('Any Sms')),array('required'=>'required','empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="clients">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Clients');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('client_id',array('type'=>'text','id'=>'clientId','label' => false,'placeholder'=>__('Default all client if you add manually then search clients name'),'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="leads">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Leads');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('lead_id',array('type'=>'text','id'=>'leadId','label' => false,'placeholder'=>__('Default all client if you add manually then search leads name'),'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="agents">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Agents');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('agent_id',array('type'=>'text','id'=>'agentId','label' => false,'placeholder'=>__('Default all client if you add manually then search agents name'),'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="any">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Any Number');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('any_sms',array('type'=>'text','placeholder'=>__('Type any number comma seprated'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Select Sms Template');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('sms_template',$smsTemplate,array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><?php echo __('Sms Template');?>:</label>
			<div class="col-sm-8">
			    <?php echo $this->Form->textarea('message',array('label' => false,'class'=>'form-control','placeholder'=>__('If you do not want to select sms template then simply type sms message.'),'div'=>false,'rows'=>5));?>
			</div>
			<div class="span2"><div id="characterLeft"></div></div>
		    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-2 col-sm-10">
			    <button type="submit" class="btn btn-success"><span class="fa fa-send"></span>&nbsp;<?php echo __('Send');?></button>
			    <?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
		    </div>
		    <?php echo$this->Form->end(null);?>
                </div>
            </div>
        </div>
    </div>
</div>
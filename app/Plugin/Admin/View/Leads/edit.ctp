<?php echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
$clientUrl=$this->Html->url(array('controller'=>'Leads','action'=>'clientsearch'));
$propertyUrl=$this->Html->url(array('controller'=>'Leads','action'=>'propertysearch'));
$url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'agent'));
?>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Leads');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Lead', array( 'controller' => 'Leads','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Lead as $k=>$post): $id=$post['Lead']['id'];$form_no=$k;$selagentName="agentName$k";?>
					<script type="text/javascript">
					$(document).ready(function(){
					    $('#startDate<?php echo $k;?>').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
					     $('#propertyId<?php echo$id;?>').select2({
						minimumInputLength: 1,
						ajax: {
						  url: '<?php echo$propertyUrl;?>',
						  dataType: 'json',
						  data: function (term, page) {
						    return {
						      q: term,
						      //q1: $('input[name="typelead<?php echo$id;?>"]:checked').val(),
						      q1: $("#typeId<?php echo$id;?>").val()
						    };
						  },
						  results: function (data, page) {
						    return { results: data };
						  }
						},
						initSelection: function (element, callback) {
						callback({"id": "<?php echo$post['Property']['id'];?>", "text": "<?php echo$post['Property']['name'];?>"});
						}
						});
					     $('#clientId<?php echo$id;?>').select2({
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
						callback({"id": <?php echo$post['Client']['id'];?>, "text": "<?php echo$post['Client']['name'];?>"});
						}
						});
					});
				    </script>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
							<div class="panel-body">								
							    <?php if($userType!='AGT'){?>
								<div class="form-group">
								<?php if($userType!='AGY'){?>
									<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->select("$k.Lead.project_id",$agency,array('id'=>"projectId$k",'rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
									</div>
									<?php }else {
										echo $this->Form->hidden("$k.Lead.project_id",array('value'=>$agencyId));
										}?>
									<label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Agent's Name");?>:</small></label>
									<div class="col-sm-4">
									   <?php if($userType!='AGY'){echo $this->Form->select("$k.Lead.user_id",$$selagentName,array('id'=>"agentId$k",'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}
									   else {echo $this->Form->select("$k.Lead.user_id",$agentList,array('id'=>'agentId','label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));}?>
									</div>
								    </div>
								    <?php }else{
								echo $this->Form->hidden("$k.Lead.project_id",array());
								echo $this->Form->hidden("$k.Lead.user_id",array());
								}?>
							   <div class="form-group">
							       <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Lead For');?>:</small></label>
							       <div class="col-sm-3">
								  <?php echo $this->Form->select("$k.Lead.type_id",$type,array('id'=>"typeId$id",'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
								  </label>
							       </div>
							        <div class="col-sm-3">
								  <?php echo $this->Form->input("$k.Lead.property_id",array('type'=>'text','id'=>"propertyId$id",'value'=>$post['Property']['id'],'label' => false,'class'=>'form-control','div'=>false));?>
							       </div>
							       <div class="col-sm-4">
								  <?php echo $this->Form->input("$k.Lead.client_id",array('type'=>'text','id'=>"clientId$id",'placeholder'=>__('Client Name'),'label' => false,'class'=>'form-control','div'=>false));?>
							       </div>
							   </div>
							    <div class="form-group">
								<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Follow Up');?>:</small></label>
								<div class="col-sm-4">
								  <div class="input-group date startDate" id="startDate<?php echo $k;?>">                        
								   <?php echo $this->Form->input("$k.Lead.follow_up",array('type'=>'text','value'=>$this->Time->format($dtFormat.$dateGap.$sysHour.$timeSep.$sysMin,$post['Lead']['follow_up']),'label' => false,'class'=>'form-control','div'=>false));?>
								   <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
							       </div>
							       </div>
								<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status');?>:</small></label>
								<div class="col-sm-4">
								   <?php echo $this->Form->input("$k.Lead.status_id",array('options'=>$status,'empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false,'default'=>1));?>
								</div>                        
							    </div>
							    <div class="form-group">
								<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Comment/Remarks');?>:</small></label>
								<div class="col-sm-10">
								   <?php echo $this->Form->input("$k.Lead.remarks",array('label' => false,'class'=>'form-control','placeholder'=>__('Comment/Remarks'),'div'=>false));?>
								</div>                        
							    </div>
							       <div class="form-group text-left">
								   <div class="col-sm-offset-2 col-sm-7">
								   <?php echo $this->Form->input("$k.Lead.id", array('type' => 'hidden'));?>
								   </div>
							       </div>
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
                    <?php endforeach; ?>
                        <?php unset($post); ?>
			<div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <button type="submit" class="btn btn-success" id="save"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
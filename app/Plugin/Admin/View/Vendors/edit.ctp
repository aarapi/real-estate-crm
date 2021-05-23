<script type="text/javascript">
    $(document).ready(function(){
        $('#post_req').validationEngine();
        });
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Vendors');?> / <?php echo __('Staff');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Vendor', array( 'controller' => 'Vendors','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Vendor as $k=>$post): $id=$post['Vendor']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		    <div class="form-group">
		      <?php if($userType!='AGY'){?>
		      <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Agency');?>:</small></label>
		      <div class="col-sm-6">
			 <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'agent'));
			 echo $this->Form->select("$k.Vendor.project_id",$projectName,array('id'=>'projectId','rel'=>$url,'label' => false,'class'=>'form-control','empty'=>__('Please Select'),'div'=>false));?>
		      </div>
		      <?php }else {
		      echo $this->Form->hidden("$k.Vendor.project_id",array('value'=>$agencyId));
		      }?>
		    </div>
		    <div class="panel-body">
		    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Name');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Address');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.address",array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php __('Contact');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.contact",array('label' => false,'class'=>'form-control','placeholder'=>__('Contact'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-4 control-label"><small><?php echo __('Licence No.');?>:</small></label>
                        <div class="col-sm-6">
                           <?php echo $this->Form->input("$k.Vendor.licence_no",array('label' => false,'class'=>'form-control','placeholder'=>__('Licence No.'),'div'=>false));?>
                        </div>
                    </div>
		      <div class="form-group text-left">
			  <div class="col-sm-offset-4 col-sm-6">
			      <?php echo $this->Form->input("$k.Vendor.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
		  </div>
		</div>
                    <?php endforeach;?>
                        <?php unset($post);?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-4 col-sm-6">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> <?php echo __('Cancel');?></button><?php }?>
                        </div>
                    </div>
                 <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
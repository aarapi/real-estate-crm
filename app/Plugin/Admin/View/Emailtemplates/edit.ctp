<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Email Template');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Emailtemplate', array( 'controller' => 'Emailtemplates','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Emailtemplate as $k=>$post): $id=$post['Emailtemplate']['id'];$form_no=$k+1;?>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form').' '.$form_no?></small></strong></div>
		  <div class="panel-body">
		    <div class="form-group">
			  <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name').':';?></small></label>
			  <div class="col-sm-10">
			     <?php echo $this->Form->input("$k.Emailtemplate.name",array('label' => false,'class'=>'form-control','placeholder'=>'Name','div'=>false));?>
			  </div>
		    </div>
		     <div class="form-group">
			  <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Email Template').':';?></small></label>
			  <div class="col-sm-10">
			     <?php echo $this->Tinymce->input("$k.Emailtemplate.description",array('label' => false,'class'=>'form-control','placeholder'=>__('Email Template'),'div'=>false),array('language'=>$configLanguage,'directionality'=>$dirType),'absolute');?>
			  </div>
		    </div>
		    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status').':';?></small></label>
                <div class="col-sm-10">
		<?php
		$option=array('Published'=>__('Published'),'Unpublished'=>__('Unpublished'));
		?>
                   <?php echo $this->Form->select("$k.Emailtemplate.status",$option,array('label' => false,'class'=>'form-control','empty'=>false,'div'=>false));?>
                </div>
            </div>
	
		      <div class="form-group text-left">
			  <div class="col-sm-6">
			      <?php echo $this->Form->input("$k.Emailtemplate.id",array('type' => 'hidden'));?>
			  </div>
		      </div>
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
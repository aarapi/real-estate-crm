<div class="modal-dialog">
    <div class="modal-content">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Send By');?> <?php echo __('Email');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Property', array( 'controller' => 'Properties','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
														
							    <div class="form-group">
							       <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('E-mail');?>:</small></label>
							       <div class="col-sm-7">
								  <?php echo $this->Form->input("email",array('type'=>'text','required'=>true,'placeholder'=>__('Multiple E-Mails seprated by comaa(,)'),'label' => false,'class'=>'form-control','div'=>false));?>
							       </div>
							       </div>
							  				
                    	<div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <button type="submit" class="btn btn-success" id="save"><span class="fa fa-refresh"></span> <?php echo __('Submit');?></button>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
		</div>
        </div>
    </div>
</div>
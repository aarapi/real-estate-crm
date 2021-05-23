<script type="text/javascript">
$(document).ready(function(){
  $('#password').change(function(){validatePassword();});
  $('#confirm_password').keyup(function(){validatePassword();})
function validatePassword(){
  if($('#password').val() != $('#confirm_password').val()) {
    document.getElementById('confirm_password').setCustomValidity("Passwords Don't Match");
  } else {
   document.getElementById('confirm_password').setCustomValidity('');
  }
}
});
</script>
<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Change Password');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Contact',array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('password',array('id'=>'password','required'=>true,'value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Confirm Password');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'confirm_password','label' => false,'class'=>'form-control','placeholder'=>__('Confirm Password'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('id', array('type' => 'hidden'));?>                            
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
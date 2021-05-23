<script type="text/javascript">
    $(document).ready(function(){
	<?php if($this->request->data['Emailsetting']['type']=="Smtp"){?>$('#smtp').show();<?php }else{?>$('#smtp').hide();<?php }?>
	$('#EmailsettingTypeSmtp').click(function(){$('#smtp').show();});
	$('#EmailsettingTypeMail').click(function(){$('#smtp').hide();});
	});
</script>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Email Settings');?></h1></div></div>
<?php echo $this->Session->flash();?>
   <div class="col-sm-12">    
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $this->Form->create('Emailsetting', array('controller' => 'Emailsettings', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Email Type');?></label>
                        <div class="col-sm-4">
				<?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Mail"=>"LOCALHOST","Smtp"=>"SMTP"),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false));?>
			</div>                        
                    </div>
		    <div id="smtp">
			<div class="form-group">
			    <label for="site_name" class="col-sm-2 control-label"><?php echo __('Server Name/Host');?></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('host',array('label' => false,'class'=>'form-control','placeholder'=>__('Server Name'),'div'=>false));?>
			    </div>
			    <label for="site_name" class="col-sm-2 control-label"><?php echo __('Port');?></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('port',array('label' => false,'class'=>'form-control','placeholder'=>__('Port'),'div'=>false));?>
			    </div>
			</div>
			<div class="form-group">
			    <label for="site_name" class="col-sm-2 control-label"><?php echo __('User Name');?></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
			    </div>
			    <label for="site_name" class="col-sm-2 control-label"><?php echo __('Password');?></label>
			    <div class="col-sm-4">
			       <?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false));?>
			    </div>                        
			</div>
		    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Save Settings');?></button>
                        </div>
                    </div>
                <?php echo$this->Form->end(null);?>
                </div>
            </div>
        </div>
    </div>
</div>
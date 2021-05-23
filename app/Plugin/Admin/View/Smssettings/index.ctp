<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('SMS Settings');?></h1></div></div>
<?php echo $this->Session->flash();?>
   <div class="col-sm-12">    
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $this->Form->create('Smssetting', array('controller' => 'Smssettings', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                         <label for="site_name" class="col-sm-2 control-label"><?php echo __('API Link');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('api',array('label' => false,'class'=>'form-control','placeholder'=>__('API Link'),'div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Sender ID');?></label>
                        <div class="col-sm-4">
			 <?php echo $this->Form->input('senderid',array('label' => false,'class'=>'form-control','placeholder'=>__('Sender ID'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('User Name');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Password/API Key');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('password',array('type'=>'password','label' => false,'class'=>'form-control','placeholder'=>__('Password/API Key'),'div'=>false));?>
                        </div>                        
                    </div>
		    <div class="form-group">
                         <label for="site_name" class="col-sm-2 control-label"><?php echo __('Heading Username');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('husername',array('label' => false,'class'=>'form-control','placeholder'=>__('Username field provided by sms gateway'),'div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label">H<?php echo __('eading Password');?></label>
                        <div class="col-sm-4">
			 <?php echo $this->Form->input('hpassword',array('label' => false,'class'=>'form-control','placeholder'=>__('Password field provided by sms gateway'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                         <label for="site_name" class="col-sm-2 control-label"><?php echo __('Heading Mobile No');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('hmobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile No field provided by sms gateway'),'div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Heading Message');?></label>
                        <div class="col-sm-4">
			 <?php echo $this->Form->input('hmessage',array('label' => false,'class'=>'form-control','placeholder'=>__('Message field provided by sms gateway'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Heading Sender Id');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('hsenderid',array('label' => false,'class'=>'form-control','placeholder'=>__('Sender Id field provided by sms gateway'),'div'=>false));?>
                        </div>
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Type');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('type',array('type'=>'radio','options'=>array("Get"=>__('Get'),"Post"=>__('Post')),'default'=>'Get','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Save Settings');?></button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
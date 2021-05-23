<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Configuration Options');?></h1></div></div><div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
               <?php echo $this->Form->create('Configuration', array( 'controller' => 'Configurations', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Site Name');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Site Name'),'div'=>false));?>
                        </div>
                         <label for="site_name" class="col-sm-2 control-label"><?php echo __('Organization Name');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('organization_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Organization Name'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Address');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Account Details');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('account_details',array('label' => false,'class'=>'form-control','placeholder'=>__('Account Details'),'div'=>false));?>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Domain Name');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('domain_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Domain Name'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Organization Email');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Organization Email'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Meta Title');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('meta_title',array('label' => false,'class'=>'form-control','placeholder'=>__('Meta Title'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Meta Description');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('meta_desc',array('label' => false,'class'=>'form-control','placeholder'=>__('Meta Description'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Time Zone');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select('timezone',$this->Time->listTimezones(),array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Currency');?></label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('currency',array('options'=>$currency,'empty'=>false,'label' => false,'class'=>'form-control','div'=>false,'escape'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Language');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select('language',$language,array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Text Direction');?></small></label>
                        <div class="col-sm-4">
                            <?php echo $this->Form->input('dir_type',array('type'=>'radio','options'=>array("1"=>__('Left-to-right (LTR)'),"0"=>__('Right-to-Left (RTL)')),'default'=>'1','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Display records per page');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('min_limit',array('label' => false,'class'=>'form-control','placeholder'=>__('Display records per page'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Max records per page');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('max_limit',array('label' => false,'class'=>'form-control','placeholder'=>__('Max records per page'),'div'=>false));?>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Date Format');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('date_format',array('label' => false,'class'=>'form-control','data-errormessage'=>__('Date Format Required'),'placeholder'=>__('Date Format'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-6 control-label"><?php echo __('Date, Month, Year, Hour, Min, Sec, Meridian, Date Separator, Time Separator');?></label>                        
                    </div>
                     <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Map Key');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('map_key',array('label' => false,'class'=>'form-control','placeholder'=>__('Map Key'),'div'=>false));?>
                        </div>
                       
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Capthca');?></small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('captcha_type',array('type'=>'radio','options'=>array("1"=>__('Image'),"0"=>__('Text')),'default'=>'1','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
                        </div>
                                                                                                 
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Short Name');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('short_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Short Name'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Contact Nos.');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('contact',array('label' => false,'class'=>'form-control','placeholder'=>__('Contact No. should be comma seprated'),'div'=>false));?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Due Days');?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('due_days',array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Due Days'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __("Late Fees (% annually)");?></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input('late_fees',array('label' => false,'class'=>'form-control','placeholder'=>__('Late Fees (% annually)'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Email Notification');?></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->input('email_notification',array('label' => false,'class'=>'form-control','data-errormessage'=>__('Date Format Required'),'placeholder'=>__('Date Format'),'div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('SMS Notification');?></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox('sms_notification',array('label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('Google Translation');?></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox('translate',array('label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site_name" class="col-sm-2 control-label"><?php echo __('Front End Registration');?></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox('front_end',array('label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
                        <label for="site_name" class="col-sm-3 control-label"><?php echo __('Front End Slides');?></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox('slides',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span>&nbsp;<?php echo __('Save Settings');?></button>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
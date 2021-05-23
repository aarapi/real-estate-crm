<?php if($type =="AY"){$pageName=__('Add Agency');}
elseif($type=="AT"){$pageName=__('Add Agent');}
else{$pageName=__('Add User');}
if(!isset($pageName)){
    $pageName="&nbsp;";}
    ?>
<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo $pageName;?></h1>	
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
<div class="content">
<div class="container">
<div class="panel">
    <div class="panel-heading">
    </div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('User', array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type'=>'file'));?>
            <?php if(!isset($type)) {?>
            <?php if($userType!='AGY'){$name="Name";?>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('User');?> <?php echo __('Level');?></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->select('ugroup_id',$ugroup,array('empty'=>__('Select'),'label' => false,'class'=>'form-control','div'=>false));?>
                </div>
            </div>
            <?php }}
            elseif($type =='AY') {$name='Agency Name'; echo $this->Form->input('ugroup_id',array('value' => '4','type'=>'hidden'));}
            elseif($type =='AT') {$name='Agent Name'; echo $this->Form->input('ugroup_id',array('value' => '2','type'=>'hidden'));
                        if($userType=="AGY"){
                            $this->Form->input('project_id',array('value' =>$pId,'type'=>'hidden'));
                        }
                        elseif($userType=='ADR'){?>
                        <div class="form-group">
                            <div id="UserAgency">
                                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Agency');?></label>
                                <div class="col-sm-4">
                                    <?php echo $this->Form->select('project_id',$project,array('empty'=>__('Select'),'label' => false,'class'=>'form-control','div'=>false));?>
                                </div>
                            </div>
                        </div>
                        <?php }
            }?>
            
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __($name);?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__($name),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Username');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('username',array('label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Password');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->password('password',array('label' => false,'class'=>'form-control validate[required,minSize[4],maxSize[15]]','required'=>'required','placeholder'=>__('Password'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Address').':';?></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Location').':';?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('location_id',$location,array('label' => false,'class'=>'form-control','empty'=>__('Please select'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Phone');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Mobile');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('mobile',array('label' => false,'class'=>'form-control','placeholder'=>__('Mobile'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Email ID');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Email ID'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Skype ID');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('skype',array('label' => false,'class'=>'form-control','placeholder'=>__('Skype ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Twitter ID');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('twitter',array('label' => false,'class'=>'form-control','placeholder'=>__('Twitter ID'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Facebook ID');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('facebook',array('label' => false,'class'=>'form-control','placeholder'=>__('Facebook ID'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Linkedin ID');?></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('linkedin',array('label' => false,'class'=>'form-control','placeholder'=>__('Linkedin ID'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Upload Photo');?></label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'div'=>false));?>
                </div>	    
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><?php echo __('Description').':';?></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('description',array('label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
                    <?php if(!isset($type)) { echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Users','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}
                    elseif($type =='AY') { echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Agencies','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}
                    elseif($type =='AT') { echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Agents','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}
                    ?>
                </div>
            </div>
            <?php echo$this->Form->end();?>
        </div>
</div>
</div>
</div>
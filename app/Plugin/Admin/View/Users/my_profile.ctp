<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('My Profile');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
                <div class="panel-body">
                <div class="table-responsive">
			<table class="table table-bordered">
				<tr class="text-primary">
					<td><p><?php echo $this->Html->image($std_img);?></p></strong></td>
				</tr>									
			</table>
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Name');?></small></strong></td>
				<td><?php echo $post['User']['name'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Username');?></small></strong></td>
				<td><?php echo $post['User']['username'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Email ID');?></small></strong></td>
				<td <?php if(!$post['User']['skype']) echo "colspan=3"?>><?php echo $post['User']['email'];?></td>
				<?php if($post['User']['skype']) {?><td><strong><small class="text-danger"><?php echo __('Skype ID');?></small></strong></td>
				<td><?php echo $post['User']['skype'];?></td><?php }?>
			    </tr>
			    <?php if($post['User']['facebook'] || $post['User']['twitter']) {?><tr>				
				<td><strong><small class="text-danger"><?php echo __('Twitter ID');?></small></strong></td>
				<td><?php echo $post['User']['twitter'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Facebook ID');?></small></strong></td>
				<td><?php echo $post['User']['facebook'];?></td>
			    </tr><?php }?>
			    <?php if($post['User']['linkedin']) {?><tr>				
				<td><strong><small class="text-danger"><?php echo __('Linkedin ID');?></small></strong></td>
				<td><?php echo $post['User']['linkedin'];?></td>
			    </tr><?php }?>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Phone');?></small></strong></td>
				<td><?php echo $post['User']['phone'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Mobile');?></small></strong></td>
				<td><?php echo $post['User']['mobile'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong></td>
				<td colspan="3"><?php echo $post['User']['address'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Location');?></small></strong></td>
				<td><?php if($post['Location']['name']) echo $post['Location']['name']; else echo "Not Specified"?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Description');?>:</small></strong></td>
				<td colspan="3"><?php echo $post['User']['description'];?></td>
			    </tr>
			</table>
			<?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit Profile'),array('controller'=>'Users','action'=>'editprofile'),array('escape'=>false,'class'=>'btn btn-warning'));?>
		    </div>
		</div>
            </div>
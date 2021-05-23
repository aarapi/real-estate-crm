<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Agent');?> <?php echo __('Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
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
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong></td>
				<td colspan="3"><?php echo $post['User']['address'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Phone');?></small></strong></td>
				<td><?php echo $post['User']['phone'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Mobile');?></small></strong></td>
				<td><?php echo $post['User']['mobile'];?></td>
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
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Description');?>:</small></strong></td>
				<td colspan="3"><?php echo $post['User']['description'];?></td>
			    </tr>
			</table>
		    </div>
        </div>
    </div>
</div>
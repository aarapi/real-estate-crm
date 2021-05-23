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
				<td colspan="3"><?php echo $post['Agent']['name'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong></td>
				<td colspan="3"><?php echo $post['Agent']['address'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Phone');?></small></strong></td>
				<td><?php echo $post['Agent']['phone'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Mobile');?></small></strong></td>
				<td><?php echo $post['Agent']['mobile'];?></td>
			    </tr>
			    <tr>				
				<td><strong><small class="text-danger"><?php echo __('Email ID');?></small></strong></td>
				<td><?php echo $post['Agent']['email'];?></td>
				<?php if($post['Agent']['skype']) {?><td><strong><small class="text-danger"><?php echo __('Skype ID');?></small></strong></td>
				<td><?php echo $post['Agent']['skype'];?></td><?php }?>
			    </tr>
			    <?php if($post['Agent']['facebook'] || $post['Agent']['twitter']) {?><tr>				
				<td><strong><small class="text-danger"><?php echo __('Twitter ID');?></small></strong></td>
				<td><?php echo $post['Agent']['twitter'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Facebook ID');?></small></strong></td>
				<td><?php echo $post['Agent']['facebook'];?></td>
			    </tr><?php }?>
			    <tr>
				<?php if($post['Agent']['linkedin']) {?><td><strong><small class="text-danger"><?php echo __('Linkedin ID');?></small></strong></td>
				<td><?php echo $post['Agent']['linkedin'];?></td><?php }?>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Description');?>:</small></strong></td>
				<td colspan="3"><?php echo $post['Agent']['description'];?></td>
			    </tr>
			</table>
		    </div>
        </div>
    </div>
</div>
<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td colspan="4"><h6><b><?php echo __('Contact Information');?></b></h6></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Name');?></small></strong></td>
				<td><?php echo h($post['Contact']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong></td>
				<td><?php echo h($post['Contact']['address']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('District');?></small></strong></td>
				<td><?php echo h($post['Contact']['district']);?></td>
				<td><strong><small class="text-danger"><?php echo __('State');?></small></strong></td>
				<td><?php echo h($post['Contact']['state']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Pincode');?></small></strong></td>
				<td><?php echo h($post['Contact']['pincode']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Email');?></small></strong></td>
				<td><?php echo h($post['Contact']['email']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Cell phone');?></small></strong></td>
				<td><?php echo h($post['Contact']['mobile']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Phone');?></small></strong></td>
				<td><?php echo h($post['Contact']['phone']);?></td>
			    </tr>
			</table>
		    </div>
        </div>
    </div>
</div>
<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Purchase');?> <span><?php echo __('Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Agency');?></small></strong></td>
				<td><?php echo h($post['Project']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Seller Name');?></small></strong></td>
				<td><?php echo h($post['Purchase']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Seller Address');?></small></strong></td>
				<td><?php echo h($post['Purchase']['address']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Seller Mobile');?></small></strong></td>
				<td><?php echo h($post['Purchase']['mobile']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Property Name');?></small></strong></td>
				<td><?php echo h($post['Purchase']['property_name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Property Area');?></small></strong></td>
				<td><?php echo h($post['Purchase']['area']).' '.h($post['Unit']['name']);;?></td>
			    </tr>
			     <tr>
				<td><strong><small class="text-danger"><?php echo __('Property Amount');?></small></strong></td>
				<td><?php echo $currency.$this->Number->format($post['Purchase']['amount']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Property Description');?></small></strong></td>
				<td><?php echo h($post['Purchase']['description']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Remarks');?></small></strong></td>
				<td colspan="3"><?php echo h($post['Purchase']['remarks']);?></td>				
			    </tr>			   
			</table>
		    </div>
        </div>
    </div>
</div>
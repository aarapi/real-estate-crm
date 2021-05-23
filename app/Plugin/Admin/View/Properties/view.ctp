<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Property');?> <?php echo __('Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td colspan="2"><strong><big class="text-danger"><?php echo __('Office ID');?></big></strong>: <strong><big class="text-info"><?php echo $post['Property']['uniq_id'];?></big></strong></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Agency');?></small></strong>: <?php echo $post['Project']['name'];?></td>
				<td><strong><small class="text-danger"><?php echo __("Property's Agent");?></small></strong>: <?php echo $post['User']['name'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Title');?></small></strong>: <?php echo $post['Property']['name'];?></td>				
				<td><strong><small class="text-danger"><?php echo __('Type');?></small></strong>: <?php echo $post['Type']['name'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Latitude');?></small></strong>: <?php if($post['Property']['latitude']) echo __($post['Property']['latitude']); else echo __('Not specified');?></td>				
				<td><strong><small class="text-danger"><?php echo __('Longitude');?></small></strong>: <?php if($post['Property']['longitude']) echo __($post['Property']['longitude']); else echo __('Not specified');?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Price');?></small></strong>: <?php echo $post['Property']['price'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Area');?></small></strong>: <?php echo $post['Property']['area'].' '.$post['Unit']['name'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Location');?></small></strong>: <?php echo $post['Location']['name'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong>: <?php echo $post['Property']['address'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Number of floors');?></small></strong>: <?php if($post['Property']['floor']) echo __($post['Property']['bedroom']); else echo __('Not specified');?></td>
				<td>&nbsp;</td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Number of bedrooms');?></small></strong>: <?php if($post['Property']['bedroom']) echo __($post['Property']['bedroom']); else echo __('Not specified');?></td>
				<td><strong><small class="text-danger"><?php echo __('Number of bathrooms');?></small></strong>: <?php if($post['Property']['bathroom']) echo __($post['Property']['bathroom']); else echo __('Not specified');?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Availiable For');?></small></strong>: <?php echo $post['Contract']['name'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Embed Video');?></small></strong>: <?php echo $post['Property']['video'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Allow user rating');?></small></strong>: <?php if($post['Property']['allow_rating']) echo __("Yes"); else echo __('No');?></td>
				<td><strong><small class="text-danger"><?php echo __('Allow user comment');?></small></strong>: <?php if($post['Property']['allow_comment']) echo __("Yes"); else echo __('No');?></td>
			    </tr>
			    <tr>
				<td colspan=2><strong><small class="text-danger"><?php echo __('Description');?></small></strong>: <?php echo $post['Property']['description'];?></td>
			    </tr>
			</table>
		    </div>
        </div>
    </div>
</div>
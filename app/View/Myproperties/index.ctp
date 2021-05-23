<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><?php echo __('Property');?> <span><?php echo __('Details');?></span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Property Name');?></small></strong></td>
				<td><?php echo $post['Property']['name'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Type');?></small></strong></td>
				<td><?php echo $post['Property']['type'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Availiable For');?></small></strong></td>
				<td><?php echo $post['Property']['availiable'];?></td>
				<td><strong><small class="text-danger"><?php echo __('Value');?.</small></strong></td>
				<td><?php if($post['Property']['availiable']=="Rent"){echo $currency.$this->Number->format($post['Property']['value']).__("/Monthly");}else{echo $currency.$this->Number->format($post['Property']['value']);}?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Area');?></small></strong></td>
				<td><?php echo $post['Property']['area'];?></td>
				<td><strong><small class="text-danger"><?php echo __('City');?></small></strong></td>
				<td><?php echo $post['Property']['city'];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('State');?></small></strong></td>
				<td colspan="3"><?php echo $post['Property']['state'];?></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Area/Specification');?>:</small></strong></td>
				<td colspan="3"><?php echo $post['Property']['specification'];?></td>				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Comment/Remarks');?></small></strong></td>
				<td colspan="3"><?php echo $post['Property']['remarks'];?></td>				
			    </tr>
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>

<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Template');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Type');?></small></strong></td>
				<td><?php echo $typeArr[$post['Template']['type']];?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Name');?></small></strong></td>
				<td><?php echo $post['Template']['name'];?></td>
			    </tr>
			     <tr>
				<td><strong><small class="text-danger"><?php echo __('Template');?></small></strong></td>
				<td><?php echo $post['Template']['description'];?></td>
			    </tr>			    
			</table>
		    </div>
        </div>
    </div>
</div>
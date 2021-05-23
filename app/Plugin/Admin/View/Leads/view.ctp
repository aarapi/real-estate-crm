<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Lead Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Client Name');?>: </small></strong><?php echo h($post['Client']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Email');?>: </small></strong><?php echo h($post['Client']['email']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Mobile');?>: </small></strong><?php echo h($post['Client']['phone']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Property Name');?>: </small></strong><?php echo h($post['Property']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Type');?>: </small></strong><?php echo h($post['Type']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Contract');?>: </small></strong><?php echo h($post['Contract']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Property Status');?>: </small></strong><?php echo h($post['Property']['status']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Follow Up');?>: <?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,h($post['Lead']['follow_up']));?></small></strong></td>
				<td><strong><small class="text-danger"><?php echo __('Status');?>: </small></strong><span style="background-color: <?php echo h($post['Status']['color']);?>;color: #ffffff;padding: 5px;"><?php echo h(__($post['Status']['name']));?></span></td>
				<td></td>
			    </tr>
			    <tr>
				<td colspan="4"><strong><small class="text-danger"><?php echo __('Comments/Remarks');?>: </small></strong><?php echo h($post['Lead']['remarks']);?></td>				
			    </tr>			   
			</table>
		    </div>
        </div>
    </div>
</div>
<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('My Deal Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Client Name');?></small></strong></td>
				<td><?php echo h($post['Client']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Property Name');?></small></strong></td>
				<td><?php echo h($post['Property']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Type');?></small></strong></td>
				<td><?php echo h($post['Type']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Availiable For');?></small></strong></td>
				<td><?php echo h($post['Contract']['name']);?></td>
			    </tr>
			    <!--<tr>
				<td><strong><small class="text-danger"><?php //echo __('Flat/Plot');?></small></strong></td>
				<td><?php //echo h($post['PropertiesFlat']['name']);?></td>
				<td><strong><small class="text-danger"><?php //echo __('Flat/Plot number');?></small></strong></td>
				<td><?php //echo h($post['PropertiesFlat']['floor_no']);?></td>				
			    </tr>-->
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Payment Plan');?></small></strong></td>
				<td><?php echo h($post['Plan']['name']);?></td>	
				<td><strong><small class="text-danger"><?php echo __('Agent');?></small></strong></td>
				<td><?php echo h($post['User']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Invoice Date');?></small></strong></td>
				<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Deal']['date']));?></td>
				<td><strong><small class="text-danger"><?php echo __('Area');?></small></strong></td>
				<td><?php echo $post['Property']['area'].' '.h($post['Unit']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Amount');?></small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['Property']['price']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Discount');?></small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['Deal']['discount']);?></td>
			    </tr>
			    <tr>
				
				<td><strong><small class="text-danger"><?php echo __('Total Amount');?></small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['Deal']['total_amount']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Comments/Remarks');?></small></strong></td>
				<td colspan="3"><?php echo h($post['Deal']['remarks']);?></td>				
			    </tr>			   
			</table>
		    </div>        </div>
    </div>
</div>
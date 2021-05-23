<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><?php echo __('My Deal');?> <span><?php echo __('Details');?></span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
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
				<td><?php echo h($post['Property']['type']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Availiable For');?></small></strong></td>
				<td><?php echo h($post['Property']['availiable']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Flat/Plot');?></small></strong></td>
				<td><?php echo h($post['PropertiesFlat']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Payment Plan');?></small></strong></td>
				<td><?php echo h($post['Plan']['name']);?></td>				
			    </tr>
			     <tr>
				<td><strong><small class="text-danger"><?php echo __('Invoice Date');?></small></strong></td>
				<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['MyDeal']['date']));?></td>
				<td><strong><small class="text-danger"><?php echo __('Area');?></small></strong></td>
				<td><?php echo $post['PropertiesFlat']['area'].' '.h($post['Unit']['name']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Amount');?></small></strong></td>
				<td><?php echo $currency.$this->Number->format(h($post['PropertiesFlat']['price']));?></td>
				<td><strong><small class="text-danger"><?php echo __('Discount');?> </small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['MyDeal']['discount']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Total Amount');?></small></strong></td>
				<td><?php echo$currency.$this->Number->format($post['MyDeal']['total_amount']);?></td>
				<td><strong><small class="text-danger">&nbsp;</small></strong></td>
				<td>&nbsp;</td>
				
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Comments/Remarks');?></small></strong></td>
				<td colspan="3"><?php echo h($post['MyDeal']['remarks']);?></td>				
			    </tr>			   
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>

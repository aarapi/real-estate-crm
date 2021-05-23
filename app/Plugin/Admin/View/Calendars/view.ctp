<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Calendar Schedule');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
	<div class="panel-body"><?php echo $this->Session->flash();?>
	    <div class="table-responsive">
		<table class="table table-bordered">
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Name');?></small></strong></td>
			<td><?php echo $post['User']['name'];?></td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Start Date Time');?></small></strong></td>
			<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin,$post['Calendar']['start_date']);?></td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('End Date Time');?></small></strong></td>
			<td><?php if($post['Calendar']['end_date']) echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin,$post['Calendar']['end_date']); else echo"No end date";?></td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Repeative Event');?></small></strong></td>
			<td><?php if($post['Calendar']['is_repeat']==1)echo __('Yes');else echo __('No');?></td>
		    </tr>
		    <?php if($post['Calendar']['is_repeat']==1){?>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Repeat Type');?></small></strong></td>
			<td><?php echo $repeatTypeArr[$post['Calendar']['repeat_type']];?></td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Number of Repeats');?></small></strong></td>
			<td><?php echo $post['Calendar']['repeat_no'];?></td>
		    </tr>
		    <?php }?>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Representative');?></small></strong></td>
			<td><?php echo $post['User']['name'];?></td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Message Type');?></small></strong></td>
			<td><?php echo $post['Calendar']['message_type'];?></td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Color');?></small></strong></td>
			<td style="background-color: <?php echo $post['Calendar']['color'];?>">&nbsp;</td>
		    </tr>
		    <tr>
			<td><strong><small class="text-danger"><?php echo __('Comment');?></small></strong></td>
			<td><?php echo $post['Calendar']['comments'];?></td>
		    </tr>
		</table>
	    </div>
	</div>
    </div>
</div>
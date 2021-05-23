<div class="dashboard-subheader">
<?php echo $this->Session->flash();?>
						<h2><?php echo __('My');?> <span><?php echo __('Profile');?></span></h2>		

						
					</div><!-- /.dashboard-header -->

					<div class="row">
						<table class="table table-users">
	<tr>
				<td><strong><small class="text-danger"><?php echo __('Name')?></small></strong></td>
				<td><?php echo h($post['MyProfile']['name']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Contact Number');?></small></strong></td>
				<td><?php echo h($post['MyProfile']['phone']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Email');?></small></strong></td>
				<td><?php echo h($post['MyProfile']['email']);?></td>
				<td><strong><small class="text-danger"><?php echo __('Address');?></small></strong></td>
				<td ><?php echo h($post['MyProfile']['address']);?></td>
			    </tr>
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Last Login');?></small></strong></td>
				<td colspan="3"><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['MyProfile']['last_login']);?></td>				
			    </tr>
</table>

					</div><!-- /.row -->	
				</div><!-- /.container -->						
			</div><!-- /.dashboard-content -->			
		</div><!-- /.dashboard -->
	</div><!-- /.page-wrapper -->
<div class="dashboard-subheader">
<?php echo $this->Session->flash();?>
						<h2><?php echo __('Payments');?></h2>
					</div><!-- /.dashboard-header -->

					<div class="row">
						<table class="table table-users">
	<thead>
		<tr>
			<th><?php echo __('Receipt No.');?></th>
			<th><?php echo __('Payment Date');?></th>
			<th><?php echo __('Payment');?></th>								
			<th><?php __('Payment Type');?></th>
			<th><?php echo __('Transaction Reference');?></th>
		</tr>
	</thead>
	<tbody>
		
			<?php foreach ($dealsPayment as $post):?>
							<tr>
								<td><?php echo h($post['DealsPayment']['receipt_no']);?></td>
								<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['DealsPayment']['payment_date']));?></td>
								<td><?php echo $currency.$this->Number->format($post['DealsPayment']['amount']);?></td>
								<td><?php echo h($post['Paymenttype']['name']);?></td>
								<td><?php echo h($post['DealsPayment']['remarks']);?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
	</tbody>
</table>

					</div><!-- /.row -->	
				</div><!-- /.container -->						
			</div><!-- /.dashboard-content -->			
		</div><!-- /.dashboard -->
	</div><!-- /.page-wrapper -->
<div class="dashboard-subheader">
<?php echo $this->Session->flash();?>
						<h2><?php echo __('My');?> <span><?php echo __('Payments');?></h2>
					</div><!-- /.dashboard-header -->

					<div class="row">
						<table class="table table-users">
	<thead>
		<tr>
			<th><?php echo __('#');?></th>
			<th><?php echo __('Receipt No');?>.</th>
			<th><?php echo __('Payment Date');?></th>
			<th><?php echo __('Payment');?></th>					
			<th><?php echo __('Payment Type');?></th>
			<th><?php echo __('Transaction Reference');?></th>
			<th><?php echo __('Action');?></th>
		</tr>
	</thead>
	<tbody>
		
			<?php foreach($postArr as $post):$id=$post['MyPayment']['id'];?>
				<tr>
					<td><?php echo$serial_no++;?></td>
					<td><?php echo h($post['MyPayment']['receipt_no']);?></td>
					<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['MyPayment']['payment_date']));?></td>
					<td><?php echo $currency.$this->Number->format($post['MyPayment']['amount']);?></td>
					<td><?php echo h($post['Paymenttype']['name']);?></td>
					<td><?php echo h($post['MyPayment']['remarks']);?></td>
					<td>
					<?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Receipt'),array('controller'=>'MyPayments','action'=>'printreceipt',$id),array('class'=>'btn btn-info','target'=>'_blank','escape'=>false));?>
					</td>
				</tr>
				<?php endforeach;unset($post);?>
	</tbody>
</table>

					</div><!-- /.row -->	
				</div><!-- /.container -->						
			</div><!-- /.dashboard-content -->			
		</div><!-- /.dashboard -->
	</div><!-- /.page-wrapper -->
<div class="dashboard-subheader">
<?php echo $this->Session->flash();?>
						<h2><?php echo __('My');?> <span><?php echo __('Deals');?></h2>
					</div><!-- /.dashboard-header -->

					<div class="row">
						<table class="table table-users">
	<thead>
		<tr>
					<th><?php echo __('#');?></th>
					<th><?php echo __('Name');?></th>
					<th><?php echo __('Invoice No');?>.</th>
					<th><?php echo __('Invoice Date');?></th>
					<th><?php echo __('Invoice Total');?></th>
					<th><?php echo __('Action');?></th>
		</tr>
				
	</thead>
	<tbody>
		
			<?php $serial_no=1;
				$url=$this->Html->url(array('controller'=>'Myproperties'));
				foreach($postArr as $post):$id=$post['MyDeal']['id'];
				?>
				<tr>
					<td><?php echo$serial_no++;?></td>
					<td><?php echo h($post['Property']['name']);?></td>
					<td><?php echo h($post['MyDeal']['invoice_no']);?></td>
					<td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['MyDeal']['date']));?></td>
					<td><?php echo $currency.$this->Number->format($post['MyDeal']['total_amount']);?></td>
					<td>
					<?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Invoice'),array('controller'=>'MyDeals','action'=>'printinvoice',$post['MyDeal']['id']),array('class'=>'btn btn-info','target'=>'_blank','escape'=>false));?>
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;'.__('Details'),'#',array('onclick'=>"show_modal('MyDeals/view/$id');",'class'=>'btn btn-info','escape'=>false));?>
					<?php echo $this->Html->link('<span class="fa fa-image"></span>&nbsp;'.__('Photos'),'#',array('onclick'=>"show_modal('$url/photo/$id');",'class'=>'btn btn-info','escape'=>false));?>
					<?php echo $this->Html->link('<span class="fa fa-file"></span>&nbsp;'.__('Documents'),'#',array('onclick'=>"show_modal('$url/document/$id');",'class'=>'btn btn-info','escape'=>false));?>
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
	<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>
<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Show Entries of');?> <?php echo$expense['Vendor']['name'];?> <?php echo __('Invoice No');?>. <?php echo$expense['Inventory']['invoice_no'];?> <?php echo __('dated');?> <?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$expense['Inventory']['invoice_date']);?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Inventory'),array('controller' => 'Inventories','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'inventories_balances')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Entry'),array('controller'=>'inventories_balances','action'=>'add',$inventoryId),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
	    <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
	    <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print'),'#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
        </div>
    </div>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<div id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="panel-body">
			</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo __('#');?></th>
			    <th><?php echo __('Quantity');?></th>
			    <th><?php echo __('Date');?></th>
			    <th><?php echo __('Remarks');?></th>
                            <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php $serialNo=1; $totalPayment=0;
			foreach ($expensePayment as $post):
                        $id=$post['InventoriesBalance']['id'];
			$totalPayment=$totalPayment+$post['InventoriesBalance']['qty'];
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['InventoriesBalance']['id'],'name'=>'data[InventoriesBalance][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php echo $this->Number->format($post['InventoriesBalance']['qty']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['InventoriesBalance']['date']));?></td>
			    <td><?php echo h($post['InventoriesBalance']['remarks']);?></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div>
			    </td>                          
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			<td class="pbutton"></td>
			<td colspan="1" align="right"><strong>Total</strong></td>
			<td><strong><?php echo$this->Number->format($totalPayment);?></strong></td>
			<td align="right"><strong>Balance</strong></td>
			<td colspan="3"><strong><?php echo$this->Number->format($expense['Inventory']['invoice_qty']-$totalPayment);?></strong></td>
			</tr>
                        </table>
                </div>
        </div>
	<?php echo$this->Form->input('inventoryId',array('type'=>'hidden','name'=>'inventoryId','value'=>$inventoryId));?>
<?php echo $this->Form->end();?>
</div>
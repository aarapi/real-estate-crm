<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Show Payments of').' '.$expense['Vendor']['name'].' '.__('Invoice No').' '.$expense['Expense']['invoice_no'].' '.__('dated').' '.$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$expense['Expense']['invoice_date']);?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Expense'),array('controller' => 'Expenses','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'expenses_payments')); echo $this->Html->link('<span class="fa fa-dollar"></span>&nbsp;'.__('Add New Payment'),array('controller'=>'expenses_payments','action'=>'add',$expenseId),array('escape'=>false,'class'=>'btn btn-success'));?>
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
			    <th><?php echo __('Payment');?></th>
			    <th><?php echo __('Payment Date');?></th>
			    <th><?php echo __('Payment Type');?></th>
			    <th><?php echo __('Transaction Reference');?></th>
                            <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php $serialNo=1; $totalPayment=0;
			foreach ($expensePayment as $post):
                        $id=$post['ExpensesPayment']['id'];
			$totalPayment=$totalPayment+$post['ExpensesPayment']['amount'];
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['ExpensesPayment']['id'],'name'=>'data[ExpensesPayment][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php echo $currency.$this->Number->format($post['ExpensesPayment']['amount']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['ExpensesPayment']['date']));?></td>
			    <td><?php echo h($post['Paymenttype']['name']);?></td>
			    <td><?php echo h($post['ExpensesPayment']['remarks']);?></td>
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
			<td colspan="1" align="right"><strong><?php echo __('Total');?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalPayment);?></strong></td>
			<td align="right"><strong><?php echo __('Balance Due');?></strong></td>
			<td colspan="3"><strong><?php echo$currency.$this->Number->format($expense['Expense']['invoice_amount']-$totalPayment);?></strong></td>
			</tr>
                        </table>
                </div>
        </div>
	<?php echo$this->Form->input('expenseId',array('type'=>'hidden','name'=>'expenseId','value'=>$expenseId));?>
<?php echo $this->Form->end();?>
</div>
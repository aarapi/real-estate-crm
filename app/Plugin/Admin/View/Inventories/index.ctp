<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Inventories');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Inventories'));?>
	    <?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Inventory'),array('controller'=>'Inventories','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print'),'#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
        </div>
    </div>
        <?php echo $this->element('pagination');
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<?php echo $this->Session->flash();?>
<div id="printable_content">
<?php echo $this->Html->css('print');?>
    <div class="panel-body">
			</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
			    <th><?php echo $this->Paginator->sort('Vendor.name', __('Vendor / Staff'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Project.name', __('Project'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('ExpenseCategory.name', __('Category Name'), array('direction' => 'asc'));?></th>			    
			    <th><?php echo $this->Paginator->sort('invoice_no', __('Invoice No.'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_date', __('Invoice Date'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_qty', __('Quantity'), array('direction' => 'asc'));?></th>
			    <th><?php echo __('Balance');?></th>			    
			    <th><?php echo __('Status');?></th>
			    <th><?php echo $this->Paginator->sort('remarks', __('Remarks'), array('direction' => 'asc'));?></th>
                            <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php $totalInvoice=0;$totalBalance=0;
			foreach ($Inventory as $post):
                        $id=$post['Inventory']['id'];
			$balanceDue=$post['Inventory']['invoice_qty']-$post['Inventory']['qty'];
			$totalInvoice=$totalInvoice+$post['Inventory']['invoice_qty'];$totalBalance=$totalBalance+$balanceDue;
			if($balanceDue<=0)
			$status=__("Empty");
			else
			$status=__("Available");
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Inventory']['id'],'name'=>'data[Inventory][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php echo h($post['Vendor']['name']);?></td>
			    <td><?php echo h($post['Project']['name']);?></td>
			    <td><?php echo h($post['ExpenseCategory']['name']);?></td>			    
			    <td><?php echo h($post['Inventory']['invoice_no']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Inventory']['invoice_date']);?></td>
                            <td><?php echo $this->Number->format($post['Inventory']['invoice_qty']);?></td>
			    <td><?php echo $this->Number->format($balanceDue);?></td>
			    <td><span class="label label-<?php if($status=="Available")echo"success";else echo"danger";?>"><?php echo __($status);?></span></td>
			    <td><?php echo h($post['Inventory']['remarks']);?></td>			    
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($status!="Paid"){?><li><?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Make Entry'),array('controller'=>'inventories_balances','action'=>'add',$id),array('escape'=>false));?></li><?php }?>
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;'.__('Show Inventories'),array('controller'=>'inventories_balances','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			    <td class="pbutton"></td>
			    <td colspan="6" align="right"><strong><?php echo __('Total');?></strong></td>
			    <td><strong><?php echo$this->Number->format($totalInvoice);?></strong></td>
			    <td colspan="5"><strong><?php echo$this->Number->format($totalBalance);?></strong></td>
			</tr>    
		    </table>

                </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
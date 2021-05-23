<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Deals')?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
	    <?php $url=$this->Html->url(array('controller'=>'Deals'));echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Deal'),array('controller'=>'Deals','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
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
                            <th><?php echo $this->Paginator->sort('Client.name', __('Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.name', __('Property'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('invoice_no', __('Invoice No'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('date', __('Invoice Date'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Property.area', __('Area'), array('direction' => 'asc'));?></th>			    
			    <th><?php echo $this->Paginator->sort('total_amount', __('Total Amount'), array('direction' => 'asc'));?></th>
			    <th><?php echo __('Balance Due');?></th>
			    <th><?php echo __('Status');?></th>
			    <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php $totalInvoice=0;$totalBalance=0;
			foreach ($Deal as $post):
                        $id=$post['Deal']['id'];
			$balanceDue=$post['Deal']['total_amount']-$post['Deal']['payment'];
			$totalInvoice=$totalInvoice+$post['Deal']['total_amount'];$totalBalance=$totalBalance+$balanceDue;
			if($balanceDue<=0)
			$status="Paid";
			else
			$status="Partial";
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Deal']['id'],'name'=>'data[Deal][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Client']['name']);?></td>
			    <td><?php echo h($post['Property']['name']);?></td>
			    <td><?php echo h($post['Deal']['invoice_no']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['Deal']['date']));?></td>
			    <td><?php echo $post['Property']['area'].' '.h($post['Unit']['name']);?></td>			    
			    <td><?php echo $currency.$this->Number->format(h($post['Deal']['total_amount']));?></td>
			    <td><?php echo $currency.$this->Number->format(h($balanceDue));?></td>
			    <td><span class="label label-<?php if($status=="Paid")echo"success";else echo"danger";?>"><?php echo __($status);?></span></td>
			    <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;'.__('Show Payment Plan'),array('controller'=>'plans_payments','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-dollar"></span>&nbsp;'.__('Make Payment'),array('controller'=>'deals_payments','action'=>'add',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;'.__('Show Payment'),array('controller'=>'deals_payments','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print Invoice'),array('controller'=>'Deals','action'=>'printinvoice',$id),array('target'=>'_blank','escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div></td>
			    </td>                            
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			<td class="pbutton"></td>
			<td colspan="7" align="right"><strong><?php echo __('Total');?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalInvoice);?></strong></td>
			<td colspan="3"><strong><?php echo$currency.$this->Number->format($totalBalance);?></strong></td>
			</tr>
                        </table>
                </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
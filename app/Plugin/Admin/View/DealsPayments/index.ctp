<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Show Payments of').' '.$dealPayment[0]['Client']['name'].' '.__('for').' '.$dealPayment[0]['Property']['name'].' '.__('Total Amount').' '.$currency.$this->Number->format($dealPayment[0]['Deal']['total_amount']);?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
         <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Deals'),array('controller' => 'Deals','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'deals_payments')); echo $this->Html->link('<span class="fa fa-dollar"></span>&nbsp;'.__('Add New Payment'),array('controller'=>'deals_payments','action'=>'add',$dealId),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
	    <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print'),'#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
        </div>
    </div>
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
                            <th><?php echo __('#');?></th>
			    <th><?php echo __('Amount');?></th>
			    <th><?php echo __('Tax Amount');?></th>
			    <th><?php echo __('Total Amount');?></th>
			    <th><?php echo __('Payment Name');?></th>
			    <th><?php echo __('Payment Date');?></th>
			    <th><?php echo __('Payment Type');?></th>
			    <th><?php echo __('Transaction Reference');?></th>
                            <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php $serialNo=0; $totalPayment=0;$totalAmount=0;$totalTaxAmount=0;
			$totalRecord=count($dealPayment);
			foreach ($dealPayment as $post):
                        $id=$post['DealsPayment']['id'];
			$totalPayment=$totalPayment+$post['DealsPayment']['amount'];
			$totalAmount=$totalAmount+$post['DealsPayment']['total_amount'];
			$totalTaxAmount=$totalTaxAmount+$post['DealsPayment']['tax_amount'];
			$serialNo++;
			?>
                        <tr>
                            <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['DealsPayment']['id'],'name'=>'data[DealsPayment][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo;?></td>
			    <td><?php echo $currency.$this->Number->format($post['DealsPayment']['total_amount']);?></td>
			    <td><?php echo $currency.$this->Number->format($post['DealsPayment']['tax_amount']);?></td>
			    <td><?php echo $currency.$this->Number->format($post['DealsPayment']['amount']);?></td>
			    <td><?php echo h($post['PlansPayment']['name']);?></td>
			    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['DealsPayment']['payment_date']));?></td>
			    <td><?php echo h($post['Paymenttype']['name']);?></td>
			    <td><?php echo h($post['DealsPayment']['remarks']);?></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			      <?php echo __('Action');?>&nbsp;<span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print Receipt'),array('controller'=>'deals_payments','action'=>'printreceipt',$id),array('target'=>'_blank','escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			    <?php if($totalRecord==$serialNo){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
			    </ul>
			  </div>
			    </td>                          
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<tr>
			<td class="pbutton"></td>
			<td  align="right"><strong><?php echo __('Total');?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalAmount);?></strong></td>
			<td><strong><?php echo$currency.$this->Number->format($totalTaxAmount);?></strong></td>
			<td colspan="7"><strong><?php echo$currency.$this->Number->format($totalPayment);?></strong></td>
			</tr>
                        </table>
                </div>
        </div>
<?php echo$this->Form->input('dealId',array('type'=>'hidden','name'=>'dealId','value'=>$dealId));?>
<?php echo $this->Form->end();?>
</div>
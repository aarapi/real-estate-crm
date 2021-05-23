<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Purchases');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Purchases'));?>
	    <?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Purchase'),array('controller'=>'Purchases','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
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
			    <th><?php echo $this->Paginator->sort('Project.name', __('Agency'), array('direction' => 'desc'));?></th>
			    <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('mobile', __('Mobile'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('property_name', __('Property Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('area', __('Area'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('amount', __('Amount'), array('direction' => 'asc'));?></th>
			    <th><?php echo __('Balance Due');?></th>
			    <th><?php echo __('Status');?></th>
			    <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php $totalAmount=0;$totalBalance=0;
			foreach ($Purchase as $post):
                        $id=$post['Purchase']['id'];if($post['Purchase']['payment']==NULL)$post['Purchase']['payment']=0;
			$balanceDue=$post['Purchase']['amount']-$post['Purchase']['payment'];
			$totalAmount=$totalAmount+$post['Purchase']['amount'];$totalBalance=$totalBalance+$balanceDue;
			if($balanceDue<=0)
			$status="Paid";
			else
			$status="Partial";
			?>
                        <tr>
			    <td class="pbutton"><?php echo $this->Form->checkbox(false,array('value' => $post['Purchase']['id'],'name'=>'data[Purchase][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php echo h($post['Purchase']['name']);?></td>
			    <td><?php echo h($post['Project']['name']);?></td>
			    <td><?php echo h($post['Purchase']['mobile']);?></td>
			    <td><?php echo h($post['Purchase']['property_name']);?></td>
			    <td><?php echo h($post['Purchase']['area']).' '.h($post['Unit']['name']);?></td>
                            <td><?php echo $currency.$this->Number->format($post['Purchase']['amount']);?></td>
			    <td><?php echo $currency.$this->Number->format($balanceDue);?></td>
			    <td><span class="label label-<?php if($status=="Paid")echo"success";else echo"danger";?>"><?php echo __($status);?></span></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <?php if($status!="Paid"){?><li><?php echo $this->Html->link('<span class="fa fa-dollar"></span>&nbsp;'.__('Make Payment'),array('controller'=>'purchases_payments','action'=>'add',$id),array('escape'=>false));?></li><?php }?>
			    <li><?php echo $this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;'.__('Show Payment'),array('controller'=>'purchases_payments','action'=>'index',$id),array('escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
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
			<td><strong><?php echo$currency.$this->Number->format($totalAmount);?></strong></td>
			<td colspan="3"><strong><?php echo$currency.$this->Number->format($totalBalance);?></strong></td>
		    </tr>    
		    </table>
                </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
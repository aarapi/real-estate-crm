<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Agent Wallet History');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <?php if($userType!='AGT'){?>
	<div class="btn-group">
            <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back'),array('controller'=>'Agents','action'=>'index'),array('escape'=>false,'class'=>'btn btn-info'));?>
        </div>
	<?php }?>
	
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
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('Agent.name', __('Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('amount', __('Amount'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('type', __('Type'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('date', __('Date & Time'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Remarks', __('Remarks'), array('direction' => 'asc'));?></th>
			    <th><?php echo __('Show Payment');?></th>
                        </tr>
                        <?php 
			foreach ($record as $post):
                        $id=$post['AwalletHistory']['id'];
			$url=$this->Html->url(array('controller'=>'awallet_histories','action'=>'view',$post['AwalletHistory']['deals_payment_id']));?>
                        <tr>
                            <td><?php echo $serialNo++; ?></td>
                            <td><?php echo h($post['User']['name']);?></td>
			    <td><?php echo $currency.$this->Number->format($post['AwalletHistory']['amount']);?></td>
			    <td><?php echo h($post['AwalletHistory']['type']);?></td>
			    <td><?php echo $this->Time->Format('d-m-Y h:i:s A',$post['AwalletHistory']['date']);?></td>
			    <td><?php echo eval('return "' . addslashes($post['AwalletHistory']['remarks']) . '";');?></td>
			    <td><?php if($post['AwalletHistory']['deals_payment_id']){ echo $this->Html->link('Show Payment','javascript:void(0);',array('onclick'=>"show_modal('$url');",'escape'=>false));}?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
			<?php if($aWallet){?>
			<tr>
				<th><?php echo __('Total Credit');?></th>
				<th><?php echo __('Total Debit');?> </th>				
				<th colspan="5"><?php echo __('Balance');?></th>
			</tr>
			<tr>
				<th><?php echo$currency.$this->Number->format($aWallet['Awallet']['credit']);?></th>
				<th><?php echo$currency.$this->Number->format($aWallet['Awallet']['debit']);?></th>
				<th colspan="5"><?php echo$currency.$this->Number->format($aWallet['Awallet']['balance']);?></th>
			</tr>
			<?php }?>
                        </table>
                </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Plans Payments');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'plans_payments')); if(!$Plan)echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add  Payments'),array('controller'=>'plans_payments','action'=>'add',$id),array('escape'=>false,'escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"editallplan();",'escape'=>false,'class'=>'btn btn-warning'));?>
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Deal'),array('controller' => 'Deals','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
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
		    <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
		    <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
		    <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('amount', __('Amount'), array('direction' => 'asc'));?></th>
		    <th><?php echo $this->Paginator->sort('date', __('Due Date'), array('direction' => 'asc'));?></th>
		</tr>
		<?php $totalAmount=0;
		foreach ($Plan as $post):
		$id=$post['PlansPayment']['id'];$totalAmount=$totalAmount+$post['PlansPayment']['amount'];
		?>
		<tr>
		    <td><?php echo $this->Form->checkbox(false,array('value' => $post['PlansPayment']['id'],'name'=>'data[PlansPayment][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
		    <td><?php echo $serialNo++; ?></td>
		    <td><?php echo h($post['PlansPayment']['name']);?></td>
		    <td><?php echo $currency.$this->Number->format($post['PlansPayment']['amount']);?></td>
		    <td><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,h($post['PlansPayment']['date']));?></td>		   
		</tr>
		<?php endforeach; ?>
		<?php unset($post);?>
	    </table>
	   </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
<script type="text/javascript">
    function editallplan()
    {
	$(document).ready(function(){
	$('.chkselect').prop('checked',true);});
	check_perform_edit('<?php echo$url;?>');
    }
</script>
<style>
    .chkselect{display:none;}
    #selectAll{display: none;}
</style>
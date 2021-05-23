<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Search History');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
	<?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
        </div>
    </div>
        <?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
	<?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<?php echo $this->Session->flash();?>
    <div class="panel-body">
			</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
			    <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', __('Search Keywords'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('link', __('Link'), array('direction' => 'asc'));?></th>
			    <th><?php echo __('Action');?></th>
                        </tr>
                        <?php foreach ($Searchhistory as $post):
                        $id=$post['Searchhistory']['id'];$ab=json_decode($post['Searchhistory']['name']);?>
                        <tr>
			    <td><?php echo $this->Form->checkbox(false,array('value' => $post['Searchhistory']['id'],'name'=>'data[Searchhistory][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serialNo++;?></td>
			    <td><?php $message=""; foreach($ab as $name):
					    foreach($name as $key=>$value):
					     if($key=='type') {
						 $message.=__('Type').' = '.$value.','.'<br>';
					     }
					     if($key=='contract') {
						 $message.=__('Contract').' = '.$value.','.'<br>';
					     }
					     if($key=='location') {
						 $message.=__('Location').' = '.$value.','.'<br>';
					     }
					     if($key=='keyword') {
						 $message.=__('Keyword').' = '.$value.','.'<br>';
					     }
					     if($key=='start_price') {
						 $message.=__('Start Price').' = '.$value.', ';
					     }
					     if($key=='end_price') {
						 $message.=__('End Price').' = '.$value.','.'<br>';
					     }
					     if($key=='bedroom') {
						 $message.=__('Bedroom').' = '.$value.','.'<br>';
					     }
					     if($key=='bathroom') {
						 $message.=__('Bathroom').' = '.$value.','.'<br>';
					     }
					     if($key=='uniq_id') {
						 $message.=__('Property ID').' = '.$value.','.'<br>';
					     }
					     if($key=='agent') {
						 $message.=__('Agent').' = '.$value.','.'<br>';
					     }
					     if($key=='agency') {
						 $message.=__('Agency').' = '.$value.','.'<br>';
					     }
					    endforeach;
					   endforeach; echo$message; unset($message);?></td>
                            <td><?php if($post['Searchhistory']['search']) {?><a href="<?php echo$siteDomain.'/Properties/index/'.$post['Searchhistory']['link'];?>history:1" target="_blank">
			    <?php echo __('Click here to view result');?></a><?php } else { echo __('No result found');}?></td>
			    <td><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false,'class'=>'btn btn-danger'));?></td>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
                        </table>
                </div>
		<?php echo $this->Form->end();?>
<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>
</div>
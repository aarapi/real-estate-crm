<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Status');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Statuses'));?>
	    <?php echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Status'),array('controller'=>'Statuses','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
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
                    <table  class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                        <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                        <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
                        <th><?php echo $this->Paginator->sort('color', __('Color'), array('direction' => 'asc'));?></th>
                        <th><?php echo __('Action');?></th>
                      </tr>
                    </thead>
                    <tbody >
                      <?php foreach ($posts as $post):
                    $id=$post['Status']['id'];?>
                    <tr>
                        <td><?php echo $this->Form->checkbox(false,array('value' => $post['Status']['id'],'name'=>'data[Status][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                        <td><?php echo $serialNo++;?></td>
                        <td><?php echo $post['Status']['name']; ?></td>
                        <td style="background-color: <?php echo $post['Status']['color'];?>">&nbsp;</td>

                        <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
			     <?php if($post['Status']['type']==null){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
			    </ul>
			  </div></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php unset($post);?>
                   </tbody>
                  </table>
                </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Level users');?></h1></div></div>
<div class="panel">

    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Users','action'=>'assignrightsedit'));
            $url1=str_replace("/assignrights","",$this->Html->url(array('controller'=>'Users'))); echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Level'),array('controller'=>'Users','action'=>'leveladd'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
            <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Users'),array('controller' => 'Users','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
        </div>
    </div>
    <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deletelevel'));?>
	 <div class="panel-body"><?php echo $this->Session->flash();?>		
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo __('Level Name');?></th>
                            <th><?php echo __('Action');?></th>
                        </tr>
                        <?php foreach ($Ugroup as $k=>$post):
                        $id=$post['Ugroup']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Ugroup']['id'],'name'=>'data[Ugroup][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo h($post['Ugroup']['name']); ?></td>
                            <td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?><span class="caret"></span>&nbsp;
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Set Permission'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"show_modal('$url/$id');",'escape'=>false));?></li>
                            <?php if($post['Ugroup']['type']==NULL){?><li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li><?php }?>
			    </ul>
			    </div></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        </div>
	<?php echo $this->Form->end();?>
    </div>

<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Property Photo');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
	    <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Property'),array('controller' => 'Properties','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
            <?php $url=$this->Html->url(array('controller'=>'properties_photos')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Photo'),'#',array('name'=>'add','id'=>'add','onclick'=>"check_perform_add('$url/add/$propertyId');",'escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
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
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo __('#');?></th>
			    <th><?php echo __('Photo');?></th>
			    <th><?php echo __('Show on Front');?></th>
                            <th><?php echo __('Action');?></th>
                        </tr>
                        <?php $serial_no=1; foreach ($PropertiesPhoto as $post):
                        $id=$post['PropertiesPhoto']['id'];$propertyId=$post['PropertiesPhoto']['property_id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['PropertiesPhoto']['id'],'name'=>'data[PropertiesPhoto][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $this->Html->image($post['PropertiesPhoto']['dir'].'_thumb/'.$post['PropertiesPhoto']['photo'],array('class'=>'img-thumbnail')); ?></td>
                            <td><?php if($post['PropertiesPhoto']['home']=="Yes"){ echo $this->Html->link('<span class="fa fa-check"></span>&nbsp;'.__('Yes'),array('controller'=>'properties_photos','action'=>'published',$id,$propertyId,'Yes'),array('escape'=>false,'class'=>'btn btn-success'));}
			    else{echo $this->Html->link('<span class="fa fa-times-circle"></span>&nbsp;'.__('No'),array('controller'=>'properties_photos','action'=>'published',$id,$propertyId,'No'),array('escape'=>false,'class'=>'btn btn-danger'));}?>
			    <td><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false,'class'=>'btn btn-primary'));?>
			    <?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'class'=>'btn btn-danger','escape'=>false));?></td>                            
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        </div>
	<?php echo$this->Form->input('propertyId',array('type'=>'hidden','name'=>'propertyId','value'=>$propertyId));?>
<?php echo $this->Form->end();?>
</div>
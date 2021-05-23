<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Contacts');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
	<?php $url=$this->Html->url(array('controller'=>'Contacts'));
	echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Contact'),array('controller'=>'Contacts','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
	<?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
	<?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
	<?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print'),'#',array('id'=>'printme','escape'=>false,'class'=>'btn btn-default'));?>
    </div>
    <?php echo $this->Form->create(array('name'=>'searchfrm','id'=>'searchfrm','action' => 'index'));?>
<div class="row">
	<div class="col-sm-2 mrg"><strong><?php echo __('Category');?></strong>
	  <?php echo $this->Form->select('cid',$category,array('label' => false,'class'=>'form-control','empty'=>__('All'),'div'=>false));?>
	</div>
	<div class="col-sm-3 mrg"><strong><?php echo __('Name');?></strong>
	  <?php echo $this->Form->input('cname',array('label' => false,'class'=>'form-control','placeholder'=>__('Contact Name'),'div'=>false));?>
	</div>  
	<div class="col-sm-1 mrg">&nbsp;
	  <button class="btn btn-default" type="submit"><i class="fa fa-search"></i><?php echo ' '.__('Search');?></button>
	</div>
</div>
<?php echo $this->Form->end();?>
    </div>
        <?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $pageParams = $this->Paginator->params();
        $limit = $pageParams['limit'];
        $page = $pageParams['page'];
        $serialNo = 1*$limit*($page-1)+1;?>
        
<?php echo $this->Session->flash();?>
<?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<div id="printable_content">
<?php echo $this->Html->css('print');?>
		<div class="panel-body">
		</div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('mobile', __('Contact Number'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('email', __('Email'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('district', __('District'), array('direction' => 'asc'));?></th>
                            <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php foreach ($Contact as $post):
                        $id=$post['Contact']['id'];?>
                        <tr>
                            <td class="pbutton"><?php if($userType!="AGT" || $post['Contact']['user_id']==$luserId){ echo $this->Form->checkbox(false,array('value' => $post['Contact']['id'],'name'=>'data[Contact][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect')); } else echo "&nbsp;";?></td>
                            <td><?php echo $serialNo++;?></td>
                            <td><?php echo h($post['Contact']['name']);?></td>
			    <td><?php echo h($post['Contact']['mobile']);?></td>
			    <td><?php echo h($post['Contact']['email']);?></td>
			    <td><?php echo h($post['Contact']['district']);?></td>
                            <td class="pbutton"><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action').' ';?><span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'#',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print'),array('controller'=>'Contacts','action'=>'printclient',$id),array('target'=>'_blank','escape'=>false));?></li>
			    <?php if($userType!="AGT" || $post['Contact']['user_id']==$luserId){?>
			    <li><?php echo $this->Html->link('<span class="fa fa-cog"></span>&nbsp;'.__('Change Password'),'#',array('onclick'=>"show_modal('$url/changepass/$id');",'escape'=>false));?></li>
			    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'#',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'#',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    <?php }?>
			    </ul>
			  </div></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>
</div>
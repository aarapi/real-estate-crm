<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Properties');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    <div class="panel-heading">
        <div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Properties')); echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add New Property'),array('controller'=>'Properties','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_editfull('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
		</div>
    </div>
       <?php echo $this->Form->create(array('name'=>'searchfrm','id'=>'searchfrmactive','action' => 'index'));?>
      <div class="row">
	      <div class="col-sm-12 mrg">
	      <div class="col-sm-6"><label><strong><?php echo __('General Search');?></strong></label>
		     <?php echo $this->Form->input('general',array('label' => false,'class'=>'form-control','placeholder'=> __('Search Title, directions, ID etc.'),'div'=>false));?>
	      </div>
	      <div class="col-sm-6"><label><strong><?php echo __('Location');?></strong></label>
		<?php echo $this->Form->input('location',array('label' => false,'class'=>'form-control','placeholder'=> __('Write a colony, city or state.'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-3"><label><strong><?php echo __('Kind of property');?></strong></label>
		<?php echo $this->Form->select('type',$type,array('label' => false,'class'=>'form-control','empty'=>'Select','placeholder'=>__('All'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-3"><label><strong><?php echo __('Contract');?></strong></label>
		<?php echo $this->Form->select('contract',$contract,array('label' => false,'class'=>'form-control','empty'=>'Select','placeholder'=>__('All'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-3"><label><strong><?php echo __('Minimum price');?></strong></label>
		<?php echo $this->Form->input('start_price',array('label' => false,'class'=>'form-control','placeholder'=> __('Minimum price'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-3"><label><strong><?php echo __('Maximum price');?></strong></label>
		<?php echo $this->Form->input('end_price',array('label' => false,'class'=>'form-control','placeholder'=> __('Maximum price'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-2"><label><strong><?php echo __('Bedroom');?></strong></label>
		<?php echo $this->Form->input('bedroom',array('label' => false,'class'=>'form-control','placeholder'=> __('Bedroom +'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-2"><label><strong><?php echo __('Bathroom');?></strong></label>
		<?php echo $this->Form->input('bathroom',array('label' => false,'class'=>'form-control','placeholder'=> __('Bathroom +'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-2"><label><strong><?php echo __('Area');?></strong></label>
		<?php echo $this->Form->input('Area',array('label' => false,'class'=>'form-control','placeholder'=> __('Area +'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-2"><label><strong><?php echo __('Published');?></strong></label>
		<?php $sex=array('Yes'=>'Yes','No'=>'No');
		echo $this->Form->select('publish',$sex,array('label' => false,'class'=>'form-control','empty'=>'Select','placeholder'=>__('All'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-2"><label><strong><?php echo __('Status');?></strong></label>
		<?php $status=array(__('Available')=>__('Available'),__('Sold')=>__('Sold'));
		echo $this->Form->select('skeyword',$status,array('label' => false,'class'=>'form-control','empty'=>'Select','placeholder'=>__('All'),'div'=>false));?>
	      </div> 
	      <div class="col-sm-1">&nbsp;
			<?php echo $this->Form->input('searchfrm',array('type'=>'hidden','value'=>'active'));?>
			<?php echo $this->Form->button('<span class="fa fa-search"></span>&nbsp;'.__('Search'),array('class'=>'btn btn-info','escape'=>false));?>
	      </div>              
	      </div>
       </div>
<?php echo$this->Form->end();?>
<?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<?php echo $this->Session->flash();?>
<div class="panel-body">
			</div>
               <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th class="pbutton"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
			    <th><?php echo $this->Paginator->sort('uniq_id', __('Office ID'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('type', __('Type'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('Contract.name', __('Contract'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('status', __('Status'), array('direction' => 'asc'));?></th>
                            <th><?php echo __('Featured/Published');?></th>
			    <th class="pbutton"><?php echo __('Action');?></th>
                        </tr>
                        <?php foreach ($Property as $post):
                        $id=$post['Property']['id'];?>
                        <tr>
                            <td class="pbutton"><?php if($userType!="AGT" || $post['Property']['user_id']==$luserId){ echo $this->Form->checkbox(false,array('value' => $post['Property']['id'],'name'=>'data[Property][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect')); } else echo "&nbsp;";?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $post['Property']['uniq_id'];?></td>
			    <td><?php echo $post['Property']['name'];?></td>
			    <td><?php echo $post['Type']['name'];?></td>
			    <td><?php echo $post['Contract']['name'];?></td>
			    <td><span class="label label-<?php if($post['Property']['status']=="Available")echo"success";else echo"danger";?>"><?php echo __($post['Property']['status']);?></span></td>
			    <td><?php if($userType!="AGT" || $post['Property']['user_id']==$luserId){ if($post['Property']['featured']=="Yes"){ echo $this->Html->link('<span class="fa fa-check"></span>&nbsp;'.__('Yes'),array('controller'=>'Properties','action'=>'featured',$id,'Yes'),array('escape'=>false,'class'=>'btn btn-success'));}
			    else{echo $this->Html->link('<span class="fa fa-times-circle"></span>&nbsp;'.__('No'),array('controller'=>'Properties','action'=>'featured',$id,'No'),array('escape'=>false,'class'=>'btn btn-danger'));}?>
			    <?php if($post['Property']['published']=="Yes"){ echo $this->Html->link('<span class="fa fa-check"></span>&nbsp;'.__('Yes'),array('controller'=>'Properties','action'=>'published',$id,'Yes'),array('escape'=>false,'class'=>'btn btn-success'));}
			    else{echo $this->Html->link('<span class="fa fa-times-circle"></span>&nbsp;'.__('No'),array('controller'=>'Properties','action'=>'published',$id,'No'),array('escape'=>false,'class'=>'btn btn-danger'));}?>
			    <?php }?></td>
			    <td class="pbutton"><?php if($userType=="AGT" && $post['Property']['user_id']!=$luserId){?>
			    <?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;&nbsp;&nbsp;&nbsp;'.__('View'),'javascript:void(0);',array('class'=>'btn','onclick'=>"show_modal('$url/View/$id');",'escape'=>false));}
			    else {?>
			    <div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			      <li><?php echo $this->Html->link('<span class="fa fa-image"></span>&nbsp;'.__('Photos'),array('controller'=>'properties_photos','action'=>"index/$id"),array('escape'=>false));?></li>
			      <li><?php echo $this->Html->link('<span class="fa fa-file"></span>&nbsp;'.__('Documents'),array('controller'=>'properties_documents','action'=>"index/$id"),array('escape'=>false));?></li>
			      <li><?php echo $this->Html->link('<span class="fa fa-building-o fa-fw"></span>&nbsp;'.__('Floor Plans'),array('controller'=>'properties_floorplans','action'=>"index/$id"),array('escape'=>false));?></li>
			      <li class="divider"></li>
			      <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape'=>false));?></li>
			      <li> <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_editPage('$url','$id');",'escape'=>false));?></li>
			      <li> <?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    </ul>
			  </div><?php }?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
            </div>
</div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>
</div>
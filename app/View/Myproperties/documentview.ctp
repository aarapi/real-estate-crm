<div class="container">
    <div class="row">
    <?php echo $this->Session->flash();
    $url=$this->Html->url(array('controller'=>'Myproperties','action'=>'document'));?>
	<div class="col-md-12">    
	    <div class="panel panel-default mrg">
		<div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><?php echo __('Property');?> <span><?php echo __('Document');?></span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
		<div class="panel-body">
		    <div><?php echo $this->Html->link('<span class="fa fa-file"></span>&nbsp;'.__('Back To Documents'),'#',array('onclick'=>"show_modal('$url/$id');",'class'=>'btn btn-info','escape'=>false));?></div>
			<div><?php echo $this->Html->image($photoImg,array('class'=>'img-thumbnail')); ?></div>
	    </div>
	</div>
    </div>
</div>

<div  class="container">
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Property');?> <span><?php echo __('Floor Plan');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <div class="table-responsive">
			<?php echo $this->Html->image($photoImg,array('class'=>'img-thumbnail')); ?>
		</div>
        </div>
    </div>
</div>
<?php echo $this->Session->flash();?>
<div class="container">
    <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default mrg">
           <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title"><?php echo __('Property');?> <span><?php echo __('Documents');?></span></strong></h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div></div>            
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo __('#');?></th>
			    <th><?php echo __('Photo');?></th>
                            <th>Action</th>
                        </tr>
                        <?php $serial_no=1;$url=$this->Html->url(array('controller'=>'Myproperties','action'=>'documentview'));
			foreach ($PropertiesDocument as $post):
                        $id=$post['PropertiesDocument']['id'];?>
                        <tr>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo $this->Html->image($post['PropertiesDocument']['dir'].'_thumb/'.$post['PropertiesDocument']['photo'],array('class'=>'img-thumbnail')); ?></td>
                            <td><?php echo $this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;View','#',array('onclick'=>"show_modal('$url/$id');",'escape'=>false,'class'=>'btn btn-primary'));?>			    
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>
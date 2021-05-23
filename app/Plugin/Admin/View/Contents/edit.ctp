<div <?php if(!$isError){?>class="container"<?php }?>>    
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Pages');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
<div class="panel">
     <div class="panel-body"><?php echo $this->Session->flash();?>
					<?php echo $this->Form->create('Content', array( 'controller' => 'Contents','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Content as $k=>$post): $id=$post['Content']['id'];$form_no=$k+1;?>
					<script type="text/javascript">
					$(document).ready(function(){
					    <?php if($post['Content']['is_url']=="External"){?>
					    $('#pgurl<?php echo$k;?>').hide();<?php }else{?>
					    $('#pgurl1<?php echo$k;?>').hide();<?php }?>
					    $( "#<?php echo$k;?>ContentIsUrlInternal" ).click(function() {
					    $('#pgurl<?php echo$k;?>').show();
					    $('#pgurl1<?php echo$k;?>').hide();
					    });
					    $( "#<?php echo$k;?>ContentIsUrlExternal" ).click(function() {
					    $('#pgurl<?php echo$k;?>').hide();
					    $('#pgurl1<?php echo$k;?>').show();
					    });
					    $( "#<?php echo$k;?>ContentLinkName").blur(function() {
						var link_name=$('#<?php echo$k;?>ContentLinkName').val();
						var link_url=escapeRegExp(link_name);
					    $('#<?php echo$k;?>ContentPageUrl').val(link_url);
					    });
					      });
				    </script>
						<div class="panel panel-default">
							<div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
							<div class="panel-body"><?php echo $this->Session->flash();?>
								<div class="form-group">
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Link Name');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.Content.link_name",array('label' => false,'class'=>'form-control','placeholder'=>__('Link Name'),'div'=>false));?>
									</div>
									<label for="group_name" class="col-sm-2 control-label"><?php echo __('Link Order');?></label>
									<div class="col-sm-4">
									   <?php echo $this->Form->input("$k.Content.ordering",array('label' => false,'class'=>'form-control','placeholder'=>__('Link Order'),'div'=>false));?>
									</div>
								</div>
								 <div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Page Type');?></small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.is_url",array('type'=>'radio','options'=>array("Internal"=>__('Internal'),"External"=>__('External')),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Icon');?></small></label>
								    <div class="col-sm-4">
									<?php echo $this->Form->input("$k.Content.page_icon",array('label' => false,'class'=>'form-control','placeholder'=>__('Icon'),'div'=>false));?>
								    </div>
								</div>
								 <div class="form-group" id="pgurl1<?php echo$k;?>">
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('External Url');?></small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.url",array('label' => false,'class'=>'form-control','placeholder'=>__('External Url'),'div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Url Target');?></small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.url_target",array('type'=>'radio','options'=>array("_self"=>__('_self'),"_blank"=>__('_blank')),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
								    </div>
								</div>
								<div id="pgurl<?php echo$k;?>">
								 <div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Page Type');?></small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.page_name",array('label' => false,'class'=>'form-control','placeholder'=>__('Page Type'),'div'=>false));?>
								    </div>
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Page Url');?></small></label>
								    <div class="col-sm-4">
								       <?php echo $this->Form->input("$k.Content.page_url",array('label' => false,'class'=>'form-control','placeholder'=>__('Page Url'),'div'=>false));?>
								    </div>
								</div>
								<div class="form-group">
								    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Page Content');?></small></label>
								    <div class="col-sm-10">
								       <?php echo $this->Tinymce->input("$k.Content.main_content", array('class'=>'form-control','label' => false,'placeholder'=>__('Page Content')),array('language'=>$configLanguage,'directionality'=>$dirType),'full');?>
								    </div>
								</div>
								</div>
								<div class="form-group text-left">
									<div class="col-sm-offset-3 col-sm-7">
										<?php echo $this->Form->input("$k.Content.id", array('type' => 'hidden'));?>                            
									</div>
								</div>
							</div>	
						</div>					
                    <?php endforeach; ?>
                        <?php unset($post); ?>
    
                        <div class="form-group text-left">
		<div class="col-sm-offset-2 col-sm-5">
		    <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			    echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
	</div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
	    
    </div>
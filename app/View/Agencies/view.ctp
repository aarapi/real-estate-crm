<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
					<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Agency Details');?></h1>
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container"><?php echo $this->Session->flash();?>
	<div class="row">
		<div class="listing-detail col-md-8 col-lg-9">
			<div class="listing-user">
				<div class="listing-user-image">
				<?php $photoUrl=$this->Html->url(array('controller'=>'img'));
				    if($Agency['User']['photo']==null){$urlPhoto=$photoUrl.'/nia.png';}else{$urlPhoto=$photoUrl.'/user_thumb/'.$Agency['User']['photo'];}?>
				     <a href="#" style="background-image: url(<?php echo $urlPhoto;?>)"></a>
				</div><!-- /.listing-user-image -->

				<div class="listing-user-title">
					<h2><?php if($Agency['User']['name']){echo $Agency['User']['name'];}else{echo __('Not Specified');}?></h2>
				</div><!-- /.listing-user-title -->

				<div class="listing-user-social">
					<ul>
						<?php if($Agency['User']['facebook']){?>
						<li><?php echo$this->html->link('<i class="fa fa-facebook"></i>','http://www.facebook.com/'.$Agency['User']['facebook'],array('escape'=>false,'target'=>'_blank'));?></li>
						<?php }?>
						<?php if($Agency['User']['twitter']){?>
						<li><?php echo$this->html->link('<i class="fa fa-twitter"></i>','http://www.twitter.com/'.$Agency['User']['twitter'],array('escape'=>false,'target'=>'_blank'));?></li>
						<?php }?>
						<?php if($Agency['User']['skype']){?>
						<li><?php echo$this->html->link('<i class="fa fa-skype"></i>','http://www.linkedin.in/'.$Agency['User']['skype'],array('escape'=>false,'target'=>'_blank'));?></li>
						<?php }?>
					</ul><!-- /.listing-row-social -->				
				</div><!-- /.listing-user-social -->
			</div><!-- /.listing-user -->

			<div class="row">
				<div class="col-lg-5">
			        <div class="overview">
			            <h2><?php echo __('Information');?></h2>

			            <ul>
			            	<li><strong><?php echo __('Name');?></strong><span><?php if($Agency['User']['name']){echo $Agency['User']['name'];}else{echo __('Not Specified');}?></span></li>
			                <li><strong><?php echo __('Address');?></strong><span><?php if($Agency['User']['address']){echo $Agency['User']['address'];}else{echo __('Not Specified');}?></span></li>
			                <li><strong><?php echo __('Location');?></strong><span><?php if($Agency['Location']['name']){echo $Agency['Location']['name'];}else{echo __('Not Specified');}?></span></li>
			                <li><strong><?php echo __('Phone');?></strong><span><?php if($Agency['User']['phone']){echo $Agency['User']['phone'];}else{echo __('Not Specified');}?></span></li>
			                <li><strong><?php echo __('Mobile');?></strong><span><?php if($Agency['User']['mobile']){echo $Agency['User']['mobile'];}else{echo __('Not Specified');}?></span></li>
			                <li><strong><?php echo __('E-mail');?></strong><span><?php if($Agency['User']['email']){echo $Agency['User']['email'];}else{echo __('Not Specified');}?></span></li>
					<li><strong><?php echo __('Skype');?></strong><span><?php if($Agency['User']['skype']){echo $Agency['User']['skype'];}else{echo __('Not Specified');}?></span></li>
			            </ul>
			        </div><!-- /.overview -->				
				</div><!-- col-* -->

				<div class="col-lg-7">
					<h2><?php echo __('About Agency');?></h2>

					<p>
						<?php if($Agency['User']['description']){echo $Agency['User']['description'];}else{echo __(__('Not Specified'));}?> 
					</p>
				</div><!-- /.col-* -->
			</div><!-- /.row -->

			<h2><?php echo __('Contact Agency');?></h2>

			<div class="listing-contact-form">
				<div class="row">
					<?php echo $this->Form->create('Agency', array( 'controller' => 'Agencies', 'action' => 'mail/'.$Agency['User']['id'],'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
						<div class="col-sm-5">
							 <div class="form-group">
							    <label><?php echo __('Name');?></label>
							    <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','required'=>true,'div'=>false));?>
							</div><!-- /.form-group -->
						
							<div class="form-group">
							    <label><?php echo __('E-mail');?></label>
							    <?php echo $this->Form->input('email',array('type'=>'email','label' => false,'class'=>'form-control','required'=>true,'div'=>false));?>
							</div><!-- /.form-group -->
						
							<div class="form-group">
							    <label><?php echo __('Phone Number');?></label>
							    <?php echo $this->Form->input('phone',array('type'=>'number','label' => false,'class'=>'form-control','required'=>true,'div'=>false));?>
							</div><!-- /.form-group -->
						
							<div class="form-group">
							    <label><?php echo __('Subject');?></label>
							    <?php echo $this->Form->input('subject',array('label' => false,'class'=>'form-control','required'=>true,'div'=>false));?>
							</div><!-- /.form-group -->    																
						</div><!-- /.col-* -->
						<div class="col-sm-1">
							    
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label><?php echo __('Message');?></label>
								<?php echo $this->Form->input('message',array('placeholder'=>__('Please keep your message as simple as possible.'),'label' => false,'cols'=>25,'class'=>'form-control','required'=>true,'div'=>false));?>
							</div><!-- /.form-group -->
						</div><!-- /.col-* -->

						<div class="col-sm-12">
							<div class="form-group-btn">
								<?php echo$this->Form->button(__('Send Message'),array('class'=>'btn btn-primary pull-right','escpae'=>false));?>
							</div><!-- /.form-group-btn -->
						</div><!-- /.col-* -->					
					<?php echo$this->Form->end();?>
				</div><!-- /.row -->
			</div><!-- /.listing-contact-form -->

			<?php echo$this->html->link("<h2>".__('Agency Assigned Properties')."</h2> ",array('controller'=>'Properties','action'=>'index','agency:'.$Agency['Agency']['id']),array('escape'=>false));?>
			
		</div><!-- /.col-* -->

		<div class="col-md-4 col-lg-3">
			<div class="widget">
	<h3 class="widgettitle"><?php echo __('Recent Properties');?></h3>
<?php foreach($allProperty as $post):$id=$post['Property']['id'];
$photoUrl=$this->Html->url(array('controller'=>'img'));
        $id=$post['Property']['id'];
        $photo=$photoUrl.'/nia.png';
        if(is_array($post['PropertiesPhoto']))
        {
                foreach($post['PropertiesPhoto'] as $photoArr):$iphoto=0;
                if($photoArr['home']=='Yes')
                {
                        $iphoto++;
                        $photo=$photoUrl."/".$photoArr['dir'].'_thumb/'.$photoArr['photo'];
                        break;
                }
                if($iphoto==0)
                $photo=$photoUrl."/".$photoArr['dir'].'_thumb/'.$photoArr['photo'];
                endforeach;
        }
	?>	
		<div class="listing-small">
	<div class="listing-small-inner">
		<div class="listing-small-image">
			<?php echo$this->Html->link(NULL,array('controller'=>'Properties','action'=>'view',$id),array('style'=>"background-image: url('$photo')"));?>
		</div><!-- /.listing-small-image -->

		<div class="listing-small-content">
			<h3><?php echo$this->Html->link($post['Property']['name'],array('controller'=>'Properties','action'=>'view',$id));?></h3>
			<h4><?php echo$currency.$this->Number->format($post['Property']['price']);?></h4>
		</div><!-- /.listing-small-content -->
	</div><!-- /.listing-small-inner -->
</div><!-- /.listing-small -->
	<?php endforeach;unset($post);?>
			
</div><!-- /.widget -->	
		</div><!-- /.col-* -->
	</div><!-- /.row -->
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->

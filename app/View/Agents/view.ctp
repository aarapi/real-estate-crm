<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
					<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Agent Details');?></h1>
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
				    if($agent['User']['photo']==null){$urlPhoto=$photoUrl.'/user-icon.png';}else{$urlPhoto=$photoUrl.'/user_thumb/'.$agent['User']['photo'];}?>
				     <a href="#" style="background-image: url(<?php echo $urlPhoto;?>)"></a>
				</div><!-- /.listing-user-image -->

				<div class="listing-user-title">
					<h2><?php if($agent['User']['name']){echo $agent['User']['name'];}else{echo 'Not Specified';}?></h2>
				</div><!-- /.listing-user-title -->

				<div class="listing-user-social">
					<ul>
						<?php if($agent['User']['facebook']){?>
						<li><?php echo$this->html->link('<i class="fa fa-facebook"></i>','http://www.facebook.com/'.$agent['User']['facebook'],array('escape'=>false,'target'=>'_blank'));?></li>
						<?php }?>
						<?php if($agent['User']['twitter']){?>
						<li><?php echo$this->html->link('<i class="fa fa-twitter"></i>','http://www.twitter.com/'.$agent['User']['twitter'],array('escape'=>false,'target'=>'_blank'));?></li>
						<?php }?>
						<?php if($agent['User']['linkedin']){?>
						<li><?php echo$this->html->link('<i class="fa fa-linkedin"></i>','http://www.linkedin.in/'.$agent['User']['linkedin'],array('escape'=>false,'target'=>'_blank'));?></li>
						<?php }?>
					</ul><!-- /.listing-row-social -->				
				</div><!-- /.listing-user-social -->
			</div><!-- /.listing-user -->

			<div class="row">
				<div class="col-lg-5">
			        <div class="overview">
			            <h2><?php echo __('Information');?></h2>

			            <ul>
			            	<li><strong><?php echo __('Name');?></strong><span><?php if($agent['User']['name']){echo $agent['User']['name'];}else{echo 'Not Specified';}?></span></li>
			                <li><strong><?php echo __('Address');?></strong><span><?php if($agent['User']['address']){echo $agent['User']['address'];}else{echo 'Not Specified';}?></span></li>
			                <li><strong><?php echo __('Phone');?></strong><span><?php if($agent['User']['phone']){echo $agent['User']['phone'];}else{echo 'Not Specified';}?></span></li>
			                <li><strong><?php echo __('Mobile');?></strong><span><?php if($agent['User']['mobile']){echo $agent['User']['mobile'];}else{echo 'Not Specified';}?></span></li>
			                <li><strong><?php echo __('E-mail');?></strong><span><?php if($agent['User']['email']){echo $agent['User']['email'];}else{echo 'Not Specified';}?></span></li>
					<li><strong><?php echo __('Skype');?></strong><span><?php if($agent['User']['skype']){echo $agent['User']['skype'];}else{echo 'Not Specified';}?></span></li>
			            </ul>
			        </div><!-- /.overview -->				
				</div><!-- col-* -->

				<div class="col-lg-7">
					<h2><?php echo __('About Agent');?></h2>

					<p>
						<?php if($agent['User']['description']){echo $agent['User']['description'];}else{echo 'Not Specified';}?> 
					</p>
				</div><!-- /.col-* -->
			</div><!-- /.row -->

			<h2><?php echo __('Contact Agent');?></h2>

			
			<div class="listing-contact-form">
				<div class="row">
					<?php echo $this->Form->create('Agent', array( 'controller' => 'Agents', 'action' => 'mail/'.$agent['User']['id'],'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
						<div class="col-sm-5">
							<div class="form-group">
								<label><?php echo __('Name');?></label>
								<input type="text" name="name" class="form-control" required="true">
							</div><!-- /.form-group -->					

							<div class="form-group">
								<label><?php echo __('E-mail');?></label>
								<input type="text" name="email" class="form-control" required="true">
							</div><!-- /.form-group -->											

							<div class="form-group">
								<label><?php echo __('Subject');?></label>
								<input type="text" name="subject" class="form-control" required="true">
							</div><!-- /.form-group -->																	
						</div><!-- /.col-* -->

						<div class="col-sm-7">
							<div class="form-group">
								<label><?php echo __('Message');?></label>
								<textarea class="form-control" rows="10" required="true" name="message" placeholder="<?php echo __('Please keep your message as simple as possible.');?>"></textarea>
							</div><!-- /.form-group -->
						</div><!-- /.col-* -->

						<div class="col-sm-12">
							<div class="form-group-btn">
								<button class="btn btn-primary pull-right"><?php echo __('Send Message');?></button>
							</div><!-- /.form-group-btn -->
						</div><!-- /.col-* -->					
					<?php echo$this->Form->end();?>
				</div><!-- /.row -->
			</div><!-- /.listing-contact-form -->

			<?php echo$this->html->link("<h2>".__('Agent Assigned Properties')."</h2> ",array('controller'=>'Properties','action'=>'index','agent:'.$agent['User']['id']),array('escape'=>false));?>
			
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

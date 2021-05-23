<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
   
   <div class="page-wrapper">
    <div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
					<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Agencies');?></h1>	
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container"><?php echo $this->Session->flash();?>
	<div class="row">
		<div class="col-md-11 col-lg-12">
			<div class="row">
				<?php  foreach($Agency as $post):$id=$post['Agency']['id'];?>
					<div class="col-md-6 col-lg-3">
						<div class="listing-box">
						<?php $photoUrl=$this->Html->url(array('controller'=>'img'));
				    if($post['User']['photo']==null){$urlPhoto=$photoUrl.'/nia.png';}else{$urlPhoto=$photoUrl.'/user_thumb/'.$post['User']['photo'];}?>
				     <div class="listing-box-image" style="background-image: url(<?php echo $urlPhoto;?>)">
	<?php echo$this->html->link('',array('controller'=>'Agencies','action'=>'view',$id),array('escape'=>false,'class'=>'listing-box-image-link'));?>
	</div><!-- /.listing-box-image -->

	<div class="listing-box-title">
		<h2><?php echo$this->html->link($post['User']['name'],array('controller'=>'Agencies','action'=>'view',$id),array('escape'=>false));?></h2>
		</div><!-- /.listing-box-title -->

	<div class="listing-box-content">
			<a href="mailto:<?php echo$post['User']['email'];?>"><i class="fa fa-at"></i> <?php if($post['User']['email']){echo $post['User']['email'];}else{echo __('Not Specified');}?></a><br>
			<a href="#"><i class="fa fa-phone"></i> <?php if($post['User']['phone']){echo $post['User']['phone'];}else{echo __('Not Specified');}?></a><br>
			<a href="#"><i class="fa fa-mobile"></i> <?php if($post['User']['mobile']){echo $post['User']['mobile'];}else{echo __('Not Specified');}?></a>
		</p>

		<ul class="listing-box-social">
	    <?php $isSocial=false;if($post['User']['facebook']){$isSocial=true;?>
	    <li><?php echo$this->html->link('<i class="fa fa-facebook"></i>','http://www.facebook.com/'.$post['User']['facebook'],array('escape'=>false,'target'=>'_blank'));?></li>
	    <?php }?>
	    <?php if($post['User']['twitter']){$isSocial=true;?>
	    <li><?php echo$this->html->link('<i class="fa fa-twitter"></i>','http://www.twitter.com/'.$post['User']['twitter'],array('escape'=>false,'target'=>'_blank'));?></li>
	    <?php }?>
	    <?php if($post['User']['skype']){$isSocial=true;?>
	    <li><?php echo$this->html->link('<i class="fa fa-skype"></i>','http://www.skype.com/'.$post['User']['skype'],array('escape'=>false,'target'=>'_blank'));?></li>
	    <?php }?>
	    <?php if($isSocial==false){?><li><div class="social-space"></div></li><?php }?>
		</ul><!-- /.listing-row-social -->			
	</div><!-- /.listing-box-cotntent -->
</div><!-- /.listing-box -->
					</div><!-- /.col-* -->
				
					<?php unset($post);endforeach;?>
			</div><!-- /.row -->

			<div class="pagination-wrapper">
			<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
	
			</div><!-- /.pagination-wrapper -->
		</div><!-- /.col-* -->

		
	</div><!-- /.row -->
			
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->
</div><!-- /.page-wrapper -->
</div><!--Ajax-->

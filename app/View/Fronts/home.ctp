<?php $photoUrl=$this->Html->url(array('controller'=>'img'));?>
<div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        	

	            <div class="content">
	                <div class="cover cover-center">
	<div class="cover-carousel">
		<?php if($frontSlides==1){?>
		      <?php foreach($slides as $k=>$value): $photoImg=$photoUrl.'/'.$value['Slide']['dirt'].'_thumb/'.$value['Slide']['photo'];?>
		<div class="cover-carousel-item">
			<div class="cover-image" id="camera_wrap_4" style="background-image: url('<?php echo $photoImg;?>');"></div><!-- /.cover-image -->
		</div><!-- /.cover-carousel-item -->
		<?php endforeach;unset($k);unset($value);?>
	<?php }?>
		
		
		
	</div><!-- /.cover-carousel -->
</div><!-- /.cover -->

<div class="container">
	<div class="page-header">
		<h1><?php echo __('Most Viewed Property');?></h1>
	</div><!-- /.page-header -->

<div class="row">
	<div class="col-md-12">
		<div class="listing-box-wrapper">
			<div class="row">
				        <?php foreach($allviewedProperty as $postV):
					$this->Function->gridProperty($record,$postV,$currency,'<div class="col-md-3">');echo$record;?>
					<?php unset($postV);unset($id);endforeach;?>
				
			</div><!-- /.row -->	
		</div><!-- /.listing-box-wrapper -->
	</div><!-- /.col-sm-* -->	
</div><!-- /.row -->
<div class="container">
	<div class="page-header">
		<h2><?php echo __('Featured Properties');?></h2>
	</div>

	<div class="listing-box-wrapper listing-box-background">
	<div class="listing-carousel-wrapper">
		<div class="listing-carousel">		
						
       <?php foreach($allProperty as $post):$id=$post['Property']['id'];
        $this->Function->gridProperty($record,$post,$currency,'<div>');echo$record;?>
<?php unset($post);endforeach;?>	
		</div>
	</div>
</div>
	</div><!-- /.container -->



	
	<div class="push-bottom">
		<div class="page-header">
	<h1><?php echo __('Popular Property Categories');?></h1>

	<p><?php echo __('Check the best property categories avaialable in our directory.');?></p>
</div><!-- /.page-header -->

<div class="categories">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
			<?php 
			foreach($propertyType as $post):if($post['Type']['photo']==null){$photo=$photoUrl.'/nia.png';}else{$photo=$photoUrl.'/'.$post['Type']['dirt'].'_thumb/'.$post['Type']['photo'];}?>
				<div class="col-sm-4">
					<div class="category" style="background-image: url('<?php echo $photo;?>');">
					<?php echo$this->Html->link("<span class='category-content'>
								<span class='category-title'>".$post['Type']['name']."</span>
								<span class='category-subtitle'>".$post['Type']['total_count'].' '.__('submissions in directory')."</span>
								<span class='btn btn-primary'>".__('View List')."</span>
							</span>",array('controller'=>'Properties','action'=>'index','type:'.$post['Type']['id']),array('escape'=>false,'class'=>'category-link'));?>
						
					</div><!-- /.category -->
				</div><!-- /.col-* -->
                              <?php unset($post);endforeach;?>
			</div><!-- /.row -->
	</div><!-- /.row -->
</div><!-- /.categories -->

	</div>
</div><!-- /.container -->

</div>

	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->

    

<style type="text/css">
 .listing-box {
    margin: 0px;
}
</style>
<div class="page-wrapper">
    <div class="main-wrapper">
	    <div class="main">
	        <div class="main-inner">
	        		        
					<div class="content-title">
	<div class="content-title-inner">
		<div class="container">		
			<h1><?php echo __('Compare');?> <span><?php echo __('Properties');?></h1>	
		</div><!-- /.container -->
	</div><!-- /.content-title-inner -->
</div><!-- /.content-title -->
				

	            <div class="content">
	                <div class="container">
			<?php echo $this->Session->flash();?>
			<?php if($fProperty){?>
	
					<div class="listing-compare-wrapper">
		<div class="row">		
			<div class="listing-compare-description-wrapper col-sm-3">
				<div class="listing-compare-description">
					<ul>		
						<li><?php echo __('Location');?></li>				
						<li><?php echo __('Contract');?></li>	
						<li><?php echo __('Price');?></li>	
						<li><?php echo __('Bedrooms');?></li>
						<li><?php echo __('Bathrooms');?></li>							
						<?php foreach($feature as $value):?>
						<li><?php echo $value['Feature']['name'];?></li>					
						<?php endforeach;unset($value);?>
					</ul>
				</div><!-- /.listing-compare-description -->	
			</div><!-- /.col-sm-3 -->
			<?php foreach($fProperty as $post):$id=$post['Property']['id'];
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
	if($post['Property']['status']=="Sold")$labelColor="label-danger";else$labelColor="label-default";
	$propertyDetail='
	 <div class="listing-box">
	 <div class="listing-box-image" style="background-image: url(\''.$photo.'\')">
                    <div class="listing-box-image-label '.$labelColor.'">'.__($post['Property']['status']).'</div><!-- /.listing-box-image-label -->
                    <span class="listing-box-image-links">
                        '.$this->Function->favouriteProperty($id).
                        $this->Html->link("<i class='fa fa-search'></i> <span>".__('View detail')."</span>",array('controller'=>'Properties','action'=>'view',$id),array('escape'=>false)).
                        $this->Function->compareProperty($id).'
                    </span>
                </div><!-- /.listing-box-image -->
                <div class="listing-box-title">
                    <h2>'.$this->Html->link($post['Property']['name'],array('controller'=>'Properties','action'=>'view',$id)).'</h2>
                    <h3>'.$currency.$this->Number->format($post['Property']['price']).'</h3></div></div>';
	?>	
			
			<div class="listing-compare-col-wrapper col-sm-3"> 
				<div class="listing-compare-col">
					<?php echo$propertyDetail;?>
					<ul class="listing-compare-list">
						<li><?php echo $post['Location']['name'];?></li>
						<li><?php echo $post['Contract']['name'];?></li>
						<li><?php echo $currency.$post['Property']['price'];?></li>
						<li><?php echo $post['Property']['bedroom'];?></li>
						<li><?php echo $post['Property']['bathroom'];?></li>
						<?php foreach($feature as $value):
						if($this->Function->checkFeature($post['Property']['id'],$value['Feature']['id'])){?>
						<li class="yes"><i class="fa fa-check"></i></li>
						<?php }
						else{?>
						 <li class="no"><i class="fa fa-times"></i></li>
						<?php }?>
						<?php endforeach;unset($value);?>
					</ul><!-- /.listing-compare-list -->
				</div><!-- /.listing-compare-col -->
			</div><!-- /.listing-compare-col-wrapper -->
<?php endforeach;unset($post);?>
			
					</div><!-- /.row -->
					</div>
					<?php }?>

		</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->
</div><!-- /.page-wrapper -->

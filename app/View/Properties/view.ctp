<?php
echo $this->Html->script('http://maps.google.com/maps/api/js?key='.$mapKey);
if($post['Property']['allow_rating']){
echo $this->Html->script('star-rating.min');
echo $this->Html->css('star-rating.min');}
$id=$post['Property']['id'];
$urlModal=$this->Html->url(array('controller'=>'Properties','action'=>'sendbymail/'.$id));
$urlCalcModal=$this->Html->url(array('controller'=>'Properties','action'=>'calculator/'.$post['Property']['price']));
$photoUrl=$this->Html->url(array('controller'=>'img'));?>
<div class="page-wrapper">
    <div class="main-wrapper">
	<div class="main">
	    <div class="main-inner">
		<div class="content-title">
		    <div class="content-title-inner">
			<div class="container"><h1><?php echo h($post['Property']['name']);?></h1></div><!-- /.container -->
		    </div><!-- /.content-title-inner -->
		</div><!-- /.content-title -->

<div class="content">
  <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="listing-detail-attributes">
    <div class="listing-detail-attribute">
        <div class="key"><?php echo __('Agency');?></div>
        <div class="value"><?php if($post['Project']['name']){echo$post['Project']['name'];}else{echo __('Not Specified');}?></div>
    </div><!-- /.listing-detail-attribute -->                                             

    <div class="listing-detail-attribute">
        <div class="key"><?php echo __('Location');?></div>
        <div class="value"><?php if($post['Location']['name']){echo$post['Location']['name'];}else{echo __('Not Specified');}?></div>
    </div><!-- /.listing-detail-attribute -->                                             
     <div class="listing-detail-attribute">
        <div class="key"><?php echo __('Contract');?></div>
        <div class="value"><?php if($post['Contract']['name']){echo$post['Contract']['name'];}else{echo __('Not Specified');}?></div>
    </div><!-- /.listing-detail-attribute -->                                             
                           
    <div class="listing-detail-attribute">
        <div class="key"><?php echo __('Price');?></div>
        <div class="value"><?php if($post['Property']['price']){echo$currency.' '.$this->Number->format($post['Property']['price']);}else{echo __('Not Specified');}?></div>
    </div><!-- /.listing-detail-attribute -->
</div><!-- /.listing-detail-attributes -->            
        </div><!-- /.col-sm-12 -->
<?php echo $this->Session->flash();?>
        <div class="listing-detail col-md-8 col-lg-9">
            <div class="gallery">
            <?php foreach($post['PropertiesPhoto'] as $post1):$url=$post1['dir'].'/'.$post1['photo']?>
    <div class="gallery-item"><?php echo $this->Html->image($url);?>
    </div><!-- /.gallery-item -->
    <?php unset($post1);endforeach;?>
</div><!-- /.gallery -->

<div class="row">            
    <div class="col-lg-5">
        <div class="overview">
            <h2><?php echo __('Property Attributes');?></h2>

            <ul>
                <li><strong><?php echo __('Office ID');?></strong><span><?php if($post['Property']['uniq_id']){echo$post['Property']['uniq_id'];}else{echo __('Not Specified');}?></span></li>
		<li><strong><?php echo __('Price');?></strong><span><?php if($post['Property']['price']){echo$currency.' '.$this->Number->format($post['Property']['price']);}else{echo __('Not Specified');}?></span></li>
                <li><strong><?php echo __('Location');?></strong><span><?php if($post['Location']['name']){echo$post['Location']['name'];}else{echo __('Not Specified');}?></span></li>
                <li><strong><?php echo __('Status');?></strong><span><?php if($post['Property']['status']){echo$post['Property']['status'];}else{echo __('Not Specified');}?></span></li>
                <li><strong><?php echo __('Bedrooms');?></strong><span><?php if($post['Property']['bedroom']){echo$post['Property']['bedroom'];}else{echo __('Not Specified');}?></span></li>
                <li><strong><?php echo __('Bathrooms');?></strong><span><?php if($post['Property']['bathroom']){echo$post['Property']['bathroom'];}else{echo __('Not Specified');}?></span></li>
                <li><strong><?php echo __('Area');?></strong><span><?php if($post['Property']['area']){echo$post['Property']['area'].' '.$post['Unit']['name'];}else{echo __('Not Specified');}?></span></li>
		<li><strong><?php echo __('Views');?></strong><span><?php echo$this->Number->format($post['Property']['views']);?></span></li>
		<?php if($post['Property']['allow_rating']=="Yes"){?><li><strong><?php echo __('Rating');?></strong><span><div class="comment-rating" data-score="<?php echo$post['Property']['rating'];?>" title="<?php echo __('Rating').' '.$post['Property']['rating'];?>"><?php echo $this->Function->starRating($post['Property']['rating']);?></div></span></li><?php }?>
            </ul>
        </div><!-- /.overview -->
    </div><!-- /.col-* -->

    <div class="col-lg-7">
        <h2><?php echo __('Property Description');?></h2>
        <p>
           <?php if($post['Property']['description']){echo$post['Property']['description'];}else{echo __('Not Specified');}?>
        </p>
    </div><!-- /.col-* -->
</div><!-- /.row -->    
           
<h2><?php echo __('Amenities');?></h2>

<ul class="amenities">
<?php foreach($feature as $fpost):?>
    <li class="yes"><?php echo$fpost['Feature']['name'];?></li>
    <?php unset($fpost);endforeach;?>
</ul>    

<?php if(count($post['PropertiesFloorplan'])>0){?>
<h2><?php echo __('Floor Plans');?></h2>
<p>
<?php foreach($post['PropertiesFloorplan'] as $fpost):$photo=$fpost['dir'].'_thumb/'.$fpost['photo'];
echo $this->Html->link($this->Html->image($photo),array('controller'=>'img','action'=>$photo=$fpost['dir'],$fpost['photo']),array('class'=>'image-popup','escape'=>false)).'&nbsp;&nbsp;';
endforeach;unset($fpost);
}?>
</p>
<?php if(strlen($post['Property']['latitude'])>0 && strlen($post['Property']['longitude'])>0){?>
<h2><?php echo __('Map');?></h2>
<div class="property-detail-map-wrapper">
    <div class="property-detail-map" id="property-detail-map"></div>
</div>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', initMap(<?php echo$post['Property']['latitude'];?>,<?php echo$post['Property']['longitude'];?>,'<?php echo$photoUrl.'/map-marker.png';?>'));
</script>
<?php }?>
<?php if($post['Property']['allow_rating']){?>
<h2><?php echo __('Rating');?></h2>
<div class="col-sm-12">
<div class="col-sm-6">
<?php $ratingUrl=$this->Html->url(array('controller'=>'Properties','action'=>'rating',$id));?>
<script type="text/javascript">
       $(document).on('ready', function () {
        $('#star-rating').rating({
            size:'xs',
	    showCaption:false
        });
	$('#ratingSubmit').click(function (){$.ajax({method: "POST",data:$('#ratingForm').serialize(),url: '<?php echo$ratingUrl;?>'}).done(function(data) {$('#mainstartrating').hide();$('#overallRating').html(data);});});
	});
    </script>
    <?php if($isRating==false){?>
    <div id="mainstartrating"><?php echo __('Your Rating');?>
<?php echo $this->Form->create('Property',array('id'=>'ratingForm'));?>
    <?php echo$this->Form->input('rating',array('id'=>'star-rating','label'=>false,'div'=>false,'class'=>'comment-rating rating-loading','value'=>1,'data-max'=>'5','data-step'=>'1','data-size'=>'xs'));?>
    <?php echo $this->Form->button(__('Submit'),array('type'=>'button','id'=>'ratingSubmit','class'=>'btn btn-xs btn-primary'));?>
    </div>
<?php }echo$this->Form->end();?>
<p>&nbsp;</p>
</div>
<div class="col-sm-6">
    <?php echo __('Overall Rating');?>
    <div id="overallRating"><div class="comment-rating" data-score="<?php echo$post['Property']['rating'];?>" title="<?php echo __('Rating').' '.$post['Property']['rating'];?>"><?php echo $this->Function->starRating($post['Property']['rating']);?></div></div>
</div>
</div>
<?php }?>

<?php if(strlen($post['Property']['video'])>0){?>
<h2><?php echo __('Video Presentation');?></h2>
<p><?php echo$post['Property']['video'];?></p>
<?php }?>

<?php if($post['Property']['allow_comment']){?>
<h2><?php echo __('Comments');?></h2>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<?php echo$siteDomain.'/Properties/view/'.$id;?>" data-numposts="10"></div>
<?php }?>



        </div><!-- /.col-* -->

        <div class="col-md-4 col-lg-3">
            <div class="widget">
    <ul class="nav nav-stacked nav-style-primary">
        <li class="nav-item">
             <?php echo$this->Html->link('<span class="fa fa-share-alt"></span>&nbsp;'.__('Share Property'),'javascript:void(0)',array('data-toggle'=>'modal','data-target'=>'#shareModal','escape'=>false,'class'=>'nav-link'));?>
        </li><!-- /.nav-item -->

        <li class="nav-item">
            <?php echo$this->Function->favouriteProperty($post['Property']['id']);?>
        </li><!-- /.nav-item -->

        <li class="nav-item">
           <?php echo$this->Function->compareProperty($post['Property']['id']);?>
        </li><!-- /.nav-item -->

        <li class="nav-item">
	    <?php echo$this->Html->link('<span class="fa fa-envelope"></span>&nbsp;'.__('Send By E-mail'),'javascript:void(0)',array('onclick'=>"show_modal('$urlModal');",'escape'=>false,'class'=>'nav-link'));?>
        </li><!-- /.nav-item -->

        <li class="nav-item">
	    <?php echo$this->Html->link("<i class='fa fa-book'></i>".__('View Agency Detail'),array('controller'=>'Agencies','action'=>'view',$post['Property']['project_id']),array('escape'=>false,'class'=>'nav-link','target'=>'_blank'));?>
        </li><!-- /.nav-item -->

        <li class="nav-item">
	    <?php echo$this->Html->link("<i class='fa fa-print'></i>".__('Print'),array('controller'=>'Properties','action'=>'printproperty',$post['Property']['id']),array('escape'=>false,'class'=>'nav-link','target'=>'_blank'));?>
         </li><!-- /.nav-item -->

	<li class="nav-item">
            <?php echo$this->Html->link('<span class="fa fa-calculator"></span>&nbsp;'.__('Calculator'),'javascript:void(0)',array('onclick'=>"show_modal('$urlCalcModal');",'escape'=>false,'class'=>'nav-link'));?>
        </li><!-- /.nav-item -->                    
        <li class="nav-item">
             <?php echo$this->Html->link('<span class="fa fa-download"></span>&nbsp;'.__('Download Document'),'javascript:void(0)',array('data-toggle'=>'modal','data-target'=>'#dwndDocumentModal','escape'=>false,'class'=>'nav-link'));?>
        </li><!-- /.nav-item -->

        
    </ul><!-- /.nav-style-primary -->
</div><!-- /.widget -->

            <div class="widget widget-background-white">
    <h3 class="widgettitle"><?php echo __('Inquiry Form');?></h3>
    <?php echo $this->Form->create('Property', array( 'controller' => 'Properties', 'action' => 'inquiry/'.$post['Property']['id'],'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
        <div class="form-group">
            <label><?php echo __('Full Name');?></label>
            <input type="text" name="full_name" class="form-control" required="true">
        </div><!-- /.form-group -->

        <div class="form-group">
            <label><?php echo __('E-mail');?></label>
            <input type="email" name="email" class="form-control" required="true">
        </div><!-- /.form-group -->

	<div class="form-group">
            <label><?php echo __('Mobile Number');?></label>
            <input type="text" name="mobile" class="form-control" required="true">
        </div><!-- /.form-group -->

        <div class="form-group">
            <label><?php echo __('Subject');?></label>
            <input type="text" name="subject" class="form-control" required="true">
        </div><!-- /.form-group -->                

        <div class="form-group">
            <label><?php echo __('Message');?></label>
            <textarea class="form-control" name="message" rows="4" required="true"></textarea>
        </div><!-- /.form-group -->                                

        <div class="form-group-btn">
            <button type="submit" class="btn btn-primary btn-block"><?php echo __('Send Message');?></button>
        </div><!-- /.form-group-btn -->
    <?php echo$this->Form->end();?>
</div><!-- /.widget -->

            <div class="widget">
   <div class="listing-small">
	<div class="listing-small-inner">
		<div class="listing-small-image">
                <?php
		if($userArr['Ugroup']['type']=="AGT"){
		    $assignUser="Agents";
		    $assignId=$userArr['User']['id'];
		}
		elseif($userArr['Ugroup']['type']=="AGY"){
		    $assignUser="Agencies";
		    $assignId=$userArr['User']['project_id'];
		}
		else{
		    $assignUser="#";
		    $assignId="#";
		}
		if($userArr['User']['photo']==null){
		    $urlPhoto=$photoUrl.'/user-icon.png';}
		else{
		    $urlPhoto=$photoUrl.'/user_thumb/'.$userArr['User']['photo'];}
		    echo $this->Html->link('',array('controller'=>$assignUser,'action'=>'view',$assignId),array('style'=>"background-image: url($urlPhoto)"));?>
				
		</div><!-- /.listing-small-image -->
		<div class="listing-small-content">
			<h3><?php echo $this->Html->link($userArr['User']['name'],array('controller'=>$assignUser,'action'=>'view',$assignId));?></h3>
			<?php if($userArr['User']['phone']){?><h4><i class="fa fa-envelope"></i>&nbsp;<a href="mailto:<?php echo$userArr['User']['email'];?>"><?php echo$userArr['User']['email'];?></a></h4><?php }?>
			<?php if($userArr['User']['phone']){?><h4><i class="fa fa-phone"></i>&nbsp; <?php echo$userArr['User']['phone'];?></h4><?php }?>
			<?php if($userArr['User']['mobile']){?><h4><i class="fa fa-mobile"></i>&nbsp; <?php echo$userArr['User']['mobile'];?></h4><?php }?>
		</div>
	</div>
    </div>
</div><!-- /.widget -->

                  
        </div><!-- /.col-* -->
    </div><!-- /.row -->
</div><!-- /.container -->
	            </div><!-- /.content -->
	        </div><!-- /.main-inner -->
	    </div><!-- /.main -->
    </div><!-- /.main-wrapper -->
</div><!-- /.page-wrapper -->

<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>&nbsp;</button>
        <h6 class="modal-title" id="exampleModalLabel"><?php echo __('Share Properties');?></h6>
      </div>
      <div class="modal-body">
     <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-574048d3b7d7d507"></script>

               			<!-- Go to www.addthis.com/dashboard to customize your tools -->
<div class="addthis_sharing_toolbox"></div>
                
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="dwndDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>&nbsp;</button>
        <h6 class="modal-title" id="exampleModalLabel"><?php echo __('Download Documents');?></h6>
      </div>
      <div class="modal-body"><div class="mrg">
    <?php foreach($post['PropertiesDocument'] as $k=>$value):$k++;
    echo $this->Html->link('<span class="fa fa-download"></span>&nbsp;'.__('Document').' '.$k,array('controller'=>'img','action'=>$value['dir'],$value['photo']),array('target'=>'_blank','class'=>'btn btn-primary','escape'=>false,'style'=>'margin-left:20px;margin-bottom:20px;'));
    endforeach;unset($value,$k);?>
      </div></div>
    </div>
  </div>
</div>
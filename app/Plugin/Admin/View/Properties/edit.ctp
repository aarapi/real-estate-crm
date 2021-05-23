<?php echo $this->Html->script('http://maps.google.com/maps/api/js?key='.$mapKey.'&libraries=places');?>
	

<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
	<div class="panel-heading"><?php echo __('Edit');?> <?php echo __('Properties');?></div>            
                <div class="panel-body"><?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Property', array( 'controller' => 'Property','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
					<?php foreach ($Property as $k=>$post): $id=$post['Property']['id'];$form_no=$k;?>
		<div class="panel panel-default">
		    <div class="panel-heading"><strong><small class="text-danger"><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
		    <div class="panel-body">
                <?php if($userType!='AGT' && $userType!='AGY'){?>
		<div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
			<div class="col-sm-4">
			   <?php
			   echo $this->Form->select("$k.Property.project_id",$agency,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
			</div>			
		    </div>
		    <?php }?>
                    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Title');?>:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->input("$k.Property.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Title'),'div'=>false));?>
                        </div>
                        <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Type');?>:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select("$k.Property.type_id",$type,array('legend'=>false,'label' => false,'empty'=>__('Select'),'div'=>false,'class'=>'form-control'));?>
                        </div>
                    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Location');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->select("$k.Property.location_id",$location,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo$this->Form->input("$k.Property.address",array('id'=>'address-map'.$k,'label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Latitude');?>:</small></label>
			<div class="col-sm-2">
			   <?php echo $this->Form->input("$k.Property.latitude",array('id'=>$k.'latitude','readonly'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Latitude'),'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-1 control-label"><small><?php echo __('Longitude');?>:</small></label>
			<div class="col-sm-2">
			   <?php echo $this->Form->input("$k.Property.longitude",array('id'=>$k.'longitude','readonly'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Longitude'),'div'=>false));?>
			</div>
			<div class="col-sm-5">
			    <label for="address-map<?php echo$k;?>"><?php echo __('Or drag the marker to property position');?></label>
			    <div id="<?php echo$k;?>submit-map" class="submit-map"></div>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Price');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.price",array('label' => false,'class'=>'form-control','placeholder'=>__('Price'),'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Contract');?>:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select("$k.Property.contract_id",$contract,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Area');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.area",array("$k.Property.area",'label' => false,'class'=>'form-control','div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Unit');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->select("$k.Property.unit_id",$unitName,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Floors');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.floor",array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Floors'),'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Bedrooms');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.bedroom",array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Bedrooms'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Bathrooms');?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.bathroom",array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Bathrooms'),'div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Add Features');?>:</small></label>
			<div class="col-sm-4">
			    <?php $gp2=array();
				foreach($post['Feature'] as $featureName):
				 $gp2[]= $featureName['id'];?>
				 <?php endforeach;unset($featureName);?>
			    <?php echo $this->Form->select("$k.PropertyFeature.feature",$featureId,array('value'=>$gp2,'multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','div'=>false, 'hidden'=>false));unset($gp2);?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Agent's Commission Type");?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.commission_type",array('type'=>'radio','options'=>array("Percentage"=>__("Percentage"),"Value"=>__("Value")),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Agent's Commission");?>:</small></label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input("$k.Property.agent_commission",array('label' => false,'class'=>'form-control','placeholder'=>__("Agent's Commission"),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Allow User Rating');?>:</small></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox("$k.Property.allow_rating", array('label'=>false,'class'=>'form-control','div'=>false)); ?>
                        </div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Allow User Comment');?>:</small></label>
                        <div class="col-sm-1">
                           <?php echo $this->Form->checkbox("$k.Property.allow_comment", array('label'=>false,'class'=>'form-control','div'=>false)); ?>
                        </div>
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Status');?>:</small></label>
                        <div class="col-sm-4">
                           <?php echo $this->Form->select("$k.Property.status",array('Available'=>__('Available'),'Sold'=>__('Sold')),array('empty'=>null,'label' => false,'class'=>'form-control','div'=>false));?>
                        </div>
		    </div> 
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Embed Video');?>:</small></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input("$k.Property.video",array('label' => false,'class'=>'form-control','placeholder'=>__('Embed Video'),'div'=>false));?>
			</div>
		    </div>
            <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Description');?>:</small></label>
			<div class="col-sm-10">
			   <?php echo $this->Tinymce->input("$k.Property.description", array('class'=>'form-control','label' => false),array('language'=>$configLanguage,'directionality'=>$dirType),'full');?>
			</div>
		    </div> 
		    <div class="form-group text-left">
			    <div class="col-sm-offset-2 col-sm-7">
			    <?php echo $this->Form->input("$k.Property.id", array('type' => 'hidden'));?>
			    </div>
			</div>
							
						
    <script type="text/javascript">
    var _latitude = <?php  if(strlen($post['Property']['latitude'])==0)echo '0';else echo$post['Property']['latitude'];?>;
    var _longitude = <?php if(strlen($post['Property']['longitude'])==0)echo '0';else echo$post['Property']['longitude'];?>;

    google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
        var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 15,
            center: mapCenter,
            disableDefaultUI: false,
            //scrollwheel: false
        };
        var mapElement = document.getElementById('<?php echo$k;?>submit-map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: mapCenter,
            map: map,
            icon: '<?php echo$this->Html->url(array('controller'=>'../img')).'/map-marker.png';?>',
            draggable: true
        });
        $('#<?php echo$k;?>submit-map').removeClass('fade-map');
        google.maps.event.addListener(marker, "mouseup", function (event) {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#<?php echo$k;?>latitude').val( this.position.lat() );
            $('#<?php echo$k;?>longitude').val( this.position.lng() );
        });

//      Autocomplete
        var input = /** @type {HTMLInputElement} */( document.getElementById('address-map<?php echo$k;?>') );
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            $('#<?php echo$k;?>latitude').val( marker.getPosition().lat() );
            $('#<?php echo$k;?>longitude').val( marker.getPosition().lng() );
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        });

    }

    function success(position) {
        initSubmitMap(position.coords.latitude, position.coords.longitude);
        $('#<?php echo$k;?>latitude').val( position.coords.latitude );
        $('#<?php echo$k;?>longitude').val( position.coords.longitude );
    }

</script>
		</div>
		</div>
                    <?php endforeach;?>
                        <?php unset($post);?>
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <button type="submit" class="btn btn-success"><span class="fa fa-refresh"></span> <?php echo __('Update');?></button>
                            <?php if(!$isError){?><?php echo$this->Html->link('<span class="fa fa-remove"></span>'.__('Cancel'),array('controller'=>'Properties','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?><?php }?>
                        </div>
                    </div>
                <?php echo$this->Form->end();?>
		</div>
		</div>
        </div>
    </div>
</div>
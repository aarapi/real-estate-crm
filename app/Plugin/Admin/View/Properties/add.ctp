<?php echo $this->Html->script('http://maps.google.com/maps/api/js?key='.$mapKey.'&libraries=places');?>
<div class="col-sm-12">
    <?php echo $this->Session->flash();?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo __('Add Property');?></div>
        <div class="panel-body">
        <?php echo $this->Form->create('Property', array( 'controller' => 'Properties', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
            <?php if($userType!='AGT' && $userType!='AGY'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Agency');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('project_id',$agency,array('label' => false,'class'=>'form-control','empty'=>__('No Agency'),'div'=>false));?>
                </div>                
            </div>
	    <?php }?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Title');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Title'),'div'=>false));?>
                </div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Type');?>:</small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('type_id',$type,array('legend'=>false,'label' => false,'empty'=>__('Select'),'div'=>false,'class'=>'form-control'));?>
		</div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Location');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('location_id',$location,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('address',array('id'=>'address-map','label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>		
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Latitude');?>:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('latitude',array('id'=>'latitude','label' => false,'class'=>'form-control','placeholder'=>__('Latitude'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-1 control-label"><small><?php echo __('Longitude');?>:</small></label>
                <div class="col-sm-2">
                   <?php echo $this->Form->input('longitude',array('id'=>'longitude','label' => false,'class'=>'form-control','placeholder'=>__('Longitude'),'div'=>false));?>
                </div>
		<div class="col-sm-5">
		    <label for="address-map"><?php echo __('Or drag the marker to property position');?></label>
		    <div id="submit-map"></div>
		</div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Price');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('price',array('label' => false,'class'=>'form-control','placeholder'=>__('Price'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Contract');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('contract_id',$contract,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Area');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('area',array('label' => false,'class'=>'form-control','placeholder'=>__('Area'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Unit');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select('unit_id',$unitName,array('label' => false,'class'=>'form-control','empty'=>__('Select'),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Floors');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('floor',array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Floors'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Bedrooms');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('bedroom',array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Bedrooms'),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Number of Bathrooms');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('bathroom',array('label' => false,'class'=>'form-control','placeholder'=>__('Number of Bathrooms'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Add Features');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->select("PropertiesFeature.feature",$feature, array('label'=>false,'multiple'=>true,'class'=>'form-control multiselectgrp')); ?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Agent's Commission Type");?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('commission_type',array('type'=>'radio','options'=>array("Percentage"=>__("Percentage"),"Value"=>__("Value")),'legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','label' => false,'div'=>false,'class'=>''));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __("Agent's Commission");?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('agent_commission',array('label' => false,'class'=>'form-control','placeholder'=>__("Agent's Commission"),'div'=>false));?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Allow User Rating');?>:</small></label>
                <div class="col-sm-1">
                   <?php echo $this->Form->checkbox('allow_rating', array('label'=>false,'class'=>'form-control','div'=>false)); ?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Allow User Comment');?>:</small></label>
                <div class="col-sm-1">
                   <?php echo $this->Form->checkbox('allow_comment', array('label'=>false,'class'=>'form-control','div'=>false)); ?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Add Photo');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.PropertiesPhoto.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Add Document');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.PropertiesDocument.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Add Floor Plan');?>:</small></label>
                <div class="col-sm-4">
                   <?php echo $this->Form->input('Pr.PropertiesFloorplan.', array('type' => 'file','label'=>false,'multiple'=>'multiple','class'=>'')); ?>
                </div>
            </div>
	    <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Embed Video');?>:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Form->input('video',array('label' => false,'class'=>'form-control','placeholder'=>__('Embed Video'),'div'=>false));?>
                </div>
	    </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Description');?>:</small></label>
                <div class="col-sm-10">
                   <?php echo $this->Tinymce->input('description', array('class'=>'form-control','label' => false),array('language'=>$configLanguage,'directionality'=>$dirType),'full');?>
                </div>
            </div> 
	    <div class="form-group text-left">
                <div class="col-sm-offset-2 col-sm-7">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
            <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Properties','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                </div>
            </div>
        <?php echo$this->Form->end();?>
        </div>
    </div>
</div>
<script>
    var _latitude = 28.633226387106745;
    var _longitude = 77.2282472742188;

    google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
        var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 15,
            center: mapCenter,
            disableDefaultUI: false,
            //scrollwheel: false
        };
        var mapElement = document.getElementById('submit-map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: mapCenter,
            map: map,
            icon: '<?php echo$this->Html->url(array('controller'=>'../img')).'/map-marker.png';?>',
            draggable: true
        });
        $('#submit-map').removeClass('fade-map');
        google.maps.event.addListener(marker, "mouseup", function (event) {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#latitude').val( this.position.lat() );
            $('#longitude').val( this.position.lng() );
        });

//      Autocomplete
        var input = /** @type {HTMLInputElement} */( document.getElementById('address-map') );
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
            $('#latitude').val( marker.getPosition().lat() );
            $('#longitude').val( marker.getPosition().lng() );
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
        $('#latitude').val( position.coords.latitude );
        $('#longitude').val( position.coords.longitude );
    }

    $('.geo-location').on("click", function() {
        if (navigator.geolocation) {
            $('#submit-map').addClass('fade-map');
            navigator.geolocation.getCurrentPosition(success);
        } else {
            error('Geo Location is not supported');
        }
    });

</script>

<?php
$this->breadcrumbs=array(
	'Listing'=>array('admin'),
	'Create',
);

/*$this->menu=array(
	//array('label'=>'List Mls', 'url'=>array('index')),
	array('label'=>'Edit Listings', 'url'=>array('admin')),
	array('label'=>'Download Doc', 'url'=>array('/listing/forms/download')),
	array('label'=>'Manage Survey', 'url'=>array('/listing/survey/admin'), 'visible'=>Yii::app()->user->isAdmin()),
);*/
?>

<?php
$script = "
	$('#btnPopulate').click(function(){
		if($('#url').val() != '' && $('#selectSite').val() != ''){
			$.ajax({
				url: '/index.php/listing/mls/populate',
				dataType : 'json',
				timeout: 4000,
				type: 'POST',
				data: {
					site : $('#selectSite').val(),
					url : $('#url').val(),
				},
				complete: function(xhr, status){
					if(status == 'timeout'){
						alert('Request timeout');
					}
					$('#overlay').css('display', 'none');
				},
				success: function(data){
					/*alert(data);*/
					insertToForm(data);
				},
				beforeSend: function(xhr){
					$('#overlay').css('display', 'block');
				}
			});
		}else{
			alert('Please specific the link url');
		}
	});
	$('#btnPopulate2').click(function(){
		if($('#searchTextField').val()){
			$.ajax({
				url: '/index.php/listing/mls/popListing',
				dataType: 'json',
				timeout: 4000,
				type: 'POST',
				data: {
					fullAdd : $('#searchTextField').val(),
				},
				complete: function(xhr, status){
					if(status == 'timeout'){
						alert('Request timeout');
					}
					$('#overlay').css('display', 'none');
				},
				success: function(data){
					/*alert(data);*/
					insertToForm(data);
				},
				beforeSend: function(xhr){
					$('#overlay').css('display', 'block');
				}
			});	
		}else{
			alert('You must fill your full address');
		}
	});
	
	function insertToForm(data){
		var x;
		var checkBox = ['property_style', 'ownership_max', 'home_features_max', 'location_max', 'utilities_data_max', 'water_access', 'water_view', 'water_frontage',
					    'pool_type_max', 'property_description', 'foundation_max', 'exterior_construction_max', 'exterior_features_max', 'roof_max', 'garage_carport_max',
					    'garage_features_max', 'architectural_style_max', 'community_features_max', 'additional_rooms_max', 'air_conditioning_max', 'heating_and_fuel_max',
					    'appliances_included_max', 'interior_features_max', 'interior_layout_max', 'master_bath_features_max', 'security_system', 'floor_covering_max',
					    'kitchen_features_max', 'fireplace_description_max', 'realtor_information_max', 'financing_available_max', 'realtor_information_confidential_max',
					    'showing_instructions_max'];
		var radioBtn = ['fireplace_yn', 'cdd_yn', 'additional_parcel_yn', 'homestead_yn', 'other_exemptions_yn', 'water_access_yn', 'water_view_yn', 'water_frontage_yn', 
			  		  'new_construction_yn', 'private_pool_yn', 'pets_allowed_yn', 'pet_restrictions_yn', 'internet_yn', 'display_property_address_on_internet_yn'];
		for(x in data){
			if(in_array(x, radioBtn))
				$('input:radio[name=\"Mls[' + x + ']\"][value=\"' + data[x] + '\"]').click();
			else if(in_array(x, checkBox)){
				var arr = data[x].split(\" | \");
				for(y in arr)
					$('input:checkbox[name=\"Mls[' + x + '][]\"][value=\"' + arr[y] + '\"]').attr('checked', true);		
			}
			else
				$('#Mls_' + x).val(data[x]);
		}
	}
	function in_array (needle, haystack, argStrict) {
	    var key = '';        strict = !! argStrict;
	 
	    if (strict) {
	        for (key in haystack) {
	            if (haystack[key] === needle) {                return true;
	            }
	        }
	    } else {
	        for (key in haystack) {            if (haystack[key] == needle) {
	                return true;
	            }
	        }
	    } 
	    return false;
	}
";
Yii::app()->getClientScript()->registerScript('form', $script, CClientScript::POS_READY);
?>
<script src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
function initialize() {
 var mapOptions = {
   center: new google.maps.LatLng(-33.8688, 151.2195),
   zoom: 13,
   mapTypeId: google.maps.MapTypeId.ROADMAP
 };
 var map = new google.maps.Map(document.getElementById('map_canvas'),
   mapOptions);

 var input = document.getElementById('searchTextField');
 var autocomplete = new google.maps.places.Autocomplete(input);

 autocomplete.bindTo('bounds', map);

 var infowindow = new google.maps.InfoWindow();

 google.maps.event.addListener(autocomplete, 'place_changed', function() {
   infowindow.close();
   var place = autocomplete.getPlace();
   if (place.geometry.viewport) {
     map.fitBounds(place.geometry.viewport);
   } else {
     map.setCenter(place.geometry.location);
     map.setZoom(17);  // Why 17? Because it looks good.
   }

   var address = '';
   if (place.address_components) {
     address = [(place.address_components[0] &&
                 place.address_components[0].short_name || ''),
                (place.address_components[1] &&
                 place.address_components[1].short_name || ''),
                (place.address_components[2] &&
                 place.address_components[2].short_name || '')
               ].join(' ');
   }

   infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
 });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!--<select id="selectForm">
	<option value="1" selected="selected">CREATE NEW LISTING</option>
	<option value="2">CREATE VACANT LAND</option>
</select>-->
<!--<label><input  type="radio" id="selectForm" name="selectForm" value="1" checked="checked"/> CREATE NEW RESIDENTIAL LISTING</label>
<label><input  type="radio" id="selectVacant" name="selectForm" value="2" onchange='window.location = "/index.php/listing/land/create";'/> CREATE NEW VACANT LAND LISTING</label>-->

<!--<div class="form">
<form style="text-align: center; margin: 10px 0;" id="formPop">
<fieldset class="row span-23">
	<div>
		Autopopulated From URL: 
		<select id="selectSite">
			<option value="">Select...</option>
			<option value="trulia">Trulia.com</option>
			<option value="zillow">Zillow.com</option>
			<option value="realestate">Realestate.com</option>
		</select>&nbsp;&nbsp;<input type="url" id="url" placeholder="http://" size="50"/>&nbsp;&nbsp;<input  type="button" value="Populate" id="btnPopulate"/>
		</div>
	<div align="center">
		<strong>OR</strong>
	</div>
	<div>
	      	Populated From Previous Listing: <input id="searchTextField" type="text" size="50" placeholder="Address, City, State Zip Code">&nbsp;&nbsp;
	   	<input  type="button" value="Populate" id="btnPopulate2"/>
	 </div>
	<div id="map_canvas"></div>
	<div id="overlay" style="position: absolute; width: 910px; background: url('http://flatratelist.com/images/loading_big.gif') no-repeat scroll center center rgba(220, 220, 220, 0.5); padding: 10px; margin: -95px -10px 0pt; height: 85px; display: none; -webkit-border-radius: 7px; -moz-border-radius: 7px; border-radius: 7px; "></div>
</fieldset>
</form>
</div>-->

<hr class="space"/>
<h1>CREATE NEW RESIDENTIAL LISTING</h1>
<?php

$ic = Yii::app()->session->get('ic');
if(!empty($ic))
{
	$model2 = new Incomplete;
	$model2 = Incomplete::model()->findByPk($ic);
	$data = json_decode($model2->data);

	$model->list_price = $data->list_price;
	$model->name = $data->name;
	$model->address = $data->address;
	$model->city = $data->city;
	$model->county = $data->county;
	$model->state = $data->state;
	$model->zip_code = $data->zip_code;
	$model->home_phone = $data->home_phone;
	$model->mobile_phone = $data->mobile_phone;
	$model->email = $data->email;

	$model->billing_address = $data->billing_address;
	$model->billing_city = $data->billing_city;
	$model->billing_state = $data->billing_state;
	$model->billing_zip_code = $data->billing_zip_code;

	$model->zip_plus = $data->zip_plus ;
	$model->unit_number = $data->unit_number ;
	$model->condo_floor_number = $data->condo_floor_number ;
	$model->building_number_floors = $data->building_number_floors ;
	$model->building_name_number = $data->building_name_number ;
	$model->floors_in_unit = $data->floors_in_unit ;
	$model->total_units = $data->total_units ;
	$model->millage_rate = $data->millage_rate ;
	$model->year_built = $data->year_built ;
	$model->tax_id = $data->tax_id ;
	$model->taxes = $data->taxes ;
	$model->tax_year = $data->tax_year ;
	$model->section = $data->section ;
	$model->township = $data->township ;
	$model->range = $data->range ;
	$model->subdivision_number = $data->subdivision_number ;
	$model->block_parcel = $data->block_parcel ;
	$model->lot_number = $data->lot_number ;
	$model->subdivision_section_number = $data->subdivision_section_number ;
	$model->legal_description = $data->legal_description ;
	$model->legal_subdivision_name = $data->legal_subdivision_name ;
	$model->zoning = $data->zoning ;
	$model->plat_book_page = $data->plat_book_page ;
	$model->future_land_use = $data->future_land_use ;
	$model->complex_community_name = $data->complex_community_name ;

	$model->property_style = $data->property_style ;
	//$model-> = $data-> ;

	$model->bedrooms = $data->bedrooms ;
	$model->full_baths = $data->full_baths ;
	$model->half_baths = $data->half_baths ;
	$model->sq_ft_heated = $data->sq_ft_heated ;
	$model->total_building_sq_ft = $data->total_building_sq_ft ;
	$model->sq_ft_source = $data->sq_ft_source ;
	$model->ownership_max = $data->ownership_max ;
	$model->cdd_yn = $data->cdd_yn ;
	$model->annual_cdd_fee = $data->annual_cdd_fee ;
	$model->additional_parcel_yn = $data->additional_parcel_yn ;
	$model->homestead_yn = $data->homestead_yn ;
	$model->other_exemptions_yn = $data->other_exemptions_yn ;
	$model->home_features_max = $data->home_features_max ;
	$model->lot_dimensions = $data->lot_dimensions ;
	$model->lot_size_sq_ft = $data->lot_size_sq_ft ;
	$model->lot_size_acre = $data->lot_size_acre ;
	$model->total_acreage = $data->total_acreage ;
	$model->location_max = $data->location_max ;
	$model->front_exposure = $data->front_exposure ;
	$model->utilities_data_max = $data->utilities_data_max ;
	$model->water_access_yn = $data->water_access_yn ;
	$model->water_access = $data->water_access ;
	$model->water_view_yn = $data->water_view_yn ;
	$model->water_view = $data->water_view ;
	$model->water_frontage_yn = $data->water_frontage_yn ;
	$model->water_frontage = $data->water_frontage ;
	$model->new_construction_yn = $data->new_construction_yn ;
	$model->construction_status = $data->construction_status ;
	$model->private_pool_yn = $data->private_pool_yn ;
	$model->pool_type_max = $data->pool_type_max ;
	$model->property_description = $data->property_description ;
	$model->foundation_max = $data->foundation_max ;
	$model->exterior_construction_max = $data->exterior_construction_max ;
	$model->roof_max = $data->roof_max ;
	$model->exterior_features_max = $data->exterior_features_max ;
	$model->garage_carport_max = $data->garage_carport_max ;
	$model->garage_features_max = $data->garage_features_max ;
	$model->garage_dimensions = $data->garage_dimensions ;
	$model->architectural_style_max = $data->architectural_style_max ;
	$model->community_features_max = $data->community_features_max ;
	
	$model->hoa_community_association = $data->hoa_community_association ;
	$model->hoa_fee = $data->hoa_fee ;
	$model->hoa_payment_schedule = $data->hoa_payment_schedule ;
	$model->monthly_maintainance_addition_to_hoa = $data->monthly_maintainance_addition_to_hoa ;
	$model->pets_allowed_yn = $data->pets_allowed_yn ;
	$model->pet_restrictions_yn = $data->pet_restrictions_yn ;
	$model->elementary_school = $data->elementary_school ;
	$model->middle_school = $data->middle_school ;
	$model->high_school = $data->high_school ;
	$model->living_room = $data->living_room ;
	$model->dining_room = $data->dining_room ;
	$model->family_room = $data->family_room ;
	$model->great_room = $data->great_room ;
	$model->kitchen = $data->kitchen ;
	$model->master_bedroom_size = $data->master_bedroom_size ;
	$model->bedroom_2nd_size = $data->bedroom_2nd_size ;
	$model->bedroom_3rd_size = $data->bedroom_3rd_size ;
	$model->bedroom_4th_size = $data->bedroom_4th_size ;
	$model->bedroom_5th_size = $data->bedroom_5th_size ;
	$model->study_den_dimensions = $data->study_den_dimensions ;
	$model->balcony_porch_lanai = $data->balcony_porch_lanai ;
	$model->dinette = $data->dinette ;
	$model->studio_dimensions = $data->studio_dimensions ;
	$model->additional_rooms_max = $data->additional_rooms_max ;
	$model->air_conditioning_max = $data->air_conditioning_max ;
	$model->heating_and_fuel_max = $data->heating_and_fuel_max ;
	$model->appliances_included_max = $data->appliances_included_max ;
	$model->interior_layout_max = $data->interior_layout_max ;
	$model->interior_features_max = $data->interior_features_max ;
	$model->master_bath_features_max = $data->master_bath_features_max ;
	$model->security_system = $data->security_system ;
	$model->floor_covering_max = $data->floor_covering_max ;
	$model->kitchen_features_max = $data->kitchen_features_max ;
	$model->fireplace_yn = $data->fireplace_yn ;
	$model->fireplace_description_max = $data->fireplace_description_max ;
	
	$model->financing_available_max = $data->financing_available_max ;
	$model->realtor_information_max = $data->realtor_information_max ;
	$model->realtor_information_confidential_max = $data->realtor_information_confidential_max ;
	$model->special_sale_provision = $data->special_sale_provision ;
	$model->showing_instructions_max = $data->showing_instructions_max ;
	$model->showing_time_secure_remarks = $data->showing_time_secure_remarks ;
	$model->virtual_tour_link = $data->virtual_tour_link;
	$model->internet_yn = $data->internet_yn ;
	$model->display_property_address_on_internet_yn = $data->display_property_address_on_internet_yn ;
	$model->driving_direction = $data->driving_direction ;
	$model->realtor_only_remarks = $data->realtor_only_remarks ;
	$model->public_remarks = $data->public_remarks ;
	$model->pay_broker_percentage = $data->pay_broker_percentage ;

	$model->photo_1 = $data->photo_1 ;
	$model->photo_2 = $data->photo_2 ;
	$model->photo_3 = $data->photo_3 ;
	$model->photo_4 = $data->photo_4 ;
	$model->photo_5 = $data->photo_5 ;
	$model->photo_6 = $data->photo_6 ;
	$model->photo_7 = $data->photo_7 ;
	$model->photo_8 = $data->photo_8 ;
	$model->photo_9 = $data->photo_9 ;
	$model->photo_10 = $data->photo_10 ;
	$model->photo_11 = $data->photo_11 ;
	$model->photo_12 = $data->photo_12 ;

	Yii::app()->session->add('ic',0);
}

if($model->isNewRecord)
{
	$model->creator_id = Yii::app()->user->id;
	$model->updator_id = Yii::app()->user->id;
}

?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'incompleteId'=>$ic)); ?>
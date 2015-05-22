<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creator_id'); ?>
		<?php echo $form->textField($model,'creator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_date'); ?>
		<?php echo $form->textField($model,'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updator_id'); ?>
		<?php echo $form->textField($model,'updator_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'list_price'); ?>
		<?php echo $form->textField($model,'list_price',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zip_code'); ?>
		<?php echo $form->textField($model,'zip_code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_phone'); ?>
		<?php echo $form->textField($model,'home_phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile_phone'); ?>
		<?php echo $form->textField($model,'mobile_phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'billing_address'); ?>
		<?php echo $form->textField($model,'billing_address',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'billing_city'); ?>
		<?php echo $form->textField($model,'billing_city',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'billing_state'); ?>
		<?php echo $form->textField($model,'billing_state',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'billing_zip_code'); ?>
		<?php echo $form->textField($model,'billing_zip_code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zip_plus'); ?>
		<?php echo $form->textField($model,'zip_plus',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_number'); ?>
		<?php echo $form->textField($model,'unit_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'condo_floor_number'); ?>
		<?php echo $form->textField($model,'condo_floor_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'building_number_floors'); ?>
		<?php echo $form->textField($model,'building_number_floors',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'building_name_number'); ?>
		<?php echo $form->textField($model,'building_name_number',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'floors_in_unit'); ?>
		<?php echo $form->textField($model,'floors_in_unit',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_units'); ?>
		<?php echo $form->textField($model,'total_units',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'millage_rate'); ?>
		<?php echo $form->textField($model,'millage_rate',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year_built'); ?>
		<?php echo $form->textField($model,'year_built'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax_id'); ?>
		<?php echo $form->textField($model,'tax_id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taxes'); ?>
		<?php echo $form->textField($model,'taxes',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tax_year'); ?>
		<?php echo $form->textField($model,'tax_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'section'); ?>
		<?php echo $form->textField($model,'section',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'township'); ?>
		<?php echo $form->textField($model,'township',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'range'); ?>
		<?php echo $form->textField($model,'range',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdivision_number'); ?>
		<?php echo $form->textField($model,'subdivision_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'block_parcel'); ?>
		<?php echo $form->textField($model,'block_parcel',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_number'); ?>
		<?php echo $form->textField($model,'lot_number',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdivision_section_number'); ?>
		<?php echo $form->textField($model,'subdivision_section_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'legal_description'); ?>
		<?php echo $form->textField($model,'legal_description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'legal_subdivision_name'); ?>
		<?php echo $form->textField($model,'legal_subdivision_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zoning'); ?>
		<?php echo $form->textField($model,'zoning',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plat_book_page'); ?>
		<?php echo $form->textField($model,'plat_book_page',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'future_land_use'); ?>
		<?php echo $form->textField($model,'future_land_use',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complex_community_name'); ?>
		<?php echo $form->textField($model,'complex_community_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_style'); ?>
		<?php echo $form->textArea($model,'property_style',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedrooms'); ?>
		<?php echo $form->textField($model,'bedrooms'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'full_baths'); ?>
		<?php echo $form->textField($model,'full_baths'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'half_baths'); ?>
		<?php echo $form->textField($model,'half_baths'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sq_ft_heated'); ?>
		<?php echo $form->textField($model,'sq_ft_heated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_building_sq_ft'); ?>
		<?php echo $form->textField($model,'total_building_sq_ft'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sq_ft_source'); ?>
		<?php echo $form->textField($model,'sq_ft_source',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ownership_max'); ?>
		<?php echo $form->textArea($model,'ownership_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cdd_yn'); ?>
		<?php echo $form->textField($model,'cdd_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'annual_cdd_fee'); ?>
		<?php echo $form->textField($model,'annual_cdd_fee',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'additional_parcel_yn'); ?>
		<?php echo $form->textField($model,'additional_parcel_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'homestead_yn'); ?>
		<?php echo $form->textField($model,'homestead_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other_exemptions_yn'); ?>
		<?php echo $form->textField($model,'other_exemptions_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_features_max'); ?>
		<?php echo $form->textArea($model,'home_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_dimensions'); ?>
		<?php echo $form->textField($model,'lot_dimensions',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_size_sq_ft'); ?>
		<?php echo $form->textField($model,'lot_size_sq_ft'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_size_acre'); ?>
		<?php echo $form->textField($model,'lot_size_acre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_acreage'); ?>
		<?php echo $form->textField($model,'total_acreage',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_max'); ?>
		<?php echo $form->textArea($model,'location_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'front_exposure'); ?>
		<?php echo $form->textField($model,'front_exposure',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'utilities_data_max'); ?>
		<?php echo $form->textArea($model,'utilities_data_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_access_yn'); ?>
		<?php echo $form->textField($model,'water_access_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_access'); ?>
		<?php echo $form->textArea($model,'water_access',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_view_yn'); ?>
		<?php echo $form->textField($model,'water_view_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_view'); ?>
		<?php echo $form->textArea($model,'water_view',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_frontage_yn'); ?>
		<?php echo $form->textField($model,'water_frontage_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_frontage'); ?>
		<?php echo $form->textArea($model,'water_frontage',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'new_construction_yn'); ?>
		<?php echo $form->textField($model,'new_construction_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'construction_status'); ?>
		<?php echo $form->textField($model,'construction_status',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projected_completion_date'); ?>
		<?php echo $form->textField($model,'projected_completion_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'private_pool_yn'); ?>
		<?php echo $form->textField($model,'private_pool_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pool_type_max'); ?>
		<?php echo $form->textArea($model,'pool_type_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_description'); ?>
		<?php echo $form->textArea($model,'property_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'foundation_max'); ?>
		<?php echo $form->textArea($model,'foundation_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exterior_construction_max'); ?>
		<?php echo $form->textArea($model,'exterior_construction_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'roof_max'); ?>
		<?php echo $form->textArea($model,'roof_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exterior_features_max'); ?>
		<?php echo $form->textArea($model,'exterior_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'garage_carport_max'); ?>
		<?php echo $form->textArea($model,'garage_carport_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'garage_features_max'); ?>
		<?php echo $form->textArea($model,'garage_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'garage_dimensions'); ?>
		<?php echo $form->textField($model,'garage_dimensions',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'architectural_style_max'); ?>
		<?php echo $form->textArea($model,'architectural_style_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'community_features_max'); ?>
		<?php echo $form->textArea($model,'community_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'housing_for_older_persons'); ?>
		<?php echo $form->textField($model,'housing_for_older_persons',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hoa_community_association'); ?>
		<?php echo $form->textField($model,'hoa_community_association',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hoa_fee'); ?>
		<?php echo $form->textField($model,'hoa_fee',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hoa_payment_schedule'); ?>
		<?php echo $form->textField($model,'hoa_payment_schedule',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monthly_maintainance_addition_to_hoa'); ?>
		<?php echo $form->textField($model,'monthly_maintainance_addition_to_hoa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pets_allowed_yn'); ?>
		<?php echo $form->textField($model,'pets_allowed_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pet_restrictions_yn'); ?>
		<?php echo $form->textField($model,'pet_restrictions_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'elementary_school'); ?>
		<?php echo $form->textField($model,'elementary_school',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'middle_school'); ?>
		<?php echo $form->textField($model,'middle_school',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'high_school'); ?>
		<?php echo $form->textField($model,'high_school',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'living_room'); ?>
		<?php echo $form->textField($model,'living_room',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dining_room'); ?>
		<?php echo $form->textField($model,'dining_room',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'family_room'); ?>
		<?php echo $form->textField($model,'family_room',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'great_room'); ?>
		<?php echo $form->textField($model,'great_room',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kitchen'); ?>
		<?php echo $form->textField($model,'kitchen',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'master_bedroom_size'); ?>
		<?php echo $form->textField($model,'master_bedroom_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedroom_2nd_size'); ?>
		<?php echo $form->textField($model,'bedroom_2nd_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedroom_3rd_size'); ?>
		<?php echo $form->textField($model,'bedroom_3rd_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedroom_4th_size'); ?>
		<?php echo $form->textField($model,'bedroom_4th_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bedroom_5th_size'); ?>
		<?php echo $form->textField($model,'bedroom_5th_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'study_den_dimensions'); ?>
		<?php echo $form->textField($model,'study_den_dimensions',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'balcony_porch_lanai'); ?>
		<?php echo $form->textField($model,'balcony_porch_lanai',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dinette'); ?>
		<?php echo $form->textField($model,'dinette',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'studio_dimensions'); ?>
		<?php echo $form->textField($model,'studio_dimensions',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'additional_rooms_max'); ?>
		<?php echo $form->textArea($model,'additional_rooms_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'air_conditioning_max'); ?>
		<?php echo $form->textArea($model,'air_conditioning_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'heating_and_fuel_max'); ?>
		<?php echo $form->textArea($model,'heating_and_fuel_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'appliances_included_max'); ?>
		<?php echo $form->textArea($model,'appliances_included_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interior_layout_max'); ?>
		<?php echo $form->textArea($model,'interior_layout_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interior_features_max'); ?>
		<?php echo $form->textArea($model,'interior_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'master_bath_features_max'); ?>
		<?php echo $form->textArea($model,'master_bath_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_system'); ?>
		<?php echo $form->textArea($model,'security_system',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'floor_covering_max'); ?>
		<?php echo $form->textArea($model,'floor_covering_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kitchen_features_max'); ?>
		<?php echo $form->textArea($model,'kitchen_features_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fireplace_yn'); ?>
		<?php echo $form->textField($model,'fireplace_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fireplace_description_max'); ?>
		<?php echo $form->textArea($model,'fireplace_description_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'financing_available_max'); ?>
		<?php echo $form->textArea($model,'financing_available_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realtor_information_max'); ?>
		<?php echo $form->textArea($model,'realtor_information_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realtor_information_confidential_max'); ?>
		<?php echo $form->textArea($model,'realtor_information_confidential_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_sale_provision'); ?>
		<?php echo $form->textArea($model,'special_sale_provision',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'showing_instructions_max'); ?>
		<?php echo $form->textArea($model,'showing_instructions_max',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'showing_time_secure_remarks'); ?>
		<?php echo $form->textArea($model,'showing_time_secure_remarks',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'virtual_tour_link'); ?>
		<?php echo $form->textField($model,'virtual_tour_link',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'internet_yn'); ?>
		<?php echo $form->textField($model,'internet_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'display_property_address_on_internet_yn'); ?>
		<?php echo $form->textField($model,'display_property_address_on_internet_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driving_direction'); ?>
		<?php echo $form->textField($model,'driving_direction',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realtor_only_remarks'); ?>
		<?php echo $form->textField($model,'realtor_only_remarks',array('size'=>60,'maxlength'=>455)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'public_remarks'); ?>
		<?php echo $form->textField($model,'public_remarks',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_broker_percentage'); ?>
		<?php echo $form->textField($model,'pay_broker_percentage',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_1'); ?>
		<?php echo $form->textField($model,'photo_1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_2'); ?>
		<?php echo $form->textField($model,'photo_2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_3'); ?>
		<?php echo $form->textField($model,'photo_3',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_4'); ?>
		<?php echo $form->textField($model,'photo_4',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_5'); ?>
		<?php echo $form->textField($model,'photo_5',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_6'); ?>
		<?php echo $form->textField($model,'photo_6',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_7'); ?>
		<?php echo $form->textField($model,'photo_7',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_8'); ?>
		<?php echo $form->textField($model,'photo_8',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_9'); ?>
		<?php echo $form->textField($model,'photo_9',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_10'); ?>
		<?php echo $form->textField($model,'photo_10',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_11'); ?>
		<?php echo $form->textField($model,'photo_11',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_12'); ?>
		<?php echo $form->textField($model,'photo_12',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agreed'); ?>
		<?php echo $form->textField($model,'agreed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
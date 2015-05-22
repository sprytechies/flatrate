<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
	<?php echo CHtml::encode($data->creator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_date')); ?>:</b>
	<?php echo CHtml::encode($data->update_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updator_id')); ?>:</b>
	<?php echo CHtml::encode($data->updator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list_price')); ?>:</b>
	<?php echo CHtml::encode($data->list_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip_code')); ?>:</b>
	<?php echo CHtml::encode($data->zip_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_phone')); ?>:</b>
	<?php echo CHtml::encode($data->home_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile_phone')); ?>:</b>
	<?php echo CHtml::encode($data->mobile_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billing_address')); ?>:</b>
	<?php echo CHtml::encode($data->billing_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billing_city')); ?>:</b>
	<?php echo CHtml::encode($data->billing_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billing_state')); ?>:</b>
	<?php echo CHtml::encode($data->billing_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('billing_zip_code')); ?>:</b>
	<?php echo CHtml::encode($data->billing_zip_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip_plus')); ?>:</b>
	<?php echo CHtml::encode($data->zip_plus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_number')); ?>:</b>
	<?php echo CHtml::encode($data->unit_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('condo_floor_number')); ?>:</b>
	<?php echo CHtml::encode($data->condo_floor_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('building_number_floors')); ?>:</b>
	<?php echo CHtml::encode($data->building_number_floors); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('building_name_number')); ?>:</b>
	<?php echo CHtml::encode($data->building_name_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('floors_in_unit')); ?>:</b>
	<?php echo CHtml::encode($data->floors_in_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_units')); ?>:</b>
	<?php echo CHtml::encode($data->total_units); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('millage_rate')); ?>:</b>
	<?php echo CHtml::encode($data->millage_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year_built')); ?>:</b>
	<?php echo CHtml::encode($data->year_built); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
	<?php echo CHtml::encode($data->tax_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxes')); ?>:</b>
	<?php echo CHtml::encode($data->taxes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_year')); ?>:</b>
	<?php echo CHtml::encode($data->tax_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('section')); ?>:</b>
	<?php echo CHtml::encode($data->section); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('township')); ?>:</b>
	<?php echo CHtml::encode($data->township); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('range')); ?>:</b>
	<?php echo CHtml::encode($data->range); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdivision_number')); ?>:</b>
	<?php echo CHtml::encode($data->subdivision_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block_parcel')); ?>:</b>
	<?php echo CHtml::encode($data->block_parcel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_number')); ?>:</b>
	<?php echo CHtml::encode($data->lot_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdivision_section_number')); ?>:</b>
	<?php echo CHtml::encode($data->subdivision_section_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legal_description')); ?>:</b>
	<?php echo CHtml::encode($data->legal_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legal_subdivision_name')); ?>:</b>
	<?php echo CHtml::encode($data->legal_subdivision_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zoning')); ?>:</b>
	<?php echo CHtml::encode($data->zoning); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plat_book_page')); ?>:</b>
	<?php echo CHtml::encode($data->plat_book_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('future_land_use')); ?>:</b>
	<?php echo CHtml::encode($data->future_land_use); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complex_community_name')); ?>:</b>
	<?php echo CHtml::encode($data->complex_community_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_style')); ?>:</b>
	<?php echo CHtml::encode($data->property_style); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedrooms')); ?>:</b>
	<?php echo CHtml::encode($data->bedrooms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('full_baths')); ?>:</b>
	<?php echo CHtml::encode($data->full_baths); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('half_baths')); ?>:</b>
	<?php echo CHtml::encode($data->half_baths); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sq_ft_heated')); ?>:</b>
	<?php echo CHtml::encode($data->sq_ft_heated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_building_sq_ft')); ?>:</b>
	<?php echo CHtml::encode($data->total_building_sq_ft); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sq_ft_source')); ?>:</b>
	<?php echo CHtml::encode($data->sq_ft_source); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownership_max')); ?>:</b>
	<?php echo CHtml::encode($data->ownership_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdd_yn')); ?>:</b>
	<?php echo CHtml::encode($data->cdd_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('annual_cdd_fee')); ?>:</b>
	<?php echo CHtml::encode($data->annual_cdd_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_parcel_yn')); ?>:</b>
	<?php echo CHtml::encode($data->additional_parcel_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homestead_yn')); ?>:</b>
	<?php echo CHtml::encode($data->homestead_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_exemptions_yn')); ?>:</b>
	<?php echo CHtml::encode($data->other_exemptions_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->home_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_dimensions')); ?>:</b>
	<?php echo CHtml::encode($data->lot_dimensions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_size_sq_ft')); ?>:</b>
	<?php echo CHtml::encode($data->lot_size_sq_ft); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_size_acre')); ?>:</b>
	<?php echo CHtml::encode($data->lot_size_acre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_acreage')); ?>:</b>
	<?php echo CHtml::encode($data->total_acreage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_max')); ?>:</b>
	<?php echo CHtml::encode($data->location_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('front_exposure')); ?>:</b>
	<?php echo CHtml::encode($data->front_exposure); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utilities_data_max')); ?>:</b>
	<?php echo CHtml::encode($data->utilities_data_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_access_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_access_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_access')); ?>:</b>
	<?php echo CHtml::encode($data->water_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_view_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_view_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_view')); ?>:</b>
	<?php echo CHtml::encode($data->water_view); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_frontage_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_frontage_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_frontage')); ?>:</b>
	<?php echo CHtml::encode($data->water_frontage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('new_construction_yn')); ?>:</b>
	<?php echo CHtml::encode($data->new_construction_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('construction_status')); ?>:</b>
	<?php echo CHtml::encode($data->construction_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projected_completion_date')); ?>:</b>
	<?php echo CHtml::encode($data->projected_completion_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('private_pool_yn')); ?>:</b>
	<?php echo CHtml::encode($data->private_pool_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pool_type_max')); ?>:</b>
	<?php echo CHtml::encode($data->pool_type_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('property_description')); ?>:</b>
	<?php echo CHtml::encode($data->property_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('foundation_max')); ?>:</b>
	<?php echo CHtml::encode($data->foundation_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exterior_construction_max')); ?>:</b>
	<?php echo CHtml::encode($data->exterior_construction_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('roof_max')); ?>:</b>
	<?php echo CHtml::encode($data->roof_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exterior_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->exterior_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('garage_carport_max')); ?>:</b>
	<?php echo CHtml::encode($data->garage_carport_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('garage_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->garage_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('garage_dimensions')); ?>:</b>
	<?php echo CHtml::encode($data->garage_dimensions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('architectural_style_max')); ?>:</b>
	<?php echo CHtml::encode($data->architectural_style_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('community_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->community_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('housing_for_older_persons')); ?>:</b>
	<?php echo CHtml::encode($data->housing_for_older_persons); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hoa_community_association')); ?>:</b>
	<?php echo CHtml::encode($data->hoa_community_association); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hoa_fee')); ?>:</b>
	<?php echo CHtml::encode($data->hoa_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hoa_payment_schedule')); ?>:</b>
	<?php echo CHtml::encode($data->hoa_payment_schedule); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_maintainance_addition_to_hoa')); ?>:</b>
	<?php echo CHtml::encode($data->monthly_maintainance_addition_to_hoa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pets_allowed_yn')); ?>:</b>
	<?php echo CHtml::encode($data->pets_allowed_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pet_restrictions_yn')); ?>:</b>
	<?php echo CHtml::encode($data->pet_restrictions_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('elementary_school')); ?>:</b>
	<?php echo CHtml::encode($data->elementary_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middle_school')); ?>:</b>
	<?php echo CHtml::encode($data->middle_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('high_school')); ?>:</b>
	<?php echo CHtml::encode($data->high_school); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('living_room')); ?>:</b>
	<?php echo CHtml::encode($data->living_room); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dining_room')); ?>:</b>
	<?php echo CHtml::encode($data->dining_room); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('family_room')); ?>:</b>
	<?php echo CHtml::encode($data->family_room); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('great_room')); ?>:</b>
	<?php echo CHtml::encode($data->great_room); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kitchen')); ?>:</b>
	<?php echo CHtml::encode($data->kitchen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('master_bedroom_size')); ?>:</b>
	<?php echo CHtml::encode($data->master_bedroom_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedroom_2nd_size')); ?>:</b>
	<?php echo CHtml::encode($data->bedroom_2nd_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedroom_3rd_size')); ?>:</b>
	<?php echo CHtml::encode($data->bedroom_3rd_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedroom_4th_size')); ?>:</b>
	<?php echo CHtml::encode($data->bedroom_4th_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bedroom_5th_size')); ?>:</b>
	<?php echo CHtml::encode($data->bedroom_5th_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('study_den_dimensions')); ?>:</b>
	<?php echo CHtml::encode($data->study_den_dimensions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balcony_porch_lanai')); ?>:</b>
	<?php echo CHtml::encode($data->balcony_porch_lanai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dinette')); ?>:</b>
	<?php echo CHtml::encode($data->dinette); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('studio_dimensions')); ?>:</b>
	<?php echo CHtml::encode($data->studio_dimensions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_rooms_max')); ?>:</b>
	<?php echo CHtml::encode($data->additional_rooms_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('air_conditioning_max')); ?>:</b>
	<?php echo CHtml::encode($data->air_conditioning_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('heating_and_fuel_max')); ?>:</b>
	<?php echo CHtml::encode($data->heating_and_fuel_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appliances_included_max')); ?>:</b>
	<?php echo CHtml::encode($data->appliances_included_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interior_layout_max')); ?>:</b>
	<?php echo CHtml::encode($data->interior_layout_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interior_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->interior_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('master_bath_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->master_bath_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('security_system')); ?>:</b>
	<?php echo CHtml::encode($data->security_system); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('floor_covering_max')); ?>:</b>
	<?php echo CHtml::encode($data->floor_covering_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kitchen_features_max')); ?>:</b>
	<?php echo CHtml::encode($data->kitchen_features_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fireplace_yn')); ?>:</b>
	<?php echo CHtml::encode($data->fireplace_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fireplace_description_max')); ?>:</b>
	<?php echo CHtml::encode($data->fireplace_description_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financing_available_max')); ?>:</b>
	<?php echo CHtml::encode($data->financing_available_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_information_max')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_information_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_information_confidential_max')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_information_confidential_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('special_sale_provision')); ?>:</b>
	<?php echo CHtml::encode($data->special_sale_provision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('showing_instructions_max')); ?>:</b>
	<?php echo CHtml::encode($data->showing_instructions_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('showing_time_secure_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->showing_time_secure_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('virtual_tour_link')); ?>:</b>
	<?php echo CHtml::encode($data->virtual_tour_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internet_yn')); ?>:</b>
	<?php echo CHtml::encode($data->internet_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_property_address_on_internet_yn')); ?>:</b>
	<?php echo CHtml::encode($data->display_property_address_on_internet_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driving_direction')); ?>:</b>
	<?php echo CHtml::encode($data->driving_direction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_only_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_only_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('public_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->public_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_broker_percentage')); ?>:</b>
	<?php echo CHtml::encode($data->pay_broker_percentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_1')); ?>:</b>
	<?php echo CHtml::encode($data->photo_1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_2')); ?>:</b>
	<?php echo CHtml::encode($data->photo_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_3')); ?>:</b>
	<?php echo CHtml::encode($data->photo_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_4')); ?>:</b>
	<?php echo CHtml::encode($data->photo_4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_5')); ?>:</b>
	<?php echo CHtml::encode($data->photo_5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_6')); ?>:</b>
	<?php echo CHtml::encode($data->photo_6); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_7')); ?>:</b>
	<?php echo CHtml::encode($data->photo_7); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_8')); ?>:</b>
	<?php echo CHtml::encode($data->photo_8); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_9')); ?>:</b>
	<?php echo CHtml::encode($data->photo_9); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_10')); ?>:</b>
	<?php echo CHtml::encode($data->photo_10); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_11')); ?>:</b>
	<?php echo CHtml::encode($data->photo_11); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_12')); ?>:</b>
	<?php echo CHtml::encode($data->photo_12); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agreed')); ?>:</b>
	<?php echo CHtml::encode($data->agreed); ?>
	<br />

	*/ ?>

</div>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('listing_date')); ?>:</b>
	<?php echo CHtml::encode($data->listing_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiration_date')); ?>:</b>
	<?php echo CHtml::encode($data->expiration_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('entered_where')); ?>:</b>
	<?php echo CHtml::encode($data->entered_where); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('listing_type')); ?>:</b>
	<?php echo CHtml::encode($data->listing_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('representation')); ?>:</b>
	<?php echo CHtml::encode($data->representation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mls_number')); ?>:</b>
	<?php echo CHtml::encode($data->mls_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_lease_yn')); ?>:</b>
	<?php echo CHtml::encode($data->for_lease_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lease_price')); ?>:</b>
	<?php echo CHtml::encode($data->lease_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lease_price_acre')); ?>:</b>
	<?php echo CHtml::encode($data->lease_price_acre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list_price')); ?>:</b>
	<?php echo CHtml::encode($data->list_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('range_price_yn')); ?>:</b>
	<?php echo CHtml::encode($data->range_price_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('range_list_low_price')); ?>:</b>
	<?php echo CHtml::encode($data->range_list_low_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_per_acre')); ?>:</b>
	<?php echo CHtml::encode($data->price_per_acre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('house_number')); ?>:</b>
	<?php echo CHtml::encode($data->house_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_name')); ?>:</b>
	<?php echo CHtml::encode($data->street_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_type')); ?>:</b>
	<?php echo CHtml::encode($data->street_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('street_dir')); ?>:</b>
	<?php echo CHtml::encode($data->street_dir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip_code')); ?>:</b>
	<?php echo CHtml::encode($data->zip_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip_plus')); ?>:</b>
	<?php echo CHtml::encode($data->zip_plus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('millage_rate')); ?>:</b>
	<?php echo CHtml::encode($data->millage_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
	<?php echo CHtml::encode($data->tax_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxes')); ?>:</b>
	<?php echo CHtml::encode($data->taxes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxes_year')); ?>:</b>
	<?php echo CHtml::encode($data->taxes_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_key_folio')); ?>:</b>
	<?php echo CHtml::encode($data->alt_key_folio); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('condo_number')); ?>:</b>
	<?php echo CHtml::encode($data->condo_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdivision_section_number')); ?>:</b>
	<?php echo CHtml::encode($data->subdivision_section_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('block_parcel')); ?>:</b>
	<?php echo CHtml::encode($data->block_parcel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lot_number')); ?>:</b>
	<?php echo CHtml::encode($data->lot_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legal_description')); ?>:</b>
	<?php echo CHtml::encode($data->legal_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('legal_subdivision_name')); ?>:</b>
	<?php echo CHtml::encode($data->legal_subdivision_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subdiv_community_name')); ?>:</b>
	<?php echo CHtml::encode($data->subdiv_community_name); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('originating_board_id')); ?>:</b>
	<?php echo CHtml::encode($data->originating_board_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('road_frontage')); ?>:</b>
	<?php echo CHtml::encode($data->road_frontage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_land_use_code')); ?>:</b>
	<?php echo CHtml::encode($data->state_land_use_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_property_use_code')); ?>:</b>
	<?php echo CHtml::encode($data->state_property_use_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county_land_use_code')); ?>:</b>
	<?php echo CHtml::encode($data->county_land_use_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county_property_use_code')); ?>:</b>
	<?php echo CHtml::encode($data->county_property_use_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_parcel_yn')); ?>:</b>
	<?php echo CHtml::encode($data->additional_parcel_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_of_additional_parcel')); ?>:</b>
	<?php echo CHtml::encode($data->number_of_additional_parcel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdd_yn')); ?>:</b>
	<?php echo CHtml::encode($data->cdd_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('annual_cdd_fee')); ?>:</b>
	<?php echo CHtml::encode($data->annual_cdd_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hoa_comm_association')); ?>:</b>
	<?php echo CHtml::encode($data->hoa_comm_association); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hoa_fee')); ?>:</b>
	<?php echo CHtml::encode($data->hoa_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hoa_payment_schedule')); ?>:</b>
	<?php echo CHtml::encode($data->hoa_payment_schedule); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zoning_compatible_yn')); ?>:</b>
	<?php echo CHtml::encode($data->zoning_compatible_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('auction_yn')); ?>:</b>
	<?php echo CHtml::encode($data->auction_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idx_yn')); ?>:</b>
	<?php echo CHtml::encode($data->idx_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_name')); ?>:</b>
	<?php echo CHtml::encode($data->owner_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_phone')); ?>:</b>
	<?php echo CHtml::encode($data->owner_phone); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('front_footage')); ?>:</b>
	<?php echo CHtml::encode($data->front_footage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_acreage')); ?>:</b>
	<?php echo CHtml::encode($data->total_acreage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('front_exposire')); ?>:</b>
	<?php echo CHtml::encode($data->front_exposire); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('availability')); ?>:</b>
	<?php echo CHtml::encode($data->availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('easements')); ?>:</b>
	<?php echo CHtml::encode($data->easements); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_access_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_access_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_view_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_view_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_frontage_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_frontage_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_extras_yn')); ?>:</b>
	<?php echo CHtml::encode($data->water_extras_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_access')); ?>:</b>
	<?php echo CHtml::encode($data->water_access); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_view')); ?>:</b>
	<?php echo CHtml::encode($data->water_view); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_frontage')); ?>:</b>
	<?php echo CHtml::encode($data->water_frontage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_extras')); ?>:</b>
	<?php echo CHtml::encode($data->water_extras); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_name')); ?>:</b>
	<?php echo CHtml::encode($data->water_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('water_front_feet')); ?>:</b>
	<?php echo CHtml::encode($data->water_front_feet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_improvements')); ?>:</b>
	<?php echo CHtml::encode($data->site_improvements); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ownership')); ?>:</b>
	<?php echo CHtml::encode($data->ownership); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fences')); ?>:</b>
	<?php echo CHtml::encode($data->fences); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utilities')); ?>:</b>
	<?php echo CHtml::encode($data->utilities); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('community_features')); ?>:</b>
	<?php echo CHtml::encode($data->community_features); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('financing_available')); ?>:</b>
	<?php echo CHtml::encode($data->financing_available); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lease_terms')); ?>:</b>
	<?php echo CHtml::encode($data->lease_terms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_information')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_information); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_information_confidential')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_information_confidential); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('special_sale_provision')); ?>:</b>
	<?php echo CHtml::encode($data->special_sale_provision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('showing_instruction')); ?>:</b>
	<?php echo CHtml::encode($data->showing_instruction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('call_center_phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->call_center_phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('showing_time_secure_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->showing_time_secure_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('special_listing_type')); ?>:</b>
	<?php echo CHtml::encode($data->special_listing_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('virtual_tour')); ?>:</b>
	<?php echo CHtml::encode($data->virtual_tour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('internet_yn')); ?>:</b>
	<?php echo CHtml::encode($data->internet_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_property_address_on_internet_yn')); ?>:</b>
	<?php echo CHtml::encode($data->display_property_address_on_internet_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_com_yn')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_com_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('third_party_yn')); ?>:</b>
	<?php echo CHtml::encode($data->third_party_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_id')); ?>:</b>
	<?php echo CHtml::encode($data->agent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_email')); ?>:</b>
	<?php echo CHtml::encode($data->agent_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_homepage')); ?>:</b>
	<?php echo CHtml::encode($data->agent_homepage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_name')); ?>:</b>
	<?php echo CHtml::encode($data->agent_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_direct_phone')); ?>:</b>
	<?php echo CHtml::encode($data->agent_direct_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_pager_cell')); ?>:</b>
	<?php echo CHtml::encode($data->agent_pager_cell); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_fax')); ?>:</b>
	<?php echo CHtml::encode($data->agent_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent2_id')); ?>:</b>
	<?php echo CHtml::encode($data->agent2_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_team_name')); ?>:</b>
	<?php echo CHtml::encode($data->sales_team_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent2_name')); ?>:</b>
	<?php echo CHtml::encode($data->agent2_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent2_phone')); ?>:</b>
	<?php echo CHtml::encode($data->agent2_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_number')); ?>:</b>
	<?php echo CHtml::encode($data->office_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_phone')); ?>:</b>
	<?php echo CHtml::encode($data->office_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_extension')); ?>:</b>
	<?php echo CHtml::encode($data->agent_extension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_fax')); ?>:</b>
	<?php echo CHtml::encode($data->office_fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_name')); ?>:</b>
	<?php echo CHtml::encode($data->office_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_agent_id')); ?>:</b>
	<?php echo CHtml::encode($data->selling_agent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_agent_name')); ?>:</b>
	<?php echo CHtml::encode($data->selling_agent_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_agent2_id')); ?>:</b>
	<?php echo CHtml::encode($data->selling_agent2_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_agent2_name')); ?>:</b>
	<?php echo CHtml::encode($data->selling_agent2_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_agent2_office_id')); ?>:</b>
	<?php echo CHtml::encode($data->selling_agent2_office_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('selling_agent2_office_name')); ?>:</b>
	<?php echo CHtml::encode($data->selling_agent2_office_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list_office2_number')); ?>:</b>
	<?php echo CHtml::encode($data->list_office2_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list_office2_name')); ?>:</b>
	<?php echo CHtml::encode($data->list_office2_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('buyer_agent_comp')); ?>:</b>
	<?php echo CHtml::encode($data->buyer_agent_comp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('non_rep_comp')); ?>:</b>
	<?php echo CHtml::encode($data->non_rep_comp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_broker_comp')); ?>:</b>
	<?php echo CHtml::encode($data->trans_broker_comp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('interoffice_info')); ?>:</b>
	<?php echo CHtml::encode($data->interoffice_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driving_directions')); ?>:</b>
	<?php echo CHtml::encode($data->driving_directions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('realtor_only_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->realtor_only_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('public_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->public_remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_public_remarks')); ?>:</b>
	<?php echo CHtml::encode($data->additional_public_remarks); ?>
	<br />

	*/ ?>

</div>
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
		<?php echo $form->label($model,'listing_date'); ?>
		<?php echo $form->textField($model,'listing_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'expiration_date'); ?>
		<?php echo $form->textField($model,'expiration_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'entered_where'); ?>
		<?php echo $form->textArea($model,'entered_where',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'listing_type'); ?>
		<?php echo $form->textArea($model,'listing_type',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'representation'); ?>
		<?php echo $form->textArea($model,'representation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mls_number'); ?>
		<?php echo $form->textField($model,'mls_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'for_lease_yn'); ?>
		<?php echo $form->textField($model,'for_lease_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lease_price'); ?>
		<?php echo $form->textField($model,'lease_price',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lease_price_acre'); ?>
		<?php echo $form->textField($model,'lease_price_acre',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'list_price'); ?>
		<?php echo $form->textField($model,'list_price',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'range_price_yn'); ?>
		<?php echo $form->textField($model,'range_price_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'range_list_low_price'); ?>
		<?php echo $form->textField($model,'range_list_low_price',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_per_acre'); ?>
		<?php echo $form->textField($model,'price_per_acre',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'house_number'); ?>
		<?php echo $form->textField($model,'house_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street_name'); ?>
		<?php echo $form->textField($model,'street_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'street_type'); ?>
		<?php echo $form->textField($model,'street_type',array('size'=>10,'maxlength'=>10)); ?>
	</div>

<!--	<div class="row">
		<?php echo $form->label($model,'street_dir'); ?>
		<?php echo $form->textField($model,'street_dir',array('size'=>4,'maxlength'=>4)); ?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zip_code'); ?>
		<?php echo $form->textField($model,'zip_code',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zip_plus'); ?>
		<?php echo $form->textField($model,'zip_plus',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'millage_rate'); ?>
		<?php echo $form->textField($model,'millage_rate',array('size'=>10,'maxlength'=>10)); ?>
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
		<?php echo $form->label($model,'taxes_year'); ?>
		<?php echo $form->textField($model,'taxes_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alt_key_folio'); ?>
		<?php echo $form->textField($model,'alt_key_folio',array('size'=>20,'maxlength'=>20)); ?>
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
		<?php echo $form->label($model,'condo_number'); ?>
		<?php echo $form->textField($model,'condo_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdivision_section_number'); ?>
		<?php echo $form->textField($model,'subdivision_section_number',array('size'=>10,'maxlength'=>10)); ?>
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
		<?php echo $form->label($model,'legal_description'); ?>
		<?php echo $form->textField($model,'legal_description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'legal_subdivision_name'); ?>
		<?php echo $form->textField($model,'legal_subdivision_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdiv_community_name'); ?>
		<?php echo $form->textField($model,'subdiv_community_name',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->label($model,'originating_board_id'); ?>
		<?php echo $form->textArea($model,'originating_board_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'road_frontage'); ?>
		<?php echo $form->textField($model,'road_frontage',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state_land_use_code'); ?>
		<?php echo $form->textField($model,'state_land_use_code',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'state_property_use_code'); ?>
		<?php echo $form->textField($model,'state_property_use_code',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'county_land_use_code'); ?>
		<?php echo $form->textField($model,'county_land_use_code',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'county_property_use_code'); ?>
		<?php echo $form->textField($model,'county_property_use_code',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'additional_parcel_yn'); ?>
		<?php echo $form->textField($model,'additional_parcel_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_of_additional_parcel'); ?>
		<?php echo $form->textField($model,'number_of_additional_parcel',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cdd_yn'); ?>
		<?php echo $form->textField($model,'cdd_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'annual_cdd_fee'); ?>
		<?php echo $form->textField($model,'annual_cdd_fee',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hoa_comm_association'); ?>
		<?php echo $form->textField($model,'hoa_comm_association',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hoa_fee'); ?>
		<?php echo $form->textField($model,'hoa_fee',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hoa_payment_schedule'); ?>
		<?php echo $form->textField($model,'hoa_payment_schedule',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zoning_compatible_yn'); ?>
		<?php echo $form->textField($model,'zoning_compatible_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'auction_yn'); ?>
		<?php echo $form->textField($model,'auction_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idx_yn'); ?>
		<?php echo $form->textField($model,'idx_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_name'); ?>
		<?php echo $form->textField($model,'owner_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'owner_phone'); ?>
		<?php echo $form->textField($model,'owner_phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_dimensions'); ?>
		<?php echo $form->textField($model,'lot_dimensions',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_size_sq_ft'); ?>
		<?php echo $form->textField($model,'lot_size_sq_ft',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lot_size_acre'); ?>
		<?php echo $form->textField($model,'lot_size_acre',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'front_footage'); ?>
		<?php echo $form->textField($model,'front_footage',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_acreage'); ?>
		<?php echo $form->textField($model,'total_acreage',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textArea($model,'location',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'front_exposire'); ?>
		<?php echo $form->textField($model,'front_exposire',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'availability'); ?>
		<?php echo $form->textField($model,'availability',array('size'=>48,'maxlength'=>48)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'easements'); ?>
		<?php echo $form->textField($model,'easements',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_access_yn'); ?>
		<?php echo $form->textField($model,'water_access_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_view_yn'); ?>
		<?php echo $form->textField($model,'water_view_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_frontage_yn'); ?>
		<?php echo $form->textField($model,'water_frontage_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_extras_yn'); ?>
		<?php echo $form->textField($model,'water_extras_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_access'); ?>
		<?php echo $form->textArea($model,'water_access',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_view'); ?>
		<?php echo $form->textArea($model,'water_view',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_frontage'); ?>
		<?php echo $form->textArea($model,'water_frontage',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_extras'); ?>
		<?php echo $form->textArea($model,'water_extras',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_name'); ?>
		<?php echo $form->textField($model,'water_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'water_front_feet'); ?>
		<?php echo $form->textField($model,'water_front_feet',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site_improvements'); ?>
		<?php echo $form->textArea($model,'site_improvements',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ownership'); ?>
		<?php echo $form->textArea($model,'ownership',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fences'); ?>
		<?php echo $form->textArea($model,'fences',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'utilities'); ?>
		<?php echo $form->textArea($model,'utilities',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'community_features'); ?>
		<?php echo $form->textArea($model,'community_features',array('rows'=>6, 'cols'=>50)); ?>
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
		<?php echo $form->label($model,'financing_available'); ?>
		<?php echo $form->textArea($model,'financing_available',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lease_terms'); ?>
		<?php echo $form->textArea($model,'lease_terms',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realtor_information'); ?>
		<?php echo $form->textArea($model,'realtor_information',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'realtor_information_confidential'); ?>
		<?php echo $form->textArea($model,'realtor_information_confidential',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_sale_provision'); ?>
		<?php echo $form->textField($model,'special_sale_provision',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'showing_instruction'); ?>
		<?php echo $form->textArea($model,'showing_instruction',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'call_center_phone_number'); ?>
		<?php echo $form->textField($model,'call_center_phone_number',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'showing_time_secure_remarks'); ?>
		<?php echo $form->textField($model,'showing_time_secure_remarks',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'special_listing_type'); ?>
		<?php echo $form->textArea($model,'special_listing_type',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'virtual_tour'); ?>
		<?php echo $form->textField($model,'virtual_tour',array('size'=>50,'maxlength'=>50)); ?>
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
		<?php echo $form->label($model,'realtor_com_yn'); ?>
		<?php echo $form->textField($model,'realtor_com_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'third_party_yn'); ?>
		<?php echo $form->textField($model,'third_party_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_id'); ?>
		<?php echo $form->textField($model,'agent_id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_email'); ?>
		<?php echo $form->textField($model,'agent_email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_homepage'); ?>
		<?php echo $form->textField($model,'agent_homepage',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_name'); ?>
		<?php echo $form->textField($model,'agent_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_direct_phone'); ?>
		<?php echo $form->textField($model,'agent_direct_phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_pager_cell'); ?>
		<?php echo $form->textField($model,'agent_pager_cell',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_fax'); ?>
		<?php echo $form->textField($model,'agent_fax',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent2_id'); ?>
		<?php echo $form->textField($model,'agent2_id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sales_team_name'); ?>
		<?php echo $form->textField($model,'sales_team_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent2_name'); ?>
		<?php echo $form->textField($model,'agent2_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent2_phone'); ?>
		<?php echo $form->textField($model,'agent2_phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_number'); ?>
		<?php echo $form->textField($model,'office_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_phone'); ?>
		<?php echo $form->textField($model,'office_phone',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agent_extension'); ?>
		<?php echo $form->textField($model,'agent_extension',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_fax'); ?>
		<?php echo $form->textField($model,'office_fax',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_name'); ?>
		<?php echo $form->textField($model,'office_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_agent_id'); ?>
		<?php echo $form->textField($model,'selling_agent_id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_agent_name'); ?>
		<?php echo $form->textField($model,'selling_agent_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_agent2_id'); ?>
		<?php echo $form->textField($model,'selling_agent2_id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_agent2_name'); ?>
		<?php echo $form->textField($model,'selling_agent2_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_agent2_office_id'); ?>
		<?php echo $form->textField($model,'selling_agent2_office_id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'selling_agent2_office_name'); ?>
		<?php echo $form->textField($model,'selling_agent2_office_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'list_office2_number'); ?>
		<?php echo $form->textField($model,'list_office2_number',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'list_office2_name'); ?>
		<?php echo $form->textField($model,'list_office2_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'buyer_agent_comp'); ?>
		<?php echo $form->textField($model,'buyer_agent_comp',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'non_rep_comp'); ?>
		<?php echo $form->textField($model,'non_rep_comp',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trans_broker_comp'); ?>
		<?php echo $form->textField($model,'trans_broker_comp',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'interoffice_info'); ?>
		<?php echo $form->textField($model,'interoffice_info',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'driving_directions'); ?>
		<?php echo $form->textField($model,'driving_directions',array('size'=>60,'maxlength'=>255)); ?>
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
		<?php echo $form->label($model,'additional_public_remarks'); ?>
		<?php echo $form->textField($model,'additional_public_remarks',array('size'=>60,'maxlength'=>1020)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
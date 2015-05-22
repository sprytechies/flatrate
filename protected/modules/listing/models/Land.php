<?php

/**
 * This is the model class for table "land".
 *
 * The followings are the available columns in table 'land':
 * @property integer $id
 * @property string $create_date
 * @property integer $creator_id
 * @property string $update_date
 * @property integer $updator_id
 * @property string $listing_date
 * @property string $expiration_date
 * @property string $entered_where
 * @property string $listing_type
 * @property string $representation
 * @property integer $mls_number
 * @property string $for_lease_yn
 * @property string $lease_price
 * @property string $lease_price_acre
 * @property string $list_price
 * @property string $range_price_yn
 * @property string $range_list_low_price
 * @property string $price_per_acre
 * @property integer $house_number
 * @property string $street_name
 * @property string $street_type
 * @property string $street_dir
 * @property string $city
 * @property string $state
 * @property string $county
 * @property string $zip_code
 * @property string $zip_plus
 * @property string $millage_rate
 * @property string $tax_id
 * @property string $taxes
 * @property integer $taxes_year
 * @property string $alt_key_folio
 * @property string $section
 * @property string $township
 * @property string $range
 * @property string $subdivision_number
 * @property string $condo_number
 * @property string $subdivision_section_number
 * @property string $block_parcel
 * @property string $lot_number
 * @property string $legal_description
 * @property string $legal_subdivision_name
 * @property string $subdiv_community_name
 * @property string $zoning
 * @property string $plat_book_page
 * @property string $future_land_use
 * @property string $complex_community_name
 * @property string $property_style
 * @property string $originating_board_id
 * @property string $road_frontage
 * @property string $state_land_use_code
 * @property string $state_property_use_code
 * @property string $county_land_use_code
 * @property string $county_property_use_code
 * @property string $additional_parcel_yn
 * @property string $number_of_additional_parcel
 * @property string $cdd_yn
 * @property string $annual_cdd_fee
 * @property string $hoa_comm_association
 * @property string $hoa_fee
 * @property string $hoa_payment_schedule
 * @property string $zoning_compatible_yn
 * @property string $auction_yn
 * @property string $idx_yn
 * @property string $owner_name
 * @property string $owner_phone
 * @property string $lot_dimensions
 * @property string $lot_size_sq_ft
 * @property string $lot_size_acre
 * @property string $front_footage
 * @property string $total_acreage
 * @property string $location
 * @property string $front_exposire
 * @property string $availability
 * @property string $easements
 * @property string $water_access_yn
 * @property string $water_view_yn
 * @property string $water_frontage_yn
 * @property string $water_extras_yn
 * @property string $water_access
 * @property string $water_view
 * @property string $water_frontage
 * @property string $water_extras
 * @property string $water_name
 * @property string $water_front_feet
 * @property string $site_improvements
 * @property string $ownership
 * @property string $fences
 * @property string $utilities
 * @property string $community_features
 * @property string $elementary_school
 * @property string $middle_school
 * @property string $high_school
 * @property string $financing_available
 * @property string $lease_terms
 * @property string $realtor_information
 * @property string $realtor_information_confidential
 * @property string $special_sale_provision
 * @property string $showing_instruction
 * @property string $call_center_phone_number
 * @property string $showing_time_secure_remarks
 * @property string $special_listing_type
 * @property string $virtual_tour
 * @property string $internet_yn
 * @property string $display_property_address_on_internet_yn
 * @property string $realtor_com_yn
 * @property string $third_party_yn
 * @property string $agent_id
 * @property string $agent_email
 * @property string $agent_homepage
 * @property string $agent_name
 * @property string $agent_direct_phone
 * @property string $agent_pager_cell
 * @property string $agent_fax
 * @property string $agent2_id
 * @property string $sales_team_name
 * @property string $agent2_name
 * @property string $agent2_phone
 * @property string $office_number
 * @property string $office_phone
 * @property string $agent_extension
 * @property string $office_fax
 * @property string $office_name
 * @property string $selling_agent_id
 * @property string $selling_agent_name
 * @property string $selling_agent2_id
 * @property string $selling_agent2_name
 * @property string $selling_agent2_office_id
 * @property string $selling_agent2_office_name
 * @property string $list_office2_number
 * @property string $list_office2_name
 * @property string $buyer_agent_comp
 * @property string $non_rep_comp
 * @property string $trans_broker_comp
 * @property string $interoffice_info
 * @property string $driving_directions
 * @property string $realtor_only_remarks
 * @property string $public_remarks
 * @property string $additional_public_remarks
 */
class Land extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Land the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'land';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		 return array(
	            array('creator_id, updator_id, for_lease_yn, lease_price, lease_price_acre, list_price, range_price_yn, range_list_low_price, price_per_acre, street_name, street_type, city, state, county, zip_code, tax_id, taxes, taxes_year, section, township, range, subdivision_number, block_parcel, lot_number, legal_description, plat_book_page, property_style, additional_parcel_yn, hoa_comm_association, idx_yn, lot_dimensions, front_footage, total_acreage, location, easements, water_access_yn, water_view_yn, water_frontage_yn, water_extras_yn, realtor_information, realtor_information_confidential, special_sale_provision, showing_instruction, special_listing_type, internet_yn, display_property_address_on_internet_yn, realtor_com_yn, third_party_yn, buyer_agent_comp, driving_directions', 'required'),
	            array('creator_id, updator_id, mls_number, house_number, taxes_year', 'numerical', 'integerOnly'=>true),
	            array('for_lease_yn, range_price_yn, additional_parcel_yn, cdd_yn, zoning_compatible_yn, auction_yn, idx_yn, water_access_yn, water_view_yn, water_frontage_yn, water_extras_yn, internet_yn, display_property_address_on_internet_yn, realtor_com_yn, third_party_yn', 'length', 'max'=>1),
	            array('lease_price, lease_price_acre, list_price, range_list_low_price, price_per_acre, taxes, hoa_fee', 'length', 'max'=>15),
	            array('street_name, easements, agent_homepage, office_name', 'length', 'max'=>100),
	            array('street_type, zip_code, zip_plus, millage_rate, subdivision_number, condo_number, subdivision_section_number, number_of_additional_parcel, office_number', 'length', 'max'=>10),
	            array('street_dir_pre, street_dir_post, dump_id', 'length', 'max'=>4),
	            array('city, county, section, township, range, legal_subdivision_name, subdiv_community_name, plat_book_page, future_land_use, complex_community_name, owner_name, total_acreage, water_name, water_front_feet, elementary_school, middle_school, high_school, showing_time_secure_remarks, virtual_tour, agent_email, agent_name, sales_team_name, agent2_name, selling_agent_name, selling_agent2_name, selling_agent2_office_name, list_office2_name, land_status, paypal_trans_id', 'length', 'max'=>50),
	            array('state, front_exposire', 'length', 'max'=>2),
	            array('tax_id, block_parcel, lot_number, zoning, road_frontage, state_land_use_code, state_property_use_code, county_land_use_code, county_property_use_code, annual_cdd_fee, hoa_payment_schedule, front_footage, special_sale_provision, agent_id, agent2_id, agent_extension, selling_agent_id, selling_agent2_id, selling_agent2_office_id, list_office2_number, buyer_agent_comp, non_rep_comp, trans_broker_comp', 'length', 'max'=>30),
	            array('alt_key_folio, hoa_comm_association, owner_phone, lot_dimensions, lot_size_sq_ft, lot_size_acre, call_center_phone_number, agent_direct_phone, agent_pager_cell, agent_fax, agent2_phone, office_phone, office_fax, photo_1, photo_2, photo_3, photo_4, photo_5, photo_6, photo_7, photo_8, photo_9, photo_10, photo_11, photo_12', 'length', 'max'=>20),
	            array('legal_description, interoffice_info, driving_directions', 'length', 'max'=>255),
	            array('availability', 'length', 'max'=>48),
	            array('realtor_only_remarks', 'length', 'max'=>455),
	            array('public_remarks', 'length', 'max'=>1530),
	            array('additional_public_remarks', 'length', 'max'=>1020),
	            array('create_date, update_date, listing_date, expiration_date, entered_where, listing_type, representation, originating_board_id, water_access, water_view, water_frontage, water_extras, site_improvements, ownership, fences, utilities, community_features, financing_available, lease_terms', 'safe'),
			array('lot_dimensions','match', 'pattern'=>'/^[0-9]{2,3}x[0-9]{2,3}((x[0-9]{2,3}){2}){0,1}$/'),
			array('buyer_agent_comp', 'match', 'pattern' =>'/^([0-9]{1,3}(\.[0-9]+)*\%|\$[0-9]+)$/'),
	            // The following rule is used by search().
	            // Please remove those attributes that should not be searched.
	            array('id, create_date, creator_id, update_date, updator_id, listing_date, expiration_date, entered_where, listing_type, representation, mls_number, for_lease_yn, lease_price, lease_price_acre, list_price, range_price_yn, range_list_low_price, price_per_acre, house_number, street_name, street_type, street_dir_pre, street_dir_post, city, state, county, zip_code, zip_plus, millage_rate, tax_id, taxes, taxes_year, alt_key_folio, section, township, range, subdivision_number, condo_number, subdivision_section_number, block_parcel, lot_number, legal_description, legal_subdivision_name, subdiv_community_name, zoning, plat_book_page, future_land_use, complex_community_name, property_style, originating_board_id, road_frontage, state_land_use_code, state_property_use_code, county_land_use_code, county_property_use_code, additional_parcel_yn, number_of_additional_parcel, cdd_yn, annual_cdd_fee, hoa_comm_association, hoa_fee, hoa_payment_schedule, zoning_compatible_yn, auction_yn, idx_yn, owner_name, owner_phone, lot_dimensions, lot_size_sq_ft, lot_size_acre, front_footage, total_acreage, location, front_exposire, availability, easements, water_access_yn, water_view_yn, water_frontage_yn, water_extras_yn, water_access, water_view, water_frontage, water_extras, water_name, water_front_feet, site_improvements, ownership, fences, utilities, community_features, elementary_school, middle_school, high_school, financing_available, lease_terms, realtor_information, realtor_information_confidential, special_sale_provision, showing_instruction, call_center_phone_number, showing_time_secure_remarks, special_listing_type, virtual_tour, internet_yn, display_property_address_on_internet_yn, realtor_com_yn, third_party_yn, agent_id, agent_email, agent_homepage, agent_name, agent_direct_phone, agent_pager_cell, agent_fax, agent2_id, sales_team_name, agent2_name, agent2_phone, office_number, office_phone, agent_extension, office_fax, office_name, selling_agent_id, selling_agent_name, selling_agent2_id, selling_agent2_name, selling_agent2_office_id, selling_agent2_office_name, list_office2_number, list_office2_name, buyer_agent_comp, non_rep_comp, trans_broker_comp, interoffice_info, driving_directions, realtor_only_remarks, public_remarks, additional_public_remarks, land_status, paypal_trans_id, photo_1, photo_2, photo_3, photo_4, photo_5, photo_6, photo_7, photo_8, photo_9, photo_10, photo_11, photo_12,dump_id', 'safe', 'on'=>'search'),
	        );
/*		return array(
			array('creator_id, updator_id, for_lease_yn, lease_price, lease_price_acre, list_price, range_price_yn, range_list_low_price, price_per_acre, street_name, street_type, city, state, county, zip_code, tax_id, taxes, taxes_year, section, township, range, subdivision_number, block_parcel, lot_number, legal_description, plat_book_page, property_style, additional_parcel_yn, hoa_comm_association, idx_yn, lot_dimensions, front_footage, total_acreage, location, easements, water_access_yn, water_view_yn, water_frontage_yn, water_extras_yn, realtor_information, realtor_information_confidential, special_sale_provision, showing_instruction, special_listing_type, internet_yn, display_property_address_on_internet_yn, realtor_com_yn, third_party_yn, buyer_agent_comp, driving_directions', 'required'),
			array('creator_id, updator_id, mls_number, house_number, taxes_year', 'numerical', 'integerOnly'=>true),
			array('for_lease_yn, range_price_yn, additional_parcel_yn, cdd_yn, zoning_compatible_yn, auction_yn, idx_yn, water_access_yn, water_view_yn, water_frontage_yn, water_extras_yn, internet_yn, display_property_address_on_internet_yn, realtor_com_yn, third_party_yn', 'length', 'max'=>1),
			array('lease_price, lease_price_acre, list_price, range_list_low_price, price_per_acre, taxes, hoa_fee', 'length', 'max'=>15),
			array('street_name, easements, agent_homepage, office_name', 'length', 'max'=>100),
			array('street_type, zip_code, zip_plus, millage_rate, subdivision_number, condo_number, subdivision_section_number, number_of_additional_parcel, office_number', 'length', 'max'=>10),
			array('street_dir_pre, street_dir_post', 'length', 'max'=>4),
			array('city, county, section, township, range, legal_subdivision_name, subdiv_community_name, plat_book_page, future_land_use, complex_community_name, owner_name, total_acreage, water_name, water_front_feet, elementary_school, middle_school, high_school, showing_time_secure_remarks, virtual_tour, agent_email, agent_name, sales_team_name, agent2_name, selling_agent_name, selling_agent2_name, selling_agent2_office_name, list_office2_name, land_status, paypal_trans_id', 'length', 'max'=>50),
			array('state, front_exposire', 'length', 'max'=>2),
			array('tax_id, block_parcel, lot_number, zoning, road_frontage, state_land_use_code, state_property_use_code, county_land_use_code, county_property_use_code, annual_cdd_fee, hoa_payment_schedule, front_footage, special_sale_provision, agent_id, agent2_id, agent_extension, selling_agent_id, selling_agent2_id, selling_agent2_office_id, list_office2_number, buyer_agent_comp, non_rep_comp, trans_broker_comp', 'length', 'max'=>30),
			array('alt_key_folio, hoa_comm_association, owner_phone, lot_dimensions, lot_size_sq_ft, lot_size_acre, call_center_phone_number, agent_direct_phone, agent_pager_cell, agent_fax, agent2_phone, office_phone, office_fax', 'length', 'max'=>20),
			array('legal_description, interoffice_info, driving_directions', 'length', 'max'=>255),
			array('availability', 'length', 'max'=>48),
			array('realtor_only_remarks', 'length', 'max'=>455),
			array('public_remarks', 'length', 'max'=>1530),
			array('additional_public_remarks', 'length', 'max'=>1020),
			array('listing_date, create_date, update_date, expiration_date, entered_where, listing_type, representation, originating_board_id, water_access, water_view, water_frontage, water_extras, site_improvements, ownership, fences, utilities, community_features, financing_available, lease_terms', 'safe'),
			array('lot_dimensions','match', 'pattern'=>'/^[0-9]{2,3}x[0-9]{2,3}((x[0-9]{2,3}){2}){0,1}$/'),
			array('buyer_agent_comp', 'match', 'pattern' =>'/^([0-9]{1,3}(\.[0-9]+)*\%|\$[0-9]+)$/'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, create_date, creator_id, update_date, updator_id, listing_date, expiration_date, entered_where, listing_type, representation, mls_number, for_lease_yn, lease_price, lease_price_acre, list_price, range_price_yn, range_list_low_price, price_per_acre, house_number, street_name, street_type, street_dir_pre, street_dir_post, city, state, county, zip_code, zip_plus, millage_rate, tax_id, taxes, taxes_year, alt_key_folio, section, township, range, subdivision_number, condo_number, subdivision_section_number, block_parcel, lot_number, legal_description, legal_subdivision_name, subdiv_community_name, zoning, plat_book_page, future_land_use, complex_community_name, property_style, originating_board_id, road_frontage, state_land_use_code, state_property_use_code, county_land_use_code, county_property_use_code, additional_parcel_yn, number_of_additional_parcel, cdd_yn, annual_cdd_fee, hoa_comm_association, hoa_fee, hoa_payment_schedule, zoning_compatible_yn, auction_yn, idx_yn, owner_name, owner_phone, lot_dimensions, lot_size_sq_ft, lot_size_acre, front_footage, total_acreage, location, front_exposire, availability, easements, water_access_yn, water_view_yn, water_frontage_yn, water_extras_yn, water_access, water_view, water_frontage, water_extras, water_name, water_front_feet, site_improvements, ownership, fences, utilities, community_features, elementary_school, middle_school, high_school, financing_available, lease_terms, realtor_information, realtor_information_confidential, special_sale_provision, showing_instruction, call_center_phone_number, showing_time_secure_remarks, special_listing_type, virtual_tour, internet_yn, display_property_address_on_internet_yn, realtor_com_yn, third_party_yn, agent_id, agent_email, agent_homepage, agent_name, agent_direct_phone, agent_pager_cell, agent_fax, agent2_id, sales_team_name, agent2_name, agent2_phone, office_number, office_phone, agent_extension, office_fax, office_name, selling_agent_id, selling_agent_name, selling_agent2_id, selling_agent2_name, selling_agent2_office_id, selling_agent2_office_name, list_office2_number, list_office2_name, buyer_agent_comp, non_rep_comp, trans_broker_comp, interoffice_info, driving_directions, realtor_only_remarks, public_remarks, additional_public_remarks, land_status, paypal_trans_id', 'safe', 'on'=>'search'),
		);*/
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}
	
	public function scopes()
	    {
	        return array(
	            'ipn'=>array(
	                'condition'=>'land_status="APPROVED"',
	            ),
	            'owner'=>array(
	                'condition'=>'creator_id="' . Yii::app()->user->id  . '"',
	            ),
	        );
	    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_date' => 'Create Date',
			'creator_id' => 'Creator',
			'update_date' => 'Update Date',
			'updator_id' => 'Updator',
			'listing_date' => 'Listing Date',
			'expiration_date' => 'Expiration Date',
			'entered_where' => 'Entered Where',
			'listing_type' => 'Listing Type',
			'representation' => 'Representation',
			'mls_number' => 'MLS #',
			'for_lease_yn' => 'For Lease',
			'lease_price' => 'Lease Price',
			'lease_price_acre' => 'Lease Price Acre',
			'list_price' => 'List Price',
			'range_price_yn' => 'Range Price',
			'range_list_low_price' => 'Range List Low Price',
			'price_per_acre' => 'Price Per Acre',
			'house_number' => 'House #',
			'street_name' => 'Street Name',
			'street_type' => 'Street Type',
			'street_dir_pre' => 'Pre',
			'street_dir_post' => 'Post',
			'city' => 'City',
			'state' => 'State',
			'county' => 'County',
			'zip_code' => 'Zip Code',
			'zip_plus' => 'Zip +4',
			'millage_rate' => 'Millage Rate',
			'tax_id' => 'Tax ID',
			'taxes' => 'Taxes',
			'taxes_year' => 'Taxes Year',
			'alt_key_folio' => 'Alt/Key/Folio',
			'section' => 'Section',
			'township' => 'Township',
			'range' => 'Range',
			'subdivision_number' => 'Subdivision #',
			'condo_number' => 'SW Subdv Condo #',
			'subdivision_section_number' => 'SW Subdivision Section #',
			'block_parcel' => 'Block/Parcel',
			'lot_number' => 'Lot #',
			'legal_description' => 'Legal Description (255 Characters)',
			'legal_subdivision_name' => 'Legal Subdivision Name',
			'subdiv_community_name' => 'SW Subdiv Community Name',
			'zoning' => 'Zoning',
			'plat_book_page' => 'Plat Book/Page',
			'future_land_use' => 'Future Land Use',
			'complex_community_name' => 'Complex/Community Name',
			'property_style' => 'Property Style',
			'originating_board_id' => 'Originating Board ID',
			'road_frontage' => 'Road Frontage',
			'state_land_use_code' => 'State Land Use Code',
			'state_property_use_code' => 'State Property Use Code',
			'county_land_use_code' => 'County Land Use Code',
			'county_property_use_code' => 'County Property Use Code',
			'additional_parcel_yn' => 'Additional Parcel Y/N',
			'number_of_additional_parcel' => 'Number Of Additional Parcel',
			'cdd_yn' => 'CDD Y/N',
			'annual_cdd_fee' => 'Annual CDD Fee',
			'hoa_comm_association' => 'HOA/Comm Association',
			'hoa_fee' => 'HOA Fee',
			'hoa_payment_schedule' => 'HOA Payment Schedule',
			'zoning_compatible_yn' => 'Zoning Compatible Y/N',
			'auction_yn' => 'Auction Y/N',
			'idx_yn' => 'IDX Y/N',
			'owner_name' => 'Owner Name',
			'owner_phone' => 'Owner Phone',
			'lot_dimensions' => 'Lot Dimensions',
			'lot_size_sq_ft' => 'Lot Size (Sq. Ft)',
			'lot_size_acre' => 'Lot Size (Acre)',
			'front_footage' => 'Front Footage',
			'total_acreage' => 'Total Acreage',
			'location' => 'Location',
			'front_exposire' => 'Front Exposure',
			'availability' => 'Availability (48 Characters)',
			'easements' => 'Easements (100 Characters)',
			'water_access_yn' => 'Water Access Y/N',
			'water_view_yn' => 'Water View Y/N',
			'water_frontage_yn' => 'Water Frontage Y/N',
			'water_extras_yn' => 'Water Extras Y/N',
			'water_access' => 'Water Access',
			'water_view' => 'Water View',
			'water_frontage' => 'Water Frontage',
			'water_extras' => 'Water Extras',
			'water_name' => 'Water Name',
			'water_front_feet' => 'Water Front Feet',
			'site_improvements' => 'Site Improvements (3 Max)',
			'ownership' => 'Ownership (3 Max)',
			'fences' => 'Fences (3Max)',
			'utilities' => 'Utilities (8 Max)',
			'community_features' => 'Community Features (25 Max)',
			'elementary_school' => 'Elementary School',
			'middle_school' => 'Middle School',
			'high_school' => 'High School',
			'financing_available' => 'Financing Available (7 Max)',
			'lease_terms' => 'Lease Terms',
			'realtor_information' => 'Realtor Information (25 Max)',
			'realtor_information_confidential' => 'Realtor Information (Confidential) (3 Max)',
			'special_sale_provision' => 'Special Sale Provision',
			'showing_instruction' => 'Showing Instruction (13 Max)',
			'call_center_phone_number' => 'Call Center Phone Number',
			'showing_time_secure_remarks' => 'Showing Time Secure Remarks',
			'special_listing_type' => 'Special Listing Type',
			'virtual_tour' => 'Virtual Tour',
			'internet_yn' => 'Internet Y/N',
			'display_property_address_on_internet_yn' => 'Display Property Address On Internet Y/N',
			'realtor_com_yn' => 'Realtor.com Y/N',
			'third_party_yn' => '3rd Party Y/N',
			'agent_id' => 'Agent',
			'agent_email' => 'Agent Email',
			'agent_homepage' => 'Agent Homepage',
			'agent_name' => 'Agent Name',
			'agent_direct_phone' => 'Direct Phone',
			'agent_pager_cell' => 'Pager/ Cell',
			'agent_fax' => 'Agent Fax',
			'agent2_id' => 'List Agent 2 ID',
			'sales_team_name' => 'Sales Team Name',
			'agent2_name' => 'List Agent 2 Name',
			'agent2_phone' => 'List Agent 2 Phone',
			'office_number' => 'Office #',
			'office_phone' => 'Office Phone',
			'agent_extension' => 'Agent Extension',
			'office_fax' => 'Office Fax',
			'office_name' => 'Office Name',
			'selling_agent_id' => 'Selling Agent ID',
			'selling_agent_name' => 'Selling Agent Name',
			'selling_agent2_id' => 'Selling Agent 2 ID',
			'selling_agent2_name' => 'Selling Agent 2 Name',
			'selling_agent2_office_id' => 'Selling Agent 2 Office ID',
			'selling_agent2_office_name' => 'Selling Agent 2 Office Name',
			'list_office2_number' => 'List Office 2 #',
			'list_office2_name' => 'List Office 2 Name',
			'buyer_agent_comp' => 'Buyer Agent Comp',
			'non_rep_comp' => 'Non-Rep Comp',
			'trans_broker_comp' => 'Trans Broker Comp',
			'interoffice_info' => 'Interoffice Info (255 Characters)',
			'driving_directions' => 'Driving Directions (255 Characters)',
			'realtor_only_remarks' => 'Realtor Only Remarks (455 Characters)',
			'public_remarks' => 'Public Remarks (1530 Characters)',
			'additional_public_remarks' => 'Additional Public Remarks (1020 Characters)',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('create_date',$this->create_date,true);
		if(Yii::app()->user->isAdmin()){
			$criteria->compare('creator_id',$this->creator_id);
			$criteria->compare('updator_id',$this->updator_id);
			$criteria->compare('land_status',$this->land_status);
		}
		else{
			$criteria->compare('creator_id', Yii::app()->user->id);
			$criteria->compare('updator_id',$this->updator_id);
			$criteria->addNotInCondition('land_status', array('SOLD'));
		}
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('listing_date',$this->listing_date,true);
		$criteria->compare('expiration_date',$this->expiration_date,true);
		$criteria->compare('entered_where',$this->entered_where,true);
		$criteria->compare('listing_type',$this->listing_type,true);
		$criteria->compare('representation',$this->representation,true);
		$criteria->compare('mls_number',$this->mls_number);
		$criteria->compare('for_lease_yn',$this->for_lease_yn,true);
		$criteria->compare('lease_price',$this->lease_price,true);
		$criteria->compare('lease_price_acre',$this->lease_price_acre,true);
		$criteria->compare('list_price',$this->list_price,true);
		$criteria->compare('range_price_yn',$this->range_price_yn,true);
		$criteria->compare('range_list_low_price',$this->range_list_low_price,true);
		$criteria->compare('price_per_acre',$this->price_per_acre,true);
		$criteria->compare('house_number',$this->house_number);
		$criteria->compare('street_name',$this->street_name,true);
		$criteria->compare('street_type',$this->street_type,true);
//		$criteria->compare('street_dir',$this->street_dir,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('zip_plus',$this->zip_plus,true);
		$criteria->compare('millage_rate',$this->millage_rate,true);
		$criteria->compare('tax_id',$this->tax_id,true);
		$criteria->compare('taxes',$this->taxes,true);
		$criteria->compare('taxes_year',$this->taxes_year);
		$criteria->compare('alt_key_folio',$this->alt_key_folio,true);
		$criteria->compare('section',$this->section,true);
		$criteria->compare('township',$this->township,true);
		$criteria->compare('range',$this->range,true);
		$criteria->compare('subdivision_number',$this->subdivision_number,true);
		$criteria->compare('condo_number',$this->condo_number,true);
		$criteria->compare('subdivision_section_number',$this->subdivision_section_number,true);
		$criteria->compare('block_parcel',$this->block_parcel,true);
		$criteria->compare('lot_number',$this->lot_number,true);
		$criteria->compare('legal_description',$this->legal_description,true);
		$criteria->compare('legal_subdivision_name',$this->legal_subdivision_name,true);
		$criteria->compare('subdiv_community_name',$this->subdiv_community_name,true);
		$criteria->compare('zoning',$this->zoning,true);
		$criteria->compare('plat_book_page',$this->plat_book_page,true);
		$criteria->compare('future_land_use',$this->future_land_use,true);
		$criteria->compare('complex_community_name',$this->complex_community_name,true);
		$criteria->compare('property_style',$this->property_style,true);
		$criteria->compare('originating_board_id',$this->originating_board_id,true);
		$criteria->compare('road_frontage',$this->road_frontage,true);
		$criteria->compare('state_land_use_code',$this->state_land_use_code,true);
		$criteria->compare('state_property_use_code',$this->state_property_use_code,true);
		$criteria->compare('county_land_use_code',$this->county_land_use_code,true);
		$criteria->compare('county_property_use_code',$this->county_property_use_code,true);
		$criteria->compare('additional_parcel_yn',$this->additional_parcel_yn,true);
		$criteria->compare('number_of_additional_parcel',$this->number_of_additional_parcel,true);
		$criteria->compare('cdd_yn',$this->cdd_yn,true);
		$criteria->compare('annual_cdd_fee',$this->annual_cdd_fee,true);
		$criteria->compare('hoa_comm_association',$this->hoa_comm_association,true);
		$criteria->compare('hoa_fee',$this->hoa_fee,true);
		$criteria->compare('hoa_payment_schedule',$this->hoa_payment_schedule,true);
		$criteria->compare('zoning_compatible_yn',$this->zoning_compatible_yn,true);
		$criteria->compare('auction_yn',$this->auction_yn,true);
		$criteria->compare('idx_yn',$this->idx_yn,true);
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('owner_phone',$this->owner_phone,true);
		$criteria->compare('lot_dimensions',$this->lot_dimensions,true);
		$criteria->compare('lot_size_sq_ft',$this->lot_size_sq_ft,true);
		$criteria->compare('lot_size_acre',$this->lot_size_acre,true);
		$criteria->compare('front_footage',$this->front_footage,true);
		$criteria->compare('total_acreage',$this->total_acreage,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('front_exposire',$this->front_exposire,true);
		$criteria->compare('availability',$this->availability,true);
		$criteria->compare('easements',$this->easements,true);
		$criteria->compare('water_access_yn',$this->water_access_yn,true);
		$criteria->compare('water_view_yn',$this->water_view_yn,true);
		$criteria->compare('water_frontage_yn',$this->water_frontage_yn,true);
		$criteria->compare('water_extras_yn',$this->water_extras_yn,true);
		$criteria->compare('water_access',$this->water_access,true);
		$criteria->compare('water_view',$this->water_view,true);
		$criteria->compare('water_frontage',$this->water_frontage,true);
		$criteria->compare('water_extras',$this->water_extras,true);
		$criteria->compare('water_name',$this->water_name,true);
		$criteria->compare('water_front_feet',$this->water_front_feet,true);
		$criteria->compare('site_improvements',$this->site_improvements,true);
		$criteria->compare('ownership',$this->ownership,true);
		$criteria->compare('fences',$this->fences,true);
		$criteria->compare('utilities',$this->utilities,true);
		$criteria->compare('community_features',$this->community_features,true);
		$criteria->compare('elementary_school',$this->elementary_school,true);
		$criteria->compare('middle_school',$this->middle_school,true);
		$criteria->compare('high_school',$this->high_school,true);
		$criteria->compare('financing_available',$this->financing_available,true);
		$criteria->compare('lease_terms',$this->lease_terms,true);
		$criteria->compare('realtor_information',$this->realtor_information,true);
		$criteria->compare('realtor_information_confidential',$this->realtor_information_confidential,true);
		$criteria->compare('special_sale_provision',$this->special_sale_provision,true);
		$criteria->compare('showing_instruction',$this->showing_instruction,true);
		$criteria->compare('call_center_phone_number',$this->call_center_phone_number,true);
		$criteria->compare('showing_time_secure_remarks',$this->showing_time_secure_remarks,true);
		$criteria->compare('special_listing_type',$this->special_listing_type,true);
		$criteria->compare('virtual_tour',$this->virtual_tour,true);
		$criteria->compare('internet_yn',$this->internet_yn,true);
		$criteria->compare('display_property_address_on_internet_yn',$this->display_property_address_on_internet_yn,true);
		$criteria->compare('realtor_com_yn',$this->realtor_com_yn,true);
		$criteria->compare('third_party_yn',$this->third_party_yn,true);
		$criteria->compare('agent_id',$this->agent_id,true);
		$criteria->compare('agent_email',$this->agent_email,true);
		$criteria->compare('agent_homepage',$this->agent_homepage,true);
		$criteria->compare('agent_name',$this->agent_name,true);
		$criteria->compare('agent_direct_phone',$this->agent_direct_phone,true);
		$criteria->compare('agent_pager_cell',$this->agent_pager_cell,true);
		$criteria->compare('agent_fax',$this->agent_fax,true);
		$criteria->compare('agent2_id',$this->agent2_id,true);
		$criteria->compare('sales_team_name',$this->sales_team_name,true);
		$criteria->compare('agent2_name',$this->agent2_name,true);
		$criteria->compare('agent2_phone',$this->agent2_phone,true);
		$criteria->compare('office_number',$this->office_number,true);
		$criteria->compare('office_phone',$this->office_phone,true);
		$criteria->compare('agent_extension',$this->agent_extension,true);
		$criteria->compare('office_fax',$this->office_fax,true);
		$criteria->compare('office_name',$this->office_name,true);
		$criteria->compare('selling_agent_id',$this->selling_agent_id,true);
		$criteria->compare('selling_agent_name',$this->selling_agent_name,true);
		$criteria->compare('selling_agent2_id',$this->selling_agent2_id,true);
		$criteria->compare('selling_agent2_name',$this->selling_agent2_name,true);
		$criteria->compare('selling_agent2_office_id',$this->selling_agent2_office_id,true);
		$criteria->compare('selling_agent2_office_name',$this->selling_agent2_office_name,true);
		$criteria->compare('list_office2_number',$this->list_office2_number,true);
		$criteria->compare('list_office2_name',$this->list_office2_name,true);
		$criteria->compare('buyer_agent_comp',$this->buyer_agent_comp,true);
		$criteria->compare('non_rep_comp',$this->non_rep_comp,true);
		$criteria->compare('trans_broker_comp',$this->trans_broker_comp,true);
		$criteria->compare('interoffice_info',$this->interoffice_info,true);
		$criteria->compare('driving_directions',$this->driving_directions,true);
		$criteria->compare('realtor_only_remarks',$this->realtor_only_remarks,true);
		$criteria->compare('public_remarks',$this->public_remarks,true);
		$criteria->compare('additional_public_remarks',$this->additional_public_remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            )
		));
	}
	
	public function getPaidListing(){
		$criteria = new CDbCriteria;
		$criteria->addInCondition('land_status', array("APPROVED"=>"APPROVED","PAID"=>"PAID", "PENDING"=>"PENDING", "SOLD"=>"SOLD"));
		if(!Yii::app()->user->isAdmin())
			$criteria->compare('creator_id', Yii::app()->user->id);
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}
	
	public function beforeSave(){
		if($this->isNewRecord){
			$this->create_date = new CDbExpression("NOW()");
		}
		$this->update_date = new CDbExpression("NOW()");
		$this->listing_date = date("Y-m-d", strtotime($this->listing_date));
		$this->expiration_date = date("Y-m-d", strtotime($this->expiration_date));
		
		$count = count($this->utilities);
		if($count > 8) $this->addError('utilities', $this->getAttributeLabel('utilities') . " $count has selected");
		
		$count = count($this->site_improvements);
		if($count > 3) $this->addError('site_improvements', $this->getAttributeLabel('site_improvements') . " $count has selected");
		
		$count = count($this->ownership);
		if($count > 3) $this->addError('ownership', $this->getAttributeLabel('ownership') . " $count has selected");
		
		$count = count($this->fences);
		if($count > 3) $this->addError('fences', $this->getAttributeLabel('fences') . " $count has selected");
		
		$count = count($this->community_features);
		if($count > 25) $this->addError('community_features', $this->getAttributeLabel('community_features') . " $count has selected");

		$count = count($this->realtor_information);
		if($count > 25) $this->addError('realtor_information', $this->getAttributeLabel('realtor_information') . " $count has selected");
		
		$count = count($this->financing_available);
		if($count > 7) $this->addError('financing_available', $this->getAttributeLabel('financing_available') . " $count has selected");
		
		$count = count($this->realtor_information_confidential);
		if($count > 3) $this->addError('realtor_information_confidential', $this->getAttributeLabel('realtor_information_confidential') . " $count has selected");
		
		$count = count($this->showing_instruction);
		if($count > 13) $this->addError('showing_instruction', $this->getAttributeLabel('showing_instruction') . " $count has selected");
		
		if($this->hasErrors())
			return false;
				
		foreach($this->attributes as $key => $val){
			if(is_array($val)){
				$this->$key = implode(" | ", $val);
			}
		}
		return true;
	}
	
	public function checkStatus($button, $status){
		$arrStatus = array("INCOMPLETE", "COMPLETED", "APPROVED");
		switch($button){
			case "Changes":
				$visible = in_array($status, $arrStatus) ? false : true;
			break;
			case "Delete":
				$visible = in_array($status, $arrStatus) ? true : false;
			break;
		}
		return $visible;
	}
	
/*	public function defaultScope()
    {
		if(!Yii::app()->user->isAdmin())
			return array("condition"=>"creator_id='" . Yii::app()->user->id . "'");  
		else
			return array();
    }*/
}
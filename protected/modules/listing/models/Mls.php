<?php

/**
 * This is the model class for table "mls".
 *
 * The followings are the available columns in table 'mls':
 * @property integer $id
 * @property string $create_date
 * @property integer $creator_id
 * @property string $update_date
 * @property integer $updator_id
 * @property string $list_price
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip_code
 * @property string $county
 * @property string $home_phone
 * @property string $mobile_phone
 * @property string $email
 * @property string $billing_address
 * @property string $billing_city
 * @property string $billing_state
 * @property string $billing_zip_code
 * @property string $zip_plus
 * @property string $unit_number
 * @property string $condo_floor_number
 * @property string $building_number_floors
 * @property string $building_name_number
 * @property string $floors_in_unit
 * @property string $total_units
 * @property string $millage_rate
 * @property integer $year_built
 * @property string $tax_id
 * @property string $taxes
 * @property integer $tax_year
 * @property string $section
 * @property string $township
 * @property string $range
 * @property string $subdivision_number
 * @property string $block_parcel
 * @property string $lot_number
 * @property string $subdivision_section_number
 * @property string $legal_description
 * @property string $legal_subdivision_name
 * @property string $zoning
 * @property string $plat_book_page
 * @property string $future_land_use
 * @property string $complex_community_name
 * @property string $property_style
 * @property integer $bedrooms
 * @property integer $full_baths
 * @property integer $half_baths
 * @property integer $sq_ft_heated
 * @property integer $total_building_sq_ft
 * @property string $sq_ft_source
 * @property string $ownership_max
 * @property string $cdd_yn
 * @property string $annual_cdd_fee
 * @property string $additional_parcel_yn
 * @property string $homestead_yn
 * @property string $other_exemptions_yn
 * @property string $home_features_max
 * @property string $lot_dimensions
 * @property integer $lot_size_sq_ft
 * @property integer $lot_size_acre
 * @property string $total_acreage
 * @property string $location_max
 * @property string $front_exposure
 * @property string $utilities_data_max
 * @property string $water_access_yn
 * @property string $water_access
 * @property string $water_view_yn
 * @property string $water_view
 * @property string $water_frontage_yn
 * @property string $water_frontage
 * @property string $new_construction_yn
 * @property string $construction_status
 * @property string $projected_completion_date
 * @property string $private_pool_yn
 * @property string $pool_type_max
 * @property string $property_description
 * @property string $foundation_max
 * @property string $exterior_construction_max
 * @property string $roof_max
 * @property string $exterior_features_max
 * @property string $garage_carport_max
 * @property string $garage_features_max
 * @property string $garage_dimensions
 * @property string $architectural_style_max
 * @property string $community_features_max
 * @property string $hoa_community_association
 * @property string $hoa_fee
 * @property string $hoa_payment_schedule
 * @property double $monthly_maintainance_addition_to_hoa
 * @property string $pets_allowed_yn
 * @property string $pet_restrictions_yn
 * @property string $elementary_school
 * @property string $middle_school
 * @property string $high_school
 * @property string $living_room
 * @property string $dining_room
 * @property string $family_room
 * @property string $great_room
 * @property string $kitchen
 * @property string $master_bedroom_size
 * @property string $bedroom_2nd_size
 * @property string $bedroom_3rd_size
 * @property string $bedroom_4th_size
 * @property string $bedroom_5th_size
 * @property string $study_den_dimensions
 * @property string $balcony_porch_lanai
 * @property string $dinette
 * @property string $studio_dimensions
 * @property string $additional_rooms_max
 * @property string $air_conditioning_max
 * @property string $heating_and_fuel_max
 * @property string $appliances_included_max
 * @property string $interior_layout_max
 * @property string $interior_features_max
 * @property string $master_bath_features_max
 * @property string $security_system
 * @property string $floor_covering_max
 * @property string $kitchen_features_max
 * @property string $fireplace_yn
 * @property string $fireplace_description_max
 * @property string $financing_available_max
 * @property string $realtor_information_max
 * @property string $realtor_information_confidential_max
 * @property string $special_sale_provision
 * @property string $showing_instructions_max
 * @property string $showing_time_secure_remarks
 * @property string $virtual_tour_link
 * @property string $internet_yn
 * @property string $display_property_address_on_internet_yn
 * @property string $driving_direction
 * @property string $realtor_only_remarks
 * @property string $public_remarks
 * @property string $pay_broker_percentage
 * @property string $photo_1
 * @property string $photo_2
 * @property string $photo_3
 * @property string $photo_4
 * @property string $photo_5
 * @property string $photo_6
 * @property string $photo_7
 * @property string $photo_8
 * @property string $photo_9
 * @property string $photo_10
 * @property string $photo_11
 * @property string $photo_12
 * @property integer $agreed
 * @property string $list_status
 * @property string $paypal_trans_id
 */
class Mls extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Mls the static model class
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
		return 'mls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
			'
				creator_id, 
				updator_id, 
				list_price, 
				name, 
				address, 
				city, 
				state, 
				zip_code,
				county, 
				home_phone, 
				email, 
				year_built, 
				tax_id, 
				taxes, 
				tax_year,
				subdivision_number, 
				legal_description, 
				legal_subdivision_name, 
				zoning,
				property_style, 
				bedrooms, 
				full_baths, 
				half_baths, 
				sq_ft_heated, 
				sq_ft_source, 
				ownership_max, 
				cdd_yn, 
				additional_parcel_yn, 
				homestead_yn, 
				total_acreage, 
				location_max, 
				utilities_data_max, 
				new_construction_yn, 
				private_pool_yn, 
				foundation_max, 
				exterior_construction_max, 
				roof_max, 
				exterior_features_max, 
				garage_carport_max, 
				garage_features_max, 
				pets_allowed_yn, 
				living_room, 
				kitchen, 
				master_bedroom_size, 
				air_conditioning_max, 
				heating_and_fuel_max, 
				appliances_included_max, 
				interior_features_max, 
				floor_covering_max, 
				fireplace_yn, 
				special_sale_provision, 
				showing_instructions_max, 
				internet_yn, 
				display_property_address_on_internet_yn, 
				driving_direction, 
				public_remarks, 
				pay_broker_percentage,
				housing_for_elders,
				lot_size_sq_ft,
				lot_size_acre,
				property_description
				', 
				'required'
				),
			array('', 'required', 'on'=>'search'),
			array(
				'
				creator_id, 
				updator_id, 
				bedrooms, 
				full_baths, 
				half_baths, 
				sq_ft_heated, 
				total_building_sq_ft,
				housing_for_elders, 
				', 
				'numerical', 'integerOnly'=>true
				),
			array(
				'
				monthly_maintainance_addition_to_hoa
				', 
				'numerical'
				),
			//array('list_price, taxes', 'length', 'max'=>15),
			array(
				'
				name, 
				city, 
				county, 
				billing_city, 
				building_name_number, 
				section, 
				township, 
				range, 
				legal_subdivision_name, 
				plat_book_page, 
				future_land_use, 
				complex_community_name, 
				elementary_school, 
				middle_school, 
				high_school,
				pay_broker_percentage,
				list_status,
				paypal_trans_id
				', 
				'length', 'max'=>50
				),
			array(
				'
				address, 
				billing_address
				', 
				'length', 'max'=>100
				),
			array(
				'
				state, 
				billing_state, 
				', 
				'length', 'max'=>2
				),
			array(
				'
				zip_code, 
				billing_zip_code, 
				zip_plus, 
				unit_number, 
				condo_floor_number, 
				building_number_floors, 
				floors_in_unit, 
				total_units, 
				millage_rate, 
				subdivision_number, 
				subdivision_section_number,
                                dump_id
				', 
				'length', 'max'=>10
				),
			array(
				'
				home_phone, 
				mobile_phone, 
				lot_dimensions, 
				garage_dimensions, 
				living_room, 
				dining_room, 
				family_room, 
				great_room, 
				kitchen, 
				master_bedroom_size, 
				bedroom_2nd_size, 
				bedroom_3rd_size, 
				bedroom_4th_size, 
				bedroom_5th_size, 
				study_den_dimensions, 
				balcony_porch_lanai, 
				dinette, 
				studio_dimensions,
				lot_size_sq_ft,
				lot_size_acre
				', 
				'length', 'max'=>20
				),
			array(
				'
				garage_dimensions, 
				living_room, 
				dining_room, 
				family_room, 
				great_room, 
				kitchen, 
				master_bedroom_size, 
				bedroom_2nd_size, 
				bedroom_3rd_size, 
				bedroom_4th_size, 
				bedroom_5th_size, 
				study_den_dimensions, 
				balcony_porch_lanai, 
				dinette, 
				studio_dimensions
				', 
				'match', 'pattern'=>'/^[0-9]+x[0-9]+$/'
				),
			array(
				'home_phone, mobile_phone', 'match', 'pattern' =>'/^([0-9]{3})\-*?([0-9]{3})\-*?([0-9]{4})$/',
				),
			array(
				'lot_dimensions', 'match', 'pattern' => '/^[0-9]{2,3}x[0-9]{2,3}((x[0-9]{2,3}){2}){0,1}$/'
				),
			array(
				'pay_broker_percentage', 'match', 'pattern' =>'/^([0-9]{1,3}(\.[0-9]+)*\%|\$[0-9]+)$/',
				),
			array(
				'lot_size_acre', 'match', 'pattern' => '/^\.[0-9]{3,}$/',
				),
			array(
				'
				email, 
				legal_description, 
				virtual_tour_link, 
				driving_direction, 
				photo_1, 
				photo_2, 
				photo_3, 
				photo_4, 
				photo_5, 
				photo_6, 
				photo_7, 
				photo_8, 
				photo_9, 
				photo_10, 
				photo_11, 
				photo_12
				', 
				'length', 'max'=>255
				),
			array(
				'
				tax_id, 
				block_parcel, 
				lot_number, 
				zoning
				', 
				'length', 'max'=>30
				),
			array(
				'
				cdd_yn, 
				additional_parcel_yn, 
				homestead_yn, 
				other_exemptions_yn, 
				water_access_yn, 
				water_view_yn, 
				water_frontage_yn, 
				new_construction_yn, 
				private_pool_yn, 
				pets_allowed_yn, 
				pet_restrictions_yn, 
				fireplace_yn, 
				internet_yn, 
				display_property_address_on_internet_yn
				', 
				'length', 'max'=>1
				),
			array('annual_cdd_fee, hoa_fee', 'length', 'max'=>12),
			array('realtor_only_remarks', 'length', 'max'=>455),
			array('public_remarks', 'length', 'max'=>1530),
			array(
				'
				home_features_max,
				section,
				township,
				range,
				plat_book_page,
				water_access, 
				water_view, 
				water_frontage, 
				projected_completion_date, 
				pool_type_max, 
				property_description, 
				architectural_style_max, 
				additional_rooms_max, 
				interior_layout_max, 
				master_bath_features_max, 
				security_system, 
				kitchen_features_max, 
				fireplace_description_max, 
				financing_available_max, 
				realtor_information_max, 
				realtor_information_confidential_max, 
				showing_time_secure_remarks,
				hoa_community_association,
				front_exposure,
				community_features_max, 
				construction_status
				', 
				'safe'
				),

			// custom
			array('list_price,taxes','length','max'=>15),
			array('list_price,taxes','numerical','min'=>1),
			array('email','email','checkMX'=>true),
			array('year_built,tax_year','numerical','integerOnly'=>true,'min'=>1900,'max'=>date('Y')),
			// end of custom				
				
				
				
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, create_date, creator_id, list_price, name, address, city, state, zip_code, county, home_phone, mobile_phone, email, billing_address, billing_city, billing_state, billing_zip_code, zip_plus, unit_number, condo_floor_number, building_number_floors, building_name_number, floors_in_unit, total_units, millage_rate, year_built, tax_id, taxes, tax_year, section, township, range, subdivision_number, block_parcel, lot_number, subdivision_section_number, legal_description, legal_subdivision_name, zoning, plat_book_page, future_land_use, complex_community_name, property_style, bedrooms, full_baths, half_baths, sq_ft_heated, total_building_sq_ft, sq_ft_source, ownership_max, cdd_yn, annual_cdd_fee, additional_parcel_yn, homestead_yn, other_exemptions_yn, home_features_max, lot_dimensions, lot_size_sq_ft, lot_size_acre, total_acreage, location_max, front_exposure, utilities_data_max, water_access_yn, water_access, water_view_yn, water_view, water_frontage_yn, water_frontage, new_construction_yn, construction_status, projected_completion_date, private_pool_yn, pool_type_max, property_description, foundation_max, exterior_construction_max, roof_max, exterior_features_max, garage_carport_max, garage_features_max, garage_dimensions, architectural_style_max, community_features_max, hoa_community_association, hoa_fee, hoa_payment_schedule, monthly_maintainance_addition_to_hoa, pets_allowed_yn, pet_restrictions_yn, elementary_school, middle_school, high_school, living_room, dining_room, family_room, great_room, kitchen, master_bedroom_size, bedroom_2nd_size, bedroom_3rd_size, bedroom_4th_size, bedroom_5th_size, study_den_dimensions, balcony_porch_lanai, dinette, studio_dimensions, additional_rooms_max, air_conditioning_max, heating_and_fuel_max, appliances_included_max, interior_layout_max, interior_features_max, master_bath_features_max, security_system, floor_covering_max, kitchen_features_max, fireplace_yn, fireplace_description_max, financing_available_max, realtor_information_max, realtor_information_confidential_max, special_sale_provision, showing_instructions_max, showing_time_secure_remarks, virtual_tour_link, internet_yn, display_property_address_on_internet_yn, driving_direction, realtor_only_remarks, public_remarks, pay_broker_percentage, photo_1, photo_2, photo_3, photo_4, photo_5, photo_6, photo_7, photo_8, photo_9, photo_10, photo_11, photo_12, agreed,list_status,paypal_trans_id,housing_for_elders', 'safe', 'on'=>'search'),
		);
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_date' => 'Created',
			'creator_id' => 'Creator',
			'update_date' => 'Last Update',
			'updator_id' => 'Updator',
			'list_price' => 'List Price ($)',
			'name' => 'Name',
			'address' => 'Address',
			'city' => 'City',
			'state' => 'State',
			'zip_code' => 'Zip Code',
			'county' => 'County',
			'home_phone' => 'Home Phone',
			'mobile_phone' => 'Mobile Phone',
			'email' => 'Email',
			'billing_address' => 'Billing Address',
			'billing_city' => 'Billing City',
			'billing_state' => 'Billing State',
			'billing_zip_code' => 'Billing Zip Code',
			'zip_plus' => 'Zip Plus',
			'unit_number' => 'Unit #',
			'condo_floor_number' => 'Condo Floor #',
			'building_number_floors' => 'Building # Floors',
			'building_name_number' => 'Building Name #',
			'floors_in_unit' => 'Floors In Unit',
			'total_units' => 'Total Units',
			'millage_rate' => 'Millage Rate',
			'year_built' => 'Year Built',
			'tax_id' => 'Tax ID',
			'taxes' => 'Taxes ($)',
			'tax_year' => 'Tax Year',
			'section' => 'Section',
			'township' => 'Township',
			'range' => 'Range',
			'subdivision_number' => 'Subdivision #',
			'block_parcel' => 'Block / Parcel',
			'lot_number' => 'Lot #',
			'subdivision_section_number' => 'Subdivision Section Number',
			'legal_description' => 'Legal Description (255 characters)',
			'legal_subdivision_name' => 'Legal Subdivision Name',
			'zoning' => 'Zoning',
			'plat_book_page' => 'Plat Book / Page',
			'future_land_use' => 'Future Land Use',
			'complex_community_name' => 'Complex / Community Name / NCCB',
			'property_style' => 'Property Style',
			'bedrooms' => 'Bedrooms',
			'full_baths' => 'Full Baths',
			'half_baths' => 'Half Baths',
			'sq_ft_heated' => 'Sq. Ft. Heated',
			'total_building_sq_ft' => 'Total Building Sq. Ft.',
			'sq_ft_source' => 'Sq. Ft. Source',
			'ownership_max' => 'Ownership (4 Max)',
			'cdd_yn' => 'CDD Y/N',
			'annual_cdd_fee' => 'Annual CDD Fee ($)',
			'additional_parcel_yn' => 'Additional Parcel Y/N',
			'homestead_yn' => 'Homestead Y/N',
			'other_exemptions_yn' => 'Other Exemptions Y/N',
			'home_features_max' => 'Home Features (4 Max)',
			'lot_dimensions' => 'Lot Dimensions',
			'lot_size_sq_ft' => 'Lot Size Sq. Ft.',
			'lot_size_acre' => 'Lot Size Acre',
			'total_acreage' => 'Total Acreage',
			'location_max' => 'Location (10 Max)',
			'front_exposure' => 'Front Exposure',
			'utilities_data_max' => 'Utilities Data (10 Max)',
			'water_access_yn' => 'Water Access Y/N',
			'water_access' => 'Water Access',
			'water_view_yn' => 'Water View Y/N',
			'water_view' => 'Water View',
			'water_frontage_yn' => 'Water Frontage Y/N',
			'water_frontage' => 'Water Frontage',
			'new_construction_yn' => 'New Construction Y/N',
			'construction_status' => 'Construction Status',
			'projected_completion_date' => 'Projected Completion Date',
			'private_pool_yn' => 'Private Pool Y/N',
			'pool_type_max' => 'Pool Type (8 Max)',
			'property_description' => 'Property Description',
			'foundation_max' => 'Foundation (3 Max)',
			'exterior_construction_max' => 'Exterior Construction (5 Max)',
			'roof_max' => 'Roof (3 Max)',
			'exterior_features_max' => 'Exterior Features (12 Max)',
			'garage_carport_max' => 'Garage / Carport (3 Max)',
			'garage_features_max' => 'Garage Features (10 Max)',
			'garage_dimensions' => 'Garage Dimensions',
			'architectural_style_max' => 'Architectural Style (6 Max)',
			'community_features_max' => 'Community Features (25 Max)',
			'hoa_community_association' => 'HOA / Community Association',
			'hoa_fee' => 'HOA Fee ($)',
			'hoa_payment_schedule' => 'HOA Payment Schedule',
			'monthly_maintainance_addition_to_hoa' => 'Monthly Maintainance (Addition To HOA)',
			'pets_allowed_yn' => 'Pets Allowed Y/N',
			'pet_restrictions_yn' => 'Pet Restrictions Y/N',
			'elementary_school' => 'Elementary School',
			'middle_school' => 'Middle School',
			'high_school' => 'High School',
			'living_room' => 'Living Room',
			'dining_room' => 'Dining Room',
			'family_room' => 'Family Room',
			'great_room' => 'Great Room',
			'kitchen' => 'Kitchen',
			'master_bedroom_size' => 'Master Bedroom Size',
			'bedroom_2nd_size' => 'Bedroom 2nd Size',
			'bedroom_3rd_size' => 'Bedroom 3rd Size',
			'bedroom_4th_size' => 'Bedroom 4th Size',
			'bedroom_5th_size' => 'Bedroom 5th Size',
			'study_den_dimensions' => 'Study / Den Dimensions',
			'balcony_porch_lanai' => 'Balcony / Porch Lanai',
			'dinette' => 'Dinette',
			'studio_dimensions' => 'Studio Dimensions',
			'additional_rooms_max' => 'Additional Rooms (9 Max)',
			'air_conditioning_max' => 'Air Conditioning (2 Max)',
			'heating_and_fuel_max' => 'Heating And Fuel (6 Max)',
			'appliances_included_max' => 'Appliances Included (13 Max)',
			'interior_layout_max' => 'Interior Layout (7 Max)',
			'interior_features_max' => 'Interior Features (14 Max)',
			'master_bath_features_max' => 'Master Bath Features (4 Max)',
			'security_system' => 'Security System',
			'floor_covering_max' => 'Floor Covering (6 Max)',
			'kitchen_features_max' => 'Kitchen Features (5 Max)',
			'fireplace_yn' => 'Fireplace Y/N',
			'fireplace_description_max' => 'Fireplace Description (5 Max)',
			'financing_available_max' => 'Financing Available (10 Max)',
			'realtor_information_max' => 'Realtor Information (25 Max)',
			'realtor_information_confidential_max' => 'Realtor Information (Confidential) 7 Max',
			'special_sale_provision' => 'Special Sale Provision',
			'showing_instructions_max' => 'Showing Instructions (16 Max)',
			'showing_time_secure_remarks' => 'Showing Time Secure Remarks',
			'virtual_tour_link' => 'Virtual Tour Link',
			'internet_yn' => 'Internet Y/N',
			'display_property_address_on_internet_yn' => 'Display Property Address On Internet Y/N',
			'driving_direction' => 'Driving Direction',
			'realtor_only_remarks' => 'Realtor Only Remarks',
			'public_remarks' => 'Public Remarks',
			'pay_broker_percentage' => 'Buyers Agent Compensate',
			'photo_1' => 'Photo 1',
			'photo_2' => 'Photo 2',
			'photo_3' => 'Photo 3',
			'photo_4' => 'Photo 4',
			'photo_5' => 'Photo 5',
			'photo_6' => 'Photo 6',
			'photo_7' => 'Photo 7',
			'photo_8' => 'Photo 8',
			'photo_9' => 'Photo 9',
			'photo_10' => 'Photo 10',
			'photo_11' => 'Photo 11',
			'photo_12' => 'Photo 12',
			'agreed' => 'Agreed',
			'list_status' => 'List Status',
			'paypal_trans_id' => 'Payment Transaction ID',
			'dump_id' => 'List Dump ID',
			'housing_for_elders' => 'Housing for Older Persons'
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
			$criteria->compare('list_status',$this->list_status);
		}
		else{
			$criteria->compare('creator_id', Yii::app()->user->id);
			$criteria->compare('updator_id', $this->updator_id);
			$criteria->addNotInCondition('list_status', array('SOLD'));
		}
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('list_price',$this->list_price,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('billing_address',$this->billing_address,true);
		$criteria->compare('billing_city',$this->billing_city,true);
		$criteria->compare('billing_state',$this->billing_state,true);
		$criteria->compare('billing_zip_code',$this->billing_zip_code,true);
		$criteria->compare('zip_plus',$this->zip_plus,true);
		$criteria->compare('unit_number',$this->unit_number,true);
		$criteria->compare('condo_floor_number',$this->condo_floor_number,true);
		$criteria->compare('building_number_floors',$this->building_number_floors,true);
		$criteria->compare('building_name_number',$this->building_name_number,true);
		$criteria->compare('floors_in_unit',$this->floors_in_unit,true);
		$criteria->compare('total_units',$this->total_units,true);
		$criteria->compare('millage_rate',$this->millage_rate,true);
		$criteria->compare('year_built',$this->year_built);
		$criteria->compare('tax_id',$this->tax_id,true);
		$criteria->compare('taxes',$this->taxes,true);
		$criteria->compare('tax_year',$this->tax_year);
		$criteria->compare('section',$this->section,true);
		$criteria->compare('township',$this->township,true);
		$criteria->compare('range',$this->range,true);
		$criteria->compare('subdivision_number',$this->subdivision_number,true);
		$criteria->compare('block_parcel',$this->block_parcel,true);
		$criteria->compare('lot_number',$this->lot_number,true);
		$criteria->compare('subdivision_section_number',$this->subdivision_section_number,true);
		$criteria->compare('legal_description',$this->legal_description,true);
		$criteria->compare('legal_subdivision_name',$this->legal_subdivision_name,true);
		$criteria->compare('zoning',$this->zoning,true);
		$criteria->compare('plat_book_page',$this->plat_book_page,true);
		$criteria->compare('future_land_use',$this->future_land_use,true);
		$criteria->compare('complex_community_name',$this->complex_community_name,true);
		$criteria->compare('property_style',$this->property_style,true);
		$criteria->compare('bedrooms',$this->bedrooms);
		$criteria->compare('full_baths',$this->full_baths);
		$criteria->compare('half_baths',$this->half_baths);
		$criteria->compare('sq_ft_heated',$this->sq_ft_heated);
		$criteria->compare('total_building_sq_ft',$this->total_building_sq_ft);
		$criteria->compare('sq_ft_source',$this->sq_ft_source,true);
		$criteria->compare('ownership_max',$this->ownership_max,true);
		$criteria->compare('cdd_yn',$this->cdd_yn,true);
		$criteria->compare('annual_cdd_fee',$this->annual_cdd_fee,true);
		$criteria->compare('additional_parcel_yn',$this->additional_parcel_yn,true);
		$criteria->compare('homestead_yn',$this->homestead_yn,true);
		$criteria->compare('other_exemptions_yn',$this->other_exemptions_yn,true);
		$criteria->compare('home_features_max',$this->home_features_max,true);
		$criteria->compare('lot_dimensions',$this->lot_dimensions,true);
		$criteria->compare('lot_size_sq_ft',$this->lot_size_sq_ft);
		$criteria->compare('lot_size_acre',$this->lot_size_acre);
		$criteria->compare('total_acreage',$this->total_acreage,true);
		$criteria->compare('location_max',$this->location_max,true);
		$criteria->compare('front_exposure',$this->front_exposure,true);
		$criteria->compare('utilities_data_max',$this->utilities_data_max,true);
		$criteria->compare('water_access_yn',$this->water_access_yn,true);
		$criteria->compare('water_access',$this->water_access,true);
		$criteria->compare('water_view_yn',$this->water_view_yn,true);
		$criteria->compare('water_view',$this->water_view,true);
		$criteria->compare('water_frontage_yn',$this->water_frontage_yn,true);
		$criteria->compare('water_frontage',$this->water_frontage,true);
		$criteria->compare('new_construction_yn',$this->new_construction_yn,true);
		$criteria->compare('construction_status',$this->construction_status,true);
		$criteria->compare('projected_completion_date',$this->projected_completion_date,true);
		$criteria->compare('private_pool_yn',$this->private_pool_yn,true);
		$criteria->compare('pool_type_max',$this->pool_type_max,true);
		$criteria->compare('property_description',$this->property_description,true);
		$criteria->compare('foundation_max',$this->foundation_max,true);
		$criteria->compare('exterior_construction_max',$this->exterior_construction_max,true);
		$criteria->compare('roof_max',$this->roof_max,true);
		$criteria->compare('exterior_features_max',$this->exterior_features_max,true);
		$criteria->compare('garage_carport_max',$this->garage_carport_max,true);
		$criteria->compare('garage_features_max',$this->garage_features_max,true);
		$criteria->compare('garage_dimensions',$this->garage_dimensions,true);
		$criteria->compare('architectural_style_max',$this->architectural_style_max,true);
		$criteria->compare('community_features_max',$this->community_features_max,true);
		$criteria->compare('hoa_community_association',$this->hoa_community_association,true);
		$criteria->compare('hoa_fee',$this->hoa_fee,true);
		$criteria->compare('hoa_payment_schedule',$this->hoa_payment_schedule,true);
		$criteria->compare('monthly_maintainance_addition_to_hoa',$this->monthly_maintainance_addition_to_hoa);
		$criteria->compare('pets_allowed_yn',$this->pets_allowed_yn,true);
		$criteria->compare('pet_restrictions_yn',$this->pet_restrictions_yn,true);
		$criteria->compare('elementary_school',$this->elementary_school,true);
		$criteria->compare('middle_school',$this->middle_school,true);
		$criteria->compare('high_school',$this->high_school,true);
		$criteria->compare('living_room',$this->living_room,true);
		$criteria->compare('dining_room',$this->dining_room,true);
		$criteria->compare('family_room',$this->family_room,true);
		$criteria->compare('great_room',$this->great_room,true);
		$criteria->compare('kitchen',$this->kitchen,true);
		$criteria->compare('master_bedroom_size',$this->master_bedroom_size,true);
		$criteria->compare('bedroom_2nd_size',$this->bedroom_2nd_size,true);
		$criteria->compare('bedroom_3rd_size',$this->bedroom_3rd_size,true);
		$criteria->compare('bedroom_4th_size',$this->bedroom_4th_size,true);
		$criteria->compare('bedroom_5th_size',$this->bedroom_5th_size,true);
		$criteria->compare('study_den_dimensions',$this->study_den_dimensions,true);
		$criteria->compare('balcony_porch_lanai',$this->balcony_porch_lanai,true);
		$criteria->compare('dinette',$this->dinette,true);
		$criteria->compare('studio_dimensions',$this->studio_dimensions,true);
		$criteria->compare('additional_rooms_max',$this->additional_rooms_max,true);
		$criteria->compare('air_conditioning_max',$this->air_conditioning_max,true);
		$criteria->compare('heating_and_fuel_max',$this->heating_and_fuel_max,true);
		$criteria->compare('appliances_included_max',$this->appliances_included_max,true);
		$criteria->compare('interior_layout_max',$this->interior_layout_max,true);
		$criteria->compare('interior_features_max',$this->interior_features_max,true);
		$criteria->compare('master_bath_features_max',$this->master_bath_features_max,true);
		$criteria->compare('security_system',$this->security_system,true);
		$criteria->compare('floor_covering_max',$this->floor_covering_max,true);
		$criteria->compare('kitchen_features_max',$this->kitchen_features_max,true);
		$criteria->compare('fireplace_yn',$this->fireplace_yn,true);
		$criteria->compare('fireplace_description_max',$this->fireplace_description_max,true);
		$criteria->compare('financing_available_max',$this->financing_available_max,true);
		$criteria->compare('realtor_information_max',$this->realtor_information_max,true);
		$criteria->compare('realtor_information_confidential_max',$this->realtor_information_confidential_max,true);
		$criteria->compare('special_sale_provision',$this->special_sale_provision,true);
		$criteria->compare('showing_instructions_max',$this->showing_instructions_max,true);
		$criteria->compare('showing_time_secure_remarks',$this->showing_time_secure_remarks,true);
		$criteria->compare('virtual_tour_link',$this->virtual_tour_link,true);
		$criteria->compare('internet_yn',$this->internet_yn,true);
		$criteria->compare('display_property_address_on_internet_yn',$this->display_property_address_on_internet_yn,true);
		$criteria->compare('driving_direction',$this->driving_direction,true);
		$criteria->compare('realtor_only_remarks',$this->realtor_only_remarks,true);
		$criteria->compare('public_remarks',$this->public_remarks,true);
		$criteria->compare('pay_broker_percentage',$this->pay_broker_percentage,true);
		$criteria->compare('photo_1',$this->photo_1,true);
		$criteria->compare('photo_2',$this->photo_2,true);
		$criteria->compare('photo_3',$this->photo_3,true);
		$criteria->compare('photo_4',$this->photo_4,true);
		$criteria->compare('photo_5',$this->photo_5,true);
		$criteria->compare('photo_6',$this->photo_6,true);
		$criteria->compare('photo_7',$this->photo_7,true);
		$criteria->compare('photo_8',$this->photo_8,true);
		$criteria->compare('photo_9',$this->photo_9,true);
		$criteria->compare('photo_10',$this->photo_10,true);
		$criteria->compare('photo_11',$this->photo_11,true);
		$criteria->compare('photo_12',$this->photo_12,true);
		$criteria->compare('agreed',$this->agreed);
		$criteria->compare('list_status',$this->list_status);
		$criteria->compare('paypal_trans_id',$this->paypal_trans_id);
		$criteria->compare('dump_id',$this->dump_id);
		$criteria->compare('housing_for_elders',$this->housing_for_elders);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            )
		));
	}
	
	public function getPaidListing(){
		$criteria = new CDbCriteria;
		$criteria->addInCondition('list_status', array("APPROVED", "PAID", "PENDING", "SOLD"));
		if(!Yii::app()->user->isAdmin())
			$criteria->compare('creator_id', Yii::app()->user->id);
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria,'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            )));
	}
	
	public function getPaidList(){
		$criteria = new CDbCriteria;
		$criteria->compare('list_status', array("PENDING","PAID"));
		if(!Yii::app()->user->isAdmin())
			$criteria->compare('creator_id', Yii::app()->user->id);
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria, 'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            )));
	}
	
	public function getPendingList(){
		$criteria = new CDbCriteria;
		$criteria->compare('list_status', "PENDING");
		if(!Yii::app()->user->isAdmin())
			$criteria->compare('creator_id', Yii::app()->user->id);
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria));
	}
	
	// extra
	
	public function scopes()
    {
        return array(
            'ipn'=>array(
                'condition'=>'list_status="APPROVED"',
            ),
            'owner'=>array(
                'condition'=>'creator_id="' . Yii::app()->user->id  . '"',
            ),
        );
    }	
	
/*	public function defaultScope()
    {
		if(!Yii::app()->user->isAdmin())
			return array("condition"=>"creator_id='" . Yii::app()->user->id . "'");  
		else
			return array();
    }*/
	
/*	public function beforeDelete()
	{
		if(!app()->user->isAdmin())
		{
			if($this->creator_id !== app()->user->id || $this->updator_id !== app()->user->id)
			{
				$this->addError('','Not authorized');
			}
			
			if($this->hasErrors())
				return false;	
		}
		return true;
	}
*/	
	/*public function afterSave() 
	{
		app()->controller->redirect(array('/paypal/default/index', 'id'=>$this->id));	
		app()->request->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UCF6BSJN7PGJA');	
		return true;
	}*/

	public function beforeSave() 
	{

		/*if(!app()->user->isAdmin())
		{
			if(($this->creator_id !== app()->user->id || $this->updator_id !== app()->user->id) && !empty($this->id))
			{
				$this->addError('','Not authorized');
			}
			
			if($this->hasErrors())
				return false;	
		}*/
		
		if($this->isNewRecord)
			$this->create_date = new CDbExpression('NOW()');
			
		$this->update_date = new CDbExpression('NOW()');
		
		if(!empty($this->projected_completion_date))
			$this->projected_completion_date = date('Y-m-d', strtotime($this->projected_completion_date));

		$selected = count($this->ownership_max); 
		if($selected > 4) $this->addError('ownership_max',$this->getAttributeLabel('ownership_max') . ': ' . $selected . ' selected ');

		$selected = count($this->home_features_max); 
		if($selected > 4) $this->addError('home_features_max',$this->getAttributeLabel('home_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->location_max); 
		if($selected > 10) $this->addError('location_max',$this->getAttributeLabel('location_max') . ': ' . $selected . ' selected ');

		$selected = count($this->utilities_data_max); 
		if($selected > 10) $this->addError('utilities_data_max',$this->getAttributeLabel('utilities_data_max') . ': ' . $selected . ' selected ');

		$selected = count($this->pool_type_max); 
		if($selected > 8) $this->addError('pool_type_max',$this->getAttributeLabel('pool_type_max') . ': ' . $selected . ' selected ');

		$selected = count($this->foundation_max); 
		if($selected > 3) $this->addError('foundation_max',$this->getAttributeLabel('foundation_max') . ': ' . $selected . ' selected ');

		$selected = count($this->exterior_construction_max); 
		if($selected > 5) $this->addError('exterior_construction_max',$this->getAttributeLabel('exterior_construction_max') . ': ' . $selected . ' selected ');

		$selected = count($this->roof_max); 
		if($selected > 3) $this->addError('roof_max',$this->getAttributeLabel('roof_max') . ': ' . $selected . ' selected ');

		$selected = count($this->exterior_features_max); 
		if($selected > 12) $this->addError('exterior_features_max',$this->getAttributeLabel('exterior_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->garage_carport_max); 
		if($selected > 3) $this->addError('garage_carport_max',$this->getAttributeLabel('garage_carport_max') . ': ' . $selected . ' selected ');

		$selected = count($this->garage_features_max); 
		if($selected > 10) $this->addError('garage_features_max',$this->getAttributeLabel('garage_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->architectural_style_max); 
		if($selected > 6) $this->addError('architectural_style_max',$this->getAttributeLabel('architectural_style_max') . ': ' . $selected . ' selected ');

		$selected = count($this->community_features_max); 
		if($selected > 25) $this->addError('community_features_max',$this->getAttributeLabel('community_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->additional_rooms_max); 
		if($selected > 9) $this->addError('additional_rooms_max',$this->getAttributeLabel('additional_rooms_max') . ': ' . $selected . ' selected ');

		$selected = count($this->air_conditioning_max); 
		if($selected > 2) $this->addError('air_conditioning_max',$this->getAttributeLabel('air_conditioning_max') . ': ' . $selected . ' selected ');

		$selected = count($this->heating_and_fuel_max); 
		if($selected > 6) $this->addError('heating_and_fuel_max',$this->getAttributeLabel('heating_and_fuel_max') . ': ' . $selected . ' selected ');

		$selected = count($this->appliances_included_max); 
		if($selected > 13) $this->addError('appliances_included_max',$this->getAttributeLabel('appliances_included_max') . ': ' . $selected . ' selected ');

		$selected = count($this->interior_layout_max); 
		if($selected > 7) $this->addError('interior_layout_max',$this->getAttributeLabel('interior_layout_max') . ': ' . $selected . ' selected ');

		$selected = count($this->interior_features_max); 
		if($selected > 14) $this->addError('interior_features_max',$this->getAttributeLabel('interior_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->master_bath_features_max); 
		if($selected > 4) $this->addError('master_bath_features_max',$this->getAttributeLabel('master_bath_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->floor_covering_max); 
		if($selected > 6) $this->addError('floor_covering_max',$this->getAttributeLabel('floor_covering_max') . ': ' . $selected . ' selected ');

		$selected = count($this->kitchen_features_max); 
		if($selected > 5) $this->addError('kitchen_features_max',$this->getAttributeLabel('kitchen_features_max') . ': ' . $selected . ' selected ');

		$selected = count($this->fireplace_description_max); 
		if($selected > 5) $this->addError('fireplace_description_max',$this->getAttributeLabel('fireplace_description_max') . ': ' . $selected . ' selected ');

		$selected = count($this->financing_available_max); 
		if($selected > 10) $this->addError('financing_available_max',$this->getAttributeLabel('financing_available_max') . ': ' . $selected . ' selected ');

		$selected = count($this->realtor_information_max); 
		if($selected > 25) $this->addError('realtor_information_max',$this->getAttributeLabel('realtor_information_max') . ': ' . $selected . ' selected ');

		$selected = count($this->realtor_information_confidential_max); 
		if($selected > 25) $this->addError('realtor_information_confidential_max',$this->getAttributeLabel('realtor_information_confidential_max') . ': ' . $selected . ' selected ');

		$selected = count($this->showing_instructions_max); 
		if($selected > 16) $this->addError('showing_instructions_max',$this->getAttributeLabel('showing_instructions_max') . ': ' . $selected . ' selected ');

		//if(!$this->agreed) $this->addError('agreed','Please check ' . $this->getAttributeLabel('agreed') . '  to continue');
		
		if($this->hasErrors())
			return false;
		
		foreach($this->attributes as $key => $value)
		{
			if(is_array($value))
			{
				$this->$key = implode(" | ",$value);
			}
		}		
		
 		// die( $this->usr_pass);
 		return true;
	}
	
	/**
	*Housing for Older persons option
	*/
	public function getOlderhousing($value = null){
		$housing = array(1=>'55 or older', 2=> '62 or older', 3=>'N/A' );
		
		return $housing;
	}
	
	public function checkStatus($button, $status){
		$arrStatus = array("INCOMPLETE", "COMPLETED", "APPROVED");
		switch($button){
			case "Changes":
				$visible = in_array($status, $arrStatus) ? false : true;
			break;
			case "Delete":
				if(Yii::app()->user->isAdmin())
					return true;
				$visible = in_array($status, $arrStatus) ? true : false;
			break;
		}
		return $visible;
	}
	
		public function advSearch(){
		$criteria = new CDbCriteria;
		
		if(isset($this->list_price[0]) AND isset($this->list_price[1]) AND !empty($this->list_price[0]) AND !empty($this->list_price[1]))
			$criteria->addBetweenCondition('list_price', $this->list_price[0], $this->list_price[1]);	
		elseif(isset($this->list_price[0]) AND !empty($this->list_price[0]))
			$criteria->addCondition("list_price >= {$this->list_price[0]}");
		
		if(isset($this->address) AND !empty($this->address))
			$criteria->addSearchCondition('address', $this->address);
		
		if(isset($this->state) AND !empty($this->state))
			$criteria->compare('state', $this->state, TRUE);
			
		if(isset($this->zip_code) AND !empty($this->zip_code))
			$criteria->compare('zip_code', $this->zip_code, TRUE);
			
		if(isset($this->city) AND !empty($this->city))
			$criteria->compare('city', $this->city, TRUE);
			
		if(isset($this->county) AND !empty($this->county))
			$criteria->compare('county', $this->county, TRUE);
			
		if(isset($this->bedrooms) AND !empty($this->bedrooms))
			$criteria->addCondition("bedrooms >= {$this->bedrooms}");
		
		if(isset($this->full_baths) AND !empty($this->full_baths))
			$criteria->addCondition("full_baths >= {$this->full_baths}");
			
		if(isset($this->half_baths) AND !empty($this->half_baths))
			$criteria->addCondition("half_baths >= {$this->half_baths}");
			
		if(isset($this->property_style) AND is_array($this->property_style)){
			$i = 0;
			$condition = '';
			foreach($this->property_style as $k => $v){
				$i++;
				$condition .= "(property_style LIKE '%$v%')";
				if($i != count($this->property_style))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->sq_ft_heated) AND !empty($this->sq_ft_heated))
			$criteria->addCondition("sq_ft_heated >= {$this->sq_ft_heated}");
			
		if(isset($this->year_built) AND !empty($this->year_built))
			$criteria->addCondition("year_built >= {$this->year_built}");
			
		if(isset($this->garage_carport_max) AND is_array($this->garage_carport_max)){
			$i = 0;
			$condition = '';
			foreach($this->garage_carport_max as $k => $v){
				$i++;
				$condition .= "(garage_carport_max LIKE '%$v%')";
				if($i != count($this->garage_carport_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->garage_features_max) AND is_array($this->garage_features_max)){
			$i = 0;
			$condition = '';
			foreach($this->garage_features_max as $k => $v){
				$i++;
				$condition .= "(garage_features_max LIKE '%$v%')";
				if($i != count($this->garage_features_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->property_description) AND is_array($this->property_description)){
			$i = 0;
			$condition = '';
			foreach($this->property_description as $k => $v){
				$i++;
				$condition .= "(property_description LIKE '%$v%')";
				if($i != count($this->property_description))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->interior_layout_max) AND is_array($this->interior_layout_max)){
			$i = 0;
			$condition = '';
			foreach($this->interior_layout_max as $k => $v){
				$i++;
				$condition .= "(interior_layout_max LIKE '%$v%')";
				if($i != count($this->interior_layout_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->air_conditioning_max) AND is_array($this->air_conditioning_max)){
			$i = 0;
			$condition = '';
			foreach($this->air_conditioning_max as $k => $v){
				$i++;
				$condition .= "(air_conditioning_max LIKE '%$v%')";
				if($i != count($this->air_conditioning_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->heating_and_fuel_max) AND is_array($this->heating_and_fuel_max)){
			$i = 0;
			$condition = '';
			foreach($this->heating_and_fuel_max as $k => $v){
				$i++;
				$condition .= "(heating_and_fuel_max LIKE '%$v%')";
				if($i != count($this->heating_and_fuel_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->total_acreage) AND !empty($this->total_acreage))
			$criteria->compare('total_acreage', $this->total_acreage, TRUE);
			
		if(isset($this->location_max) AND is_array($this->location_max)){
			$i = 0;
			$condition = '';
			foreach($this->location_max as $k => $v){
				$i++;
				$condition .= "(location_max LIKE '%$v%')";
				if($i != count($this->location_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(isset($this->community_features_max) AND is_array($this->community_features_max)){
			$i = 0;
			$condition = '';
			foreach($this->community_features_max as $k => $v){
				$i++;
				$condition .= "(community_features_max LIKE '%$v%')";
				if($i != count($this->community_features_max))
					$condition .= " OR ";
			}
			$criteria->addCondition($condition);
		}
		
		if(Yii::app()->user->getUserRole("Silver"))
			$criteria->compare('list_status', 'PAID');
		elseif(Yii::app()->user->getUserRole("Gold"))
			$criteria->addInCondition('list_status', array("COMPLETED", "APPROVED", "PAID"));
		
		return new CActiveDataProvider($this, array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>10)));
	}
	
	
}
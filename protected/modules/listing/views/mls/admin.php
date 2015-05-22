<?php
$this->breadcrumbs=array(
	'Listing'=>array('admin'),
	'Edit',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mls-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>EDIT LISTINGS</h1>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array('model'=>$model,)); ?>
</div>--><!-- search-form -->

<?php
	if(Yii::app()->user->isAdmin())
	{
		$buttons = '{view}&nbsp;{update}&nbsp;{delete}';
	} else {
		$buttons = '{view}&nbsp;{update}&nbsp;{delete}&nbsp;{changes}';
	}
	

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mls-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(


		'id',
		'list_price',
		'name',
		'address',
		'city',
		'state',
		'zip_code',
		'county',
		'home_phone',
		'mobile_phone',
		'email',
		'list_status',


		/*
		'id',
		'create_date',
		'creator_id',
		'update_date',
		'updator_id',
		'county',
		'home_phone',
		'mobile_phone',
		'email',
		'billing_address',
		'billing_city',
		'billing_state',
		'billing_zip_code',
		'zip_plus',
		'unit_number',
		'condo_floor_number',
		'building_number_floors',
		'building_name_number',
		'floors_in_unit',
		'total_units',
		'millage_rate',
		'year_built',
		'tax_id',
		'taxes',
		'tax_year',
		'section',
		'township',
		'range',
		'subdivision_number',
		'block_parcel',
		'lot_number',
		'subdivision_section_number',
		'legal_description',
		'legal_subdivision_name',
		'zoning',
		'plat_book_page',
		'future_land_use',
		'complex_community_name',
		'property_style',
		'bedrooms',
		'full_baths',
		'half_baths',
		'sq_ft_heated',
		'total_building_sq_ft',
		'sq_ft_source',
		'ownership_max',
		'cdd_yn',
		'annual_cdd_fee',
		'additional_parcel_yn',
		'homestead_yn',
		'other_exemptions_yn',
		'home_features_max',
		'lot_dimensions',
		'lot_size_sq_ft',
		'lot_size_acre',
		'total_acreage',
		'location_max',
		'front_exposure',
		'utilities_data_max',
		'water_access_yn',
		'water_access',
		'water_view_yn',
		'water_view',
		'water_frontage_yn',
		'water_frontage',
		'new_construction_yn',
		'construction_status',
		'projected_completion_date',
		'private_pool_yn',
		'pool_type_max',
		'property_description',
		'foundation_max',
		'exterior_construction_max',
		'roof_max',
		'exterior_features_max',
		'garage_carport_max',
		'garage_features_max',
		'garage_dimensions',
		'architectural_style_max',
		'community_features_max',
		'housing_for_older_persons',
		'hoa_community_association',
		'hoa_fee',
		'hoa_payment_schedule',
		'monthly_maintainance_addition_to_hoa',
		'pets_allowed_yn',
		'pet_restrictions_yn',
		'elementary_school',
		'middle_school',
		'high_school',
		'living_room',
		'dining_room',
		'family_room',
		'great_room',
		'kitchen',
		'master_bedroom_size',
		'bedroom_2nd_size',
		'bedroom_3rd_size',
		'bedroom_4th_size',
		'bedroom_5th_size',
		'study_den_dimensions',
		'balcony_porch_lanai',
		'dinette',
		'studio_dimensions',
		'additional_rooms_max',
		'air_conditioning_max',
		'heating_and_fuel_max',
		'appliances_included_max',
		'interior_layout_max',
		'interior_features_max',
		'master_bath_features_max',
		'security_system',
		'floor_covering_max',
		'kitchen_features_max',
		'fireplace_yn',
		'fireplace_description_max',
		'financing_available_max',
		'realtor_information_max',
		'realtor_information_confidential_max',
		'special_sale_provision',
		'showing_instructions_max',
		'showing_time_secure_remarks',
		'virtual_tour_link',
		'internet_yn',
		'display_property_address_on_internet_yn',
		'driving_direction',
		'realtor_only_remarks',
		'public_remarks',
		'additional_public_remarks',
		'pay_broker_percentage',
		'photo_1',
		'photo_2',
		'photo_3',
		'photo_4',
		'photo_5',
		'photo_6',
		'photo_7',
		'photo_8',
		'photo_9',
		'photo_10',
		'photo_11',
		'photo_12',
		'agreed',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>$buttons,
			'buttons'=>array(
				'changes'=>array(
					'url'=>'Yii::app()->request->baseUrl . "/index.php/site/reqUpdate/id/" . $data->id ."/type/mls"',
					'visible' => 'Mls::checkStatus("Changes", $data->list_status)',
					'imageUrl' => Yii::app()->theme->baseUrl . "/css/images/icon_update.png",
					'label' => 'Request for Update'
				),
				'delete'=>array(
					'visible'=>'Mls::checkStatus("Delete", $data->list_status)',
				),
			),
		),
	),
)); 


echo '<fieldset style="border:1px solid #c6c6c6;padding:20px;">';
echo '<legend><b>&nbsp;&nbsp;INCOMPLETE LISTINGS&nbsp;&nbsp;</b></legend>';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'incomplete-grid',
	'hideHeader'=>true,
	'dataProvider'=>new CArrayDataProvider($model2, array( 'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            ))),
	//'filter'=>$model,
	'columns'=>array(
		array('value'=>'Profile::model()->findByAttributes(array("user_id"=>$data->userid))->firstname. " ". Profile::model()->findByAttributes(array("user_id"=>$data->userid))->lastname', "header"=>"", 'type'=>'raw', ),
		'address',
                 	array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}&nbsp;&nbsp;{update}',
			'buttons'=> 
				array(
					'update'=>array
					(
					  	'url'=> 'Yii::app()->request->baseUrl . "/index.php/listing/mls/load/id/" . $data->id',       //A PHP expression for generating the URL of the button.
					  	//'imageUrl'=>'',  //Image URL of the button.
					  	//'options'=>array(), //HTML options for the button tag.
					  	//'click'=>'alert("Load incomplete listing");',     //A JS function to be invoked when the button is clicked.
					  	'visible'=>'true;',   //A PHP expression for determining whether the button is visible.
				  	),
					'delete'=>array
					(
					  	'url'=> 'Yii::app()->request->baseUrl . "/index.php/listing/mls/deletein/id/" . $data->id',       //A PHP expression for generating the URL of the button.
						'visible'=>'true;', 
					)
			),
		),
	),
));
echo '</fieldset>';

?>

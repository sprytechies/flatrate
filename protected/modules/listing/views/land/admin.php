<?php
$this->breadcrumbs=array(
	'Lands'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('land-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>EDIT VACANT LANDS</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<!--<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">\
</div>--><!-- search-form -->

<?php
	if(Yii::app()->user->isAdmin())
		$buttons = '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}';
	else
		$buttons = '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{changes}';
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'land-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'list_price',
		'street_name',
		'city',
		'state',
		'county',
		'land_status',
		/*
		'create_date',
		'creator_id',
		'update_date',
		'updator_id',
		'listing_date',
		'expiration_date',
		'entered_where',
		'listing_type',
		'representation',
		'mls_number',
		'for_lease_yn',
		'lease_price',
		'lease_price_acre',
		'list_price',
		'range_price_yn',
		'range_list_low_price',
		'price_per_acre',
		'house_number',
		'street_name',
		'street_type',
		'street_dir',
		'city',
		'state',
		'county',
		'zip_code',
		'zip_plus',
		'millage_rate',
		'tax_id',
		'taxes',
		'taxes_year',
		'alt_key_folio',
		'section',
		'township',
		'range',
		'subdivision_number',
		'condo_number',
		'subdivision_section_number',
		'block_parcel',
		'lot_number',
		'legal_description',
		'legal_subdivision_name',
		'subdiv_community_name',
		'zoning',
		'plat_book_page',
		'future_land_use',
		'complex_community_name',
		'property_style',
		'originating_board_id',
		'road_frontage',
		'state_land_use_code',
		'state_property_use_code',
		'county_land_use_code',
		'county_property_use_code',
		'additional_parcel_yn',
		'number_of_additional_parcel',
		'cdd_yn',
		'annual_cdd_fee',
		'hoa_comm_association',
		'hoa_fee',
		'hoa_payment_schedule',
		'zoning_compatible_yn',
		'auction_yn',
		'idx_yn',
		'owner_name',
		'owner_phone',
		'lot_dimensions',
		'lot_size_sq_ft',
		'lot_size_acre',
		'front_footage',
		'total_acreage',
		'location',
		'front_exposire',
		'availability',
		'easements',
		'water_access_yn',
		'water_view_yn',
		'water_frontage_yn',
		'water_extras_yn',
		'water_access',
		'water_view',
		'water_frontage',
		'water_extras',
		'water_name',
		'water_front_feet',
		'site_improvements',
		'ownership',
		'fences',
		'utilities',
		'community_features',
		'elementary_school',
		'middle_school',
		'high_school',
		'financing_available',
		'lease_terms',
		'realtor_information',
		'realtor_information_confidential',
		'special_sale_provision',
		'showing_instruction',
		'call_center_phone_number',
		'showing_time_secure_remarks',
		'special_listing_type',
		'virtual_tour',
		'internet_yn',
		'display_property_address_on_internet_yn',
		'realtor_com_yn',
		'third_party_yn',
		'agent_id',
		'agent_email',
		'agent_homepage',
		'agent_name',
		'agent_direct_phone',
		'agent_pager_cell',
		'agent_fax',
		'agent2_id',
		'sales_team_name',
		'agent2_name',
		'agent2_phone',
		'office_number',
		'office_phone',
		'agent_extension',
		'office_fax',
		'office_name',
		'selling_agent_id',
		'selling_agent_name',
		'selling_agent2_id',
		'selling_agent2_name',
		'selling_agent2_office_id',
		'selling_agent2_office_name',
		'list_office2_number',
		'list_office2_name',
		'buyer_agent_comp',
		'non_rep_comp',
		'trans_broker_comp',
		'interoffice_info',
		'driving_directions',
		'realtor_only_remarks',
		'public_remarks',
		'additional_public_remarks',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>$buttons,
			'buttons'=>array(
				'changes'=>array(
					'url'=>'Yii::app()->request->baseUrl . "/index.php/site/reqUpdate/id/" . $data->id ."/type/vacant"',
					'visible' => 'true',
					'imageUrl' => Yii::app()->theme->baseUrl . "/css/images/icon_update.png",
					'label' => 'Request for Update'
				),
			),
		),
	),
)); 

echo '<fieldset style="border:1px solid #c6c6c6; padding:20px;">';
echo '<legend><b>INCOMPLETE VACANT LAND</b></legend>';
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'incomplete-land-grid',
	'hideHeader'=>true,
	'dataProvider'=>new CArrayDataProvider($model2,array( 'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            ))),
	'columns'=>array(
		array('value'=>'Profile::model()->findByAttributes(array("user_id"=>$data->userid))->firstname. " ". Profile::model()->findByAttributes(array("user_id"=>$data->userid))->lastname', "header"=>"", 'type'=>'raw', ),
		'address', 
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}&nbsp;&nbsp;{update}',
			'buttons'=>
				array(
					'update'=>array(
						'url'=>'Yii::app()->createUrl("/listing/land/load/id/" . $data->id)',
					),
					'delete'=>array(
						'url'=>'Yii::app()->createUrl("/listing/land/deletein/id/" . $data->id)',
					),
				),
		)
	)
))

?>

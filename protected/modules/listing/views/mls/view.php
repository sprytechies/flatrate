asdads<?php
$skrip = "
	$('#chkAgree').change(function()
	{
		var result = $('#chkAgree').attr('checked');
		var btn = $('input[name=" . 'btnApprove' . "], input[name=" . 'btnSurvey' . "]');
		if(result == undefined){
			btn.attr('disabled',true);	
		}
		else{
			btn.attr('disabled',false);
		}

	});
	$('a[rel=group]').fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
	});
	$('#appPromo').click(function(){
		if($('#promocode').val() == ''){
			alert('Please enter your promo code');
		}else{
			$(this).attr('disabled', 'disabled');
			$.ajax({
				url : '/index.php/listing/mls/useCode/id/$model->id',
				dataType : 'json',
				type : 'POST',
				data: {
					code : $('#promocode').val(),
				},
				success: function(data){
					if(data.success == false){
						alert(data.message);
						$(this).removeAttr('disabled');
					}else{
						window.location = data.url;
					}
				}
			});
		}
	});
";

$cs = Yii::app()->getClientScript();  
$cs->registerScript('myjs',$skrip,CClientScript::POS_READY); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.fancybox-1.3.4.pack.js', CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery.mousewheel-3.0.4.pack.js', CClientScript::POS_HEAD);
$cs->registerScript('fancy', $fancyScript, CClientScript::POS_HEAD);
$cs->registerCssFile(Yii::app()->theme->baseUrl . '/css/jquery.fancybox-1.3.4.css', 'all');
?>
<?php 
$this->breadcrumbs=array(
	'Listing'=>array('admin'),
	$model->address,
);
if(Yii::app()->user->isAdmin())
{
	$this->menu=array(
		//array('label'=>'List Mls', 'url'=>array('index')),
		array('label'=>'Create New Listing', 'url'=>array('create')),
		array('label'=>'Update Listing', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete Listing', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	);
} else {
	$this->menu=array(
		array('label'=>'Create New Listing', 'url'=>array('create')),
		array('label'=>'Update Listing', 'url'=>array('update', 'id'=>$model->id)),
	);
}
?>
<h1><?php echo strtoupper($model->address); ?></h1>
<?php
$photo_1 = !empty($model->photo_1) ? app()->params['uploadUrl'] . $model->photo_1 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_2 = !empty($model->photo_2) ? app()->params['uploadUrl'] . $model->photo_2 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_3 = !empty($model->photo_3) ? app()->params['uploadUrl'] . $model->photo_3 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_4 = !empty($model->photo_4) ? app()->params['uploadUrl'] . $model->photo_4 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_5 = !empty($model->photo_5) ? app()->params['uploadUrl'] . $model->photo_5 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_6 = !empty($model->photo_6) ? app()->params['uploadUrl'] . $model->photo_6 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_7 = !empty($model->photo_7) ? app()->params['uploadUrl'] . $model->photo_7 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_8 = !empty($model->photo_8) ? app()->params['uploadUrl'] . $model->photo_8 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_9 = !empty($model->photo_9) ? app()->params['uploadUrl'] . $model->photo_9 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_10 = !empty($model->photo_10) ? app()->params['uploadUrl'] . $model->photo_10 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_11 = !empty($model->photo_11) ? app()->params['uploadUrl'] . $model->photo_11 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_12 = !empty($model->photo_12) ? app()->params['uploadUrl'] . $model->photo_12 : app()->theme->baseUrl . '/css/images/photo_not_available.png';

//$photo_1_holder = '';
//if(!empty($model->photo_1))
	$photo_1_holder = CHtml::image($photo_1,'photo',array('id'=>'view-photo-holder')); 
//else 
//	$photo_1_holder = CHtml::image(app()->theme->baseUrl . '/css/images/photo_not_available.png','photo',array('alt'=>'No Photo Available','id'=>'view-photo-holder')); 
?>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="success-info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="error-info">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<div class="span-23" style="border:1px solid #CCC; margin-bottom:20px;">
    <h2 class="span-23 last view-address"><?php echo $model->address . ", " . $model->city; ?>&nbsp<?php echo CHtml::link( CHtml::image( Yii::app()->theme->baseUrl . '/css/images/icon_print.png', '', array ()) , array('/listing/mls/print/id/' . $model->id ), array('target'=>'_blank') ); ?>&nbsp;</h2>
        <div class="span-7"><a rel="group" href="<?php echo $photo_1; ?>"><?php echo CHtml::image($photo_1,'',array('class'=>'dragImage', 'id'=>'view-photo-holder')); ?></a></div>
        <div class="span-9">
            <?php echo CHtml::label($model->getAttributeLabel('city'),'',array('class'=>'view-title')) . ": " . $model->city; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('state'),'',array('class'=>'view-title')) . ": " . $model->state; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('county'),'',array('class'=>'view-title')) . ": " . $model->county; ?>&nbsp;&nbsp;<br/>
            <?php echo CHtml::label($model->getAttributeLabel('zip_code'),'',array('class'=>'view-title')) . ": " . $model->zip_code; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('unit_number'),'',array('class'=>'view-title')) . ": " . $model->unit_number; ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label('Sub. Name','',array('class'=>'view-title')) . ": " . strtoupper($model->legal_subdivision_name); ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label($model->getAttributeLabel('home_phone'),'',array('class'=>'view-title')) . ": " . $model->home_phone; ?>&nbsp;&nbsp;<br/>
            <?php echo CHtml::label($model->getAttributeLabel('mobile_phone'),'',array('class'=>'view-title')) . ": " . $model->mobile_phone; ?>&nbsp;&nbsp;<br/>
            <?php echo CHtml::label($model->getAttributeLabel('email'),'',array('class'=>'view-title')) . ": " . $model->email; ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label('Beds','',array('class'=>'view-title')) . ": " . $model->bedrooms; ?>&nbsp;&nbsp;
            <?php echo CHtml::label('Baths','',array('class'=>'view-title')) . ": " . $model->full_baths . '/' . $model->half_baths; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('sq_ft_heated'),'',array('class'=>'view-title')) . ": " . number_format($model->sq_ft_heated,0); ?>&nbsp;&nbsp;<br/>
        </div>
        <div class="span-3" style="text-align:right; float:left;">
            <?php echo CHtml::label('List Price','',array('class'=>'view-title')) ?><br/>
            <?php echo CHtml::label($model->getAttributeLabel('year_built'),'',array('class'=>'view-title')) ?><br/>
            <?php echo CHtml::label('Special Sale','',array('class'=>'view-title')) ?>
            <?php echo CHtml::label($model->getAttributeLabel('billing_address'),'',array('class'=>'view-title')) . " : " . $model->billing_address; ?>
            <?php echo CHtml::label($model->getAttributeLabel('billing_city'),'',array('class'=>'view-title')) . " : " . $model->billing_city; ?>
            <?php echo CHtml::label($model->getAttributeLabel('billing_state'),'',array('class'=>'view-title')) . " : " . $model->billing_state; ?>
            <?php echo CHtml::label($model->getAttributeLabel('billing_zip_code'),'',array('class'=>'view-title')) . ": " . $model->billing_zip_code; ?>
            <?php echo CHtml::label($model->getAttributeLabel('zip_plus'),'',array('class'=>'view-title')) . " : " . $model->zip_plus; ?>
            
        </div>
        <div class="span-4 last">
            <?php echo ': $' . number_format($model->list_price,2); ?><br/>
            <?php echo ': ' . $model->year_built; ?><br/>
            <?php echo ': ' . $model->special_sale_provision; ?>
        </div>
        <div class="span-15 last">
            <?php echo CHtml::label('Private Pool','',array('class'=>'view-title')) . ": " . $model->private_pool_yn; ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label('Property','',array('class'=>'view-title')) . ": " . $model->property_style; ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label($model->getAttributeLabel('total_acreage'),'',array('class'=>'view-title')) . ": " . $model->total_acreage; ?>&nbsp;&nbsp;
            <?php echo CHtml::label('Total Sq. Ft.','',array('class'=>'view-title')) . ": " . number_format($model->total_building_sq_ft,0); ?>&nbsp;&nbsp;
            <?php echo CHtml::label('Pet Allowed','',array('class'=>'view-title')) . ": " . $model->pets_allowed_yn; ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label($model->getAttributeLabel('construction_status'),'',array('class'=>'view-title')) . ": " . $model->construction_status; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('projected_completion_date'),'',array('class'=>'view-title')) . ": " . CHtml::encode($model->projected_completion_date); ?>&nbsp;&nbsp;<br/>
            <?php echo CHtml::label('Location','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->location_max); ?>&nbsp;&nbsp;<br/><br/>
        </div>
    <div class="span-23 last" style="padding:10px;" ><?php echo $model->public_remarks; ?></div>
    
    <div class="span-23 view-section"><b>Land, Site and Tax Information</b></div>
	<div class="span-23 last" style="padding:10px;">
        <?php echo CHtml::label($model->getAttributeLabel('subdivision_number'),'',array('class'=>'view-title')) . ": " . $model->subdivision_number; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('section'),'',array('class'=>'view-title')) . ": " . $model->section; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('block_parcel'),'',array('class'=>'view-title')) . ": " . $model->block_parcel; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('front_exposure'),'',array('class'=>'view-title')) . ": " . $model->front_exposure; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('tax_id'),'',array('class'=>'view-title')) . ": " . $model->tax_id; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('additional_parcel_yn'),'',array('class'=>'view-title')) . ": " . $model->additional_parcel_yn; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('millage_rate'),'',array('class'=>'view-title')) . ": " . $model->millage_rate; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('lot_number'),'',array('class'=>'view-title')) . ": " . $model->lot_number; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Taxes','',array('class'=>'view-title')) . ": $" . number_format($model->taxes,2); ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('tax_year'),'',array('class'=>'view-title')) . ": " . $model->tax_year; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('homestead_yn'),'',array('class'=>'view-title')) . ": " . $model->homestead_yn; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('other_exemptions_yn'),'',array('class'=>'view-title')) . ": " . $model->other_exemptions_yn; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('cdd_yn'),'',array('class'=>'view-title')) . ": " . $model->cdd_yn; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('annual_cdd_fee'),'',array('class'=>'view-title')) . ": $" . $model->annual_cdd_fee; ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label($model->getAttributeLabel('total_building_sq_ft'),'',array('class'=>'view-title')) . ": $" . $model->total_building_sq_ft; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Legal Description','',array('class'=>'view-title')) . ": " . $model->legal_description; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Ownership','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->ownership_max); ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('complex_community_name'),'',array('class'=>'view-title')) . ": " . $model->complex_community_name; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('plat_book_page'),'',array('class'=>'view-title')) . ": " . $model->plat_book_page; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('condo_floor_number'),'',array('class'=>'view-title')) . ": " . $model->condo_floor_number; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('building_number_floors'),'',array('class'=>'view-title')) . ": " . $model->building_number_floors; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('building_name_number'),'',array('class'=>'view-title')) . ": " . $model->building_name_number; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('floors_in_unit'),'',array('class'=>'view-title')) . ": " . $model->floors_in_unit; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('total_units'),'',array('class'=>'view-title')) . ": " . $model->total_units; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('millage_rate'),'',array('class'=>'view-title')) . ": " . $model->millage_rate; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('range'),'',array('class'=>'view-title')) . ": " . $model->range; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('township'),'',array('class'=>'view-title')) . ": " . $model->township; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('subdivision_section_number'),'',array('class'=>'view-title')) . ": " . $model->subdivision_section_number; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('zoning'),'',array('class'=>'view-title')) . ": " . $model->zoning; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('future_land_use'),'',array('class'=>'view-title')) . ": " . $model->future_land_use; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('home_features_max'),'',array('class'=>'view-title')) . ": " . $model->home_features_max; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('lot_dimensions'),'',array('class'=>'view-title')) . ": " . $model->lot_dimensions; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('lot_size_sq_ft'),'',array('class'=>'view-title')) . ": " . $model->lot_size_sq_ft; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('lot_size_acre'),'',array('class'=>'view-title')) . ": " . $model->lot_size_acre; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('water_access_yn'),'',array('class'=>'view-title')) . ": " . $model->water_access; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('water_view_yn'),'',array('class'=>'view-title')) . ": " . $model->water_view; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('water_frontage_yn'),'',array('class'=>'view-title')) . ": " . $model->water_frontage; ?>&nbsp;&nbsp;<br/>
	
        <?php echo CHtml::label($model->getAttributeLabel('water_access'),'',array('class'=>'view-title')) . ": " . $model->water_access; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('water_view'),'',array('class'=>'view-title')) . ": " . $model->water_view; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('water_frontage'),'',array('class'=>'view-title')) . ": " . $model->water_frontage; ?>&nbsp;&nbsp;<br/>
	
        <?php echo CHtml::label($model->getAttributeLabel('financing_available_max'),'',array('class'=>'view-title')) . ": " . $model->financing_available_max; ?>&nbsp;&nbsp;<br/>
	<?php echo CHtml::label($model->getAttributeLabel('realtor_information_max'),'',array('class'=>'view-title')) . ": " . $model->realtor_information_max; ?>&nbsp;&nbsp;<br/>
	<?php echo CHtml::label($model->getAttributeLabel('realtor_information_confidential_max'),'',array('class'=>'view-title')) . ": " . $model->realtor_information_confidential_max; ?>&nbsp;&nbsp;<br/>
	
        </div>
    
    <div class="span-23 last view-section" ><b>Interior Information</b></div>
	<div class="span-23 last" style="padding:10px;">
        <?php echo CHtml::label($model->getAttributeLabel('living_room'),'',array('class'=>'view-title')) . ": " . $model->living_room; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('dining_room'),'',array('class'=>'view-title')) . ": " . $model->dining_room; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('family_room'),'',array('class'=>'view-title')) . ": " . $model->family_room; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('great_room'),'',array('class'=>'view-title')) . ": " . $model->great_room; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('kitchen'),'',array('class'=>'view-title')) . ": " . $model->kitchen; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Master Bedroom','',array('class'=>'view-title')) . ": " . $model->master_bedroom_size; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('2nd Bedroom','',array('class'=>'view-title')) . ": " . $model->bedroom_2nd_size; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('3rd Bedroom','',array('class'=>'view-title')) . ": " . $model->bedroom_3rd_size; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('4th Bedroom','',array('class'=>'view-title')) . ": " . $model->bedroom_4th_size; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('5th Bedroom','',array('class'=>'view-title')) . ": " . $model->bedroom_5th_size; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Study / Den','',array('class'=>'view-title')) . ": " . $model->study_den_dimensions; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('Balcony / Porch','',array('class'=>'view-title')) . ": " . $model->balcony_porch_lanai; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('dinette'),'',array('class'=>'view-title')) . ": " . $model->dinette; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('Studio','',array('class'=>'view-title')) . ": " . $model->studio_dimensions; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Additional Rooms','',array('class'=>'view-title')) . ": " . str_replace("|",", ", $model->additional_rooms_max); ?>&nbsp;&nbsp;
        <?php echo CHtml::label('Air Conditioning','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->air_conditioning_max); ?>&nbsp;&nbsp;
        <?php echo CHtml::label('Heating & Fuel','',array('class'=>'view-title')) . ": " . str_replace("|",", " , $model->heating_and_fuel_max); ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Floor Covering','',array('class'=>'view-title')) . ": " . str_replace("|",", ", $model->floor_covering_max); ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('sq_ft_source'),'',array('class'=>'view-title')) . ": " . $model->sq_ft_source; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('security_system'),'',array('class'=>'view-title')) . ": " . $model->security_system; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('fireplace_yn'),'',array('class'=>'view-title')) . ": " . $model->fireplace_yn; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('Fireplace Description','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->fireplace_description_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Utilities Data','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->utilities_data_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Interior Layout','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->interior_layout_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Interior Features','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->interior_features_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Master Bath Features','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->master_bath_features_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Appliances Included','',array('class'=>'view-title')) . ": " . str_replace("|",", " , $model->appliances_included_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Kitchen Features','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->kitchen_features_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Additional Rooms','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->additional_rooms_max); ?>&nbsp;&nbsp;<br/>
	</div>
    
    <div class="span-23 last view-section"><b>Exterior Information</b></div>
	<div class="span-23 last" style="padding:10px;">
        <?php echo CHtml::label('Exterior Construction','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->exterior_construction_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Pool Type','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->pool_type_max); ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Exterior Features','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->exterior_features_max); ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('property_description'),'',array('class'=>'view-title')) . ": " . $model->property_description; ?>&nbsp;&nbsp;<br/>
	<?php echo CHtml::label($model->getAttributeLabel('foundation_max'),'',array('class'=>'view-title')) . ": " . $model->foundation_max; ?>&nbsp;&nbsp;<br/>
	<?php echo CHtml::label($model->getAttributeLabel('roof_max'),'',array('class'=>'view-title')) . ": " . $model->roof_max; ?>&nbsp;&nbsp;<br/>
	
        <?php echo CHtml::label($model->getAttributeLabel('architectural_style_max'),'',array('class'=>'view-title')) . ": " . $model->architectural_style_max; ?>&nbsp;&nbsp;<br/>
	
        <?php echo CHtml::label($model->getAttributeLabel('garage_features_max'),'',array('class'=>'view-title')) . ": " . $model->garage_features_max; ?>&nbsp;&nbsp;<br/>
	
        <?php echo CHtml::label('Garage / Carport','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->garage_carport_max); ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('garage_dimensions'),'',array('class'=>'view-title')) . ": " . $model->garage_dimensions; ?>&nbsp;&nbsp;<br/>
	</div>
    
    <div class="span-23 last view-section"><b>Community Information</b></div>
	<div class="span-23 last" style="padding:10px;">
        <?php echo CHtml::label('Community Features','',array('class'=>'view-title')) . ": " . str_replace("|",", " ,$model->community_features_max); ?>&nbsp;&nbsp;<br/>
        <?php 
		$housing = MLS::getOlderhousing();
		echo CHtml::label('Housing for Older Persons','',array('class'=>'view-title')) . ": " . $housing[$model->housing_for_elders]; ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label('Pet Restrictions','',array('class'=>'view-title')) . ": " . $model->pet_restrictions_yn; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('hoa_community_association'),'',array('class'=>'view-title')) . ": " . $model->hoa_community_association; ?>&nbsp;&nbsp;
        <?php echo CHtml::label('HOA Fee','',array('class'=>'view-title')) . ": $" . number_format($model->hoa_fee,2); ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('hoa_payment_schedule'),'',array('class'=>'view-title')) . ": " . $model->hoa_payment_schedule; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('monthly_maintainance_addition_to_hoa'),'',array('class'=>'view-title')) . ": " . $model->monthly_maintainance_addition_to_hoa; ?>&nbsp;&nbsp;<br/>

        <?php echo CHtml::label($model->getAttributeLabel('elementary_school'),'',array('class'=>'view-title')) . ": " . $model->elementary_school; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('middle_school'),'',array('class'=>'view-title')) . ": " . $model->middle_school; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('high_school'),'',array('class'=>'view-title')) . ": " . $model->high_school; ?>&nbsp;&nbsp;<br/>
        <?php echo CHtml::label($model->getAttributeLabel('showing_instructions_max'),'',array('class'=>'view-title')) . ": " . $model->showing_instructions_max; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('showing_time_secure_remarks'),'',array('class'=>'view-title')) . ": " . $model->showing_time_secure_remarks; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('virtual_tour_link'),'',array('class'=>'view-title')) . ": " . $model->virtual_tour_link; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('internet_yn'),'',array('class'=>'view-title')) . ": " . $model->internet_yn; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('display_property_address_on_internet_yn'),'',array('class'=>'view-title')) . ": " . $model->display_property_address_on_internet_yn; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('driving_direction'),'',array('class'=>'view-title')) . ": " . $model->driving_direction; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('realtor_only_remarks'),'',array('class'=>'view-title')) . ": " . $model->realtor_only_remarks; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('public_remarks'),'',array('class'=>'view-title')) . ": " . $model->public_remarks; ?><br/>
	<?php echo CHtml::label($model->getAttributeLabel('pay_broker_percentage'),'',array('class'=>'view-title')) . ": " . $model->pay_broker_percentage; ?><br/>
	
        </div>

    <div class="span-23 last view-section"><b>Photos</b></div>
	<div class="span-23 last" style="padding:10px;">
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_1; ?>"><?php echo CHtml::image($photo_1,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_2; ?>"><?php echo CHtml::image($photo_2,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_3; ?>"><?php echo CHtml::image($photo_3,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_4; ?>"><?php echo CHtml::image($photo_4,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_5; ?>"><?php echo CHtml::image($photo_5,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder last"><a rel="group" href="<?php echo $photo_6; ?>"><?php echo CHtml::image($photo_6,'',array('class'=>'dragImage')); ?></a></div>
    </div>
	<div class="span-23 last image-group" style="padding:10px;">
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_7; ?>"><?php echo CHtml::image($photo_7,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_8; ?>"><?php echo CHtml::image($photo_8,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_9; ?>"><?php echo CHtml::image($photo_9,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_10; ?>"><?php echo CHtml::image($photo_10,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_11; ?>"><?php echo CHtml::image($photo_11,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder last"><a rel="group" href="<?php echo $photo_12; ?>"><?php echo CHtml::image($photo_12,'',array('class'=>'dragImage')); ?></a></div>
  	</div>
	<?php  if(!empty($docs)): ?>
	 <div class="span-23 last view-section"><b>Document</b></div>
	<div class="span-23 last" style="padding: 10px">
		<?php 
		echo CHtml::openTag('ul');
		foreach($docs as $doc){
			echo CHtml::openTag('li') . '<a href="' . app()->params['uploadUrl'] . $doc->filename . '" target="_blank">'. $doc->filename .'</a>' . CHtml::closeTag('li');
		}
		echo CHtml::closeTag('ul');
		?>
	</div>
	<?php endif; ?>
    	<?php if( ($model->list_status == 'COMPLETED' || $model->list_status == 'APPROVED')) : ?>
	<table class="span-23 last form_tb2" >
		<tr>
	        	<td style="vertical-align:top; padding:20px; text-align:center;">
		            	<h3 style="padding-top:5px;">Agreements</h3>
		              <p style="text-align:justify;">The Focus Firm is acting under a "NO BROKERAGE" relationship and promise to conduct our business with you dealing fairly and honestly.  We must disclose all known facts that materially affect the value of the residential real property which are not readily observable to the buyer and we will Account for all funds entrusted to the licensee.</p>
		              <p style="text-align:justify;">The Owner has reviewed the information entered on this Profile Sheet and acknowledges that the foregoing information is believed to be true and correct and by reference hereto becomes a part of the Listing Agreement. Owner agrees to promptly notify us if there is any material change in such information during the term of this Listing. The Owner agrees to indemnify and hold harmless the My-Florida Regional MLS and its employees, the Listing Broker and Licensees, the Selling Broker and Licensees, and all other Cooperating Brokers and Licensees against any and all claims or liability (Including attorney's fees) arising from any breach of warranty by Owner or from any incorrect information supplied by Owner or from any facts concerning the Property which was known or reasonably should have been known to Owner but not disclosed by Owner. At the request of the Listing Broker, unless otherwise properly indicated on this Profile Sheet, the My-Florida Regional MLS may electronically transfer information about Owner's property to Internet Web Sites to aid in the marketing of the Property for sale. Seller authorizes Broker, the MLS and/or Association of Realtors® to use and/or license the Active listing and sold data. My-Florida Regional MLS assumes no responsibility or liability to Owner for errors or omissions on this Data Entry Form or in the MLS computer system or reciprocal computer systems. The owner(s) also acknowledges that they must notify The Focus Firm Inc., REALTORS within 48 hours of signing a sales contract AND within 48 hours of closing and agree to pay any and all fines levied if you do not do so.</p>
		              <div style="text-align:left;"></div> 
		              <p><?php echo CHtml::checkBox('chkAgree', false, array()); ?>&nbsp;I&nbsp;Agree</p>
	               	<p style="color:#090; text-align:left;">
					<i>* Click '<b>Approve</b>' link to state you are agreed with above agreements and redirect to payment.</i><br/>
					<i>* Click '<b>Take a Survey</b>' link to state you are agreed with above agreements and take a survey</i><br/>
					<i>* Click '<b>Cancel</b>' link to approve later.</i><br/><br/>
	               	</p>
			</td>
      		</tr>
  	</table>
	<div class="row buttons" style="text-align:center;">
		<?php
			/*echo CHtml::openTag('label') . CHtml::checkBox('survey', TRUE, array('style'=>'display:inline')) . " Take a Survey ?" . CHtml::closeTag('label');
			echo "<br/>";*/
		?>
	    	<?php echo CHtml::submitButton('CANCEL', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/admin')); ?>
	    	<?php echo '&nbsp;&nbsp;'; ?>
	    	<?php echo CHtml::submitButton('I APPROVE THIS LISTING, TAKE ME TO CHECKOUT', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/approve/id/' . $model->id,'disabled'=>true,'name'=>'btnApprove', 'id'=>'btnApprove')); ?>
	    	<?php echo '&nbsp;&nbsp;'; ?>
	    	<?php //echo CHtml::submitButton('TAKE A SURVEY', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/approve/id/' . $model->id . '/survey/true' ,'disabled'=>true,'name'=>'btnSurvey', 'id'=>'btnSurvey')); ?>
	</div>
	<div class="row buttons" style="text-align: center; margin-top: 20px;">
		<p class="hint">A Promo code will be sent directly to your email for a discount upon your 10th listing.</p>
		<?php echo CHtml::textField('promocode', '', array('placeholder'=>'Promo Code Here')); ?>
		<?php echo CHtml::button('Use Promo Code', array('id'=>'appPromo')); ?>
	</div>
	<?php elseif($model->list_status == "PAID") : ?>
	<table class="span-23 last form_tb2" ></table>
	<div class="row buttons" style="text-align:center;">
		<?php// echo CHtml::submitButton('CANCEL', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/admin')); ?>
	    	<?php// echo '&nbsp;&nbsp;'; ?>
	    	<?php// echo CHtml::submitButton('SET AS PENDING', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/pending/id/' . $model->id,'name'=>'btnPending')); ?>
	</div>
	<?php elseif($model->list_status == "PENDING") : ?>
	<table class="span-23 last form_tb2" ></table>
	<div class="row buttons" style="text-align:center;">
		<?php // echo CHtml::submitButton('CANCEL', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/admin')); ?>
	    	<?php // echo '&nbsp;&nbsp;'; ?>
	    	<?php // echo CHtml::submitButton('SET AS SOLD', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/mls/sold/id/' . $model->id,'name'=>'btnSold')); ?>
	</div>
    	<?php endif; ?>
    <br/><br/>
</div>

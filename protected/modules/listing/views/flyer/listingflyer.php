<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
<style>
    body {
    margin: 0;
    padding: 0;
    color: #555;
    font: normal 10pt Arial,Helvetica,sans-serif;
    background: none;
}
    .flyer-data{
        width: 960px;
        margin-left: auto;
        margin-right: auto;
    }
   
</style>
<div class="flyer-data">
<?php
$photo_1 = !empty($model->photo_1) ? Yii::app()->params['uploadUrl'] . $model->photo_1 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_2 = !empty($model->photo_2) ? Yii::app()->params['uploadUrl'] . $model->photo_2 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_3 = !empty($model->photo_3) ? Yii::app()->params['uploadUrl'] . $model->photo_3 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_4 = !empty($model->photo_4) ? Yii::app()->params['uploadUrl'] . $model->photo_4 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_5 = !empty($model->photo_5) ? Yii::app()->params['uploadUrl'] . $model->photo_5 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_6 = !empty($model->photo_6) ? Yii::app()->params['uploadUrl'] . $model->photo_6 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_7 = !empty($model->photo_7) ? Yii::app()->params['uploadUrl'] . $model->photo_7 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_8 = !empty($model->photo_8) ? Yii::app()->params['uploadUrl'] . $model->photo_8 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_9 = !empty($model->photo_9) ? Yii::app()->params['uploadUrl'] . $model->photo_9 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_10 = !empty($model->photo_10) ? Yii::app()->params['uploadUrl'] . $model->photo_10 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_11 = !empty($model->photo_11) ? Yii::app()->params['uploadUrl'] . $model->photo_11 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$photo_12 = !empty($model->photo_12) ? Yii::app()->params['uploadUrl'] . $model->photo_12 : Yii::app()->theme->baseUrl . '/css/images/photo_not_available.png';
$userdetails = Profile::model()->findByAttributes(array('user_id'=>$model->creator_id));
//$photo_1_holder = '';
//if(!empty($model->photo_1))
	$photo_1_holder = CHtml::image($photo_1,'photo',array('id'=>'view-photo-holder')); 
//else 
//	$photo_1_holder = CHtml::image(app()->theme->baseUrl . '/css/images/photo_not_available.png','photo',array('alt'=>'No Photo Available','id'=>'view-photo-holder')); 
?>
<div class="span-23" style="border:1px solid #CCC; margin-bottom:20px;">
   <h2 class="span-23 last view-address"><?php echo $model->address . ", " . $model->city; ?>&nbsp<?php echo CHtml::link( CHtml::image( Yii::app()->theme->baseUrl . '/css/images/icon_print.png', '', array ()) , array('/listing/mls/print/id/' . $model->id ), array('target'=>'_blank') ); ?>&nbsp;</h2>
        <div class="span-7"><a rel="group" href="<?php echo $photo_1; ?>"><?php echo CHtml::image($photo_1,'',array('class'=>'dragImage', 'id'=>'view-photo-holder')); ?></a></div>
        <div class="span-13">
            <?php echo CHtml::label($model->getAttributeLabel('county'),'',array('class'=>'view-title')) . ": " . $model->county; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('zip_code'),'',array('class'=>'view-title')) . ": " . $model->zip_code; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('unit_number'),'',array('class'=>'view-title')) . ": " . $model->unit_number; ?>&nbsp;&nbsp;<?php echo CHtml::label('List Price','',array('class'=>'view-title')) .': $' . number_format($model->list_price,2); ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label('Sub. Name','',array('class'=>'view-title')) . ": " . strtoupper($model->legal_subdivision_name); ?>&nbsp;&nbsp; <?php echo CHtml::label($model->getAttributeLabel('year_built'),'',array('class'=>'view-title')) . ': ' . $model->year_built;?><br/>
            
            <?php echo CHtml::label('Beds','',array('class'=>'view-title')) . ": " . $model->bedrooms; ?>&nbsp;&nbsp;
            <?php echo CHtml::label('Baths','',array('class'=>'view-title')) . ": " . $model->full_baths . '/' . $model->half_baths; ?>&nbsp;&nbsp;
            <?php echo CHtml::label($model->getAttributeLabel('sq_ft_heated'),'',array('class'=>'view-title')) . ": " . number_format($model->sq_ft_heated,0); ?>&nbsp;&nbsp; <?php echo CHtml::label('Special Sale','',array('class'=>'view-title')) . ': ' . $model->special_sale_provision;?><br/>
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
        <br/>
        <div class="span-15 last">
            <?php echo CHtml::label('Owner Name','',array('class'=>'view-title')) . ": " . $model->name; ?>&nbsp;&nbsp;<br/>
            
            <?php echo CHtml::label('Phone Number','',array('class'=>'view-title')) . ": " . $model->home_phone; ?>&nbsp;&nbsp;<br/>
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
        
        <?php echo CHtml::label('Legal Description','',array('class'=>'view-title')) . ": " . $model->legal_description; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label('Ownership','',array('class'=>'view-title')) . ": " . str_replace("|",", ",$model->ownership_max); ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('complex_community_name'),'',array('class'=>'view-title')) . ": " . $model->complex_community_name; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('plat_book_page'),'',array('class'=>'view-title')) . ": " . $model->plat_book_page; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('building_number_floors'),'',array('class'=>'view-title')) . ": " . $model->building_number_floors; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('zoning'),'',array('class'=>'view-title')) . ": " . $model->zoning; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('future_land_use'),'',array('class'=>'view-title')) . ": " . $model->future_land_use; ?>&nbsp;&nbsp;<br/>

        <?php echo CHtml::label($model->getAttributeLabel('lot_dimensions'),'',array('class'=>'view-title')) . ": " . $model->lot_dimensions; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('lot_size_sq_ft'),'',array('class'=>'view-title')) . ": " . $model->lot_size_sq_ft; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('lot_size_acre'),'',array('class'=>'view-title')) . ": " . $model->lot_size_acre; ?>&nbsp;&nbsp;<br/>
        
        <?php echo CHtml::label($model->getAttributeLabel('water_access'),'',array('class'=>'view-title')) . ": " . $model->water_access; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('water_view'),'',array('class'=>'view-title')) . ": " . $model->water_view; ?>&nbsp;&nbsp;
        <?php echo CHtml::label($model->getAttributeLabel('water_frontage'),'',array('class'=>'view-title')) . ": " . $model->water_frontage; ?>&nbsp;&nbsp;
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
        	
        <?php echo CHtml::label("Showing Instruction",'',array('class'=>'view-title')) . ": " . $model->showing_instructions_max; ?>&nbsp;&nbsp;<br/>
      
	</div>

    <div class="span-23 last view-section"><b>Photos</b></div>
	<div class="span-23 last" style="padding:10px;">
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_1; ?>"><?php echo CHtml::image($photo_1,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_2; ?>"><?php echo CHtml::image($photo_2,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_3; ?>"><?php echo CHtml::image($photo_3,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_4; ?>"><?php echo CHtml::image($photo_4,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_5; ?>"><?php echo CHtml::image($photo_5,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_6; ?>"><?php echo CHtml::image($photo_6,'',array('class'=>'dragImage')); ?></a></div>
    </div>
	<div class="span-23 last" style="padding:10px;">
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_7; ?>"><?php echo CHtml::image($photo_7,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_8; ?>"><?php echo CHtml::image($photo_8,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_9; ?>"><?php echo CHtml::image($photo_9,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_10; ?>"><?php echo CHtml::image($photo_10,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder"><a rel="group" href="<?php echo $photo_11; ?>"><?php echo CHtml::image($photo_11,'',array('class'=>'dragImage')); ?></a></div>
        <div class="span-3 imgHolder "><a rel="group" href="<?php echo $photo_12; ?>"><?php echo CHtml::image($photo_12,'',array('class'=>'dragImage')); ?></a></div>
        </div>
    <div style="clear: both;"></div><br/><br/><br/>
  
    <br/><br/>
</div>
</div>
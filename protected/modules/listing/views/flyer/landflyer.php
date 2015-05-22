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
$userdetails = Profile::model()->findByAttributes(array('user_id'=>$model->creator_id));
?>
<div class="span-23" style="border:1px solid #CCC; margin-bottom:20px;">
	<h2 class="span-23 last view-address"><?php echo "$model->street_name, $model->city " ; ?>&nbsp;</h2>
	<div class="span-23 last">
		<div class="span-11" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('House # ','',array('class'=>'view-title')) . ": $temp->house_number<br/>";
				echo CHtml::label('Street Name ','',array('class'=>'view-title')) . ": $temp->street_name<br/>";
				echo CHtml::label('Street Type ','',array('class'=>'view-title')) . ": $temp->street_type<br/>";
				echo CHtml::label('City ','',array('class'=>'view-title')) . ": $temp->city<br/>";
				echo CHtml::label('State ','',array('class'=>'view-title')) . ": $temp->state<br/>";
				echo CHtml::label('County ','',array('class'=>'view-title')) . ": $temp->county<br/>";
				echo CHtml::label('Zip Code ','',array('class'=>'view-title')) . ": $temp->zip_code<br/>";
				echo CHtml::label('Zip +4 ','',array('class'=>'view-title')) . ": $temp->zip_plus<br/>";
				echo CHtml::label('Listing Date ','',array('class'=>'view-title')) . ": $temp->listing_date<br/>";
				echo CHtml::label('Expiration Date ','',array('class'=>'view-title')) . ": $temp->expiration_date<br/>";
			?>
                  
		</div>
		<div class="span-11 last" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('For Lease ','',array('class'=>'view-title')) . ": $temp->for_lease_yn<br/>";
				echo CHtml::label('Lease Price ','',array('class'=>'view-title')) . ": $" . number_format($temp->lease_price,2) . "<br/>";
				echo CHtml::label('Lease Price Acre ','',array('class'=>'view-title')) . ": $" . number_format($temp->lease_price_acre,2) . "<br/>";
				echo CHtml::label('Range Price ','',array('class'=>'view-title')) . ": $temp->range_price_yn<br/>";
				echo CHtml::label('Range List Low Price ','',array('class'=>'view-title')) . ": $" . number_format($temp->range_list_low_price,2) . "<br/>";
				echo CHtml::label('Price Per Acre ','',array('class'=>'view-title')) . ": $" . number_format($temp->price_per_acre,2) . "<br/>";
				echo CHtml::label('Entered Where ','',array('class'=>'view-title')) . ": $temp->entered_where<br/>";
				echo CHtml::label('Listing Type ','',array('class'=>'view-title')) . ": $temp->listing_type<br/>";
				echo CHtml::label('Representation ','',array('class'=>'view-title')) . ": $temp->representation<br/>";
				echo CHtml::label('Listing Price ','',array('class'=>'view-title')) . ": $" . number_format($temp->listing_price,2) . "<br/>";
			?>
		</div>
		<div class="span-22 last" style="margin: -10px 0 10px 10px">
			<?php
				echo CHtml::label('Property Style ','',array('class'=>'view-title')) . ": $temp->property_style<br/>";
			?>
                    <br />
                    <?php
				echo CHtml::label('Owner Name','',array('class'=>'view-title')) . ": $temp->owner_name<br/>";
				echo CHtml::label('Phone Number ','',array('class'=>'view-title')) . ": $temp->owner_phone<br/>";
                    ?>
		</div>
              
	</div>
	<div class="span-23 last view-section"><strong>Land, Site and Tax Information</strong></div>
	<div class="span-23 last">
		<div class="span-22 last" style="margin: 0 0 0 10px;">
			<?php
				echo CHtml::label('Ownership ','',array('class'=>'view-title')) . ": $temp->ownership<br/>";
			?>
		</div>
		<div class="span-7" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('Millage Rate ','',array('class'=>'view-title')) . ": $temp->millage_rate<br/>";
				echo CHtml::label('Tax ID ','',array('class'=>'view-title')) . ": $temp->tax_id<br/>";
				echo CHtml::label('Taxes ','',array('class'=>'view-title')) . ": $" . number_format($temp->taxes) . "<br/>";
				echo CHtml::label('Taxes Year ','',array('class'=>'view-title')) . ": $temp->tax_year<br/>";
				echo CHtml::label('Alt/Key/Folio ','',array('class'=>'view-title')) . ": $temp->alt_key_folio<br/>";
				echo CHtml::label('Section ','',array('class'=>'view-title')) . ": $temp->section<br/>";
				echo CHtml::label('Township ','',array('class'=>'view-title')) . ": $temp->township<br/>";
				echo CHtml::label('Range ','',array('class'=>'view-title')) . ": $temp->range<br/>";
				echo CHtml::label('CDD ','',array('class'=>'view-title')) . ": $temp->cdd_yn<br/>";
				echo CHtml::label('Annual CDD Fee ','',array('class'=>'view-title')) . ": $temp->annual_cdd_fee<br/>";
				echo CHtml::label('IDX ','',array('class'=>'view-title')) . ": $temp->idx_yn<br/>";
				echo CHtml::label('Water Access ','',array('class'=>'view-title')) . ": $temp->water_access_yn<br/>";
				echo CHtml::label('Water View ','',array('class'=>'view-title')) . ": $temp->water_view_yn<br/>";
			?>
		</div>
		<div class="span-7" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('Subdivision # ','',array('class'=>'view-title')) . ": $temp->subdivision_number<br/>";
				echo CHtml::label('Condo # ','',array('class'=>'view-title')) . ": $temp->condo_number<br/>";
				echo CHtml::label('Subdivision Section # ','',array('class'=>'view-title')) . ": $temp->subdivision_section_number<br/>";
				echo CHtml::label('Block / Parcel ','',array('class'=>'view-title')) . ": $temp->block_parcel<br/>";
				echo CHtml::label('Lot # ','',array('class'=>'view-title')) . ": $temp->lot_number<br/>";
				echo CHtml::label('Zoning ','',array('class'=>'view-title')) . ": $temp->zoning<br/>";
				echo CHtml::label('Zoning Compatible ','',array('class'=>'view-title')) . ": $temp->zoning_compatible_yn<br/>";
				echo CHtml::label('Auction ','',array('class'=>'view-title')) . ": $temp->auction_yn<br/>";
				echo CHtml::label('Plat Book / Page ','',array('class'=>'view-title')) . ": $temp->plat_book_page<br/>";
				echo CHtml::label('Future Land Use ','',array('class'=>'view-title')) . ": $temp->future_land_use<br/>";
				echo CHtml::label('Additional Parcel ','',array('class'=>'view-title')) . ": $temp->additional_parcel_yn<br/>";
				echo CHtml::label('Number of Add. Parcel ','',array('class'=>'view-title')) . ": $temp->number_off_addtional_parcel<br/>";
				echo CHtml::label('Water Frontage ','',array('class'=>'view-title')) . ": $temp->water_frontage_yn<br/>";
			?>
		</div>
		<div class="span-8 last" style="margin: 0 0 10px 10px">
			<?php
				echo CHtml::label('Legal Description ','',array('class'=>'view-title')) . ": $temp->legal_description<br/>";
				echo CHtml::label('Legal Subdivision Name ','',array('class'=>'view-title')) . ": $temp->legal_subdivision_name<br/>";
				echo CHtml::label('Subdiv Community Name ','',array('class'=>'view-title')) . ": $temp->subdiv_community_name<br/>";
				echo CHtml::label('Complex Community Name ','',array('class'=>'view-title')) . ": $temp->complex_community_name<br/>";
				echo CHtml::label('Lot Dimensions ','',array('class'=>'view-title')) . ": $temp->lot_dimesions<br/>";
				echo CHtml::label('Lot Size (Sq.Ft.) ','',array('class'=>'view-title')) . ": $temp->lot_size_sq_ft<br/>";
				echo CHtml::label('Lot Size (Acre) ','',array('class'=>'view-title')) . ": $temp->lot_size_acre<br/>";
				echo CHtml::label('Road Frontage ','',array('class'=>'view-title')) . ": $temp->road_frontage<br/>";
				echo CHtml::label('State Land Use Code ','',array('class'=>'view-title')) . ": $temp->state_land_use_code<br/>";
				echo CHtml::label('State Property Use Code ','',array('class'=>'view-title')) . ": $temp->state_property_use_code<br/>";
				echo CHtml::label('County Land Use Code ','',array('class'=>'view-title')) . ": $temp->county_land_use_code<br/>";
				echo CHtml::label('County Property Use Code ','',array('class'=>'view-title')) . ": $temp->county_property_use_code<br/>";
				echo CHtml::label('Water Extras ','',array('class'=>'view-title')) . ": $temp->water_extras_yn<br/>";
			?>
		</div>
	</div>
	<div class="span-23 last view-section"><strong>Community Information</strong></div>
	<div class="span-23 last" style="margin: 0 0 10px 10px">
		<div class="span-22 last">
			<?php
				echo CHtml::label('Community Features ','',array('class'=>'view-title')) . ": $temp->community_features<br/>";
			?>
		</div>
		<div class="span-7">
			<?php
				echo CHtml::label('HOA Fee ','',array('class'=>'view-title')) . ": $" . number_format($temp->hoa_fee,2) . "<br/>";
				echo CHtml::label('Elementary School ','',array('class'=>'view-title')) . ": $temp->elementary_school<br/>";
			?>
		</div>
		<div class="span-7">
			<?php
				echo CHtml::label('HOA Payment Schedule ','',array('class'=>'view-title')) . ": $temp->hoa_payment_schedule<br/>";
				echo CHtml::label('Middle School ','',array('class'=>'view-title')) . ": $temp->middle_school<br/>";
			?>
		</div>
		<div class="span-8 last">
			<?php
				echo CHtml::label('HOA Communication Association ','',array('class'=>'view-title')) . ": $temp->hoa_comm_association<br/>";
				echo CHtml::label('High School ','',array('class'=>'view-title')) . ": $temp->high_school<br/>";
			?>
		</div>
	</div>
	<div class="span-23 last view-section"><strong>Agent Information</strong></div>
	<div class="span-23 last" style="margin: 0 0 10px 10px">
		<div class="span-11">
			<?php
				echo CHtml::label('Agent ID ','',array('class'=>'view-title')) . ": $temp->agent_id<br/>";
			?>
		</div>
		<div class="span-11 last">
			<?php
				echo CHtml::label('Agent Email ','',array('class'=>'view-title')) . ": $temp->agent_email<br/>";
			?>
		</div>
		<div class="span-22 last">
			<?php
				echo CHtml::label('Agent Homepage ','',array('class'=>'view-title')) . ": $temp->agent_homepage<br/>";
			?>
		</div>
		<div class="span-11">
			<?php
				echo CHtml::label('Agent Name ','',array('class'=>'view-title')) . ": $temp->agent_name<br/>";
				echo CHtml::label("Pager / Cell ",'',array('class'=>'view-title')) . ": $temp->agent_pager_cell<br/>";
				echo CHtml::label('List Agent 2 ID ','',array('class'=>'view-title')) . ": $temp->agent2_id<br/>";
				echo CHtml::label('List Agent 2 Name ','',array('class'=>'view-title')) . ": $temp->agent2_name<br/>";
				echo CHtml::label('Office # ','',array('class'=>'view-title')) . ": $temp->office_number<br/>";
				echo CHtml::label('Agent Extension ','',array('class'=>'view-title')) . ": $temp->agent_extension<br/>";
			?>
		</div>
		<div class="span-11 last">
			<?php
				echo CHtml::label('Direct Phone ','',array('class'=>'view-title')) . ": $temp->agent_direct_phone<br/>";
				echo CHtml::label('Agent Fax ','',array('class'=>'view-title')) . ": $temp->agent_fax<br/>";
				echo CHtml::label('Sales Team Name ','',array('class'=>'view-title')) . ": $temp->sales_team_name<br/>";
				echo CHtml::label('List Agent 2 Phone ','',array('class'=>'view-title')) . ": $temp->agent2_phone<br/>";
				echo CHtml::label('Office Phone ','',array('class'=>'view-title')) . ": $temp->office_phone<br/>";
				echo CHtml::label('Office Fax ','',array('class'=>'view-title')) . ": $temp->office_fax<br/>";
			?>
		</div>
		<div class="span-22 last">
			<?php
				echo CHtml::label('Office Name ','',array('class'=>'view-title')) . ": $temp->office_name<br/>";
			?>
		</div>
		<div class="span-11">
			<?php
				echo CHtml::label('Selling Agent ID ','',array('class'=>'view-title')) . ": $temp->selling_agent_id<br/>";
				echo CHtml::label('Selling Agent 2 ID ','',array('class'=>'view-title')) . ": $temp->selling_agent2_id<br/>";
				echo CHtml::label('Selling Agent 2 Office ID ','',array('class'=>'view-title')) . ": $temp->selling_agent2_office_id<br/>";
				echo CHtml::label('List Office 2 # ','',array('class'=>'view-title')) . ": $temp->list_office2_number<br/>";
			?>
		</div>
		<div class="span-11 last">
			<?php
				echo CHtml::label('Selling Agent Name ','',array('class'=>'view-title')) . ": $temp->selling_agent_name<br/>";
				echo CHtml::label('Selling Agent 2 Name ','',array('class'=>'view-title')) . ": $temp->selling_agent2_name<br/>";
				echo CHtml::label('Selling Agent 2 Office Name ','',array('class'=>'view-title')) . ": $temp->selling_agent2_office_name<br/>";
				echo CHtml::label('List Office 2 Name ','',array('class'=>'view-title')) . ": $temp->list_office2_name<br/>";
			?>		
		</div>
		<div class="span-7">
			<?php echo CHtml::label('Buyer Agent Comp ','',array('class'=>'view-title')) . ": $temp->buyer_agent_comp<br/>"; ?>
		</div>
		<div class="span-7">
			<?php echo CHtml::label('Non-Rep Comp ','',array('class'=>'view-title')) . ": $temp->non_rep_comp<br/>"; ?>
		</div>
		<div class="span-8 last">
			<?php echo CHtml::label('Trans Broker Comp ','',array('class'=>'view-title')) . ": $temp->trans_broker_comp<br/>"; ?>
		</div>
	</div>
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
  	<div class="clear"></div><br/>
  	<?php echo CHtml::label("Showing Instruction",'',array('class'=>'view-title')) . ": " . $model->showing_instruction; ?>&nbsp;&nbsp;<br/></div>

	

</div>
<?php
$this->breadcrumbs=array(
	'Lands'=>array('index'),
	"Land #" . $model->id,
);

$temp = new stdClass();
foreach($model as $k => $v){
	$temp->$k = str_replace(" |", ",", $v);
}
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

<?php
$skrip = "
	$('#chkAgree').change(function()
	{
		var result = $('#chkAgree').attr('checked');
		var btn = $('.stripe-button-el, input[name=" . 'btnSurvey' . "]');
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
<h1>View Vacant Land #<?php echo $model->id; ?></h1>
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
	<h2 class="span-23 last view-address"><?php echo "$model->street_name, $model->city " . CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/css/images/icon_print.png', '', array()), array("/listing/land/print/id/$model->id"), array('target'=>'_blank') ); ?>&nbsp;</h2>
	<div class="span-23 last">
		<div class="span-11" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('List Price ','',array('class'=>'view-title')) . ": $temp->list_price<br/>";
				echo CHtml::label('House # ','',array('class'=>'view-title')) . ": $temp->house_number<br/>";
				echo CHtml::label('Street Name ','',array('class'=>'view-title')) . ": $temp->street_name<br/>";
				echo CHtml::label('Street Type ','',array('class'=>'view-title')) . ": $temp->street_type<br/>";
				echo CHtml::label('Pre ','',array('class'=>'view-title')) . ": $temp->street_dir_pre";
				echo CHtml::label('Post ','',array('class'=>'view-title')) . ": $temp->street_dir_post<br/>";
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
				echo(isset($temp->listing_price)?CHtml::label('Listing Price ','',array('class'=>'view-title')) . ": $" . number_format(doubleval($temp->listing_price),2). "<br/>":CHtml::label('Listing Price ','',array('class'=>'view-title')) . ": $<br/>");
                                echo CHtml::label('Originating Board Id ','',array('class'=>'view-title')) . ": $temp->originating_board_id<br/>";
			?>
		</div>
		<div class="span-22 last" style="margin: -10px 0 10px 10px">
			<?php
				echo CHtml::label('Property Style ','',array('class'=>'view-title')) . ": $temp->property_style<br/>";
			?>
		</div>
	</div>
	<div class="span-23 last view-section"><strong>Land, Site and Tax Information</strong></div>
	<div class="span-23 last">
		<div class="span-22 last" style="margin: 0 0 0 10px;">
			<?php
				echo CHtml::label('Ownership ','',array('class'=>'view-title')) . ": $temp->ownership<br/>";
                                echo CHtml::label('Availability ','',array('class'=>'view-title')) . ": $temp->availability<br/>";
                                echo CHtml::label('Easements ','',array('class'=>'view-title')) . ": $temp->easements<br/>";
                        ?>
		</div>
		<div class="span-7" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('Location ','',array('class'=>'view-title')) . ": $temp->location<br/>";
				echo CHtml::label('Millage Rate ','',array('class'=>'view-title')) . ": $temp->millage_rate<br/>";
				echo CHtml::label('Tax ID ','',array('class'=>'view-title')) . ": $temp->tax_id<br/>";
				echo CHtml::label('Taxes ','',array('class'=>'view-title')) . ": $" . number_format($temp->taxes) . "<br/>";
				echo(isset($temp->tax_year)?CHtml::label('Taxes Year ','',array('class'=>'view-title')) . ": " .$temp->tax_year. "<br/>":CHtml::label('Taxes Year ','',array('class'=>'view-title')) . ": <br/>");
                                echo CHtml::label('Alt/Key/Folio ','',array('class'=>'view-title')) . ": ".isset($temp->alt_key_folio)?$temp->alt_key_folio:""."<br/>";
				echo CHtml::label('Section ','',array('class'=>'view-title')) . ": $temp->section<br/>";
				echo CHtml::label('Township ','',array('class'=>'view-title')) . ": $temp->township<br/>";
				echo CHtml::label('Range ','',array('class'=>'view-title')) . ": $temp->range<br/>";
				echo CHtml::label('CDD ','',array('class'=>'view-title')) . ": $temp->cdd_yn<br/>";
				echo CHtml::label('Annual CDD Fee ','',array('class'=>'view-title')) . ": $temp->annual_cdd_fee<br/>";
				echo CHtml::label('IDX ','',array('class'=>'view-title')) . ": $temp->idx_yn<br/>";
				echo CHtml::label('Water Access Y/N ','',array('class'=>'view-title')) . ": $temp->water_access_yn<br/>";
				echo CHtml::label('Water Access ','',array('class'=>'view-title')) . ": $temp->water_access<br/>";
				echo CHtml::label('Water View Y/N ','',array('class'=>'view-title')) . ": $temp->water_view_yn<br/>";
                                echo CHtml::label('Water View ','',array('class'=>'view-title')) . ": $temp->water_view<br/>";
                                echo CHtml::label('Owner Name ','',array('class'=>'view-title')) . ": ".$temp->owner_name."<br/>";
				
                                ?>
		</div>
		<div class="span-7" style="margin: 0 0 10px 10px;">
			<?php
				echo CHtml::label('Front Exposure  ','',array('class'=>'view-title')) . ": $temp->front_exposire<br/>";
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
				echo(isset($temp->additional_parcel_yn)?CHtml::label('Additional Parcel ','',array('class'=>'view-title')) . ": " . $temp->additional_parcel_yn. "<br/>":CHtml::label('Additional Parcel ','',array('class'=>'view-title')) . ": <br/>");
                                echo(isset($temp->number_off_addtional_parcel)?CHtml::label('Number of Add. Parcel ','',array('class'=>'view-title')) . ": $" . number_format(doubleval($temp->number_off_addtional_parcel),2). "<br/>":CHtml::label('Number of Add. Parcel ','',array('class'=>'view-title')) . ": <br/>");
                                echo CHtml::label('Water Frontage Y/N ','',array('class'=>'view-title')) . ": $temp->water_frontage_yn<br/>";
                                echo CHtml::label('Water Frontage ','',array('class'=>'view-title')) . ": $temp->water_frontage<br/>";
                                echo CHtml::label('Water Name ','',array('class'=>'view-title')) . ": $temp->water_name<br/>";
				echo CHtml::label('Owner Phone Number','',array('class'=>'view-title')) . ": ".$temp->owner_phone."<br/>";
			?>
		</div>
		<div class="span-8 last" style="margin: 0 0 10px 10px">
			<?php
				echo CHtml::label('Front Footage ','',array('class'=>'view-title')) . ": $temp->front_footage<br/>";
				echo CHtml::label('Legal Description ','',array('class'=>'view-title')) . ": $temp->legal_description<br/>";
				echo CHtml::label('Legal Subdivision Name ','',array('class'=>'view-title')) . ": $temp->legal_subdivision_name<br/>";
				echo CHtml::label('Subdiv Community Name ','',array('class'=>'view-title')) . ": $temp->subdiv_community_name<br/>";
				echo CHtml::label('Complex Community Name ','',array('class'=>'view-title')) . ": $temp->complex_community_name<br/>";
				echo(isset($temp->lot_dimesions)?CHtml::label('Lot Dimensions ','',array('class'=>'view-title')) . ": " . $temp->lot_dimensions. "<br/>":CHtml::label('Lot Dimensions ','',array('class'=>'view-title')) . ":<br/>");
                                echo(isset($temp->lot_size_sq_ft)?CHtml::label('Lot Size (Sq.Ft.) ','',array('class'=>'view-title')) . ": " . $temp->lot_size_sq_ft. "<br/>":CHtml::label('Lot Size (Sq.Ft.) ','',array('class'=>'view-title')) . ": <br/>");
                                echo CHtml::label('Lot Size (Acre) ','',array('class'=>'view-title')) . ": $temp->lot_size_acre<br/>";
				echo CHtml::label('Road Frontage ','',array('class'=>'view-title')) . ": $temp->road_frontage<br/>";
				echo CHtml::label('State Land Use Code ','',array('class'=>'view-title')) . ": $temp->state_land_use_code<br/>";
				echo CHtml::label('State Property Use Code ','',array('class'=>'view-title')) . ": $temp->state_property_use_code<br/>";
				echo CHtml::label('County Land Use Code ','',array('class'=>'view-title')) . ": $temp->county_land_use_code<br/>";
				echo CHtml::label('County Property Use Code ','',array('class'=>'view-title')) . ": $temp->county_property_use_code<br/>";
				echo CHtml::label('Water Extras Y/N ','',array('class'=>'view-title')) . ": $temp->water_extras_yn<br/>";
                                echo CHtml::label('Water Extras','',array('class'=>'view-title')) . ": $temp->water_extras<br/>";
                                echo CHtml::label('Water Front Feet ','',array('class'=>'view-title')) . ": ".$temp->water_front_feet."<br/>";
				echo CHtml::label('CDD Y/N ','',array('class'=>'view-title')) . ": ".$temp->cdd_yn."<br/>";
			?>
		</div>
                <div class="span-22 last" style="margin: 0 0 0 10px;">
			<?php
				echo CHtml::label('Utilities (8 Max) ','',array('class'=>'view-title')) . ": $temp->utilities<br/>";
                                echo CHtml::label('Fences (3 Max) ','',array('class'=>'view-title')) . ": $temp->fences<br/>";
                                echo CHtml::label('Site Improvements (3 Max) ','',array('class'=>'view-title')) . ": $temp->site_improvements<br/>";
			?>
		</div>
	</div>
	<div class="span-23 last view-section"><strong>Community Information</strong></div>
	<div class="span-23 last" style="margin: 0 0 10px 10px">
		<div class="span-22 last">
			<?php
				echo CHtml::label('Community Features ','',array('class'=>'view-title')) . ": $temp->community_features<br/>";
                                echo CHtml::label('Realtor Information ','',array('class'=>'view-title')) . ": $temp->realtor_information<br/>";
                                echo CHtml::label('Realtor Information (Confidential) (3 Max)  ','',array('class'=>'view-title')) . ": $temp->realtor_information_confidential<br/>";
                                echo CHtml::label('Financing Available (7 Max) ','',array('class'=>'view-title')) . ": $temp->financing_available<br/>";
                                echo CHtml::label('Lease Terms ','',array('class'=>'view-title')) . ": $temp->lease_terms<br/>";
                                echo CHtml::label('Special Listing Types ','',array('class'=>'view-title')) . ": $temp->special_listing_type<br/>";
                                echo CHtml::label('Special Sale Provisions ','',array('class'=>'view-title')) . ": $temp->special_sale_provision<br/>";
                                echo CHtml::label('Driving Directions ','',array('class'=>'view-title')) . ": $temp->driving_directions<br/>";
                                echo CHtml::label('Realtor only remarks ','',array('class'=>'view-title')) . ": $temp->realtor_only_remarks<br/>";
                                echo CHtml::label('Public Remarks ','',array('class'=>'view-title')) . ": $temp->public_remarks<br/>";
                                ?>
		</div>
		<div class="span-7">
			<?php
				echo CHtml::label('HOA Fee ','',array('class'=>'view-title')) . ": $" . number_format($temp->hoa_fee,2) . "<br/>";
				echo CHtml::label('Elementary School ','',array('class'=>'view-title')) . ": $temp->elementary_school<br/>";
                                echo CHtml::label('Virtual Tour ','',array('class'=>'view-title')) . ": $temp->virtual_tour<br/>";
                                echo CHtml::label('Showing Time Secure Remarks ','',array('class'=>'view-title')) . ": $temp->showing_time_secure_remarks<br/>";
                                ?>
		</div>
                
		<div class="span-7">
			<?php
				echo CHtml::label('HOA Payment Schedule ','',array('class'=>'view-title')) . ": $temp->hoa_payment_schedule<br/>";
				echo CHtml::label('Middle School ','',array('class'=>'view-title')) . ": $temp->middle_school<br/>";
                                echo CHtml::label('Call Center Phone ','',array('class'=>'view-title')) . ": $temp->call_center_phone_number<br/>";
                                echo CHtml::label('Display address on internet Y/N ','',array('class'=>'view-title')) . ": $temp->display_property_address_on_internet_yn<br/>";
                                ?>
		</div>
		<div class="span-8 last">
			<?php
				echo CHtml::label('HOA Communication Association ','',array('class'=>'view-title')) . ": $temp->hoa_comm_association<br/>";
				echo CHtml::label('High School ','',array('class'=>'view-title')) . ": $temp->high_school<br/>";
                                echo CHtml::label('Internet Y/N ','',array('class'=>'view-title')) . ": $temp->internet_yn<br/>";
                                echo CHtml::label('Realtor.com Y/N','',array('class'=>'view-title')) . ": $temp->realtor_com_yn&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo CHtml::label('3rd Party Y/N','',array('class'=>'view-title')) . ": $temp->third_party_yn";
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
            <?php echo CHtml::label('Showing Instruction  ','',array('class'=>'view-title')) . ": $temp->showing_instruction<br/>"; ?>
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
  	</div>
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
	
	<?php if( ($model->land_status == 'COMPLETED' || $model->land_status == 'APPROVED')) : ?>
	<table class="span-23 last form_tb2" >
		<tr>
	        	<td style="vertical-align:top; padding:20px; text-align:center;">
		            	<h3 style="padding-top:5px;">Agreements</h3>
		              <p style="text-align:justify;">The Focus Firm is acting under a "NO BROKERAGE" relationship and promise to conduct our business with you dealing fairly and honestly.  We must disclose all known facts that materially affect the value of the residential real property which are not readily observable to the buyer and we will Account for all funds entrusted to the licensee.</p>
		              <p style="text-align:justify;">The Owner has reviewed the information entered on this Profile Sheet and acknowledges that the foregoing information is believed to be true and correct and by reference hereto becomes a part of the Listing Agreement. Owner agrees to promptly notify us if there is any material change in such information during the term of this Listing. The Owner agrees to indemnify and hold harmless the My-Florida Regional MLS and its employees, the Listing Broker and Licensees, the Selling Broker and Licensees, and all other Cooperating Brokers and Licensees against any and all claims or liability (Including attorney's fees) arising from any breach of warranty by Owner or from any incorrect information supplied by Owner or from any facts concerning the Property which was known or reasonably should have been known to Owner but not disclosed by Owner. At the request of the Listing Broker, unless otherwise properly indicated on this Profile Sheet, the My-Florida Regional MLS may electronically transfer information about Owner's property to Internet Web Sites to aid in the marketing of the Property for sale. Seller authorizes Broker, the MLS and/or Association of Realtors® to use and/or license the Active listing and sold data. My-Florida Regional MLS assumes no responsibility or liability to Owner for errors or omissions on this Data Entry Form or in the MLS computer system or reciprocal computer systems. The owner(s) also acknowledges that they must notify The Focus Firm Inc., REALTORS within 48 hours of signing a sales contract AND within 48 hours of closing and agree to pay any and all fines levied if you do not do so.</p>
		              <div style="text-align:left;"></div> 
		              <p><?php echo CHtml::checkBox('chkAgree', false, array()); ?>&nbsp;I&nbsp;Agree</p>
	               	<p style="color:#090; text-align:left;">
					<i>* Click '<b>Approve</b>' link to state you are agreed with above agreements.<i><br/>
					<i>* Click '<b>Cancel</b>' link to approve later.</i><br/><br/>
	               	</p>
			</td>
      		</tr>
  	</table>
	<div class="row buttons" style="text-align:center;">
	    	<?php echo '&nbsp;&nbsp;'; ?>
            <form action="<?php echo Yii::app()->createUrl('listing/land/approve', array('id'=>$model->id)) ?>" method="POST">
                  <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                   data-key="pk_live_ixMRCij4iwpDUZM9ebTgRYbg"
                    data-image="http://localhost/flatrate/themes/custom/css/images/logo.png"
                    data-name="Flatratelist.com"
                    data-description="Flatratelist.com Listing Service"
                    data-amount="14700">
                  </script>
                  <input name="userid" type="hidden" value="<?php echo Yii::app()->user->id; ?>"/>
                  <input name="mls_id" type="hidden" value="<?php echo $model->id ;?>"/>
                  <input name="paymentdone" type="hidden" value="1"/>
                </form>
	    	<?php echo CHtml::submitButton('CANCEL', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/land/admin')); ?>
	    	<?php //echo CHtml::submitButton('I APPROVE THIS LISTING, TAKE ME TO CHECKOUT', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/land/approve/id/' . $model->id,'disabled'=>true,'name'=>'btnApprove')); ?>
	</div>
	<?php elseif($model->land_status == "PAID") : ?>
	<table class="span-23 last form_tb2" ></table>
	<div class="row buttons" style="text-align:center;">
		<?php echo CHtml::submitButton('CANCEL', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/land/admin')); ?>
	    	<?php echo '&nbsp;&nbsp;'; ?>
	    	<?php echo CHtml::submitButton('SET AS PENDING', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/land/pending/id/' . $model->id,'name'=>'btnPending')); ?>
	</div>
	<?php elseif($model->land_status == "PENDING") : ?>
	<table class="span-23 last form_tb2" ></table>
	<div class="row buttons" style="text-align:center;">
		<?php echo CHtml::submitButton('CANCEL', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/land/admin')); ?>
	    	<?php echo '&nbsp;&nbsp;'; ?>
	    	<?php echo CHtml::submitButton('SET AS SOLD', array('submit'=> Yii::app()->request->baseUrl . '/index.php/listing/land/sold/id/' . $model->id,'name'=>'btnSold')); ?>
	</div>
    	<?php endif; ?>

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_date',
		'creator_id',
		'update_date',
		'updator_id',
		'originating_board_id',
		'owner_name',
		'owner_phone',
		'front_footage',
		'total_acreage',
		'location',
		'front_exposire',
		'availability',
		'easements',
		'water_access',
		'water_view',
		'water_frontage',
		'water_extras',
		'water_name',
		'water_front_feet',
		'site_improvements',
		'fences',
		'utilities',
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
		'interoffice_info',
		'driving_directions',
		'realtor_only_remarks',
		'public_remarks',
		'additional_public_remarks',
	),
));*/ ?>

<script>
$(document).ready(function(){
    $('.stripe-button-el span').empty().append('I Approve This Listing, Proceed To Checkout').css('min-height', '10px');
    $('.stripe-button-el').prop("disabled",true);
    $('#chkAgree').change(function()
	{
		var result = $('#chkAgree').attr('checked');
		var btn = $('.stripe-button-el');
		if(result == undefined){
			btn.attr('disabled',true);	
		}
		else{
			btn.attr('disabled',false);
		}

	});
})        
</script>
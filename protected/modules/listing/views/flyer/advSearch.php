<div class="form">
<h1>Advanced Search</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>'/index.php/listing/flyer/result',
	'id'=>'mls-advSearch-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<fieldset class="row span-24">
		<legend style="margin-top: 15px;"><h3>Basic</h3></legend>
		<div class="span-23 last">
			<div class="row">
				<?php echo $form->labelEx($model,'list_price'); ?>
				<?php echo $form->textField($model,'list_price[]', array('placeholder'=>'Min List Price')) . " to " . $form->textField($model,'list_price[]', array('placeholder'=>'Max List Price')); ?>
				<?php echo $form->error($model,'list_price'); ?>
			</div>	
		</div>
		<div class=" span-23 last">
			<div class="row">
				<div class="span-4">
					<?php echo $form->labelEx($model,'address'); ?>
					<?php echo $form->textField($model,'address'); ?>
					<?php echo $form->error($model,'address'); ?>
				</div>
				<div class="span-4">
					<?php echo $form->labelEx($model,'city'); ?>
					<?php echo $form->textField($model,'city'); ?>
					<?php echo $form->error($model,'city'); ?>
				</div>
				<div class="span-4">
					<?php echo $form->labelEx($model,'state'); ?>
					<?php echo $form->dropDownList($model,'state', CHtml::listData(DropStates::model()->findAll(),'code','name'), array('empty'=>'select...')); ?>
					<?php echo $form->error($model,'state'); ?>
				</div>
				<div class="span-4">
					<?php echo $form->labelEx($model,'zip_code'); ?>
					<?php echo $form->textField($model,'zip_code'); ?>
					<?php echo $form->error($model,'zip_code'); ?>
				</div>
				<div class="span-4">
					<?php echo $form->labelEx($model,'county'); ?>
					<?php echo $form->textField($model,'county'); ?>
					<?php echo $form->error($model,'county'); ?>
				</div>
			</div>	
		</div>
		<div class="span-23 last">
			<div class="row">
				<div class="span-4">
					<?php echo $form->labelEx($model,'bedrooms'); ?>
					<?php echo $form->dropDownList($model,'bedrooms', array(""=>"Any", 1=>"1+", 2=>"2+", 3=>"3+", 4=>"4+", 5=>"5+")); ?>
					<?php echo $form->error($model,'bedrooms'); ?>
					
					<?php echo $form->labelEx($model,'full_baths'); ?>
					<?php echo $form->dropDownList($model,'full_baths', array(""=>"Any", 1=>"1+", 2=>"2+", 3=>"3+", 4=>"4+", 5=>"5+")); ?>
					<?php echo $form->error($model,'full_baths'); ?>
					
					<?php echo $form->labelEx($model,'half_baths'); ?>
					<?php echo $form->dropDownList($model,'half_baths', array(""=>"Any", 1=>"1+", 2=>"2+", 3=>"3+", 4=>"4+", 5=>"5+")); ?>
					<?php echo $form->error($model,'half_baths'); ?>
				</div>
				<div class="span-8">
					<?php echo $form->labelEx($model,'property_style'); ?>
					<?php echo $form->checkBoxList($model,'property_style', CHtml::listData(ListPropertyStyle::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'property_style'); ?>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset class="row span-24">
		<legend style="margin-top: 15px;"><h3>Property Features</h3></legend>
		<div style="span-24 last">
			<div class="row">
				<div class="span-6">
					<?php echo $form->labelEx($model,'sq_ft_heated'); ?>
					<?php echo $form->textField($model,'sq_ft_heated', array('placeholder'=>'Min Sq Ft')); ?>
					<?php echo $form->error($model,'sq_ft_heated'); ?>
					<br/><br/>
					<?php echo $form->labelEx($model,'property_description'); ?>
					<?php echo $form->checkBoxList($model,'property_description', CHtml::listData(ListPropertyDescription::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'property_description'); ?>
				</div>
				<div class="span-6">
					<?php echo $form->labelEx($model,'year_built'); ?>
					<?php echo $form->textField($model,'year_built', array('placeholder'=>'Min Year Built')); ?>
					<?php echo $form->error($model,'year_built'); ?>
					<br/><br/>
					<?php echo $form->labelEx($model,'interior_layout_max'); ?>
					<?php echo $form->checkBoxList($model,'interior_layout_max', CHtml::listData(ListInteriorLayout::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'interior_layout_max'); ?>
					<br/><br/>
					<?php echo $form->labelEx($model,'air_conditioning_max'); ?>
					<?php echo $form->checkBoxList($model,'air_conditioning_max', CHtml::listData(ListAirConditioning::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'air_conditioning_max'); ?>
				</div>
				<div class="span-6">
					<?php echo $form->labelEx($model,'garage_carport_max'); ?>
					<?php echo $form->checkBoxList($model,'garage_carport_max', CHtml::listData(ListGarage::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'garage_carport_max'); ?>
					<br/><br/>
					<?php echo $form->labelEx($model,'heating_and_fuel_max'); ?>
					<?php echo $form->checkBoxList($model,'heating_and_fuel_max', CHtml::listData(ListHeatingAndFuel::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'heating_and_fuel_max'); ?>
				</div>
				<div class="span-6 last">
					<?php echo $form->labelEx($model,'garage_features_max'); ?>
					<?php echo $form->checkBoxList($model,'garage_features_max', CHtml::listData(ListGarageFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
					<?php echo $form->error($model,'garage_features_max'); ?>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="span-24">
		<div class="span-12">
			<fieldset class="span-12">
				<legend style="margin-top: 15px;"><h3>Lot & Community</h3></legend>
				<div class="span-12">
					<div class="span-6">
						<?php echo $form->labelEx($model,'total_acreage'); ?>
						<?php echo $form->dropDownList($model,'total_acreage', CHtml::listData(DropTotalAcreage::model()->findAll(),'code','name'), array('empty'=>'select...')); ?>
						<?php echo $form->error($model,'total_acreage'); ?>
						<br/><br/>
						<?php echo $form->labelEx($model,'location_max'); ?>
						<?php echo $form->checkBoxList($model,'location_max', CHtml::listData(ListLocation::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'location_max'); ?>
					</div>
					<div class="span-6 last">
						<?php echo $form->labelEx($model,'community_features_max'); ?>
						<?php echo $form->checkBoxList($model,'community_features_max', CHtml::listData(ListCommunityFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'community_features_max'); ?>
					</div>
				</div>
			</fieldset>
		</div>
<!--		<div class="span-12 last">
			<?php if(!Yii::app()->user->isGuest): ?>
			<fieldset class="span-12">
				<legend style="margin-top: 15px;"><h3>Display Options</h3></legend>
				
			</fieldset>
			<?php endif; ?>
		</div>-->
	</div>
	<div class="row buttons" style="clear: both;">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<!--	<fieldset>
		<legend><h3>Features</h3></legend>
		<div class="span-23 last">
			<div class="span-4">
				<?php echo $form->labelEx($model,'ownership_max'); ?>
				<?php echo $form->checkBoxList($model,'ownership_max', CHtml::listData(ListOwnership::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'ownership_max'); ?>
			</div>
			<div class="span-4">
				<?php echo $form->labelEx($model,'sq_ft_source'); ?>
				<?php echo $form->checkBoxList($model,'sq_ft_source', CHtml::listData(DropSqftSource::model()->findAll(),'code','name'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'sq_ft_source'); ?>
			</div>
			<div class="span-7 last">
			
			</div>
		</div>
	</fieldset>-->
		<!--<div class="span-6">	
			<div class="row">
				<?php echo $form->labelEx($model,'building_number_floors'); ?>
				<?php echo $form->textField($model,'building_number_floors'); ?>
				<?php echo $form->error($model,'building_number_floors'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'unit_number'); ?>
				<?php echo $form->textField($model,'unit_number'); ?>
				<?php echo $form->error($model,'unit_number'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'total_units'); ?>
				<?php echo $form->textField($model,'total_units'); ?>
				<?php echo $form->error($model,'total_units'); ?>
			</div>
		</div>
		<div class="span-5 last">
		
			<div class="row">
				<?php echo $form->labelEx($model,'condo_floor_number'); ?>
				<?php echo $form->textField($model,'condo_floor_number'); ?>
				<?php echo $form->error($model,'condo_floor_number'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'millage_rate'); ?>
				<?php echo $form->textField($model,'millage_rate'); ?>
				<?php echo $form->error($model,'millage_rate'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'floors_in_unit'); ?>
				<?php echo $form->textField($model,'floors_in_unit'); ?>
				<?php echo $form->error($model,'floors_in_unit'); ?>
			</div>
		</div>-->
<!--	<fieldset class="row">
		<div class="span-6">
			
		
			<div class="row">
				<?php echo $form->labelEx($model,'taxes'); ?>
				<?php echo $form->textField($model,'taxes'); ?>
				<?php echo $form->error($model,'taxes'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'tax_year'); ?>
				<?php echo $form->textField($model,'tax_year'); ?>
				<?php echo $form->error($model,'tax_year'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'plat_book_page'); ?>
				<?php echo $form->textField($model,'plat_book_page'); ?>
				<?php echo $form->error($model,'plat_book_page'); ?>
			</div>
		</div>
		<div class="span-5">
			<div class="row">
				<?php echo $form->labelEx($model,'section'); ?>
				<?php echo $form->textField($model,'section'); ?>
				<?php echo $form->error($model,'section'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'township'); ?>
				<?php echo $form->textField($model,'township'); ?>
				<?php echo $form->error($model,'township'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'range'); ?>
				<?php echo $form->textField($model,'range'); ?>
				<?php echo $form->error($model,'range'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'future_land_use'); ?>
				<?php echo $form->textField($model,'future_land_use'); ?>
				<?php echo $form->error($model,'future_land_use'); ?>
			</div>
		</div>
		<div class="span-6">
			<div class="row">
				<?php echo $form->labelEx($model,'subdivision_number'); ?>
				<?php echo $form->textField($model,'subdivision_number'); ?>
				<?php echo $form->error($model,'subdivision_number'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'block_parcel'); ?>
				<?php echo $form->textField($model,'block_parcel'); ?>
				<?php echo $form->error($model,'block_parcel'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'lot_number'); ?>
				<?php echo $form->textField($model,'lot_number'); ?>
				<?php echo $form->error($model,'lot_number'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'complex_community_name'); ?>
				<?php echo $form->textField($model,'complex_community_name'); ?>
				<?php echo $form->error($model,'complex_community_name'); ?>
			</div>
		</div>
		<div class="span-5 last">
			<div class="row">
				<?php echo $form->labelEx($model,'legal_description'); ?>
				<?php echo $form->textField($model,'legal_description'); ?>
				<?php echo $form->error($model,'legal_description'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'legal_subdivision_name'); ?>
				<?php echo $form->textField($model,'legal_subdivision_name'); ?>
				<?php echo $form->error($model,'legal_subdivision_name'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'zoning'); ?>
				<?php echo $form->textField($model,'zoning'); ?>
				<?php echo $form->error($model,'zoning'); ?>
			</div>
		</div>
	</fieldset>-->
<!--	<fieldset class="row">
		<div class="span-6">
			
		</div>
		<div class="span-5">
			
		
			
		

		
			<div class="row">
				<?php echo $form->labelEx($model,'total_building_sq_ft'); ?>
				<?php echo $form->textField($model,'total_building_sq_ft'); ?>
				<?php echo $form->error($model,'total_building_sq_ft'); ?>
			</div>
		</div>
		<div class="span-6">
			
			
		
			<div class="row">
				<?php echo $form->labelEx($model,'cdd_yn'); ?>
				<?php echo $form->radioButtonList($model,'cdd_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;', 'labelOptions'=>array('style'=>'display:inline'))); ?>
				<?php echo $form->error($model,'cdd_yn'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'annual_cdd_fee'); ?>
				<?php echo $form->textField($model,'annual_cdd_fee'); ?>
				<?php echo $form->error($model,'annual_cdd_fee'); ?>
			</div>
		</div>
		<div class="span-5 last">
			<div class="row">
				<?php echo $form->labelEx($model,'additional_parcel_yn'); ?>
				<?php echo $form->radioButtonList($model,'additional_parcel_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;', 'labelOptions'=>array('style'=>'display:inline'))); ?>
				<?php echo $form->error($model,'additional_parcel_yn'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'homestead_yn'); ?>
				<?php echo $form->radioButtonList($model,'homestead_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;', 'labelOptions'=>array('style'=>'display:inline'))); ?>
				<?php echo $form->error($model,'homestead_yn'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'other_exemptions_yn'); ?>
				<?php echo $form->radioButtonList($model,'other_exemptions_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;', 'labelOptions'=>array('style'=>'display:inline'))); ?>
				<?php echo $form->error($model,'other_exemptions_yn'); ?>
			</div>
		</div>
	</fieldset>
	<fieldset class="row">
		<div class="span-6">

		</div>
		<div class="span-5">
			<div class="row">
				<?php echo $form->labelEx($model,'home_features_max'); ?>
				<?php echo $form->checkBoxList($model,'home_features_max', CHtml::listData(ListHomeFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'home_features_max'); ?>
			</div>
			<div class="row">
				<?php echo $form->labelEx($model,'utilities_data_max'); ?>
				<?php echo $form->checkBoxList($model,'utilities_data_max', CHtml::listData(ListUtilitiesData::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'utilities_data_max'); ?>
			</div>
		</div>
		<div class="span-6">
			<div class="row">
				<?php echo $form->labelEx($model,'lot_dimensions'); ?>
				<?php echo $form->textField($model,'lot_dimensions'); ?>
				<?php echo $form->error($model,'lot_dimensions'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'lot_size_sq_ft'); ?>
				<?php echo $form->textField($model,'lot_size_sq_ft'); ?>
				<?php echo $form->error($model,'lot_size_sq_ft'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'lot_size_acre'); ?>
				<?php echo $form->textField($model,'lot_size_acre'); ?>
				<?php echo $form->error($model,'lot_size_acre'); ?>
			</div>
			

			
			<div class="row">
				<?php echo $form->labelEx($model,'water_access'); ?>
				<?php echo $form->checkBoxList($model,'water_access', CHtml::listData(ListWaterAccess::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'water_access'); ?>
			</div>
		</div>
		<div class="span-5 last">
			<div class="row">
				<?php echo $form->labelEx($model,'water_view'); ?>
				<?php echo $form->checkBoxList($model,'water_view', CHtml::listData(ListWaterView::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'water_view'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'water_frontage'); ?>
				<?php echo $form->checkBoxList($model,'water_frontage', CHtml::listData(ListWaterFrontage::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
				<?php echo $form->error($model,'water_frontage'); ?>
			</div>
		
		</div>
	</fieldset>-->
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'pets_allowed_yn'); ?>
		<?php echo $form->textField($model,'pets_allowed_yn'); ?>
		<?php echo $form->error($model,'pets_allowed_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'living_room'); ?>
		<?php echo $form->textField($model,'living_room'); ?>
		<?php echo $form->error($model,'living_room'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kitchen'); ?>
		<?php echo $form->textField($model,'kitchen'); ?>
		<?php echo $form->error($model,'kitchen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'master_bedroom_size'); ?>
		<?php echo $form->textField($model,'master_bedroom_size'); ?>
		<?php echo $form->error($model,'master_bedroom_size'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'garage_dimensions'); ?>
		<?php echo $form->textField($model,'garage_dimensions'); ?>
		<?php echo $form->error($model,'garage_dimensions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dining_room'); ?>
		<?php echo $form->textField($model,'dining_room'); ?>
		<?php echo $form->error($model,'dining_room'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'family_room'); ?>
		<?php echo $form->textField($model,'family_room'); ?>
		<?php echo $form->error($model,'family_room'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'great_room'); ?>
		<?php echo $form->textField($model,'great_room'); ?>
		<?php echo $form->error($model,'great_room'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bedroom_2nd_size'); ?>
		<?php echo $form->textField($model,'bedroom_2nd_size'); ?>
		<?php echo $form->error($model,'bedroom_2nd_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bedroom_3rd_size'); ?>
		<?php echo $form->textField($model,'bedroom_3rd_size'); ?>
		<?php echo $form->error($model,'bedroom_3rd_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bedroom_4th_size'); ?>
		<?php echo $form->textField($model,'bedroom_4th_size'); ?>
		<?php echo $form->error($model,'bedroom_4th_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bedroom_5th_size'); ?>
		<?php echo $form->textField($model,'bedroom_5th_size'); ?>
		<?php echo $form->error($model,'bedroom_5th_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'study_den_dimensions'); ?>
		<?php echo $form->textField($model,'study_den_dimensions'); ?>
		<?php echo $form->error($model,'study_den_dimensions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'balcony_porch_lanai'); ?>
		<?php echo $form->textField($model,'balcony_porch_lanai'); ?>
		<?php echo $form->error($model,'balcony_porch_lanai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dinette'); ?>
		<?php echo $form->textField($model,'dinette'); ?>
		<?php echo $form->error($model,'dinette'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'studio_dimensions'); ?>
		<?php echo $form->textField($model,'studio_dimensions'); ?>
		<?php echo $form->error($model,'studio_dimensions'); ?>
	</div>
	






	<div class="row">
		<?php echo $form->labelEx($model,'new_construction_yn'); ?>
		<?php echo $form->textField($model,'new_construction_yn'); ?>
		<?php echo $form->error($model,'new_construction_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'private_pool_yn'); ?>
		<?php echo $form->textField($model,'private_pool_yn'); ?>
		<?php echo $form->error($model,'private_pool_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'foundation_max'); ?>
		<?php echo $form->textField($model,'foundation_max'); ?>
		<?php echo $form->error($model,'foundation_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exterior_construction_max'); ?>
		<?php echo $form->textField($model,'exterior_construction_max'); ?>
		<?php echo $form->error($model,'exterior_construction_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'roof_max'); ?>
		<?php echo $form->textField($model,'roof_max'); ?>
		<?php echo $form->error($model,'roof_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exterior_features_max'); ?>
		<?php echo $form->textField($model,'exterior_features_max'); ?>
		<?php echo $form->error($model,'exterior_features_max'); ?>
	</div>






	<div class="row">
		<?php echo $form->labelEx($model,'appliances_included_max'); ?>
		<?php echo $form->textField($model,'appliances_included_max'); ?>
		<?php echo $form->error($model,'appliances_included_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'interior_features_max'); ?>
		<?php echo $form->textField($model,'interior_features_max'); ?>
		<?php echo $form->error($model,'interior_features_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'floor_covering_max'); ?>
		<?php echo $form->textField($model,'floor_covering_max'); ?>
		<?php echo $form->error($model,'floor_covering_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'water_access_yn'); ?>
		<?php echo $form->textField($model,'water_access_yn'); ?>
		<?php echo $form->error($model,'water_access_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'water_view_yn'); ?>
		<?php echo $form->textField($model,'water_view_yn'); ?>
		<?php echo $form->error($model,'water_view_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'water_frontage_yn'); ?>
		<?php echo $form->textField($model,'water_frontage_yn'); ?>
		<?php echo $form->error($model,'water_frontage_yn'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fireplace_yn'); ?>
		<?php echo $form->textField($model,'fireplace_yn'); ?>
		<?php echo $form->error($model,'fireplace_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'special_sale_provision'); ?>
		<?php echo $form->textField($model,'special_sale_provision'); ?>
		<?php echo $form->error($model,'special_sale_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monthly_maintainance_addition_to_hoa'); ?>
		<?php echo $form->textField($model,'monthly_maintainance_addition_to_hoa'); ?>
		<?php echo $form->error($model,'monthly_maintainance_addition_to_hoa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'building_name_number'); ?>
		<?php echo $form->textField($model,'building_name_number'); ?>
		<?php echo $form->error($model,'building_name_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'construction_status'); ?>
		<?php echo $form->textField($model,'construction_status'); ?>
		<?php echo $form->error($model,'construction_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hoa_community_association'); ?>
		<?php echo $form->textField($model,'hoa_community_association'); ?>
		<?php echo $form->error($model,'hoa_community_association'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hoa_payment_schedule'); ?>
		<?php echo $form->textField($model,'hoa_payment_schedule'); ?>
		<?php echo $form->error($model,'hoa_payment_schedule'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'elementary_school'); ?>
		<?php echo $form->textField($model,'elementary_school'); ?>
		<?php echo $form->error($model,'elementary_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middle_school'); ?>
		<?php echo $form->textField($model,'middle_school'); ?>
		<?php echo $form->error($model,'middle_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'high_school'); ?>
		<?php echo $form->textField($model,'high_school'); ?>
		<?php echo $form->error($model,'high_school'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'front_exposure'); ?>
		<?php echo $form->textField($model,'front_exposure'); ?>
		<?php echo $form->error($model,'front_exposure'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip_plus'); ?>
		<?php echo $form->textField($model,'zip_plus'); ?>
		<?php echo $form->error($model,'zip_plus'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subdivision_section_number'); ?>
		<?php echo $form->textField($model,'subdivision_section_number'); ?>
		<?php echo $form->error($model,'subdivision_section_number'); ?>
	</div>




	<div class="row">
		<?php echo $form->labelEx($model,'pet_restrictions_yn'); ?>
		<?php echo $form->textField($model,'pet_restrictions_yn'); ?>
		<?php echo $form->error($model,'pet_restrictions_yn'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'hoa_fee'); ?>
		<?php echo $form->textField($model,'hoa_fee'); ?>
		<?php echo $form->error($model,'hoa_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'realtor_only_remarks'); ?>
		<?php echo $form->textField($model,'realtor_only_remarks'); ?>
		<?php echo $form->error($model,'realtor_only_remarks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pool_type_max'); ?>
		<?php echo $form->textField($model,'pool_type_max'); ?>
		<?php echo $form->error($model,'pool_type_max'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'architectural_style_max'); ?>
		<?php echo $form->textField($model,'architectural_style_max'); ?>
		<?php echo $form->error($model,'architectural_style_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'additional_rooms_max'); ?>
		<?php echo $form->textField($model,'additional_rooms_max'); ?>
		<?php echo $form->error($model,'additional_rooms_max'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'master_bath_features_max'); ?>
		<?php echo $form->textField($model,'master_bath_features_max'); ?>
		<?php echo $form->error($model,'master_bath_features_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'security_system'); ?>
		<?php echo $form->textField($model,'security_system'); ?>
		<?php echo $form->error($model,'security_system'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kitchen_features_max'); ?>
		<?php echo $form->textField($model,'kitchen_features_max'); ?>
		<?php echo $form->error($model,'kitchen_features_max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fireplace_description_max'); ?>
		<?php echo $form->textField($model,'fireplace_description_max'); ?>
		<?php echo $form->error($model,'fireplace_description_max'); ?>
	</div>
</div>
	-->
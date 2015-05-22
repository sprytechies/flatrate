<?php
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->assetManager->publish(
		Yii::getPathOfAlias('application').'/js/jquery.tools.min.js'),
		CClientScript::POS_HEAD
		);

$skrip = "
	$('.tt').tooltip();
	$('.dragImage').draggable({ revert: true }); 
	$('#droppable').droppable({
		drop: function( event, ui ) {
			var oid = $(ui.draggable).attr('id');
			var sid = oid.replace('zImage_','');
			$(ui.draggable).attr('src','');
			$('#Land_photo_'+ sid).val('');

			$('.dragImage').each(function(index) {
				if(index < 11 && $(this).attr('src') == '' && $('#zImage_'+ (index+2)).attr('src') !== '')
				{
					$('#Land_photo_' + (index+1)).val( $('#Land_photo_' + (index+2)).val() );
					$(this).attr( 'src', $('#zImage_'+ (index+2)).attr('src') );
					$('#Land_photo_' + (index+2)).val('');
					$('#zImage_'+ (index+2)).attr('src','');
				}
			});

		},
	});
	$('#saveIncomplete, #flyingIncButton').click(function(){
		$('#yt0').click();
		return false;
	});
	
	var delay = (function(){
          var timer = 0;
          return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
          };
        })();
        
        $('input').keyup(function() {
            delay(function(){
              $('#yt2').click();
		return false;
            }, 1500 );
        });
        
        $('select').change(function() {
            delay(function(){
              $('#yt2').click();
		return false;
            }, 1500 );
        });
        
        $('input:checkbox').change(function() {
            delay(function(){
              $('#yt2').click();
		return false;
            }, 1500 );
        });
        
        function autosavedata(data) {
            $('#incompleteID').val(data);
        }
";

$cs = Yii::app()->getClientScript();  
$cs->registerScript('myjs',$skrip,CClientScript::POS_READY); 
$question = Yii::app()->theme->baseUrl . '/css/images/question.png';
$link = '<br/><br/>' . CHtml::link('Link to tax records page', 'http://flatratelist.com/links.html', array('target'=>'_blank','style'=>'color:#ffffff;font-weight:bold;'));
$link_criteria = '<br/><br/>' . CHtml::link('Use this link to perform a search to find each CDD per county', 'http://www.floridaspecialdistricts.org/officiallist/criteria.cfm', array('target'=>'_blank','style'=>'color:#ffffff;font-weight:bold;'));

foreach($model as $k => $v){
	if(!is_array($v) && strpos($v, "|"))
		$model->$k = explode(" | ", $v);
}
?>
<div id="flyingIncButton">Save as<br/>Incomplete</div>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'land-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php
		if($model->hasErrors())
			echo '<div class="ui-state-highlight ui-corner-all" style="padding: 10px; width:85%"><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				<strong>Reminder: </strong>You can continue to correct this listing or just <a href="#" id="saveIncomplete">click here</a> to save as incomplete.
			</div><br/>';
	?>
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'create_date'); ?>
	<?php echo $form->hiddenField($model,'creator_id'); ?>
	<?php echo $form->hiddenField($model,'update_date'); ?>
	<?php echo $form->hiddenField($model,'updator_id'); ?>
	
	<!--<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-13">
					<div class="span-4">
						<div class="row">
							<?php echo $form->labelEx($model,'listing_date'); ?>
							<?php        
				                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				                            'model'=>$model,
				                            'name'=>'Land[listing_date]',
								'value'=>$model->listing_date,
				                            // additional javascript options for the date picker plugin
				                            'options'=>array(
				                                'showAnim'=>'fold',
								  'changeMonth' => true,
								  'changeYear' => true,
				                            ),
				                        ));
				                        ?>  
							<?php echo $form->error($model,'listing_date'); ?>
						</div>
					</div>
					<div class="span-4">
						<div class="row">
							<?php echo $form->labelEx($model,'expiration_date'); ?>
							<?php        
				                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				                            'model'=>$model,
				                            'name'=>'Land[expiration_date]',
								'value'=>$model->expiration_date,
				                            // additional javascript options for the date picker plugin
				                            'options'=>array(
				                                'showAnim'=>'fold',
								  'changeMonth' => true,
								  'changeYear' => true,
				                            ),
				                        ));
				                     ?>  
							<?php echo $form->error($model,'expiration_date'); ?>
						</div>
					</div>
					<div class="span-5 last">
						<div class="row">
							<?php echo $form->labelEx($model,'entered_where'); ?>
							<?php echo $form->radioButtonList($model,'entered_where',CHtml::listData(LandEnteredWhere::model()->findAll(),'id','id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
							<?php echo $form->error($model,'entered_where'); ?>
						</div>
					</div>
					<div class="span-13 last">
						<div class="row">
							<?php echo $form->labelEx($model,'representation'); ?>
							<?php echo $form->radioButtonList($model,'representation',CHtml::listData(LandRepresentation::model()->findAll(),'id','id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
							<?php echo $form->error($model,'representation'); ?>
						</div>
					</div>
				</div>
				<div class="span-9 last">
					<div class="row">
						<?php echo $form->labelEx($model,'listing_type'); ?>
						<?php echo $form->checkBoxList($model,'listing_type',CHtml::listData(LandListingType::model()->findAll(),'id','id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'listing_type'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>-->
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-6">
					<!--<div class="row">
						<?php echo $form->labelEx($model,'mls_number'); ?>
						<?php echo $form->textField($model,'mls_number'); ?>
						<?php echo $form->error($model,'mls_number'); ?>
					</div>-->
					<div class="row">
						<?php echo $form->labelEx($model,'list_price'); ?>
						<?php echo $form->textField($model,'list_price',array('maxlength'=>15)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
						'title'=>'This is the price you are asking for the property. It must be numeric and must not contain commas or dollar signs. This field must contain a valid number-Zero cannot be used'
					)); ?>
						<?php echo $form->error($model,'list_price'); ?>
					</div>
				</div>
				<div class="span-11">
					<div class="span-5">
						<div class="row">
							<?php echo $form->labelEx($model,'for_lease_yn'); ?>
							<?php echo $form->radioButtonList($model,'for_lease_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
							<?php echo $form->error($model,'for_lease_yn'); ?>
						</div>
					</div>
					<div class="span-6 last">
						<div class="row">
							<?php echo $form->labelEx($model,'lease_price'); ?>
							<?php echo $form->textField($model,'lease_price',array('size'=>15,'maxlength'=>15)); ?>
							<?php echo $form->error($model,'lease_price'); ?>
						</div>
					</div>
					<div class="span-5">
						<div class="row">
							<?php echo $form->labelEx($model,'range_price_yn'); ?>
							<?php echo $form->radioButtonList($model,'range_price_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
							<?php echo $form->error($model,'range_price_yn'); ?>
						</div>
					</div>
					<div class="span-6 last">					
						<div class="row">
							<?php echo $form->labelEx($model,'range_list_low_price'); ?>
							<?php echo $form->textField($model,'range_list_low_price',array('size'=>15,'maxlength'=>15)); ?>
							<?php echo $form->error($model,'range_list_low_price'); ?>
						</div>
					</div>
				</div>
				<div class="span-5 last">
					<div class="row">
						<?php echo $form->labelEx($model,'lease_price_acre'); ?>
						<?php echo $form->textField($model,'lease_price_acre',array('size'=>15,'maxlength'=>15)); ?>
						<?php echo $form->error($model,'lease_price_acre'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'price_per_acre'); ?>
						<?php echo $form->textField($model,'price_per_acre',array('size'=>15,'maxlength'=>15)); ?>
						<?php echo $form->error($model,'price_per_acre'); ?>
					</div>
				</div>
				<div class="span-22 last">
					<div class="span-17">
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'house_number'); ?>
								<?php echo $form->textField($model,'house_number'); ?>
								<?php echo $form->error($model,'house_number'); ?>
							</div>
						</div>
						<div class="span-10">
							<div class="row">
								<?php echo $form->labelEx($model,'street_name'); ?>
								<?php echo $form->textField($model,'street_name',array('size'=>60,'maxlength'=>100)); ?>
								<?php echo $form->error($model,'street_name'); ?>
							</div>
						</div>
						<div class="span-3 last">
							<div class="row">
								<?php echo $form->labelEx($model,'street_type'); ?>
								<?php echo $form->textField($model,'street_type',array('size'=>10,'maxlength'=>10)); ?>
								<?php echo $form->error($model,'street_type'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'city'); ?>
								<?php echo $form->textField($model,'city',array('maxlength'=>50)); ?>
								<?php echo $form->error($model,'city'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'state'); ?>
								<?php echo $form->dropDownList($model,'state',CHtml::listData(DropStates::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
								<?php echo $form->error($model,'state'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'county'); ?>
								<?php echo $form->textField($model,'county',array('size'=>20,'maxlength'=>50)); ?>
								<?php echo $form->error($model,'county'); ?>
							</div>
						</div>
						<div class="span-2">
							<div class="row">
								<?php echo $form->labelEx($model,'zip_code'); ?>
								<?php echo $form->textField($model,'zip_code',array('size'=>7,'maxlength'=>10)); ?>
								<?php echo $form->error($model,'zip_code'); ?>
							</div>
						</div>
						<div class="span-2 last">
							<div class="row">
								<?php echo $form->labelEx($model,'zip_plus'); ?>
								<?php echo $form->textField($model,'zip_plus',array('size'=>4,'maxlength'=>10)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'The additional four digits of the Zip Code as established by the United States Postal Service.'
                        )); ?>
								<?php echo $form->error($model,'zip_plus'); ?>
							</div>
						</div>
					</div>
					<div class="span-4 push-1 last">
						<div class="span-4 last" align="center"><strong>Str. Dir.</strong></div>
						<div class="span-2" align="center">
							<div class="row">
								<?php echo $form->labelEx($model,'street_dir_pre'); ?>
								<?php echo $form->textField($model,'street_dir_pre',array('size'=>4,'maxlength'=>4)); ?>
								<?php echo $form->error($model,'street_dir_pre'); ?>
							</div>
						</div>
						<div class="span-2 last" align="center">
							<div class="row">
								<?php echo $form->labelEx($model,'street_dir_post'); ?>
								<?php echo $form->textField($model,'street_dir_post',array('size'=>4,'maxlength'=>4)); ?>
								<?php echo $form->error($model,'street_dir_pre'); ?>
							</div>
						</div>
					</div>
					<div class="span-23 last">
						<div class="span-4 first">
							<div class="row">
								<?php echo $form->labelEx($model,'millage_rate'); ?>
								<?php echo $form->textField($model,'millage_rate',array('size'=>14,'maxlength'=>10)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'A rate used to compute property taxes and can be confirmed through the tax collectors web site.' . $link
                    )); ?>
								<?php echo $form->error($model,'millage_rate'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'tax_id'); ?>
								<?php echo $form->textField($model,'tax_id',array('size'=>14,'maxlength'=>30)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'We can complete this field for you. If you want to enter it manually, below is the acceptable format. Separate each field by a space only-no slashes or dashes.' . $link
                    )); ?>
								<?php echo $form->error($model,'tax_id'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'taxes'); ?>
								<?php echo $form->textField($model,'taxes',array('size'=>14,'maxlength'=>15)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field is the ad valorem taxes for the property.' . $link
                    )); ?>
								<?php echo $form->error($model,'taxes'); ?>
							</div>
						</div>
						<div class="span-5">
							<div class="row">
								<?php echo $form->labelEx($model,'taxes_year'); ?>
								<?php echo $form->textField($model,'taxes_year', array('size'=>19)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field is the tax year of the tax amount recorded in the Taxes field.' . $link
                    )); ?>
								<?php echo $form->error($model,'taxes_year'); ?>
							</div>
						</div>
						<div class="span-4 last">
							<div class="row">
								<?php echo $form->labelEx($model,'alt_key_folio'); ?>
								<?php echo $form->textField($model,'alt_key_folio',array('size'=>20,'maxlength'=>20)); ?>
								<?php echo $form->error($model,'alt_key_folio'); ?>
							</div>
						</div>
					</div>
					<div class="span-23 last">
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'section'); ?>
								<?php echo $form->textField($model,'section',array('size'=>14,'maxlength'=>50)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Section" information contained in the tax record.' . $link
                    )); ?>
								<?php echo $form->error($model,'section'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'township'); ?>
								<?php echo $form->textField($model,'township',array('size'=>14,'maxlength'=>50)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Township" information contained in the tax record.' . $link
                    )); ?>
								<?php echo $form->error($model,'township'); ?>
							</div>
						</div>
						<div class="span-5">
							<div class="row">
								<?php echo $form->labelEx($model,'range'); ?>
								<?php echo $form->textField($model,'range',array('size'=>14,'maxlength'=>50)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Range" information contained in the tax record.' . $link
                    )); ?>
								<?php echo $form->error($model,'range'); ?>
							</div>
						</div>
						<div class="span-4">
							<div class="row">
								<?php echo $form->labelEx($model,'subdivision_number'); ?>
								<?php echo $form->textField($model,'subdivision_number',array('size'=>10,'maxlength'=>10)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'The subdivision # is part of the tax ID information.'
                    )); ?>
								<?php echo $form->error($model,'subdivision_number'); ?>
							</div>
						</div>
						<div class="span-4 last">
							<div class="row">
								<?php echo $form->labelEx($model,'condo_number'); ?>
								<?php echo $form->textField($model,'condo_number',array('size'=>10,'maxlength'=>10)); ?>
								<?php echo $form->error($model,'condo_number'); ?>
							</div>
						</div>
					</div>
					<div class="span-23 last">
						<div class="span-8">
							<div class="row">
								<?php echo $form->labelEx($model,'subdivision_section_number'); ?>
								<?php echo $form->textField($model,'subdivision_section_number',array('size'=>40,'maxlength'=>10)); ?>
								<?php echo $form->error($model,'subdivision_section_number'); ?>
							</div>
						</div>
						<div class="span-7">
							<div class="row">
								<?php echo $form->labelEx($model,'block_parcel'); ?>
								<?php echo $form->textField($model,'block_parcel',array('size'=>30,'maxlength'=>30)); ?>
								<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field is part of the tax identification information.' . $link
                    )); ?>
								<?php echo $form->error($model,'block_parcel'); ?>
							</div>
						</div>
						<div class="span-7 last">
							<div class="row">
								<?php echo $form->labelEx($model,'lot_number'); ?>
								<?php echo $form->textField($model,'lot_number',array('size'=>30,'maxlength'=>30)); ?>
								<?php echo $form->error($model,'lot_number'); ?>
							</div>
						</div>
					</div>
					<div class="span-23 last">
						<div class="row">
							<?php echo $form->labelEx($model,'legal_description', array('style'=>'display:inline')); ?>
							<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Legal Description" information contained in the tax record.' . $link
                    )); ?><br/>
							<?php echo $form->textArea($model,'legal_description',array('rows'=>6, 'cols'=>50)); ?>
							<?php echo $form->error($model,'legal_description'); ?>
						</div>
						<div class="span-22 last">
							<div class="span-9">
								<div class="row">
									<?php echo $form->labelEx($model,'legal_subdivision_name'); ?>
									<?php echo $form->textField($model,'legal_subdivision_name',array('size'=>50,'maxlength'=>50)); ?>
									<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>"Used to record the subdivision's legal name."
                    )); ?>
									<?php echo $form->error($model,'legal_subdivision_name'); ?>
								</div>
								<div class="row">
									<?php echo $form->labelEx($model,'zoning'); ?>
									<?php echo $form->textField($model,'zoning',array('size'=>50,'maxlength'=>30)); ?>
									<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Used to record the classification as determined by the governing municipality.' . $link
                    )); ?>
									<?php echo $form->error($model,'zoning'); ?>
								</div>
								<div class="row">
									<?php echo $form->labelEx($model,'future_land_use'); ?>
									<?php echo $form->textField($model,'future_land_use',array('size'=>50,'maxlength'=>50)); ?>
									<?php echo $form->error($model,'future_land_use'); ?>
								</div>
							</div>
							<div class="span-7 last">
								<div class="row">
									<?php echo $form->labelEx($model,'subdiv_community_name'); ?>
									<?php echo $form->textField($model,'subdiv_community_name',array('size'=>38,'maxlength'=>50)); ?>
									<?php echo $form->error($model,'subdiv_community_name'); ?>
								</div>
								<div class="row">
									<?php echo $form->labelEx($model,'plat_book_page'); ?>
									<?php echo $form->textField($model,'plat_book_page',array('size'=>38,'maxlength'=>50)); ?>
									<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Found in the county tax records.' . $link
                    )); ?>
									<?php echo $form->error($model,'plat_book_page'); ?>
								</div>
								<div class="row">
									<?php echo $form->labelEx($model,'complex_community_name'); ?>
									<?php echo $form->textField($model,'complex_community_name',array('size'=>38,'maxlength'=>50)); ?>
									<?php echo $form->error($model,'complex_community_name'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'property_style'); ?>
						<?php echo $form->checkBoxList($model,'property_style',CHtml::listData(LandPropertyStyle::model()->findAll(),'id','id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'property_style'); ?>
					</div>
				</div>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'originating_board_id'); ?>
						<?php echo $form->checkBoxList($model,'originating_board_id',CHtml::listData(LandOriginalBoardId::model()->findAll(),'id','id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'originating_board_id'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($model,'owner_name'); ?>
						<?php echo $form->textField($model,'owner_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'owner_name'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'owner_phone'); ?>
						<?php echo $form->textField($model,'owner_phone',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'owner_phone'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($model,'zoning_compatible_yn'); ?>
						<?php echo $form->radioButtonList($model,'zoning_compatible_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'zoning_compatible_yn'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'auction_yn'); ?>
						<?php echo $form->radioButtonList($model,'auction_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'auction_yn'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'idx_yn'); ?>
						<?php echo $form->radioButtonList($model,'idx_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'idx_yn'); ?>
					</div>
				</div>
				<div class="span-6">
					<div class="row">
						<?php echo $form->labelEx($model,'road_frontage'); ?>
						<?php echo $form->textField($model,'road_frontage',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'road_frontage'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'state_land_use_code'); ?>
						<?php echo $form->textField($model,'state_land_use_code',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'state_land_use_code'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'state_property_use_code'); ?>
						<?php echo $form->textField($model,'state_property_use_code',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'state_property_use_code'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'county_land_use_code'); ?>
						<?php echo $form->textField($model,'county_land_use_code',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'county_land_use_code'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'county_property_use_code'); ?>
						<?php echo $form->textField($model,'county_property_use_code',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'county_property_use_code'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($model,'additional_parcel_yn', array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'This field is used when an additional parcel is included in the sale of the property.' 
                        )); ?><br/>
						<?php echo $form->radioButtonList($model,'additional_parcel_yn', array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'additional_parcel_yn'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'number_of_additional_parcel'); ?>
						<?php echo $form->textField($model,'number_of_additional_parcel',array('size'=>10,'maxlength'=>10)); ?>
						<?php echo $form->error($model,'number_of_additional_parcel'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($model,'cdd_yn', array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'Community Development District (CDD) – A district that by governmental approval may charge separate non- ad valorem special assessments for satisfying the debt obligations of the district (community) related to financing, maintaining, and servicing the districts (communities) improvement and/or services.' . $link_criteria 
                        )); ?><br/>
						<?php echo $form->radioButtonList($model,'cdd_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'cdd_yn'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'annual_cdd_fee'); ?>
						<?php echo $form->textField($model,'annual_cdd_fee',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'annual_cdd_fee'); ?>
					</div>
					
					<div class="row">
						<?php echo $form->labelEx($model,'hoa_comm_association'); ?>
						<?php echo $form->dropDownList($model,'hoa_comm_association', CHtml::listData(DropHoaCommunityAssociation::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
						<?php echo $form->error($model,'hoa_comm_association'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'hoa_fee'); ?>
						<?php echo $form->textField($model,'hoa_fee',array('size'=>15,'maxlength'=>15)); ?>
						<?php echo $form->error($model,'hoa_fee'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'hoa_payment_schedule'); ?>
						<?php echo $form->dropDownList($model,'hoa_payment_schedule', CHtml::listData(DropHoaPaymentSchedule::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
						<?php echo $form->error($model,'hoa_payment_schedule'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'location', array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate additional descriptions of where a dwelling is located with a community, city or county." 
                        )); ?><br/>
						<?php echo $form->checkBoxList($model,'location',CHtml::listData(LandLocation::model()->findAll(),'id','id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'location'); ?>
					</div>
				</div>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'front_exposire',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate the general compass direction of the front door." 
                        )); ?><br/>
						<?php echo $form->radioButtonList($model,'front_exposire',CHtml::listData(DropFrontExposure::model()->findAll(), 'code', 'name'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'front_exposire'); ?>
					</div>
					<br/>
					<div class="row">
						<?php echo $form->labelEx($model,'total_acreage'); ?>
						<?php echo $form->radioButtonList($model,'total_acreage', CHtml::listData(DropTotalAcreage::model()->findAll(), 'code', 'name'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'total_acreage'); ?>
					</div>
				</div>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'lot_dimensions'); ?>
						<?php echo $form->textField($model,'lot_dimensions',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Must be in the following format 80x110x84x110. Rectangular properties may be entered as 80x110. Enter dimensions for irregular shaped properties as best you can.<br/>Approximate lot dimensions can be obtained by locating the property record at the county's site and then while viewing the parcel/property map, zoom to the lowest viewing level to view the lot dimensions." 
                        )); ?>
						<?php echo $form->error($model,'lot_dimensions'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'lot_size_sq_ft'); ?>
						<?php echo $form->textField($model,'lot_size_sq_ft',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Obtained from County records." 
                        )); ?>
						<?php echo $form->error($model,'lot_size_sq_ft'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'lot_size_acre'); ?>
						<?php echo $form->textField($model,'lot_size_acre',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Obtained from County records. Must be in  .xxx format." 
                        )); ?>
						<?php echo $form->error($model,'lot_size_acre'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'front_footage'); ?>
						<?php echo $form->textField($model,'front_footage',array('size'=>20,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'front_footage'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'availability'); ?>
						<?php echo $form->textArea($model,'availability',array('cols'=>30, 'rows'=>10)); ?>
						<?php echo $form->error($model,'availability'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'easements'); ?>
						<?php echo $form->textArea($model,'easements',array('cols'=>30, 'rows'=>10)); ?>
						<?php echo $form->error($model,'easements'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-5">
					<div class="row">
						<?php echo $form->labelEx($model,'water_access_yn',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'This field should only be used when the subject property has deeded access to one or more of the corresponding pick-list" NOTE: The availability of off-site Water Access facilities provided by an association membership does not qualify under this heading. Enter this type under the Community Features field' 
                        )); ?><br/>
						<?php echo $form->radioButtonList($model,'water_access_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_access_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'water_access'); ?>
						<?php echo $form->checkBoxList($model,'water_access',CHtml::listData(ListWaterAccess::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_access'); ?>
					</div>
				</div>
				<div class="span-6">
					<div class="row">
						<?php echo $form->labelEx($model,'water_view_yn',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"This field should only be used when the subject property has a view of the water." 
                        )); ?><br/>
						<?php echo $form->radioButtonList($model,'water_view_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_view_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'water_view'); ?>
						<?php echo $form->checkBoxList($model,'water_view',CHtml::listData(ListWaterView::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_view'); ?>
					</div>
				</div>
				<div class="span-6">
					<div class="row">
						<?php echo $form->labelEx($model,'water_frontage_yn', array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"This field should be used only when the subject property touches water." 
                        )); ?><br/>
						<?php echo $form->radioButtonList($model,'water_frontage_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_frontage_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'water_frontage'); ?>
						<?php echo $form->checkBoxList($model,'water_frontage',CHtml::listData(ListWaterFrontage::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_frontage'); ?>
					</div>
				</div>
				<div class="span-5 last">
					<div class="row">
						<?php echo $form->labelEx($model,'water_extras_yn'); ?>
						<?php echo $form->radioButtonList($model,'water_extras_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_extras_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'water_extras'); ?>
						<?php echo $form->checkBoxList($model,'water_extras',CHtml::listData(LandWaterExtras::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'water_extras'); ?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="span-11">
					<div class="row">
						<?php echo $form->labelEx($model,'water_name'); ?>
						<?php echo $form->textField($model,'water_name',array('size'=>50,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'water_name'); ?>
					</div>
				</div>
				<div class="span-11 last">
					<div class="row">
						<?php echo $form->labelEx($model,'water_front_feet'); ?>
						<?php echo $form->textField($model,'water_front_feet',array('size'=>50,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'water_front_feet'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'utilities', array('style'=>"display:inline")); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to describe the utilities available at the property address." 
                        )); ?><br/>
						<?php echo $form->checkBoxList($model,'utilities',CHtml::listData(LandUtilities::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'utilities'); ?>
					</div>
				</div>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'site_improvements'); ?>
						<?php echo $form->checkBoxList($model,'site_improvements',CHtml::listData(LandSiteImprovements::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'site_improvements'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'fences'); ?>
						<?php echo $form->checkBoxList($model,'fences',CHtml::listData(LandSiteImprovements::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'fences'); ?>
					</div>
				</div>
				<div class="span-7 last">
					<div class="row">
						<?php echo $form->labelEx($model,'ownership'); ?>
						<?php echo $form->checkBoxList($model,'ownership',CHtml::listData(LandSiteImprovements::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'ownership'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'community_features',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate amenities in the common areas of the community for the residents use.<br/>Some amenities may or may not be subject to availability and may require a usage fee<br/>Note additional information about the Community Features in the Public Remarks field." 
                        )); ?><br/>
						<?php echo $form->checkBoxList($model,'community_features',CHtml::listData(ListCommunityFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'community_features'); ?>
					</div>
				</div>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'elementary_school'); ?>
						<?php echo $form->textField($model,'elementary_school',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'elementary_school'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'middle_school'); ?>
						<?php echo $form->textField($model,'middle_school',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'middle_school'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'high_school'); ?>
						<?php echo $form->textField($model,'high_school',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'high_school'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'financing_available'); ?>
						<?php echo $form->checkBoxList($model,'financing_available',CHtml::listData(ListFinancingAvailable::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'financing_available'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'lease_terms'); ?>
						<?php echo $form->checkBoxList($model,'lease_terms',CHtml::listData(LandLeaseTerms::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'lease_terms'); ?>
					</div>
				</div>
				<div class="span-8 last">
					<div class="row">
						<?php echo $form->labelEx($model,'realtor_information'); ?>
						<?php echo $form->checkBoxList($model,'realtor_information',CHtml::listData(LandRealtorInformation::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'realtor_information'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'realtor_information_confidential'); ?>
						<?php echo $form->checkBoxList($model,'realtor_information_confidential',CHtml::listData(LandRealtorInformationConfidential::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'realtor_information_confidential'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'special_sale_provision'); ?>
						<?php echo $form->dropDownList($model,'special_sale_provision',CHtml::listData(DropSpecialSaleProvision::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
						<?php echo $form->error($model,'special_sale_provision'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'call_center_phone_number'); ?>
						<?php echo $form->textField($model,'call_center_phone_number',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'call_center_phone_number'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'showing_time_secure_remarks',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Call owner at (xxx) xxx-xxxx for showing instructions." 
                        )); ?><br/>
						<?php echo $form->textField($model,'showing_time_secure_remarks',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'showing_time_secure_remarks'); ?>
					</div>
				</div>
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'showing_instruction',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"This field is used to indicate showing instructions.  It is against MLS Rules and Regulations to publish, in any field, access codes, combination lockbox codes, security gate codes, security alarm codes or any other codes for equipment or systems designed to ensure the security of the property." 
                        )); ?><br/>
						<?php echo $form->checkBoxList($model,'showing_instruction',CHtml::listData(LandShowingInstructions::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'showing_instruction'); ?>
					</div>
				</div>
				<div class="span-8 last">
					<div class="row">
						<?php echo $form->labelEx($model,'special_listing_type'); ?>
						<?php echo $form->checkBoxList($model,'special_listing_type',CHtml::listData(LandSpecialListingType::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'special_listing_type'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'virtual_tour',array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Check with your provider to make certain the link being added is unbranded. i.e. no signs or contact information." 
                        )); ?><br/>
						<?php echo $form->textField($model,'virtual_tour',array('size'=>50,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'virtual_tour'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'internet_yn'); ?>
						<?php echo $form->radioButtonList($model,'internet_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'internet_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'display_property_address_on_internet_yn', array('style'=>'display:inline')); ?>
                    <?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>"Information in this field will be displayed on all public sites that the can be viewed. A word of caution…Especially if the home is vacant, we recommend not displaying the address on the Internet." 
                    )); ?><br/>
						<?php echo $form->radioButtonList($model,'display_property_address_on_internet_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'display_property_address_on_internet_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'realtor_com_yn'); ?>
						<?php echo $form->radioButtonList($model,'realtor_com_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'realtor_com_yn'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'third_party_yn'); ?>
						<?php echo $form->radioButtonList($model,'third_party_yn',array('Y'=>'Yes','N'=>'No'),array('separator'=>'&nbsp;&nbsp;','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
						<?php echo $form->error($model,'third_party_yn'); ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
	
	<!--<table class="span-23 last form_tb">
		<tr>
			<td>
				<div class="span-11">
					<div class="row">
						<?php echo $form->labelEx($model,'agent_id'); ?>
						<?php echo $form->textField($model,'agent_id',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'agent_id'); ?>
					</div>
				</div>
				<div class="span-11 last">
					<div class="row">
						<?php echo $form->labelEx($model,'agent_email'); ?>
						<?php echo $form->textField($model,'agent_email',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'agent_email'); ?>
					</div>
				</div>
				<div class="span-22">
					<div class="row">
						<?php echo $form->labelEx($model,'agent_homepage'); ?>
						<?php echo $form->textField($model,'agent_homepage',array('size'=>60,'maxlength'=>100)); ?>
						<?php echo $form->error($model,'agent_homepage'); ?>
					</div>
				</div>
				<div class="span-11">
					<div class="row">
						<?php echo $form->labelEx($model,'agent_name'); ?>
						<?php echo $form->textField($model,'agent_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'agent_name'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'agent_pager_cell'); ?>
						<?php echo $form->textField($model,'agent_pager_cell',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'agent_pager_cell'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'agent2_id'); ?>
						<?php echo $form->textField($model,'agent2_id',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'agent2_id'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'agent2_name'); ?>
						<?php echo $form->textField($model,'agent2_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'agent2_name'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'office_number'); ?>
						<?php echo $form->textField($model,'office_number',array('size'=>30,'maxlength'=>10)); ?>
						<?php echo $form->error($model,'office_number'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'agent_extension'); ?>
						<?php echo $form->textField($model,'agent_extension',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'agent_extension'); ?>
					</div>
				</div>
				<div class="span-11 last">
					<div class="row">
						<?php echo $form->labelEx($model,'agent_direct_phone'); ?>
						<?php echo $form->textField($model,'agent_direct_phone',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'agent_direct_phone'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'agent_fax'); ?>
						<?php echo $form->textField($model,'agent_fax',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'agent_fax'); ?>
					</div>
				
				
					<div class="row">
						<?php echo $form->labelEx($model,'sales_team_name'); ?>
						<?php echo $form->textField($model,'sales_team_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'sales_team_name'); ?>
					</div>
				
				
					<div class="row">
						<?php echo $form->labelEx($model,'agent2_phone'); ?>
						<?php echo $form->textField($model,'agent2_phone',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'agent2_phone'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'office_phone'); ?>
						<?php echo $form->textField($model,'office_phone',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'office_phone'); ?>
					</div>
				
					<div class="row">
						<?php echo $form->labelEx($model,'office_fax'); ?>
						<?php echo $form->textField($model,'office_fax',array('size'=>30,'maxlength'=>20)); ?>
						<?php echo $form->error($model,'office_fax'); ?>
					</div>
				</div>
				<div class="span-22">
					<div class="row">
						<?php echo $form->labelEx($model,'office_name'); ?>
						<?php echo $form->textField($model,'office_name',array('size'=>60,'maxlength'=>100)); ?>
						<?php echo $form->error($model,'office_name'); ?>
					</div>
				</div>
				<div class="span-11">	
					<div class="row">
						<?php echo $form->labelEx($model,'selling_agent_id'); ?>
						<?php echo $form->textField($model,'selling_agent_id',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'selling_agent_id'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'selling_agent2_id'); ?>
						<?php echo $form->textField($model,'selling_agent2_id',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'selling_agent2_id'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'selling_agent2_office_id'); ?>
						<?php echo $form->textField($model,'selling_agent2_office_id',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'selling_agent2_office_id'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'list_office2_number'); ?>
						<?php echo $form->textField($model,'list_office2_number',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'list_office2_number'); ?>
					</div>
				</div>
				<div class="span-11 last">
					<div class="row">
						<?php echo $form->labelEx($model,'selling_agent_name'); ?>
						<?php echo $form->textField($model,'selling_agent_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'selling_agent_name'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'selling_agent2_name'); ?>
						<?php echo $form->textField($model,'selling_agent2_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'selling_agent2_name'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'selling_agent2_office_name'); ?>
						<?php echo $form->textField($model,'selling_agent2_office_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'selling_agent2_office_name'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model,'list_office2_name'); ?>
						<?php echo $form->textField($model,'list_office2_name',array('size'=>30,'maxlength'=>50)); ?>
						<?php echo $form->error($model,'list_office2_name'); ?>
					</div>
				</div>
			</td>	
		</tr>
	</table>-->
	
	<table class="span-23 last form_tb">
		<tr>
			<td>
			<div class="span-22 last">
				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'buyer_agent_comp' , array('style'=>'display:inline')); ?>
                        	<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"You must enter a value to compensate an agent should they bring a buyer.  TIP The format must include % or $ symbols. (i.e. 3% not 3)($1200 not 1200)." 
                        )); ?>
						<?php echo $form->textField($model,'buyer_agent_comp',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'buyer_agent_comp'); ?>
					</div>
				</div>
<!--				<div class="span-7">
					<div class="row">
						<?php echo $form->labelEx($model,'non_rep_comp'); ?>
						<?php echo $form->textField($model,'non_rep_comp',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'non_rep_comp'); ?>
					</div>
				</div>
				<div class="span-7 last">
					<div class="row">
						<?php echo $form->labelEx($model,'trans_broker_comp'); ?>
						<?php echo $form->textField($model,'trans_broker_comp',array('size'=>30,'maxlength'=>30)); ?>
						<?php echo $form->error($model,'trans_broker_comp'); ?>
					</div>
				</div>-->
			</div>
<!--				<div class="row">
					<?php echo $form->labelEx($model,'interoffice_info'); ?>
					<?php echo $form->textArea($model,'interoffice_info',array('cols'=>60,'rows'=>6)); ?>
					<?php echo $form->error($model,'interoffice_info'); ?>
				</div>-->
				<div class="row">
					<?php echo $form->labelEx($model,'driving_directions', array('style'=>'display:inline')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'Directions must have a starting and ending point. They should start from a major intersection. The first turn should state turn north, south, east or west. After that, lefts and rights can be used.  TIP Do not enter "See Mapquest" or any other mapping solution.' 
                        )); ?><br/>
					<?php echo $form->textArea($model,'driving_directions',array('cols'=>60,'rows'=>6)); ?>
					<?php echo $form->error($model,'driving_directions'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'realtor_only_remarks',array('style'=>'display:inline')); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field may be used for special or important realtor information as well as bonuses that are being offered.' 
                    )); ?><br/>
					<?php echo $form->textArea($model,'realtor_only_remarks',array('cols'=>60,'rows'=>8)); ?>
					<?php echo $form->error($model,'realtor_only_remarks'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'public_remarks', array('style'=>'display:inline')); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This is the description of your property. The first 1530 characters is what will be seen on the public internet sites. The remaining characters will be shown on the MLS.  You shall not include contact information, bonuses, URL information, affiliated businesses, owner name or contact information.' 
                    )); ?><br/>
					<?php echo $form->textArea($model,'public_remarks',array('cols'=>60,'rows'=>6)); ?>
					<?php echo $form->error($model,'public_remarks'); ?>
				</div>
<!--				<div class="row">
					<?php echo $form->labelEx($model,'additional_public_remarks'); ?>
					<?php echo $form->textArea($model,'additional_public_remarks',array('cols'=>60,'rows'=>10)); ?>
					<?php echo $form->error($model,'additional_public_remarks'); ?>
				</div>-->
			</td>
		</tr>
	</table>

	<?php 
        $photo_1 = !empty($model->photo_1) ? app()->params['uploadUrl'] . 't_' . $model->photo_1 : ''; 
        $photo_2 = !empty($model->photo_2) ? app()->params['uploadUrl'] . 't_' . $model->photo_2 : ''; 
        $photo_3 = !empty($model->photo_3) ? app()->params['uploadUrl'] . 't_' . $model->photo_3 : ''; 
        $photo_4 = !empty($model->photo_4) ? app()->params['uploadUrl'] . 't_' . $model->photo_4 : ''; 
        $photo_5 = !empty($model->photo_5) ? app()->params['uploadUrl'] . 't_' . $model->photo_5 : ''; 
        $photo_6 = !empty($model->photo_6) ? app()->params['uploadUrl'] . 't_' . $model->photo_6 : ''; 
        $photo_7 = !empty($model->photo_7) ? app()->params['uploadUrl'] . 't_' . $model->photo_7 : ''; 
        $photo_8 = !empty($model->photo_8) ? app()->params['uploadUrl'] . 't_' . $model->photo_8 : ''; 
        $photo_9 = !empty($model->photo_9) ? app()->params['uploadUrl'] . 't_' . $model->photo_9 : ''; 
        $photo_10 = !empty($model->photo_10) ? app()->params['uploadUrl'] . 't_' . $model->photo_10 : ''; 
        $photo_11 = !empty($model->photo_11) ? app()->params['uploadUrl'] . 't_' . $model->photo_11 : ''; 
        $photo_12 = !empty($model->photo_12) ? app()->params['uploadUrl'] . 't_' . $model->photo_12 : ''; 
    ?>
  
	<table class="span-23 last form_tb">
		<tr>
        	<td style="margin:10px; border-bottom:1px solid #CCC;">
			  <div style="float:left; display:block;">			  
			  <?php
                    $this->widget('ext.EAjaxUpload.EAjaxUpload',
                        array(
                            'id'=>'uploadFile',
                            'config'=>array(
                                   'action'=>'/index.php/listing/land/upload',
                                   'allowedExtensions'=>array("jpg","jpeg","gif","png","doc", "docx", "pdf"), 
                                   'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                   'template'=>'<div class="qq-uploader"><div class="qq-upload-button">Upload Photos</div><ul class="qq-upload-list"></ul></div>',//'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                                   'onComplete'=>"js:function(id, fileName, responseJSON)
                                        { 
					  		if((fileName.indexOf('doc') != -1) || (fileName.indexOf('docx') != -1) || (fileName.indexOf('pdf') != -1)){
								$('#docHolder').append('<input type=\"hidden\" name=\"Document[filename][]\" value=\"' + responseJSON.filename + '\" />');
								return false;
							}
											var counter = 0;
											$('.dragImage').each(function(index) {
    											if($(this).attr('src') == '')
												{
													counter++;
					                                            		$('#Land_photo_' + (index+1)).val(responseJSON.filename); 
					                                            		$('#zImage_' + (index+1)).attr('src','" . Yii::app()->params['uploadUrl'] . 't_' . "'+ responseJSON.filename);
													return false;
												}
											});
											
                                        }",
                                   'messages'=>array(
                                                     'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                     'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                     'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                     'emptyError'=>"{file} is empty, please select files again without it.",
                                                     'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                    ),
                                   'showMessage'=>"js:function(message){ alert(message); }"
                                  )
                    ));    

?>
			Place photos in the order in which you would like them to appear on your listing
              </div>
              <div style="float:right; display:block;">
              	<img src="<?php echo Yii::app()->theme->baseUrl . '/css/images/trash.png'; ?>" id="droppable" title="drag here to remove photo" />
              </div>
            </td>
        </tr>
        <tr>
			<td>
				<div class="span-3 imgHolder"><?php echo CHtml::image($photo_1,'',array('class'=>'dragImage','id'=>'zImage_1')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_2,'',array('class'=>'dragImage','id'=>'zImage_2')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_3,'',array('class'=>'dragImage','id'=>'zImage_3')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_4,'',array('class'=>'dragImage','id'=>'zImage_4')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_5,'',array('class'=>'dragImage','id'=>'zImage_5')); ?></div>
                <div class="span-3 imgHolder last"><?php echo CHtml::image($photo_6,'',array('class'=>'dragImage','id'=>'zImage_6')); ?></div>
    		</td>
       	</tr>
        <tr>
			<td>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_7,'',array('class'=>'dragImage','id'=>'zImage_7')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_8,'',array('class'=>'dragImage','id'=>'zImage_8')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_9,'',array('class'=>'dragImage','id'=>'zImage_9')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_10,'',array('class'=>'dragImage','id'=>'zImage_10')); ?></div>
                <div class="span-3 imgHolder"><?php echo CHtml::image($photo_11,'',array('class'=>'dragImage','id'=>'zImage_11')); ?></div>
                <div class="span-3 imgHolder last"><?php echo CHtml::image($photo_12,'',array('class'=>'dragImage','id'=>'zImage_12')); ?></div>
			</td>
       	</tr>
    </table>
    

	<?php echo $form->hiddenField($model,'photo_1'); ?>
    <?php echo $form->hiddenField($model,'photo_2'); ?>
    <?php echo $form->hiddenField($model,'photo_3'); ?>
    <?php echo $form->hiddenField($model,'photo_4'); ?>
    <?php echo $form->hiddenField($model,'photo_5'); ?>
    <?php echo $form->hiddenField($model,'photo_6'); ?>
    <?php echo $form->hiddenField($model,'photo_7'); ?>
    <?php echo $form->hiddenField($model,'photo_8'); ?>
    <?php echo $form->hiddenField($model,'photo_9'); ?>
    <?php echo $form->hiddenField($model,'photo_10'); ?>
    <?php echo $form->hiddenField($model,'photo_11'); ?>
    <?php echo $form->hiddenField($model,'photo_12'); ?>
  
	 <div id="docHolder"></div>
	
	<div class="row buttons" align="center">
		<?php
			if($model->isNewRecord){
			?>
			  	<p class="note">
					<span class="required">*</span> When you select "Save as Incomplete", your work will be saved and you can return later to complete this listing<br/>
					<span class="required">*</span> When you select "Save", the next step is to approve your listing
				</p>
			<?php
				echo CHtml::hiddenField('incompleteID', $incompleteID);
				echo CHtml::ajaxButton('Save as incomplete', Yii::app()->request->baseUrl . "/index.php/listing/land/incomplete", array(
					'type'=>'POST',
					'data'=>'js:$("#land-form").serialize()',
					'success'=>'function(data){ alert( data ); if(data=="Saved as incomplete") window.location = "' . Yii::app()->request->baseUrl . '/index.php/listing/land/admin"; }'), array ());
				echo "&nbsp;&nbsp;";
				echo CHtml::submitButton("Save and View My Listing");
				echo CHtml::ajaxButton('Autosave',  Yii::app()->request->baseUrl . '/index.php/listing/land/autosave', array ('type'=>'post','data'=>"js:$('#land-form').serialize()",'success' => 'function(data) { if(data) autosavedata(data);} '), array ('style'=>'display:none;')); 	
			}else{
//				echo CHtml::submitButton('Update as incomplete');				
//				echo '&nbsp;&nbsp;';				
				echo CHtml::submitButton('Save and View My Listing');	
				echo CHtml::ajaxButton('Autosave',  Yii::app()->request->baseUrl . '/index.php/listing/land/autosave', array ('type'=>'post','data'=>"js:$('#land-form').serialize()",'success' => 'function(data) { if(data) autosavedata(data);} '), array ('style'=>'display:none;')); 	
			}
		?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
jQuery('.qq-upload-drop-area').remove();
</script>
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
			$('#Mls_photo_'+ sid).val('');

			$('.dragImage').each(function(index) {
				if(index < 11 && $(this).attr('src') == '' && $('#zImage_'+ (index+2)).attr('src') !== '')
				{
					$('#Mls_photo_' + (index+1)).val( $('#Mls_photo_' + (index+2)).val() );
					$(this).attr( 'src', $('#zImage_'+ (index+2)).attr('src') );
					$('#Mls_photo_' + (index+2)).val('');
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
?>

<?php echo($model->list_status); if( $model->list_status == "SOLD" || $model->list_status == "PAID"){}else{ ?>
<div id="flyingIncButton">Save as<br/>Incomplete</div>
<?php } ?>


<div class="form">

	<?php 
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'mls-form',
        'enableAjaxValidation'=>true,
    )); 
    ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php
		if($model->hasErrors())
			echo '<div class="ui-state-highlight ui-corner-all" style="padding: 10px; width:85%"><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				<strong>Reminder: </strong>You can continue to correct this listing or just <a href="#" id="saveIncomplete">click here</a> to save this form as incomplete.
			</div><br/>';
	?>
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'create_date'); ?>
	<?php echo $form->hiddenField($model,'creator_id'); ?>
	<?php echo $form->hiddenField($model,'update_date'); ?>
	<?php echo $form->hiddenField($model,'updator_id'); ?>

	<table class="span-23 last form_tb" >
    	<tr>
        	<td class="span-11" style="vertical-align:top;">
            	<div class="row">
					<?php echo $form->labelEx($model,'list_price'); ?>
					<?php echo $form->textField($model,'list_price',array('size'=>15,'maxlength'=>15)); ?>
                    <?php echo CHtml::image($question,'', array('class'=>'tt',
						'title'=>'This is the price you are asking for the property. It must be numeric and must not contain commas or dollar signs. This field must contain a valid number-Zero cannot be used'
					)); ?>
					<?php echo $form->error($model,'list_price'); ?>
            	</div>
                <div class="row">
                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
					<?php echo $form->labelEx($model,'address'); ?>
                    <?php echo $form->textField($model,'address',array('size'=>50,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'address'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'city'); ?>
                    <?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'city'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'county'); ?>
                    <?php echo $form->textField($model,'county',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'county'); ?>
                </div>
                <div class="span-4">
                    <div class="row">
                        <?php echo $form->labelEx($model,'state'); ?>
                        <?php echo $form->dropDownList($model,'state', CHtml::listData(DropStates::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'state'); ?>
                    </div>
                </div>
                <div class="span-6">
                    <div class="row">
                        <?php echo $form->labelEx($model,'zip_code'); ?>
                        <?php echo $form->textField($model,'zip_code',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'zip_code'); ?>
                    </div>
            	</div>        
            </td>
            <td class="span-12 last" style="vertical-align:top;">
                <div class="row">
                    <?php echo $form->labelEx($model,'home_phone'); ?>
                    <?php echo $form->textField($model,'home_phone',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'home_phone'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'mobile_phone'); ?>
                    <?php echo $form->textField($model,'mobile_phone',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'mobile_phone'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>

            	<div class="row">
					<?php echo $form->labelEx($model,'billing_address'); ?>
                    <?php echo $form->textField($model,'billing_address',array('size'=>60,'maxlength'=>100)); ?>
                    <?php echo $form->error($model,'billing_address'); ?>
               	</div>
                
                <div class="row">
                    <?php echo $form->labelEx($model,'billing_city'); ?>
                    <?php echo $form->textField($model,'billing_city',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'billing_city'); ?>
                </div>
                <div class="span-4">
                    <div class="row">
                        <?php echo $form->labelEx($model,'billing_state'); ?>
                        <?php echo $form->dropDownList($model,'billing_state', CHtml::listData(DropStates::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'billing_state'); ?>
                    </div>
                </div>    
                <div class="span-3">
                    <div class="row">
                        <?php echo $form->labelEx($model,'billing_zip_code'); ?>
                        <?php echo $form->textField($model,'billing_zip_code',array('size'=>10,'maxlength'=>10)); ?>
                        <?php echo $form->error($model,'billing_zip_code'); ?>
                    </div>
            	</div>
                <div class="span-3">
                    <div class="row">
                        <?php echo $form->labelEx($model,'zip_plus'); ?>
                        <?php echo $form->textField($model,'zip_plus',array('size'=>8,'maxlength'=>10)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'The additional four digits of the Zip Code as established by the United States Postal Service.'
                        )); ?>
                        <?php echo $form->error($model,'zip_plus'); ?>
                    </div>
				</div>
            </td>
        </tr>
	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td>
                <div class="span-3">
                    <?php echo $form->labelEx($model,'unit_number'); ?>
                    <?php echo $form->textField($model,'unit_number',array('size'=>8,'maxlength'=>10)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Used to record the unit number of the property.'
                    )); ?>
                    <?php echo $form->error($model,'unit_number'); ?>
                </div>
            
                <div class="span-3">
                    <?php echo $form->labelEx($model,'condo_floor_number'); ?>
                    <?php echo $form->textField($model,'condo_floor_number',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'condo_floor_number'); ?>
                </div>
            
                <div class="span-3">
                    <?php echo $form->labelEx($model,'building_number_floors'); ?>
                    <?php echo $form->textField($model,'building_number_floors',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'building_number_floors'); ?>
                </div>
            
                <div class="span-9">
                    <?php echo $form->labelEx($model,'building_name_number'); ?>
                    <?php echo $form->textField($model,'building_name_number',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'building_name_number'); ?>
                </div>
            </td>
    	</tr>
		<tr>
        	<td>
                <div class="span-3">
                    <?php echo $form->labelEx($model,'floors_in_unit'); ?>
                    <?php echo $form->textField($model,'floors_in_unit',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'floors_in_unit'); ?>
                </div>
            
                <div class="span-3">
                    <?php echo $form->labelEx($model,'total_units'); ?>
                    <?php echo $form->textField($model,'total_units',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'total_units'); ?>
                </div>
            
                <div class="span-3">
                    <?php echo $form->labelEx($model,'millage_rate'); ?>
                    <?php echo $form->textField($model,'millage_rate',array('size'=>8,'maxlength'=>10)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'A rate used to compute property taxes and can be confirmed through the tax collectors web site.' . $link
                    )); ?>
                    <?php echo $form->error($model,'millage_rate'); ?>
                </div>
            
            </td>
        </tr>
    </table>
    
	<table class="span-23 last form_tb" >
        <tr>
        	<td class="span-11" style="vertical-align:top;">
                <div class="row">
                    <?php echo $form->labelEx($model,'year_built'); ?>
                    <?php echo $form->textField($model,'year_built',array('size'=>4,'maxlength'=>4)); ?>
                    <?php echo $form->error($model,'year_built'); ?>
                </div>
                
                <div class="row">
                    <?php echo $form->labelEx($model,'tax_id'); ?>
                    <?php echo $form->textField($model,'tax_id',array('size'=>30,'maxlength'=>30)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'We can complete this field for you. If you want to enter it manually, below is the acceptable format. Separate each field by a space only-no slashes or dashes.' . $link
                    )); ?>
                    <?php echo $form->error($model,'tax_id'); ?>
                </div>
            
                <div class="span-3">
                    <?php echo $form->labelEx($model,'tax_year'); ?>
                    <?php echo $form->textField($model,'tax_year',array('size'=>4,'maxlength'=>4)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field is the tax year of the tax amount recorded in the Taxes field.' . $link
                    )); ?>
                    <?php echo $form->error($model,'tax_year'); ?>
				</div>
                <div class="span-7">
                    <?php echo $form->labelEx($model,'taxes'); ?>
                    <?php echo $form->textField($model,'taxes',array('size'=>15,'maxlength'=>15)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field is the ad valorem taxes for the property.' . $link
                    )); ?>
                    <?php echo $form->error($model,'taxes'); ?>
                </div>
            
                <div class="row">
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'section'); ?>
                    <?php echo $form->textField($model,'section',array('size'=>50,'maxlength'=>50)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Section" information contained in the tax record.' . $link
                    )); ?><br/>
                    <?php echo $form->error($model,'section'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'township'); ?>
                    <?php echo $form->textField($model,'township',array('size'=>50,'maxlength'=>50)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Township" information contained in the tax record.' . $link
                    )); ?>
                    <?php echo $form->error($model,'township'); ?>
                </div>
			</td> 
        	<td class="span-12 last" style="vertical-align:top;">                 
                <div class="row">
                    <?php echo $form->labelEx($model,'range'); ?>
                    <?php echo $form->textField($model,'range',array('size'=>50,'maxlength'=>50)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Range" information contained in the tax record.' . $link
                    )); ?>
                    <?php echo $form->error($model,'range'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'subdivision_number'); ?>
                    <?php echo $form->textField($model,'subdivision_number',array('size'=>10,'maxlength'=>10)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'The subdivision # is part of the tax ID information.'
                    )); ?>
                    <?php echo $form->error($model,'subdivision_number'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model,'block_parcel'); ?>
                    <?php echo $form->textField($model,'block_parcel',array('size'=>30,'maxlength'=>30)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field is part of the tax identification information.' . $link
                    )); ?>
                    <?php echo $form->error($model,'block_parcel'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'lot_number'); ?>
                    <?php echo $form->textField($model,'lot_number',array('size'=>30,'maxlength'=>30)); ?>
                    <?php echo $form->error($model,'lot_number'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'subdivision_section_number'); ?>
                    <?php echo $form->textField($model,'subdivision_section_number',array('size'=>10,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'subdivision_section_number'); ?>
                </div>
            </td>
        </tr>
	</table>

	<table class="span-23 last form_tb" >
        <tr>
            <td>
                <div class="row">
                    <?php echo $form->labelEx($model,'legal_description',array('style'=>'display:inline;')); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Use this field for the "Legal Description" information contained in the tax record.' . $link
                    )); ?><br/>
                    <?php echo $form->textArea($model,'legal_description',array('rows'=>3, 'cols'=>105)); ?>
                    <?php echo $form->error($model,'legal_description'); ?>
                </div>
            </td>
        </tr>
		<tr>
        	<td>
                <div class="span-10">
                    <?php echo $form->labelEx($model,'legal_subdivision_name'); ?>
                    <?php echo $form->textField($model,'legal_subdivision_name',array('size'=>50,'maxlength'=>50)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>"Used to record the subdivision's legal name."
                    )); ?>
                    <?php echo $form->error($model,'legal_subdivision_name'); ?>
                </div>
            
                <div class="span-12">
                    <?php echo $form->labelEx($model,'zoning'); ?>
                    <?php echo $form->textField($model,'zoning',array('size'=>30,'maxlength'=>30)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Used to record the classification as determined by the governing municipality.' . $link
                    )); ?>
                    <?php echo $form->error($model,'zoning'); ?>
                </div>
            
            </td>
       	</tr>
        <tr>
        	<td>
                <div class="span-10">
                    <?php echo $form->labelEx($model,'plat_book_page'); ?>
                    <?php echo $form->textField($model,'plat_book_page',array('size'=>50,'maxlength'=>50)); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'Found in the county tax records.' . $link
                    )); ?>
                    <?php echo $form->error($model,'plat_book_page'); ?>
                </div>

                <div class="span-12">
                    <?php echo $form->labelEx($model,'future_land_use'); ?>
                    <?php echo $form->textField($model,'future_land_use',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'future_land_use'); ?>
                </div>
			</td>
     	</tr>
        <tr>    
        	<td>
                <div class="row">
                    <?php echo $form->labelEx($model,'complex_community_name'); ?>
                    <?php echo $form->textField($model,'complex_community_name',array('size'=>50,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'complex_community_name'); ?>
                </div>
            </td>
        </tr>
	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top">
            	<div class="row">
					<?php if(!is_array($model->property_style)) $model->property_style=explode(" | ",$model->property_style); ?>
                    <div class="span-5">
                        <?php echo $form->labelEx($model,'property_style'); ?>
                        <?php echo $form->checkBoxList($model,'property_style',CHtml::listData(ListPropertyStyle::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'property_style'); ?>
                    </div>
            	</div>
            </td>
            <td style="vertical-align:top">
            	<div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'bedrooms'); ?>
                        <?php echo $form->textField($model,'bedrooms',array('size'=>3,'maxlength'=>3)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'There is no universally accepted definition of a bedroom; the definition of r bedroom is determined by the governing municipality.' 
                        )); ?>
                        <?php echo $form->error($model,'bedrooms'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'full_baths'); ?>
                        <?php echo $form->textField($model,'full_baths',array('size'=>3,'maxlength'=>3)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'A full bath is considered a full bath if it has three fixtures-typically a toilet, sink and a shower or tub.' 
                        )); ?>
                        <?php echo $form->error($model,'full_baths'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'half_baths'); ?>
                        <?php echo $form->textField($model,'half_baths',array('size'=>3,'maxlength'=>3)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'A bath is considered a half bath if it has two fixtures-typically a toilet and sink.' 
                        )); ?>
                        <?php echo $form->error($model,'half_baths'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'sq_ft_heated'); ?>
                        <?php echo $form->textField($model,'sq_ft_heated'); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'The number of square feet that is heated in the home.' 
                        )); ?>
                        <?php echo $form->error($model,'sq_ft_heated'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'total_building_sq_ft'); ?>
                        <?php echo $form->textField($model,'total_building_sq_ft'); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'This is the total Square footage of the building including the garage, lanai, and the air conditioned space.' 
                        )); ?>
                        <?php echo $form->error($model,'total_building_sq_ft'); ?>
                    </div>
                </div>
            </td>
            <td style="vertical-align:top">
            	<div class="span-5">
					<?php if(!is_array($model->sq_ft_source)) $model->sq_ft_source = explode(" | ",$model->sq_ft_source); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'sq_ft_source'); ?>
                        <?php echo $form->dropDownList($model,'sq_ft_source', CHtml::listData(DropSqftSource::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'sq_ft_source'); ?>
                    </div>
                
                    <?php if(!is_array($model->ownership_max)) $model->ownership_max = explode(" | ",$model->ownership_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'ownership_max'); ?>
                        <?php echo $form->checkBoxList($model,'ownership_max',CHtml::listData(ListOwnership::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'ownership_max'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model,'cdd_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'Community Development District (CDD) – A district that by governmental approval may charge separate non- ad valorem special assessments for satisfying the debt obligations of the district (community) related to financing, maintaining, and servicing the districts (communities) improvement and/or services.' . $link_criteria 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'cdd_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'cdd_yn'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'annual_cdd_fee'); ?>
                        <?php echo $form->textField($model,'annual_cdd_fee',array('size'=>12,'maxlength'=>12)); ?>
                        <?php echo $form->error($model,'annual_cdd_fee'); ?>
                    </div>

                </div>
             </td>
            <td style="vertical-align:top">
            	<div class="span-5">
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'additional_parcel_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'This field is used when an additional parcel is included in the sale of the property.' 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'additional_parcel_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'additional_parcel_yn'); ?>
                    </div><br/>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'homestead_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'Indicates if the property has a homestead exemption.' 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'homestead_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'homestead_yn'); ?>
                    </div><br/>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'other_exemptions_yn'); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'other_exemptions_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'other_exemptions_yn'); ?>
                    </div>
                </div>
         	</td>
      	</tr>
	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
				<div class="span-6">
					<?php if(!is_array($model->home_features_max)) $model->home_features_max = explode(" | ",$model->home_features_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'home_features_max'); ?>
                        <?php echo $form->checkBoxList($model,'home_features_max',CHtml::listData(ListHomeFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'home_features_max'); ?>
                    </div>
                
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
                        <?php echo $form->textField($model,'lot_size_sq_ft'); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Obtained from County records." 
                        )); ?>
                        <?php echo $form->error($model,'lot_size_sq_ft'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'lot_size_acre'); ?>
                        <?php echo $form->textField($model,'lot_size_acre'); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Obtained from County records. Must be in  .xxx format." 
                        )); ?>
                        <?php echo $form->error($model,'lot_size_acre'); ?>
                    </div>
                    
                    <div class="row">
                        <?php echo $form->labelEx($model,'total_acreage'); ?>
                        <?php echo $form->dropDownList($model,'total_acreage', CHtml::listData(DropTotalAcreage::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'total_acreage'); ?>
                    </div>

    			</div>
            </td>
        	<td style="vertical-align:top;">
				<div class="span-5">
					<?php if(!is_array($model->location_max)) $model->location_max = explode(" | ",$model->location_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'location_max',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate additional descriptions of where a dwelling is located with a community, city or county." 
                        )); ?><br/>
                        <?php echo $form->checkBoxList($model,'location_max',CHtml::listData(ListLocation::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'location_max'); ?>
                    </div>
                </div>
           	</td>
        	<td style="vertical-align:top;">
				<div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'front_exposure',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate the general compass direction of the front door." 
                        )); ?><br/>
                        <?php echo $form->dropDownList($model,'front_exposure', CHtml::listData(DropFrontExposure::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'front_exposure'); ?>
                    </div>
                
                    <?php if(!is_array($model->utilities_data_max)) $model->utilities_data_max = explode(" | ",$model->utilities_data_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'utilities_data_max',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to describe the utilities available at the property address." 
                        )); ?><br/>
                        <?php echo $form->checkBoxList($model,'utilities_data_max',CHtml::listData(ListUtilitiesData::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'utilities_data_max'); ?>
                    </div>
                </div>
			</div>
      	</tr>
	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
                <div class="span-5">
                	<div class="row">
						<?php echo $form->labelEx($model,'water_access_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'This field should only be used when the subject property has deeded access to one or more of the corresponding pick-list" NOTE: The availability of off-site Water Access facilities provided by an association membership does not qualify under this heading. Enter this type under the Community Features field' 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'water_access_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'water_access_yn'); ?>
            		</div>
                	<div class="row">
						<?php if(!is_array($model->water_access)) $model->water_access = explode(" | ",$model->water_access); ?>
                        <div class="row">
                            <?php echo $form->labelEx($model,'water_access'); ?>
                            <?php echo $form->checkBoxList($model,'water_access',CHtml::listData(ListWaterAccess::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                            <?php echo $form->error($model,'water_access'); ?>
                        </div>
                 	</div>
            	</div>
            </td>
        	<td style="vertical-align:top;">
                <div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'water_view_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"This field should only be used when the subject property has a view of the water." 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'water_view_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'water_view_yn'); ?>
                    </div>
                
                    <?php if(!is_array($model->water_view)) $model->water_view = explode(" | ",$model->water_view); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'water_view'); ?>
                        <?php echo $form->checkBoxList($model,'water_view',CHtml::listData(ListWaterView::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'water_view'); ?>
                    </div>
                </div>
           	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'water_frontage_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"This field should be used only when the subject property touches water." 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'water_frontage_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'water_frontage_yn'); ?>
                    </div>
                
                    <?php if(!is_array($model->water_frontage)) $model->water_frontage = explode(" | ",$model->water_frontage); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'water_frontage'); ?>
                        <?php echo $form->checkBoxList($model,'water_frontage',CHtml::listData(ListWaterFrontage::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'water_frontage'); ?>
                    </div>
                </div>
            </td>
        	<td style="vertical-align:top;">
                <div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'new_construction_yn'); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'new_construction_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'new_construction_yn'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'construction_status'); ?>
                        <?php echo $form->dropDownList($model,'construction_status', CHtml::listData(DropConstructionStatus::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'construction_status'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'projected_completion_date'); ?>
                        <?php //echo $form->textField($model,'projected_completion_date'); ?>
                
                        <?php        
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model'=>$model,
                            'name'=>'projected_completion_date',
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px; width:80px;'
                            ),
                        ));
                        ?>  
                        
                        
                        <?php echo $form->error($model,'projected_completion_date'); ?>
                    </div>
                </div>
           	</td>
       	</tr>
	</table>        
     
	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
                <div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'private_pool_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'If the pool is located in a community, enter N for no. Community Pools can be entered in the "Community Features" field.' 
                        )); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'private_pool_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'private_pool_yn'); ?>
                    </div>
                
                    <?php if(!is_array($model->pool_type_max)) $model->pool_type_max = explode(" | ",$model->pool_type_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'pool_type_max'); ?>
                        <?php echo $form->checkBoxList($model,'pool_type_max',CHtml::listData(ListPoolType::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'pool_type_max'); ?>
                    </div>
                </div>
           	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
					<?php if(!is_array($model->property_description)) $model->property_description = explode(" | ",$model->property_description); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'property_description'); ?>
                        <?php echo $form->checkBoxList($model,'property_description',CHtml::listData(ListPropertyDescription::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'property_description'); ?>
                    </div>
                </div>
          	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
					<?php if(!is_array($model->foundation_max)) $model->foundation_max = explode(" | ",$model->foundation_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'foundation_max'); ?>
                        <?php echo $form->checkBoxList($model,'foundation_max',CHtml::listData(ListFoundation::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'foundation_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->exterior_construction_max)) $model->exterior_construction_max = explode(" | ",$model->exterior_construction_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'exterior_construction_max'); ?>
                        <?php echo $form->checkBoxList($model,'exterior_construction_max',CHtml::listData(ListExteriorConstruction::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'exterior_construction_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->roof_max)) $model->roof_max = explode(" | ",$model->roof_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'roof_max'); ?>
                        <?php echo $form->checkBoxList($model,'roof_max',CHtml::listData(ListRoof::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'roof_max'); ?>
                    </div>
				</div>
            </td>                
        	<td style="vertical-align:top;">
                <div class="span-5">
                    <?php if(!is_array($model->exterior_features_max)) $model->exterior_features_max = explode(" | ",$model->exterior_features_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'exterior_features_max'); ?>
                        <?php echo $form->checkBoxList($model,'exterior_features_max',CHtml::listData(ListExteriorFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'exterior_features_max'); ?>
                    </div>
				</div>
          	</td>
      	</tr>
  	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
                <div class="span-5">
					<?php if(!is_array($model->garage_carport_max)) $model->garage_carport_max = explode(" | ",$model->garage_carport_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'garage_carport_max'); ?>
                        <?php echo $form->checkBoxList($model,'garage_carport_max',CHtml::listData(ListGarage::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'garage_carport_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->garage_features_max)) $model->garage_features_max = explode(" | ",$model->garage_features_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'garage_features_max'); ?>
                        <?php echo $form->checkBoxList($model,'garage_features_max',CHtml::listData(ListGarageFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'garage_features_max'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'garage_dimensions'); ?>
                        <?php echo $form->textField($model,'garage_dimensions',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'garage_dimensions'); ?>
                    </div>
                </div>
          	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
					<?php if(!is_array($model->architectural_style_max)) $model->architectural_style_max = explode(" | ",$model->architectural_style_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'architectural_style_max'); ?>
                        <?php echo $form->checkBoxList($model,'architectural_style_max',CHtml::listData(ListArchitecturalStyle::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'architectural_style_max'); ?>
                    </div>
                </div>
           	</td>
        	<td style="vertical-align:top;">
                <div class="span-6">
					<?php if(!is_array($model->community_features_max)) $model->community_features_max = explode(" | ",$model->community_features_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'community_features_max',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate amenities in the common areas of the community for the residents use.<br/>Some amenities may or may not be subject to availability and may require a usage fee<br/>Note additional information about the Community Features in the Public Remarks field." 
                        )); ?><br/>
                        <?php echo $form->checkBoxList($model,'community_features_max',CHtml::listData(ListCommunityFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'community_features_max'); ?>
                    </div>
                </div>
           	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
                	<div class="row">
                        <?php echo $form->labelEx($model,'housing_for_elders'); ?>
                        <?php echo $form->dropDownList($model,'housing_for_elders', MLS::getOlderhousing() , array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'housing_for_elders'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model,'hoa_community_association'); ?>
                        <?php echo $form->dropDownList($model,'hoa_community_association', CHtml::listData(DropHoaCommunityAssociation::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'hoa_community_association'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'hoa_fee'); ?>
                        <?php echo $form->textField($model,'hoa_fee',array('size'=>12,'maxlength'=>12)); ?>
                        <?php echo $form->error($model,'hoa_fee'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'hoa_payment_schedule'); ?>
                        <?php echo $form->dropDownList($model,'hoa_payment_schedule', CHtml::listData(DropHoaPaymentSchedule::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'hoa_payment_schedule'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'monthly_maintainance_addition_to_hoa'); ?>
                        <?php echo $form->textField($model,'monthly_maintainance_addition_to_hoa'); ?>
                        <?php echo $form->error($model,'monthly_maintainance_addition_to_hoa'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'pets_allowed_yn'); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'pets_allowed_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'pets_allowed_yn'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'pet_restrictions_yn',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Used to indicate if there are restrictions by the HOA/Community/Condo Association relating to the types of pets that can reside on/in the property." 
                        )); ?><br/>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'pet_restrictions_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'pet_restrictions_yn'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'elementary_school'); ?>
                        <?php echo $form->textField($model,'elementary_school',array('maxlength'=>50)); ?>
                        <?php echo $form->error($model,'elementary_school'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'middle_school'); ?>
                        <?php echo $form->textField($model,'middle_school',array('maxlength'=>50)); ?>
                        <?php echo $form->error($model,'middle_school'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'high_school'); ?>
                        <?php echo $form->textField($model,'high_school',array('maxlength'=>50)); ?>
                        <?php echo $form->error($model,'high_school'); ?>
                    </div>
				</div>
            </td>
     	</tr>
  	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
                <div class="span-5">
                    <div class="row">
                        <?php echo $form->labelEx($model,'living_room'); ?>
                        <?php echo $form->textField($model,'living_room',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'living_room'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'dining_room'); ?>
                        <?php echo $form->textField($model,'dining_room',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'dining_room'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'family_room'); ?>
                        <?php echo $form->textField($model,'family_room',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'family_room'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'great_room'); ?>
                        <?php echo $form->textField($model,'great_room',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'great_room'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'kitchen'); ?>
                        <?php echo $form->textField($model,'kitchen',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'kitchen'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'master_bedroom_size'); ?>
                        <?php echo $form->textField($model,'master_bedroom_size',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'master_bedroom_size'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'bedroom_2nd_size'); ?>
                        <?php echo $form->textField($model,'bedroom_2nd_size',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'bedroom_2nd_size'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'bedroom_3rd_size'); ?>
                        <?php echo $form->textField($model,'bedroom_3rd_size',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'bedroom_3rd_size'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'bedroom_4th_size'); ?>
                        <?php echo $form->textField($model,'bedroom_4th_size',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'bedroom_4th_size'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'bedroom_5th_size'); ?>
                        <?php echo $form->textField($model,'bedroom_5th_size',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'bedroom_5th_size'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'study_den_dimensions'); ?>
                        <?php echo $form->textField($model,'study_den_dimensions',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'study_den_dimensions'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'balcony_porch_lanai'); ?>
                        <?php echo $form->textField($model,'balcony_porch_lanai',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'balcony_porch_lanai'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'dinette'); ?>
                        <?php echo $form->textField($model,'dinette',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'dinette'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'studio_dimensions'); ?>
                        <?php echo $form->textField($model,'studio_dimensions',array('size'=>20,'maxlength'=>20)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Format must be (two numbers x two numbers) example 08x15 not 8x15. TIP: Entering 00x00 is not allowed." 
                        )); ?>
                        <?php echo $form->error($model,'studio_dimensions'); ?>
                    </div>
                </div>
          	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
					<?php if(!is_array($model->additional_rooms_max)) $model->additional_rooms_max = explode(" | ",$model->additional_rooms_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'additional_rooms_max'); ?>
                        <?php echo $form->checkBoxList($model,'additional_rooms_max',CHtml::listData(ListAdditionalRooms::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'additional_rooms_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->air_conditioning_max)) $model->air_conditioning_max = explode(" | ",$model->air_conditioning_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'air_conditioning_max'); ?>
                        <?php echo $form->checkBoxList($model,'air_conditioning_max',CHtml::listData(ListAirConditioning::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'air_conditioning_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->heating_and_fuel_max)) $model->heating_and_fuel_max = explode(" | ",$model->heating_and_fuel_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'heating_and_fuel_max'); ?>
                        <?php echo $form->checkBoxList($model,'heating_and_fuel_max',CHtml::listData(ListHeatingAndFuel::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'heating_and_fuel_max'); ?>
                    </div>
				</div>
           	</td>
        	<td style="vertical-align:top;">
                <div class="span-6">
					<?php if(!is_array($model->appliances_included_max)) $model->appliances_included_max = explode(" | ",$model->appliances_included_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'appliances_included_max',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"To ensure that misunderstandings do not occur, you should note the make and model of each appliance that is to remain with the property and provide this to the Buyer." 
                        )); ?><br/>
                        <?php echo $form->checkBoxList($model,'appliances_included_max',CHtml::listData(ListAppliancesIncluded::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'appliances_included_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->interior_layout_max)) $model->interior_layout_max = explode(" | ",$model->interior_layout_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'interior_layout_max'); ?>
                        <?php echo $form->checkBoxList($model,'interior_layout_max',CHtml::listData(ListInteriorLayout::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'interior_layout_max'); ?>
                    </div>
				</div>
          	</td>
        	<td style="vertical-align:top;">
                <div class="span-5">
					<?php if(!is_array($model->interior_features_max)) $model->interior_features_max = explode(" | ",$model->interior_features_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'interior_features_max'); ?>
                        <?php echo $form->checkBoxList($model,'interior_features_max',CHtml::listData(ListInteriorFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'interior_features_max'); ?>
                    </div>
				</div>
          	</td>
      	</tr>
  	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
                <div class="span-6">
					<?php if(!is_array($model->master_bath_features_max)) $model->master_bath_features_max = explode(" | ",$model->master_bath_features_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'master_bath_features_max'); ?>
                        <?php echo $form->checkBoxList($model,'master_bath_features_max',CHtml::listData(ListMasterBathFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'master_bath_features_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->security_system)) $model->security_system = explode(" | ",$model->security_system); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'security_system',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"It is against MLS Rules and Regulations to publish, in any field, access codes, combination lockbox codes, security gate codes, security alarm codes or any other codes for equipment or systems designed to ensure the security of the property." 
                        )); ?><br/>
                        <?php echo $form->checkBoxList($model,'security_system',CHtml::listData(ListSecuritySystem::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'security_system'); ?>
                    </div>
                
                    <?php if(!is_array($model->floor_covering_max)) $model->floor_covering_max = explode(" | ",$model->floor_covering_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'floor_covering_max'); ?>
                        <?php echo $form->checkBoxList($model,'floor_covering_max',CHtml::listData(ListFloorCovering::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'floor_covering_max'); ?>
                    </div>
                    
					<?php if(!is_array($model->kitchen_features_max)) $model->kitchen_features_max = explode(" | ",$model->kitchen_features_max); ?>
                    <div class="row">
                        <div class="row">
                            <?php echo $form->labelEx($model,'kitchen_features_max'); ?>
                            <?php echo $form->checkBoxList($model,'kitchen_features_max',CHtml::listData(ListKitchenFeatures::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                            <?php echo $form->error($model,'kitchen_features_max'); ?>
                        </div>
					</div>
                                    
                    <div class="row">
                        <?php echo $form->labelEx($model,'fireplace_yn'); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'fireplace_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'fireplace_yn'); ?>
                    </div>
                
                    <?php if(!is_array($model->fireplace_description_max)) $model->fireplace_description_max = explode(" | ",$model->fireplace_description_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'fireplace_description_max'); ?>
                        <?php echo $form->checkBoxList($model,'fireplace_description_max',CHtml::listData(ListFireplaceDescription::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'fireplace_description_max'); ?>
                    </div>
                    
                </div>
           	</td>
            
        	<td style="vertical-align:top;">
                <div class="span-6">
					<?php if(!is_array($model->financing_available_max)) $model->financing_available_max = explode(" | ",$model->financing_available_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'financing_available_max'); ?>
                        <?php echo $form->checkBoxList($model,'financing_available_max',CHtml::listData(ListFinancingAvailable::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'financing_available_max'); ?>
                    </div>
                
                    <?php if(!is_array($model->realtor_information_max)) $model->realtor_information_max = explode(" | ",$model->realtor_information_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'realtor_information_max'); ?>
                        <?php echo $form->checkBoxList($model,'realtor_information_max',CHtml::listData(ListRealtorInformation::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'realtor_information_max'); ?>
                    </div>
				</div>
          	</td>
            
            <td style="vertical-align:top;">
                <div class="span-6">
					<?php if(!is_array($model->realtor_information_confidential_max)) $model->realtor_information_confidential_max = explode(" | ",$model->realtor_information_confidential_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'realtor_information_confidential_max'); ?>
                        <?php echo $form->checkBoxList($model,'realtor_information_confidential_max',CHtml::listData(ListRealtorInformationConfidential::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'realtor_information_confidential_max'); ?>
                    </div>
                
                    <div class="row">
                        <?php echo $form->labelEx($model,'special_sale_provision'); ?>
                        <?php echo $form->dropDownList($model,'special_sale_provision', CHtml::listData(DropSpecialSaleProvision::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
                        <?php echo $form->error($model,'special_sale_provision'); ?>
                    </div>
                
                    <?php if(!is_array($model->showing_instructions_max)) $model->showing_instructions_max = explode(" | ",$model->showing_instructions_max); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'showing_instructions_max',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"This field is used to indicate showing instructions.  It is against MLS Rules and Regulations to publish, in any field, access codes, combination lockbox codes, security gate codes, security alarm codes or any other codes for equipment or systems designed to ensure the security of the property." 
                        )); ?><br/>
                        <?php echo $form->checkBoxList($model,'showing_instructions_max',CHtml::listData(ListShowingInstructions::model()->findAll(), 'id', 'id'),array('separator'=>'<br />','labelOptions'=>array('style'=>'display:inline;font-weight:normal;'))); ?>
                        <?php echo $form->error($model,'showing_instructions_max'); ?>
                    </div>
				</div>
          	</td> 
      	</tr>
  	</table>

	<table class="span-23 last form_tb" >
		<tr>
        	<td style="vertical-align:top;">
                <div class="row">
                    <?php echo $form->labelEx($model,'showing_time_secure_remarks',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Call owner at (xxx) xxx-xxxx for showing instructions." 
                        )); ?><br/>
                    <?php echo $form->textArea($model,'showing_time_secure_remarks',array('rows'=>2, 'cols'=>105)); ?>
                    <?php echo $form->error($model,'showing_time_secure_remarks'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'virtual_tour_link',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"Check with your provider to make certain the link being added is unbranded. i.e. no signs or contact information." 
                        )); ?><br/>
                    <?php echo $form->textField($model,'virtual_tour_link',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'virtual_tour_link'); ?>
                </div>
            
            	<div class="row">
                    <div class="row">
                        <?php echo $form->labelEx($model,'internet_yn'); ?>
                        <div class="compactRadioGroup">
                            <?php echo $form->radioButtonList($model,'internet_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                        </div>		
                        <?php echo $form->error($model,'internet_yn'); ?>
                    </div>
               	</div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'display_property_address_on_internet_yn',array('style'=>'display:inline;')); ?>
                    <?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>"Information in this field will be displayed on all public sites that the can be viewed. A word of caution…Especially if the home is vacant, we recommend not displaying the address on the Internet." 
                    )); ?><br/>
                    <div class="compactRadioGroup">
                        <?php echo $form->radioButtonList($model,'display_property_address_on_internet_yn', array('Y'=>'Yes','N'=>'No'), array('separator'=>'&nbsp;&nbsp;')); ?>
                    </div>		
                    <?php echo $form->error($model,'display_property_address_on_internet_yn'); ?>
                </div>
                
                <div class="row">
                    <?php echo $form->labelEx($model,'driving_direction',array('style'=>'display:inline;')); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>'Directions must have a starting and ending point. They should start from a major intersection. The first turn should state turn north, south, east or west. After that, lefts and rights can be used.  TIP Do not enter "See Mapquest" or any other mapping solution.' 
                        )); ?><br/>
                    <?php echo $form->textArea($model,'driving_direction',array('rows'=>2, 'cols'=>105)); ?>
                    <?php echo $form->error($model,'driving_direction'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'realtor_only_remarks',array('style'=>'display:inline;')); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This field may be used for special or important realtor information as well as bonuses that are being offered.' 
                    )); ?><br/>
                    <?php echo $form->textArea($model,'realtor_only_remarks',array('rows'=>2, 'cols'=>105)); ?>
                    <?php echo $form->error($model,'realtor_only_remarks'); ?>
                </div>
            
                <div class="row">
                    <?php echo $form->labelEx($model,'public_remarks',array('style'=>'display:inline;')); ?>
					<?php echo CHtml::image($question,'', array('class'=>'tt',
                        'title'=>'This is the description of your property. The first 1530 characters is what will be seen on the public internet sites. The remaining characters will be shown on the MLS.  You shall not include contact information, bonuses, URL information, affiliated businesses, owner name or contact information.' 
                    )); ?><br/>
                    <?php echo $form->textArea($model,'public_remarks',array('rows'=>2, 'cols'=>105)); ?>
                    <?php echo $form->error($model,'public_remarks'); ?>
                </div>
           
                <div class="row">
                    <?php echo $form->labelEx($model,'pay_broker_percentage'); ?>
                    <?php echo $form->textField($model,'pay_broker_percentage',array('maxlength'=>50)); ?>
						<?php echo CHtml::image($question,'', array('class'=>'tt',
                            'title'=>"You must enter a value to compensate an agent should they bring a buyer.  TIP The format must include % or $ symbols. (i.e. 3% not 3)($1200 not 1200)." 
                        )); ?>
                    <?php echo $form->error($model,'pay_broker_percentage'); ?>
                </div>
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
                                   'action'=>Yii::app()->baseUrl.'/listing/mls/upload',
                                   'allowedExtensions'=>array("jpg","jpeg","gif","png","doc", "docx", "pdf"), 
                                   'template'=>'<div class="qq-uploader"><div class="qq-upload-button">Upload Photos</div><ul class="qq-upload-list"></ul></div>',
                                   'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                   'minSizeLimit'=>1,// minimum file size in bytes
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
													/*alert(this.id);*/
													counter++;
                                            		$('#Mls_photo_' + (index+1)).val(responseJSON.filename); 
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
                   // echo app()->basePath."/../upload";
                    //var_dump(ini_get('upload_max_filesize'));
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
	
	<div class="row buttons" style="text-align:center;">
		<?php 
			if(!Yii::app()->user->isAdmin() && !Yii::app()->user->isGuest){
				if($model->isNewRecord)
				{
				?>
				  	<p class="note">
						<span class="required">*</span> When you select "Save as Incomplete", your work will be saved and you can return later to complete this listing<br/>
						<span class="required">*</span> When you select "Save", the next step is to approve your listing
					</p>
				<?php
					echo CHtml::hiddenField('incompleteID', $incompleteId);
					/*echo CHtml::openTag('label') . CHtml::checkBox('survey', TRUE, array('style'=>'display:inline')) . " Take a Survey ?" . CHtml::closeTag('label');
					echo "<br/>";*/
					echo CHtml::ajaxButton('Save as incomplete',  Yii::app()->request->baseUrl . '/index.php/listing/mls/incomplete', array ('type'=>'post','data'=>"js:$('#mls-form').serialize()",'success' => 'function(data) { alert( data ); if(data=="Saved as incomplete") window.location = "' . Yii::app()->request->baseUrl . '/index.php/listing/mls/admin"; }'), array ());
					echo '&nbsp;&nbsp;';
					echo CHtml::submitButton('Save and View My Listing');
					echo CHtml::ajaxButton('Autosave',  Yii::app()->request->baseUrl . '/index.php/listing/mls/autosave', array ('type'=>'post','data'=>"js:$('#mls-form').serialize()",'success' => 'function(data) { if(data) autosavedata(data);} '), array ('style'=>'display:none;'));				
				} elseif ($model->list_status == 'INCOMPLETE' || $model->list_status == 'COMPLETED' || $model->list_status == "APPROVED" || $model->list_status == "SOLD" || $model->list_status == "PAID" || $model->list_status == "PENDING") {
					/*echo CHtml::submitButton('Update as incomplete');				
					echo '&nbsp;&nbsp;';	*/			
					echo CHtml::submitButton('Save and View My Listing');	
					echo CHtml::ajaxButton('Autosave',  Yii::app()->request->baseUrl . '/index.php/listing/mls/autosave', array ('type'=>'post','data'=>"js:$('#mls-form').serialize()",'success' => 'function(data) { if(data) autosavedata(data);} '), array ('style'=>'display:none;'));			
				}
			}else{
			
				if($model->isNewRecord)
				{
				?>
				  	<p class="note">
						<span class="required">*</span> When you select "Save as Incomplete", your work will be saved and you can return later to complete this listing<br/>
						<span class="required">*</span> When you select "Save", the next step is to approve your listing
					</p>
				<?php
					echo CHtml::hiddenField('incompleteID', $incompleteId);
					/*echo CHtml::openTag('label') . CHtml::checkBox('survey', TRUE, array('style'=>'display:inline')) . " Take a Survey ?" . CHtml::closeTag('label');
					echo "<br/>";*/
					echo CHtml::ajaxButton('Save as incomplete',  Yii::app()->request->baseUrl . '/index.php/listing/mls/incomplete', array ('type'=>'post','data'=>"js:$('#mls-form').serialize()",'success' => 'function(data) { alert( data ); if(data=="Saved as incomplete") window.location = "' . Yii::app()->request->baseUrl . '/index.php/listing/mls/admin"; }'), array ());
					echo '&nbsp;&nbsp;';
					echo CHtml::submitButton('Save and View My Listing');
					echo CHtml::ajaxButton('Autosave',  Yii::app()->request->baseUrl . '/index.php/listing/mls/autosave', array ('type'=>'post','data'=>"js:$('#mls-form').serialize()",'success' => 'function(data) { if(data) autosavedata(data);} '), array ('style'=>'display:none;'));				
				} else{
					/*echo CHtml::submitButton('Update as incomplete');				
					echo '&nbsp;&nbsp;';*/				
					echo CHtml::submitButton('Save and View My Listing');	
					echo CHtml::ajaxButton('Autosave',  Yii::app()->request->baseUrl . '/index.php/listing/mls/autosave', array ('type'=>'post','data'=>"js:$('#mls-form').serialize()",'success' => 'function(data) { if(data) autosavedata(data);} '), array ('style'=>'display:none;')); 			
				}	
			}
		?>
	</div><br/><br/>
<?php $this->endWidget(); ?>
</div><!-- form -->
<script type="text/javascript">
//	alert($('#mls-form').serialize());

</script>
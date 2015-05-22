<p><b><i>Your business means the world to us. To show how much we want to make your next experience with us the best it can be, take 5 minutes to complete this short survey and we will take $5 off the price of your listing. Instead of paying $147, you will only pay $142.</i></b></p>
<?php 
  //  echo CHtml::submitButton('SKIP SURVEY', array('submit'=> Yii::app()->createUrl('listing/flyer/printflyer',array('mls_id'=>$model->mls_id))));
?>
<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_live_ixMRCij4iwpDUZM9ebTgRYbg"
    data-image="http://localhost/flatrate/themes/custom/css/images/logo.png"
    data-name="Flatratelist.com"
    data-description="Flatratelist.com Listing Service"
    data-amount="14700">
  </script>
  <input name="userid" type="hidden" value="<?php echo Yii::app()->user->id; ?>"/>
  <input name="mls_id" type="hidden" value="<?php echo $model->mls_id ;?>"/>
  <input name="paymentdone" type="hidden" value="1"/>
</form>
<br/><br/>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'mls_id'); ?>
		<?php echo $form->hiddenField($model,'mls_id'); ?>
		<?php //echo $form->error($model,'mls_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hear_about'); ?>
       	<?php echo $form->dropDownList($model,'hear_about', CHtml::listData(DropSurveyHearAbout::model()->findAll(), 'code', 'name'), array('empty'=>'select ...')); ?>
		<?php echo $form->textField($model,'hear_about_text',array('maxlength'=>50,'size'=>50)); ?>
		<?php echo $form->error($model,'hear_about'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'how_easy'); ?>
        <div class="compactRadioGroup">
            <?php echo $form->radioButtonList($model,'how_easy', array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'), array('separator'=>'&nbsp;&nbsp;')); ?>
        </div>		
        <?php echo $form->error($model,'how_easy'); ?>
    </div><br/>

	<div class="row">
		<?php echo $form->labelEx($model,'refer_other'); ?>
		<?php echo $form->textArea($model,'refer_other',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'refer_other'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suggestion'); ?>
		<?php echo $form->textArea($model,'suggestion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'suggestion'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'how_long'); ?>
        <div class="compactRadioGroup">
            <?php echo $form->radioButtonList($model,'how_long', array('15-30 minutes'=>'15-30 minutes','30-45 minutes'=>'30-45 minutes','45-60 minutes'=>'45-60 minutes','More than an hour'=>'More than an hour'), array('separator'=>'<br/>')); ?>
        </div>		
        <?php echo $form->error($model,'how_long'); ?>
    </div><br/>

    <div class="row">
        <?php echo $form->labelEx($model,'help_chat'); ?>
        <div class="compactRadioGroup">
            <?php echo $form->radioButtonList($model,'help_chat', array('1-2'=>'1-2','3 or more'=>'3 or more'), array('separator'=>'<br/>')); ?>
        </div>		
        <?php echo $form->error($model,'help_chat'); ?>
    </div><br/>

	<div class="row">
		<?php echo $form->labelEx($model,'difficult_part'); ?>
		<?php echo $form->textArea($model,'difficult_part',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'difficult_part'); ?>
	</div>
	<br/>
	<div class="row buttons">
    	<?php echo CHtml::submitButton('SUBMIT SURVEY & GO TO PAYMENT', array ( )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$(document).ready(function(){
  $('.stripe-button-el span').empty().append('Proceed to Check Out').css('min-height', '10px');
  })     
</script>
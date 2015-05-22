<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'promo_code'); ?>
		<?php echo $form->textField($model,'promo_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'promo_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'promo_name'); ?>
		<?php echo $form->textField($model,'promo_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'promo_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disc_amount'); ?>
		<?php echo $form->textField($model,'disc_amount',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'disc_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disc_type'); ?>
		<?php echo $form->textField($model,'disc_type',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'disc_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_data'); ?>
		<?php echo $form->textField($model,'end_data'); ?>
		<?php echo $form->error($model,'end_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plans'); ?>
		<?php echo $form->textArea($model,'plans',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'plans'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publish'); ?>
		<?php echo $form->textField($model,'publish'); ?>
		<?php echo $form->error($model,'publish'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
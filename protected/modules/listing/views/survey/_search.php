<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mls_id'); ?>
		<?php echo $form->textField($model,'mls_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hear_about'); ?>
		<?php echo $form->textField($model,'hear_about',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'how_easy'); ?>
		<?php echo $form->textField($model,'how_easy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refer_other_yn'); ?>
		<?php echo $form->textField($model,'refer_other_yn',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refer_other'); ?>
		<?php echo $form->textArea($model,'refer_other',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suggestion'); ?>
		<?php echo $form->textArea($model,'suggestion',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'how_long'); ?>
		<?php echo $form->textField($model,'how_long',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'help_chat'); ?>
		<?php echo $form->textField($model,'help_chat',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'difficult_part'); ?>
		<?php echo $form->textArea($model,'difficult_part',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
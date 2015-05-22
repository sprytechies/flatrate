<?php
$this->pageTitle=Yii::app()->name . ' - Ask Broker';
$this->breadcrumbs=array(
	'Ask a Broker',
);
?>

<div style="width: 720px; margin:0 auto;">
<h1>Ask a Broker</h1>

<?php if(Yii::app()->user->hasFlash('broker')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('broker'); ?>
</div>

<?php else: ?>

<p>
If you have a real estate related question, type your question here and a real estate Broker will get back with you with an answer. Thank you.
</p>

<?php $form=$this->beginWidget('CActiveForm'); ?>
	<div>
	<div class="form formWindmill" style="margin: 0 auto !important; width: 720px;">
	<?php echo $form->errorSummary($model); ?>
	</div>
	</div>
	
<div class="windmill">
<div class="wcontent">
<div class="form">

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div style="float: left; width: 39%">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30)); ?>
	</div>
	</div>

	<div style="float: left; width: 59%">
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30)); ?>
	</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>76,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>55)); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above. Letters are not case-sensitive.</div>
	</div>
	<?php endif; ?>
	<div class="row">
		<label><?php echo CHtml::checkBox('notify', $checked); ?> Want to be notified of important changes in real estate?</label>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>


</div>
</div>
</div><!-- form -->
<?php $this->endWidget(); ?>

<?php endif; ?>
</div>
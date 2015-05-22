<?php
$this->pageTitle=Yii::app()->name . ' - '. "Request for Make a Changes";
$this->breadcrumbs=array(
	"Make a Changes",
);
?>

<div style="width: 720px; margin:0 auto;">
<h1>Request for Make a Changes</h1>
<?php if(Yii::app()->user->hasFlash('reqChangeSubmit')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('reqChangeSubmit'); ?>
</div>

<?php else: ?>

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
		<?php echo $form->dropDownList($model,'subject', $subject, array('style'=>'width:460px')); ?>
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
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

</div>
</div>
</div><!-- form -->
<?php $this->endWidget(); ?>

<?php endif; ?>
</div>

<style>
    hr.space {
        color: #000;
        background: #000;
    }
    .form{
        margin-left: 50px;
    }
</style>
<?php
$this->breadcrumbs=array(
	'jacksonsigns'=>array('update'),
);
?>
   <h1>Jackson's Signs</h1>
<hr />
<div class="control-panel">
    <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'signs-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
       <div class="row">
		<?php echo $form->labelEx($model,'transaction_id'); ?>
		<?php echo $model->transaction_id; ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'saddress'); ?>
		<?php echo $model->saddress; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scity'); ?>
		<?php echo $model->scity; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scountry'); ?>
		 <?php echo $model->scountry; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'szipcode'); ?>
		<?php echo $model->szipcode; ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'baddress'); ?>
		<?php echo $model->saddress; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bcity'); ?>
		<?php echo $model->scity; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bcountry'); ?>
		 <?php echo $model->scountry; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bzipcode'); ?>
		<?php echo $model->szipcode; ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $model->phone; ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropdownlist($model,'status',array('1'=>'In Process', '2'=>'Delivery Sent', '3'=>'Delivered'),array('style'=>'width:250px')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buy Now' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>


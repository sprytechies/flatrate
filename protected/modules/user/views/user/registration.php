<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>



<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="windmill">
<div class="wcontent">
<h1><?php echo UserModule::t("Registration"); ?></h1>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
</div>
</div>
<?php else: ?>
<?php echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data')); ?>
	<div>
	<div class="form formWindmill" style="margin: 0 auto !important; width: 720px;">
		<?php echo CHtml::errorSummary($form); ?>
		<?php echo CHtml::errorSummary($profile); ?>
	</div>
	</div>
	<h1 style="margin-left: 120px;"><?php echo UserModule::t("Registration"); ?></h1>
	<div class="windmill">
	<div class="wcontent">
	<div class="form">

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<div style="float:left; width:39%;">
		<div class="row">
		<?php echo CHtml::activeLabelEx($form,'email'); ?>
		<?php echo CHtml::activeTextField($form,'email'); ?>
		</div>
	
		<div class="row">
		<?php //echo CHtml::activeLabelEx($form,'username'); ?>
		<?php echo CHtml::activeHiddenField($form,'username',array('value'=>uniqid())); ?>
		</div>
		
		<div class="row">
		<?php echo CHtml::activeLabelEx($form,'password'); ?>
		<?php echo CHtml::activePasswordField($form,'password'); ?>
		<p class="hint">
		<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
		</p>
		</div>
		
		<div class="row">
		<?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?>
		<?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
		</div>
	</div>
	<div style="float: right; width:59%">
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php 
			if($field->varname != 'plan')
				echo CHtml::activeLabelEx($profile,$field->varname); ?>
		<?php 
		if ($field->widgetEdit($profile)) {
			echo $field->widgetEdit($profile);
		} elseif ($field->range) {
			echo CHtml::activeDropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			if($field->varname == 'plan'){
				/*$plans = Plan::getPlans();
				echo CHtml::activeDropDownList($profile,$field->varname, $plans);
				echo "<br/>";*/
				echo CHtml::openTag('div', array('style'=>'display:none')) . CHtml::checkBox('listing', true) . " Listing Member" . CHtml::closeTag('div');
			}
			else
				echo CHtml::activeTextField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo CHtml::error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
?>
	</div>
	<div style="clear: both"></div>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row" style="margin-top: -20px;">
		<?php echo CHtml::activeLabelEx($form,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo CHtml::activeTextField($form,'verifyCode'); ?>
		</div>
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
		<label><?php echo CHtml::checkBox('notify'); ?> I want to receive updates of important changes in real estate</label>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

</div><!-- form -->
</div>
</div>
<?php echo CHtml::endForm(); ?>
<?php endif; ?>
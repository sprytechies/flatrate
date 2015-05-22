<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mls_id')); ?>:</b>
	<?php echo CHtml::encode($data->mls_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hear_about')); ?>:</b>
	<?php echo CHtml::encode($data->hear_about); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('how_easy')); ?>:</b>
	<?php echo CHtml::encode($data->how_easy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('refer_other')); ?>:</b>
	<?php echo CHtml::encode($data->refer_other); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suggestion')); ?>:</b>
	<?php echo CHtml::encode($data->suggestion); ?>
	<br />

	<?php 
	<b><?php echo CHtml::encode($data->getAttributeLabel('how_long')); ?>:</b>
	<?php echo CHtml::encode($data->how_long); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('help_chat')); ?>:</b>
	<?php echo CHtml::encode($data->help_chat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('difficult_part')); ?>:</b>
	<?php echo CHtml::encode($data->difficult_part); ?>
	<br />

	 ?>

</div>
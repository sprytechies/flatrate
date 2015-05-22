<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promo_code')); ?>:</b>
	<?php echo CHtml::encode($data->promo_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promo_name')); ?>:</b>
	<?php echo CHtml::encode($data->promo_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disc_amount')); ?>:</b>
	<?php echo CHtml::encode($data->disc_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disc_type')); ?>:</b>
	<?php echo CHtml::encode($data->disc_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_data')); ?>:</b>
	<?php echo CHtml::encode($data->end_data); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('plans')); ?>:</b>
	<?php echo CHtml::encode($data->plans); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	*/ ?>

</div>
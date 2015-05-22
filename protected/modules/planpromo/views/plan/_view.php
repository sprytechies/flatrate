<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan_code')); ?>:</b>
	<?php echo CHtml::encode($data->plan_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plan_name')); ?>:</b>
	<?php echo CHtml::encode($data->plan_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trial_price')); ?>:</b>
	<?php echo CHtml::encode($data->trial_price); ?>
	<br />


</div>
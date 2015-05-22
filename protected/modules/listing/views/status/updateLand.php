<h1>Update Status</h1>
<?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'mls-form',
        'enableAjaxValidation'=>true,
    )); ?>
<table>
	<tr>
		<th>ID</th>
		<td>: <?php echo $model->id; ?></td>
	</tr>
	<tr>
		<th>Address</th>
		<td>: 
			<?php 
				/*if($type == 'mls') 
					echo $model->address; 
				else */
					echo $model->street_name; 
			?>
		</td>
	</tr>
	<tr>
		<th>Listing Status</th>
		<td>: 
			<?php
				/*if($type == 'mls')
					echo $form->dropDownList($model, 'list_status', array('PAID'=>'PAID', 'PENDING'=>'PENDING', 'SOLD'=>'SOLD'));
				else*/
					echo $form->dropDownList($model, 'land_status', array('PAID'=>'PAID', 'PENDING'=>'PENDING', 'SOLD'=>'SOLD'));
			?>
		</td>
	</tr>
</table>
<div class="row buttons">
	<?php echo CHtml::submitButton('Update'); ?>
</div>
<?php $this->endWidget(); ?>
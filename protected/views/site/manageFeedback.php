<div>
	<h2>Manage Feedback</h2>
<?php
	echo CHtml::submitButton('Submit New Feedback', array('submit'=>'/index.php/site/feedback'));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'manage-feedback',
		'dataProvider' => $model->search(),
		'columns' => array(
			'id',
			'submit_date',
			'subject',
			array(
				'name' => 'priority',
				'type' => 'html',
				'value' => 'CHtml::decode(Feedback::PriorityAllias($data->priority, $data->solved))',
			),
			array(
				'class' =>  'CButtonColumn',
				'template' => '{view}',
				'buttons'=> array(
					'view'=> array(
						'url'=>'Yii::app()->request->baseUrl . "/index.php/site/viewFeedback/id/" . $data->id',
					)
				)
			),
		),
	));
?>
</div>	
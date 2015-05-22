<h1>Mark Listing as Sold</h1>
<?php
 
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'mls-grid',
		'dataProvider'=>$mls->getPendingList(),
		//'filter'=>$model,
		'columns'=>array(
			'id',
			'name',
			'address',
			'city',
			'state',
			'zip_code',
			'list_status',
			array(
				'class'=>'CButtonColumn',
				'template' => "{update}",
				'buttons'=>array(
					'update'=>array(
						'url' => 'Yii::app()->request->baseUrl . "/index.php/listing/default/formSold/id/" . $data->id ."/type/MLS"',
						'label' => 'Make as Sold',
					),
				),
			),
		),
	));
?>
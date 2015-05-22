<h1>Update Listing Status</h1>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=> 'mls-status',
		'dataProvider' => $model->getPaidListing(),
		'filter'=>$model,
		'columns' => array(
			'id',
			'address',
			array(
				'name'=>'list_status',
				'type' => 'raw',
				'filter' => array("PAID"=>"PAID", "PENDING"=>"PENDING", "SOLD"=>"SOLD"),
				'value' => '$data->list_status',
			),
			array('class'=>'CButtonColumn'),
		)
	));
?>
<h1>Track Sales</h1>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=> 'mls-status',
		'dataProvider' => $model->search(),
	));
?>
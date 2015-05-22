<?php
$this->breadcrumbs=array(
	'Signs'=>array('index'),
	$model->idsigns,
);

$this->menu=array(
	array('label'=>'List Signs', 'url'=>array('index')),
	array('label'=>'Create Signs', 'url'=>array('create')),
	array('label'=>'Update Signs', 'url'=>array('update', 'id'=>$model->idsigns)),
	array('label'=>'Delete Signs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idsigns),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Signs', 'url'=>array('admin')),
);
?>

<h1>View Signs #<?php echo $model->idsigns; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idsigns',
		'iduser',
		'created_Date',
		'transaction_id',
		'status',
		'idlink',
		'address',
		'city',
		'state',
		'zipcode',
		'phone',
	),
)); ?>

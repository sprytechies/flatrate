<?php
$this->breadcrumbs=array(
	'Signs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Signs', 'url'=>array('index')),
	array('label'=>'Manage Signs', 'url'=>array('admin')),
);
?>

<h1>Create Signs</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
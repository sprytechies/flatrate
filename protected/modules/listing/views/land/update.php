<?php
$this->breadcrumbs=array(
	'Lands'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	//array('label'=>'List Mls', 'url'=>array('index')),
	array('label'=>'Create New Listing', 'url'=>array('create')),
	array('label'=>'View Listing', 'url'=>array('view', 'id'=>$model->id)),
);
?>
<h1>Edit Land <?php echo $model->id; ?></h1>
<?php $model->updator_id = app()->user->id; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
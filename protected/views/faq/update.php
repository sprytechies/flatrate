<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	$model->idfaq=>array('view','id'=>$model->idfaq),
	'Update',
);

$this->menu=array(
	array('label'=>'List Faq', 'url'=>array('index')),
	array('label'=>'Create Faq', 'url'=>array('create')),
	array('label'=>'View Faq', 'url'=>array('view', 'id'=>$model->idfaq)),
	array('label'=>'Manage Faq', 'url'=>array('admin')),
);
?>

<h1>Update Faq <?php echo $model->idfaq; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
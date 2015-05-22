<?php
$this->breadcrumbs=array(
	'Testimonials'=>array('index'),
	$model->idtestimonial=>array('view','id'=>$model->idtestimonial),
	'Update',
);

?>

<h1>Update Testimonials <?php echo $model->idtestimonial; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
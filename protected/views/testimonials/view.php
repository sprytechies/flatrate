<?php
$this->breadcrumbs=array(
	'Testimonials'=>array('index'),
	$model->idtestimonial,
);

?>

<h1>View Testimonials #<?php echo $model->idtestimonial; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idtestimonial',
		'cdate',
		'mdate',
		'testimonial',
		'client',
		'designation',
		'company',
	),
)); ?>

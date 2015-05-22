<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	$model->idfaq,
);

?>

<h1>View Faq #<?php echo $model->idfaq; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idfaq',
		'cdate',
		'mdate',
		'question',
		'answer',
	),
)); ?>

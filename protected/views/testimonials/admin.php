<?php
$this->breadcrumbs=array(
	'Testimonials'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('testimonials-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Testimonials</h1>

<?php 
echo CHtml::submitButton('Add new Testimonial', array('submit'=>'/index.php/testimonials/create'));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'testimonials-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array('value'=>'$data->idtestimonial', 'header'=>'ID','name'=>'idtestimonial'),
		'testimonial',
		'client',
		'designation',
		/*
		'company',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

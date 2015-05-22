<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>MANAGE FAQs</h1>

<?php 
echo CHtml::submitButton('Add new FAQ', array('submit'=>'/index.php/faq/create'));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'faq-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		array('value'=>'$data->idfaq', 'header'=>'ID','name'=>'idfaq'),
		'question',
		'answer',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

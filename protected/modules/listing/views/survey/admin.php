<?php
$this->breadcrumbs=array(
	'Surveys'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Create Survey', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('survey-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manage Surveys</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'survey-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array('header'=>'Survey ID', 'value'=>'$data->id'),
		array('header'=>'MLS ID', 'value'=>'$data->mls_id'),
		array('header'=>'Hear About Us', 'value'=>'$data->hear_about'),
		array('header'=>'On Scale of 1-10', 'value'=>'$data->how_easy'),
		array('header'=>'Refer Other', 'value'=>'$data->refer_other'),
		/*
		'suggestion',
		'how_long',
		'help_chat',
		'difficult_part',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{delete}'
		),
	),
)); ?>

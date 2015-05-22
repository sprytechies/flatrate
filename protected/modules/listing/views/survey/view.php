<?php
$this->breadcrumbs=array(
	'Surveys'=>array('index'),
	$model->id,
);

$this->menu=array(
/*	array('label'=>'List Survey', 'url'=>array('index')),*/
/*	array('label'=>'Create Survey', 'url'=>array('create')),*/
/*	array('label'=>'Update Survey', 'url'=>array('update', 'id'=>$model->id)),*/
/*	array('label'=>'Delete Survey', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),*/
);
?>
<h1>View Survey #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mls_id',
		'hear_about',
		'how_easy',
		'refer_other',
		'suggestion',
		'how_long',
		'help_chat',
		'difficult_part',
	),
)); ?>

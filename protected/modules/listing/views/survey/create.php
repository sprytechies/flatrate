<?php
$this->breadcrumbs=array(
	'Surveys'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
*/?>

<h1>Survey</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
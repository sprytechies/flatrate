<?php
$this->breadcrumbs=array(
	'Promos',
);

$this->menu=array(
	array('label'=>'Manage Plan', 'url'=>array('/planpromo/plan')),
	array('label'=>'Create Promo', 'url'=>array('create')),
	array('label'=>'Manage Promo', 'url'=>array('admin')),
);
?>

<h1>Promos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Plans',
);

$this->menu=array(
	array('label'=>'Manage Promo', 'url'=>array('/planpromo/promo')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>Plans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

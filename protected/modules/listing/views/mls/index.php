<?php
$this->breadcrumbs=array(
	'Listing',
);

$this->menu=array(
	array('label'=>'Create New Listing', 'url'=>array('create')),
	array('label'=>'Edit Listings', 'url'=>array('admin')),
);

?>

<!--<h1>Mls</h1>-->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

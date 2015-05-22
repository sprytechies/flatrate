<?php
$this->breadcrumbs=array(
	'Surveys',
);

?>
<h1>Surveys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
$this->breadcrumbs=array(
	'Testimonials'=>array('index'),
	'Create',
);

?>

<h1>Create Testimonials</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
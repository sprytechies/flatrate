<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	'Create',
);

?>

<h1>Create Faq</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
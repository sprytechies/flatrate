<style>
    hr.space {
        color: #000;
        background: #000;
    }
    .form{
        margin-left: 50px;
    }
</style>
<?php
$this->breadcrumbs=array(
	'jacksonsigns'=>array('index'),
);
?>
   <h1>Jackson's Signs </h1>
<hr />
<div class="control-panel">
<?php $status = array('1'=>'In Process', '2'=>'Delivery Sent', '3'=>'Delivered');
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'signs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'iduser',
		'created_date',
		'transaction_id',
		array('value'=>'($data->status > 1)?($data->status == 2)?"Delivery Sent":"Delivered":"In Process"', 'name'=>'status',),
		'address',
		'city',
		'state',
		'zipcode',
		'phone',
		array(
			'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',
		),
	),
)); ?>
</div>
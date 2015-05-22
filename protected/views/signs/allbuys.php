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
	'jacksonsigns'=>array('jacksonbuys'),
);
?>
   <h1>Jackson's Signs </h1>
<hr /><div class="control-panel">
<?php $status = array('1'=>'In Process', '2'=>'Delivery Sent', '3'=>'Delivered');

if(Yii::app()->user->isAdmin()){
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'signs-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'created_date','header'=>'Date'),
		'transaction_id',
		array('value'=>'($data->status > 1)?($data->status == 2)?"Delivery Sent":"Delivered":"In Process"', 'name'=>'status',),
		'saddress',
		'scity',
		'scountry',
		'szipcode',
                  'baddress',
		'bcity',
		'bcountry',
		'bzip',
		'phone',
		array(
			'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',
		),
	),
));
}else{
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'signs-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'created_date','header'=>'Date'),
		'transaction_id',
		array('value'=>'($data->status > 1)?($data->status == 2)?"Delivery Sent":"Delivered":"In Process"', 'name'=>'status',),
		'saddress',
		'scity',
		'scountry',
		'szipcode',
                  'baddress',
		'bcity',
		'bcountry',
		'bzip',
		'phone',
		
	),
));} ?>
</div>
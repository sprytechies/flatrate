<?php /*Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . "/js/jquery.jeditable.js", CClientScript::POS_HEAD);*/ ?>
<?php
	/*$script = "
		$('#mls-status table tbody tr td:eq(2)').editable('/index.php/listing/status/update/', {
			data : {
				'PAID':'PAID',
				'PENDING':'PENDING',
				'SOLD':'SOLD',
				'CLOSE':'CLOSE',
			},
			type : 'select',
			submit : 'Update',
			callback : function(value, settings){
				alert(value);
			}
		});
	";
	Yii::app()->getClientScript()->registerScript('edit', $script, CClientScript::POS_READY);*/
?>
<h1>Update Listing Status</h1>
<strong>Residential Listing</strong>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=> 'mls-status',
		'dataProvider' => $resident->getPaidListing(),
		'columns' => array(
			'id',
			'address',
			array(
				'name'=>'list_status',
				'type' => 'raw',
				'value' => '$data->list_status',
/*				'htmlOptions'=>array('id'=>'{$data->id}'),*/
			),
			array(
				'class'=>'CButtonColumn',
				'template'=> '{update}',
				'buttons'=>array(
					'update'=>array(
						'url'=>'Yii::app()->request->baseUrl . "/index.php/listing/status/updateMls/id/" . $data->id',
						'visible' => 'true',
						'label' => 'Update Status'
					),
				),
			),
		)
	));
?>
<strong>Vacand Land Listing</strong>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=> 'land-status',
		'dataProvider' => $vacant->getPaidListing(),
		'columns' => array(
			'id',
			'street_name',
			array(
				'name'=>'land_status',
				'type' => 'raw',
				'value' => '$data->land_status',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=> '{update}',
				'buttons'=>array(
					'update'=>array(
						'url'=>'Yii::app()->request->baseUrl . "/index.php/listing/status/updateLand/id/" . $data->id',
						'visible' => 'true',
						'label' => 'Update Status'
					),
				),
			),
		)
	));
?>
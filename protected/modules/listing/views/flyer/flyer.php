<?php
	$script = "
		$('#mls-flyer .button-column a, #land-flyer .button-column a').click(function(){
			w = window.open();
			$.ajax({
				url : $(this).attr('href'),
				type : 'POST',
				success: function(data){
					w.document.write(data);
				}
			});
			/*w.print();
			w.close();*/
			return false;
		});
	";
	Yii::app()->getClientScript()->registerScript('edit', $script, CClientScript::POS_READY);
?>
<h1>Get Your Flyer</h1>
<strong>Residential Listing</strong>
<?php
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=> 'mls-flyer',
		'dataProvider' => $mls->getPaidListing(),
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
				'template'=> '{print}',
				'buttons'=>array(
					'print'=>array(
						'url'=>'Yii::app()->request->baseUrl . "/index.php/listing/flyer/print/type/residential/id/" . $data->id',
						'visible' => 'true',
						'label' => 'Print Flyer',
						'imageUrl'=>'/themes/custom/css/images/icon_print.png',
					),
				),
			),
		)
	));
?>
<!--<strong>Vacand Land Listing</strong>-->
<?php
/*	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=> 'land-flyer',
		'dataProvider' => $land->getPaidListing(),
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
				'template'=> '{print}',
				'buttons'=>array(
					'print'=>array(
						'url'=>'Yii::app()->request->baseUrl . "/index.php/listing/flyer/print/type/vacant/id/" . $data->id',
						'visible' => 'true',
						'label' => 'Print Flyer',
						'imageUrl'=>'/themes/custom/css/images/icon_print.png',
					),
				),
			),
		)
	));*/
?>
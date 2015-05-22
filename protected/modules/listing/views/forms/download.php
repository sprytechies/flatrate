<?php
$this->menu=array(
	array('label'=>'Download Doc', 'url'=>array('/listing/forms/download')),
	array('label'=>'Upload Doc', 'url'=>array('/listing/forms/upload'), 'visible'=>Yii::app()->user->isAdmin()),
);
?>
<H1>Download Document</H1>
<?php if($model !== NULL): ?>
	<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'download-grid',
			'dataProvider'=>$model,
			//'filter'=>$model,
			'columns'=>array(
				array(
					'header'=>'Document Name',
					'value'=>'$data->realname',
				),
				array(
					'class'=>'CButtonColumn',
					'template'=>'{download}&nbsp;{delete}',
					'buttons'=>array(
						'download'=>array(
							'url'=> 'Yii::app()->params["uploadUrl"] . $data->filename',
							'visible' => 'true',
							'imageUrl' => Yii::app()->theme->baseUrl . "/css/images/icon_update.png",
							'label' => 'Download File'
						),
						'delete'=>array(
							'visible'=>'Yii::app()->user->isAdmin()',
						),
					),
				),
			)
		));
	?>
<?php else: ?>
	<h3><i>No documents available to download</i></h3>
<?php endif; ?>
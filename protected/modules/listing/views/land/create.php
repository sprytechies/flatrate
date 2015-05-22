<?php
$this->breadcrumbs=array(
	'Lands'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'Edit Vacant Lands', 'url'=>array('admin')),
	array('label'=>'Download Doc', 'url'=>array('/listing/forms/download')),
	array('label'=>'Manage Survey', 'url'=>array('/listing/survey/admin'), 'visible'=>Yii::app()->user->isAdmin()),
);*/
?>

<?php
/*$script = "
	$('#selectForm').change(function(){
		if($('#selectForm').val() == '1'){
			window.location = '". Yii::app()->createUrl('listing/mls/create') ."';
		}
	})
";
Yii::app()->getClientScript()->registerScript('form', $script, CClientScript::POS_READY);*/
?>
<!--<select id="selectForm">
	<option value="1">CREATE NEW LISTING</option>
	<option value="2" selected="selected">CREATE VACANT LAND</option>
</select>-->
<!--<label><input  type="radio" id="selectForm" name="selectForm" value="1" onchange="window.location = '/index.php/listing/mls/create';"/> CREATE NEW RESIDENTIAL LISTING</label>
<label><input  type="radio" id="selectForm" name="selectForm" value="2" checked="checked"/> CREATE NEW VACANT LAND LISTING</label>-->

<hr class="space"/>
<h1>CREATE NEW VACANT LAND LISTING</h1>

<?php
	$ic = Yii::app()->session->get('ic');
	if(!empty($ic)){
		$model2 = IncompleteLand::model()->findByPk($ic);
		$data = json_decode($model2->data);
		
		foreach($data as $k => $v){
			$model->$k = $data->$k;
		}
		
		Yii::app()->session->add('ic',0);
	}
?>
<?php
	if($model->isNewRecord){
		$model->creator_id = Yii::app()->user->id;
		$model->updator_id = Yii::app()->user->id;
	}
?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'incompleteID'=>$ic)); ?>
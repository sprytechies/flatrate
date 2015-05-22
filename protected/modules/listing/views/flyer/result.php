<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$model->advSearch(),
		'itemView'=>'_view',
	));
?>
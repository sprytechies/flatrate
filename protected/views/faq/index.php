<h1 style="float: left;">Frequently Asked Questions</h1>
<span style="float: left;margin-left:58px;"><?php echo CHtml::button('Begin Listing', array('submit' => array('listing/mls/create'))); ?></span><hr>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'summaryText'=> '',
)); ?>


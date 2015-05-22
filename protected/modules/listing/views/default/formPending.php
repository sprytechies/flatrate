<div class="windmill" style="margin-top: 10px;">
<div class="wcontent">
<div class="form">
<h1>Pending Form</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pending-formPending-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'listing_id', array('value'=>$_GET['id'])); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'listing_type', array('value'=>$_GET['type'])); ?>
	</div>
        <div style="clear: both"><div>
        <div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'contract_status'); ?>
		<?php echo $form->dropDownList($model,'contract_status', Pending::getContractStatus()); ?>
		<?php echo $form->error($model,'contract_status'); ?>
	</div>
          </div>
        <div style="clear: both"><div>
            
	<div class="row" >
		<?php echo $form->labelEx($model,'expected_close_date'); ?>
		<?php        
                 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                     'model'=>$model,
                     'attribute'=>'expected_close_date',
                     // additional javascript options for the date picker plugin
                     'options'=>array(
                         'showAnim'=>'fold',
						 'dateFormat' => 'yy-mm-dd'
                     ),
                     'htmlOptions'=>array(
                         'style'=>'height:20px; width:80px;'
                     ),
                 ));
                 ?>  
		<?php echo $form->error($model,'expected_close_date'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'selling_agent_id'); ?>
		<?php echo $form->textField($model,'selling_agent_id'); ?>
		<?php echo $form->error($model,'selling_agent_id'); ?>
	</div>
      
	 <div style="clear: both"><div>
        <div>
	<div class="row" style="float:left;">
		<?php echo $form->labelEx($model,'sold_date'); ?>
		<?php        
                 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                     'model'=>$model,
                     'attribute'=>'sold_date',
                     // additional javascript options for the date picker plugin
                     'options'=>array(
                         'showAnim'=>'fold',
						 'dateFormat' => 'yy-mm-dd'
                     ),
                     'htmlOptions'=>array(
                         'style'=>'height:20px; width:80px;'
                     ),
                 ));
                 ?>  
		<?php echo $form->error($model,'sold_date'); ?>
	</div>

	<div class="row"  style="float:left;margin-left: 200px;">
		<?php echo $form->labelEx($model,'sold_price'); ?>
		<?php echo $form->textField($model,'sold_price'); ?>
		<?php echo $form->error($model,'sold_price'); ?>
	</div>
        <div style="clear: both"><div>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'sold_terms'); ?>
		<?php echo $form->dropDownList($model,'sold_terms', Sold::getSoldTerms()); ?>
		<?php echo $form->error($model,'sold_terms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seller_paid_buyer_costs'); ?>
		<?php echo $form->textField($model,'seller_paid_buyer_costs'); ?>
		<?php echo $form->error($model,'seller_paid_buyer_costs'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
        <div style="clear:both"></div>
</div><!-- form -->
</div>
</div>
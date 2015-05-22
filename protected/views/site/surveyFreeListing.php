<style type="text/css">
    .news{
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px; 
		padding: 20px;
		border: solid 1px #DCDCDC;
		margin: 20px 0;
		-webkit-box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5);
		-moz-box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5);
		box-shadow: inset 0px 0px 8px 2px rgba(200, 200, 200, 0.5); 
	}
        .ctable td{
            text-align: center;
            padding-top: 30px;
        }    
       
</style>
<h1>Quick Survey</h1>
<div class="news">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'freeListing-form',
    //'enableAjaxValidation'=>true,
)); ?>
    <p><b>How many homes do you plan to sell this year?</b></p>
        <div class="row">
            <input type="radio" name="User[free_listing]" value="0" id="two" >
            <label for="two" style="pointer:cursor;">1 or 2 Homes</label>
            <input type="radio" name="User[free_listing]" value="2" id="three" >
            <label for="three" style="pointer:cursor;">3 or more Homes</label>
        </div>
    <br>
        <div class="row">
            <?php echo CHtml::submitButton('Sumbit')?>
        </div>
        
<?php $this->endWidget(); ?>
</div>

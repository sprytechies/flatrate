<?php
$this->breadcrumbs=array(
	'Flyers'=>array('index'),
	'printFlyer',
);

/*$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
*/?>

<h1>Flyer</h1>

<p><b><i>Do you want to print a free flyer for this listing?</i></b></p>
<p><?php echo CHtml::submitButton('CLICK TO PRINT A FREE FLYER', array( 'onclick'=>'window.open("'.Yii::app()->request->baseUrl.'/index.php/listing/flyer/print/type/residential/id/'.$mls->id.'", "_blank")')); ?></p>
<p><b>Or</b></p>
<?php 

if($status!="sold" && $free){
    echo CHtml::submitButton('FINISH', array('submit'=> Yii::app()->createUrl('listing/flyer/freeListing',array('mls_id'=>$mls->id))));
}
else{ ?>
   <p><form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_live_ixMRCij4iwpDUZM9ebTgRYbg"
    data-image="http://localhost/flatrate/themes/custom/css/images/logo.png"
    data-name="Flatratelist.com"
    data-description="Flatratelist.com Listing Service"
    data-amount="14200">
  </script>
  <input name="userid" type="hidden" value="<?php echo Yii::app()->user->id; ?>"/>
  <input name="mls_id" type="hidden" value="<?php echo $mls->id ;?>"/>
  <input name="paymentdone" type="hidden" value="1"/>
</form></p>
<?php }
?>

<script>
$(document).ready(function(){
  $('.stripe-button-el span').empty().append('Proceed to Check Out').css('min-height', '10px');
  })     
</script>
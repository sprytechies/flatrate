<style>
    hr.space {
        color: #000;
        background: #000;
    }
</style>
<?php
$this->breadcrumbs=array(
	'jacksonsigns'=>array('jacksonsigns'),
);
?>
<h1>Yard Sign Order <span style="float:right;margin-right: 60px;font-size: 20px;"><?php echo CHtml::link('Bought Signs', array('signs/jacksonbuys')) ?></span></h1>
<hr />
<div class="control-panel">
    <div>
        <h4>Add this professional looking sign to your arsenal of marketing tools. You made a wise choice to list on the MLS because you know exposure is what gets your house SOLD. </h4>

    They say referrals are the best business. Why? Because referrals are people who already want to conduct business with you. This is what a professional sign does for you. It lets the neighbors know you are selling and those neighbors likely have friends they would like to live close to them and will refer to them to you. Make another wise choice and purchase this professional looking sign.

    </div>
    <br/>
	 <div style="text-align: center;">
        <?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="success-info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="error-info">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
    <div style="text-align: center;">
    <img src="<?php echo Yii::app()->theme->baseUrl ?>/css/images/forsale.jpg" alt=""  width="400" />
    <br />
    <span><i>$25(Sign Cost) + $10(Shipping and Handling Cost)</i></span>
    <br /><br />
       <form action="<?php echo Yii::app()->createUrl('signs/buySign', array('id'=>$model->id)) ?>" method="POST">
                  <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                   data-key="pk_live_ixMRCij4iwpDUZM9ebTgRYbg"
                    data-image="http://localhost/flatrate/themes/custom/css/images/logo.png"
                    data-name="Flatratelist.com"
                    data-description="Jackson Signs"
                    data-billing-address="true"
                    data-shipping-address='true'
                    data-amount="3500">
                  </script>
                  <input name="userid" type="hidden" value="<?php echo Yii::app()->user->id; ?>"/>
                  <input name="jackson" type="hidden" value="1"/>
                </form>

<!--        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="BDWUPEAH8724E">
        <input type="image" src="https://www.sandbox.paypal.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
        <img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
        </form>-->
    </div>
</div>

<script>
$(document).ready(function(){
  $('.stripe-button-el span').empty().append('Proceed to Check Out').css('min-height', '10px');
  })     
</script>
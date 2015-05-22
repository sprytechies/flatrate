<style>
    .news {
        border: 1px solid #DCDCDC;
        border-radius: 5px;
        box-shadow: 0 0 8px 2px rgba(200, 200, 200, 0.5) inset;
        margin: 20px 0;
        padding: 20px;
    }
    .fb-like span:nth-child(1) {
        top: 0;
    }
    
</style>
<?php
$this->breadcrumbs=array(
	'Listing'=>array('admin'),
	'Thank You',
);
?>
<hr class="space">
<div class="control-panel">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="success-info">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <div class="news">
    
        <h1>Start by telling friends and family about your listing.<br><br> Press <div class="fb-like" data-href="https://www.facebook.com/pages/Flatratelistcom/482790508521898?ref=hl" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
     to like us on facebook 
    </h1>
        <a href="<?php echo Yii::app()->createUrl(Yii::app()->user->getState('url'),array('id'=>$_GET['id']));?>">click here to continue..</a>
    
    </div>
</div>

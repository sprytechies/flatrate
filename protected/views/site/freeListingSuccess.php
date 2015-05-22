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
<h1></h1>
<div id="success">
<?php if(Yii::app()->user->hasFlash('successMsg')){
        echo "<h2>".Yii::app()->user->getFlash('successMsg')."<h2>";
?>
<div class="news">
    <div class="row">
            <input type="button" name="yes" value="Yes" id="yes" >
            <input type="button" name="no" value="No" id="no" >
    </div>
</div>
<?php 
}
?>
</div>
<script>
$('input').click(function(){
    if($(this).attr('id')=="yes"){
        window.location = "<?php echo Yii::app()->createUrl('listing/mls/create')?>";
    }
    else if($(this).attr('id')=="no"){
        $('h1').html("Be sure to tell other investors how they can get a FREE listing");
        $('#success').hide();
    }
    
});
</script>

<script type="text/javascript">
	WebFontConfig = {
	 google: { families: [ 'Simonetta', 'Lustria', 'Galdeano' ] }
	};
	(function() {
	 var wf = document.createElement('script');
	 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
	     '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	 wf.type = 'text/javascript';
	 wf.async = 'true';
	 var s = document.getElementsByTagName('script')[0];
	 s.parentNode.insertBefore(wf, s);
	})();
</script>
<?php
$photo_1 = !empty($model->photo_1) ? app()->params['uploadUrl'] . $model->photo_1 : app()->theme->baseUrl . '/css/images/photo_not_available.png';
$address =  "{$model->address}, {$model->city}, {$model->state}, {$model->zip_code}";
//$photo_1_holder = '';
//if(!empty($model->photo_1))
	$photo_1_holder = CHtml::image($photo_1,'photo',array('id'=>'view-photo-holder', 'width'=>'320px')); 
//else 
//	$photo_1_holder = CHtml::image(app()->theme->baseUrl . '/css/images/photo_not_available.png','photo',array('alt'=>'No Photo Available','id'=>'view-photo-holder')); 
?>
<style type="text/css">
	#flyer{
		width: 800px;
		height: 480px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px; 
		margin: auto;		
		-webkit-box-shadow: 6px 0 4px  -4px #222 , -6px 0 4px  -4px #222;
		-moz-box-shadow: 6px 0 4px  -4px #222 , -6px 0 4px  -4px #222; 
		box-shadow: 6px 0 4px  -4px #222 , -6px 0 4px  -4px #222;
		font-family: 'Simonetta';
		padding: 10px;
	}
	#header{
		background: #e3e3e3;
		color: #fff;
	}
	#img-holder{
		width: 40%;
		float: left;
		padding: 5px;
		-webkit-border-radius: 3px;
		-moz-border-radius:3px;
		border-radius: 3px; 
		background: rgba(220, 220, 220, 0.75);
		margin-right: 20px;
		margin-bottom: 20px;
	}
	#list-info{
		float: left;
		width: 30%;
		font-family: "Lustria";
	}
	#list-info h3{
		color: blue;
	}
	#list-info h3 span{
		color: #000;
		font-weight: normal;
	}
	#list-price{
		float: left;
		-moz-transform:rotate(-20deg);
		-webkit-transform:rotate(-20deg);
		-o-transform:rotate(-20deg);
		-ms-transform:rotate(-20deg);
		background: url('/themes/custom/css/images/badge_bg.png') no-repeat center center;
		width: 150px;
		color: #fff;
	}
	#map div h3{
		font-family: 'Galdeano';
	}
</style>
<div id="flyer">
	<div id="header"><h1 align="center"><?php echo $address; ?></h1></div>
	<div id="img-holder"><?php echo $photo_1_holder; ?></div>
	<div id="list-info">
		<h3>Square Feet : <span><?php echo $model->sq_ft_heated; ?></span></h3>
		<h3>Bedrooms : <span><?php echo $model->bedrooms; ?></span></h3>
		<h3>Bathrooms : <span><?php echo $model->full_baths . "/" . $model->half_baths; ?></span></h3>
		<h3>Lot Size : <span><?php echo $model->lot_size_sq_ft == "" ? "-" : $model->lot_size_sq_ft; ?></span></h3>
	</div>
	<div id="list-price"><h2 style="text-align: center;">Only<br/>$ <?php echo number_format($model->list_price,2); ?></h2></div>
	<hr style="clear: both"/>
	<div id="map">
		<div style="float: left; vertical-align: top">
			<h3>
				Dan Feuser <br/>
				E-mail : <a href="mailto: dan@flatratelist.com">dan@flatratelist.com</a><br/>
				3631 South Access Rd<br/>
				Englewood, FL, 34224
			</h3>
		</div>
		<div style="float: right; width: 200px;" align="center">
			<img src="/themes/custom/css/images/logo.png"/>
			<h3>The Focus Firm, Inc</h3>
		</div>
	</div>
</div>
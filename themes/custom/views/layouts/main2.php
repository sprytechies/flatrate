<?php 
Yii::app()->session->add('ic',0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<?php app()->clientScript->registerCoreScript('jquery'); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-28806661-1']);
	  _gaq.push(['_trackPageview']);
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=389268774420695";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<!--<script type="text/javascript">
		$(document).ready(function(){
			$('div.wcontent').css('opacity', '.65');
		});
	</script>-->
</head>

<body>
    <div id="header">
        <div id="logo" class="span-3"><a href="<?php echo Yii::app()->homeUrl; ?>"><img style="margin-top: 15px;" src="<?php echo Yii::app()->theme->baseUrl.'/css/images/logo.png'; ?>"/></a></div>
        <?php if(!Yii::app()->user->isGuest) { ?>
        <div id="mainmenu" class="span-17">
        <?php } else { ?>
        <div id="mainmenu" class="span-21 last">
        <?php } ?>
        <?php
		//if((Yii::app()->request->url == '/' || Yii::app()->request->url == Yii::app()->request->baseUrl . '/index.php/site/index') && app()->user->isGuest)
		if((Yii::app()->request->url !== '/' && Yii::app()->request->url !== Yii::app()->request->baseUrl . '/index.php/site/index' && Yii::app()->request->url !== Yii::app()->request->baseUrl . '/index.php') && Yii::app()->user->isGuest)
		{
			$this->widget('zii.widgets.CMenu', 
				array(
					'encodeLabel'=>false, 
					'items' => array(
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>Rights', 'url' => array('/rights'), 'visible' => app()->user->isAdmin()),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_users.png" alt="" /><br/>'.app()->getModule('user')->t("Users"), 'url' => array('/user/admin'), 'visible' => app()->user->isAdmin()),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_profile.png" alt="" /><br/>'.app()->getModule('user')->t("Profile"), 'url' => app()->getModule('user')->profileUrl, 'visible' => (!app()->user->isGuest)),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/blog_icon.png" alt="" /><br/>Blog', 'url' => array('/post')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_contact_us.png" alt="" /><br/>Contact Us', 'url' => array('/site/contact')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/testi.png" alt="" style="margin-bottom: 3px;"/><br/>Testimonials', 'url' => array('/testimonials')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>FAQ', 'url' => array('/faq')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_profile.png" alt="" /><br/>About Us', 'url' => array('/site/about')),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>FAQs', 'url' => array('/site/faq'), 'visible' => !app()->user->isAdmin()),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_home.png" alt="" /><br/>Home', 'url' => array('/site/index')),
					),
			   ));
		} elseif((Yii::app()->request->url == '/' || Yii::app()->request->url == Yii::app()->request->baseUrl . '/index.php/site/index' || Yii::app()->request->url == Yii::app()->request->baseUrl . '/index.php') && app()->user->isGuest) {
			$this->widget('zii.widgets.CMenu', 
				array(
					'encodeLabel'=>false, 
					'items' => array(
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>Rights', 'url' => array('/rights'), 'visible' => app()->user->isAdmin()),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_users.png" alt="" /><br/>'.app()->getModule('user')->t("Users"), 'url' => array('/user/admin'), 'visible' => app()->user->isAdmin()),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_profile.png" alt="" /><br/>'.app()->getModule('user')->t("Profile"), 'url' => app()->getModule('user')->profileUrl, 'visible' => (!app()->user->isGuest)),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/blog_icon.png" alt="" /><br/>Blog', 'url' => array('/post')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_contact_us.png" alt="" /><br/>Contact Us', 'url' => array('/site/contact')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/testi.png" alt="" style="margin-bottom: 3px;"/><br/>Testimonials', 'url' => array('/testimonials')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>FAQ', 'url' => array('/faq')),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_profile.png" alt="" /><br/>About Us', 'url' => array('/site/about')),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>FAQs', 'url' => array('/site/faq'), 'visible' => !app()->user->isAdmin()),
					),
			   ));
			
		} else {
			$this->widget('zii.widgets.CMenu', 
				array(
					'encodeLabel'=>false, 
					'items' => array(
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_logout.png" alt="" /><br/>'.app()->getModule('user')->t("Logout"), 'url' => app()->getModule('user')->logoutUrl, 'visible' => !app()->user->isGuest),
/*						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_login.png" alt="" /><br/>'.app()->getModule('user')->t("Login"), 'url' => app()->getModule('user')->loginUrl, 'visible' => app()->user->isGuest),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_register.png" alt="" /><br/>'.app()->getModule('user')->t("Register"), 'url' => app()->getModule('user')->registrationUrl, 'visible' => app()->user->isGuest),*/
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/blog_icon.png" alt="" /><br/>Blog', 'url' => array('/post')),
					    array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>FAQ', 'url' => array('/faq'), 'visible' => !app()->user->isAdmin()),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>Rights', 'url' => array('/rights'), 'visible' => app()->user->isAdmin()),
						//array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_faq.png" alt="" /><br/>FAQs', 'url' => array('/site/faq'), 'visible' => !app()->user->isAdmin()),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_users.png" alt="" /><br/>'.app()->getModule('user')->t("Users"), 'url' => array('/user/admin'), 'visible' => app()->user->isAdmin()),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_profile.png" alt="" /><br/>About Us', 'url' => array('/site/about'), 'visible' => !app()->user->isAdmin() && !Yii::app()->user->getUserRole("Silver") && !Yii::app()->user->getUserRole("Gold")),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_contact_us.png" alt="" /><br/>Contact Us', 'url' => array('/site/contact'), 'visible' => !app()->user->isAdmin()),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_list_home.png" alt="" /><br/>List Home', 'url'=>array('/listing/mls/create'), 'visible'=>Yii::app()->user->getUserRole("Listing") || app()->user->isAdmin()),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_list_home.png" alt="" /><br/>Search', 'url'=>array('/listing/flyer'), 'visible'=>app()->user->isAdmin() || Yii::app()->user->getUserRole("Silver") || Yii::app()->user->getUserRole("Gold") ),
						array('label' => '<img src="'.Yii::app()->theme->baseUrl.'/css/images/btn_home.png" alt="" /><br/>Control Panel', 'url' => array('/site/controlpanel')),
					),
			   ));
		}
		
        ?>
        </div>
        <!-- mainmenu -->

        <?php if(!Yii::app()->user->isGuest) { ?>
        <div id="chat" class="span-4 last">
        
<!-- BEGIN ProvideSupport.com Graphics Chat Button Code -->
<div id="ciLfAM" style="z-index:100;position:absolute"></div><div id="scLfAM" style="display:inline"></div><div id="sdLfAM" style="display:none"></div><script type="text/javascript">var seLfAM=document.createElement("script");seLfAM.type="text/javascript";var seLfAMs=(location.protocol.indexOf("https")==0?"https":"http")+"://image.providesupport.com/js/flatratelist/safe-standard.js?ps_h=LfAM&ps_t="+new Date().getTime();setTimeout("seLfAM.src=seLfAMs;document.getElementById('sdLfAM').appendChild(seLfAM)",1)</script><noscript><div style="display:inline"><a href="http://www.providesupport.com?messenger=flatratelist">Live Help Desk</a></div></noscript>
<!-- END ProvideSupport.com Graphics Chat Button Code -->
        </div>
        <?php } ?>


    </div><!-- header -->
    <div class="container" id="page" style="min-height:350px;">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs)); ?><!-- breadcrumbs -->
	<?php if(!Yii::app()->user->isGuest): ?>
	<div id="mainMbmenu" style="float: right; margin-right: 10px;">
	<?php
	$this->widget('application.extensions.mbmenu.MbMenu', 
		array(
			'encodeLabel'=>false, 
			'items' => array(
				array('label' => 'Control Panel', 'url' => "#", 'visble' => !Yii::app()->user->isGuest, 'items'=>array(
					array('label' => 'Create a residential listing', 'url' => array("/listing/mls/create"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Make a change to your residential listing', 'url' => array("/listing/mls/admin"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Mark your residential listing as pending', 'url' => array("/listing/mls/managePending"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					
					array('label' => 'Create a vacant lot listing', 'url' => array("/listing/land/create"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Make a change to your vacant lot listing', 'url' => array("/listing/land/admin"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Download forms', 'url' => array("/listing/forms/download"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Report an issue with the website or your listing', 'url' => array("/site/contact")),
					array('label' => 'Print a flyer', 'url' =>array('/listing/flyer/flyer'), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
				
					array('label' => 'I have a question about my listing', 'url' => array("/site/broker"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'FAQs', 'url' => array("/faq/index")),
					array('label' => 'Testimonials', 'url' => array("/testimonials/index")),
                                        array('label' => 'Need the help of a full service Realtor?', 'url' => array("/site/broker")),
					array('label' => 'List All Feedback', 'url' => array("/site/manageFeedback")),
                                        array('label' => "Professional Looking Yard Sign", 'url' => array("/site/jacksonsigns")),
					array('label' => 'Mikogo', 'url' => 'http://go.mikogo.com'),
					
	/*				array('label' => 'Manage residential listing', 'url' => array("/listing/mls/admin"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Create a residential listing', 'url' => array("/listing/mls/create"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Make a change to your residential listing', 'url' => "#", 'visible'=>Yii::app()->user->getUserPlan() == "LISTING" || Yii::app()->user->isAdmin()),
					array('label' => 'Manage vacant lot listing', 'url' => array("/listing/land/admin"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Create a vacant lot listing', 'url' => array("/listing/land/create"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Make a change to your vacant lot listing', 'url' => "#", 'visible'=>Yii::app()->user->getUserPlan() == "LISTING" || Yii::app()->user->isAdmin()),
					array('label' => 'Mark your residential listing as pending / sold', 'url' => array("/listing/mls/admin"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Mark your vacant lot listing as pending / sold', 'url' => array("/listing/land/admin"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'Search Home', 'url'=>array("/listing/flyer"), 'visible'=>Yii::app()->user->getUserRole("Gold") || Yii::app()->user->getUserRole("Silver") || Yii::app()->user->isAdmin()),
					array('label' => 'Download forms', 'url' => array("/listing/forms/download")),
					array('label' => 'Report an issue', 'url' => array("/site/contact")),
					array('label' => 'Print flyer', 'url' =>array('/listing/flyer/flyer'), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),
					array('label' => 'I have a question about my listing', 'url' => array("/site/broker"), 'visible'=>Yii::app()->user->getUserRole("Listing") || Yii::app()->user->isAdmin()),*/
					)),
				array('label'=> 'Admin Panel', 'url' => "#", 'visible'=> Yii::app()->user->isAdmin(), 'items'=>array(
					array('label' => 'Upload forms', 'url' => array("/listing/forms/upload")),
					array('label' => 'Update listing status', 'url'=> array('/listing/status/admin')),
					array('label' => 'Track Sales', 'url'=>array('/listing/status/sales')),
					array('label' => 'Plan & Promo', 'url'=>array('/planpromo/plan')),
					array('label' => 'Manage Survey', 'url'=>array('/listing/survey/admin')),
					array('label' => 'Manage FAQs', 'url'=>array('/faq/admin')),
					array('label' => 'Manage Testimonials', 'url'=>array('/testimonials/admin')),
					)),				
			),
	   ));
	 ?>
	</div>
	<?php endif; ?>
        <?php echo $content; ?>
        <div id="footer">
		<div style="float: left;" class="fb-like" data-href="http://www.facebook.com/pages/Flatratelist/371490606195651" data-send="false" data-width="450" data-show-faces="false" data-action="recommend" data-font="arial"></div>
		<div style="clear: both;">
	            Copyright &copy; <?php echo date('Y'); ?> by The Focus Firm Inc.<br/>
       	     All Rights Reserved.<br/>
		</div>
            <?php //echo Yii::powered(); ?>
        </div>
        <!-- footer -->    

    </div>
    
<?php //echo Yii::app()->request->url; ?>

</body>
</html>
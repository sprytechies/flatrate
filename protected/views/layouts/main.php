<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<?php app()->clientScript->registerCoreScript('jquery'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
	
        <div id="logo"><?php echo CHtml::encode(app()->name); ?></div>
    </div>
    <!-- header -->

    <div id="mainmenu">
        <?php
           /* $langList = $this->widget('DropDownRedirect', array(
                                               'data' => app()->user->availableLanguages, // data od my dropdownlist
                                               'url' => $this->createUrl('/' . $this->route, array_merge($_GET, array('lang' => '__value__'))), // the url (__value__ will be replaced by the selected value)
                                               'select' => app()->user->language, //the preselected value
                                          ))->run();*/
            $this->widget('zii.widgets.CMenu', array(
                                                      'items' => array(
                                                          array('label' => 'Home', 'url' => array('/site/index')),
                                                          array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                                          array('label' => 'Contact', 'url' => array('/site/contact')),
                                                          array('label' => app()->getModule('user')->t("Login"), 'url' => app()->getModule('user')->loginUrl, 'visible' => app()->user->isGuest),
                                                          array('label' => app()->getModule('user')->t("Register"), 'url' => app()->getModule('user')->registrationUrl, 'visible' => app()->user->isGuest),
                                                          array('label' => app()->getModule('user')->t("Profile"), 'url' => app()->getModule('user')->profileUrl, 'visible' => (!app()->user->isGuest && !app()->user->isAdmin())),
                                                          array('label' => app()->getModule('user')->t("Users"), 'url' => array('/user/admin'), 'visible' => app()->user->isAdmin()),
                                                          array('label' => 'Rights', 'url' => array('/rights'), 'visible' => app()->user->isAdmin()),
                                                          array('label' => app()->getModule('user')->t("Logout") . ' (' . app()->user->name . ')', 'url' => app()->getModule('user')->logoutUrl, 'visible' => !app()->user->isGuest),
                                                          //array('label' => '', 'template' => $langList),
                                                      ),
                                                 ));


        ?>

    </div>
    <!-- mainmenu -->

    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                                         'links' => $this->breadcrumbs,
                                                    )); ?><!-- breadcrumbs -->

    <?php echo $content; ?>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by The Focus Firm Inc.<br/>
        All Rights Reserved.<br/>
        <?php //echo Yii::powered(); ?>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
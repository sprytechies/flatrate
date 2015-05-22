<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'FLAT RATE LIST',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.modules.listing.models.*',
	'application.modules.planpromo.models.*'
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
			'ipFilters'=>array('125.162.30.218','::1', '180.251.*.*', '125.162.*.*'),
        ),
        'user' => array(
            'tableUsers' => 'users',
            'tableProfiles' => 'profiles',
            'tableProfileFields' => 'profiles_fields',
			'returnUrl' => array('/site/surveyFreeListing'),
        ),
        'rights' => array(
            'install' => false, // Enables the installer.
        ),
        'blog',
	 'listing'=>array(),
	 'land',
	'planpromo',
    ),

    // application components
    'components' => array(
	     'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
            //'availableLanguages' => array('en' => t('EN', 'english'), 'fr' => t('FR', 'french'), 'it' => t('IT', 'italy'))
            /*'availableLanguages' => array('en' => 'EN')*/
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager', // Provides support authorization item sorting.
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
           'urlFormat'=>'path',
   			 'showScriptName'=>false,
   			  'caseSensitive'=>false,        
            'rules' => array(
			  '<controller:\w+>/<id:\d+>' => '<controller>/view',
			  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			  'post/<id:\d+>/<title:.*?>'=>'post/view',
			  'posts/<tag:.*?>'=>'post/index',
			  '~<view:\w+'=>'site/page'
            ),
/*	    'showScriptName'=>false,
   	    'caseSensitive'=>false, */
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=flatrate_flat',
            'emulatePrepare' => true,
            'username' => 'flatrate_flat',
            'password' => '9Q~+RC,#[$VL',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => '/site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    //
                    // I include *trace* for the
                    // sake of the example, you can include
                    // more levels separated by commas
                    'levels' => 'trace',
                    //
                    // I include *vardump* but you
                    // can include more separated by commas
                    'categories' => 'vardump',
                    //
                    // This is self-explanatory right?
                    'showInFireBug' => true
                ),
                // uncomment the following to show log messages on web pages
                /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                    */
            ),
        ),
    ),

	'theme'=>'custom',
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'dan@flatratelist.com',
	'askBrokerEmail' => 'dan@flatratelist.com',
	'contactUsEmail' => 'dan@flatratelist.com',
	'mlsApprovedEmail' => 'dan@flatratelist.com',
	'mlsUpdateReqEmail' => 'dan@flatratelist.com',
	'registrationEmail' => 'dan@flatratelist.com',
		'uploadUrl'=> 'http://flatratelist.com/upload/',
		'ipnLogPath'=> '/home/flatrate/ipn_log/',
		'imgUploader' => array(
			'folder'=> '/home4/flatrate/public_html/upload/',
			'allowedExtensions'=> array("jpg","jpeg","gif","png","doc", "docx", "pdf"),
			'sizeLimit' => 10 * 1024 * 1024,
		),
		'docUploader' => array(
			'folder' => '/home/flatrate/public_html/upload/',
			'allowedExtensions' => array("doc", "docx", "pdf"),
			'sizeLimit' => 10 * 1024 * 1024,
		),
	'CCAuthType' => 'BASIC',
	'CCAPIKey' => '08062577-a0b1-44a8-82f2-5baa566e5653',
	'CCAPISecret' => '2d86c3069572411db6c3a1787ae294a6',
	'CCUsername' => 'flatratelist',
	'CCPassword' => 'rudiyanto',
	'CCGeneralListID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/1',
	'CCPendingID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/2',
	'CCSoldID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/3',
	'CCRegisterNotActiveID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/4',
	'CCActiveID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/5',
	'CCNotifyChangeID' =>'http://api.constantcontact.com/ws/customers/flatratelist/lists/8',
	'CCTempID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/9',
	'CCTempSoldID' => 'http://api.constantcontact.com/ws/customers/flatratelist/lists/10',
	
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	
/*	'CCAuthType' => 'BASIC',
	'CCAPIKey' => 'fbe16814-415f-4998-8a3f-93a2bb2b000e',
	'CCAPISecret' => 'b1c6db3f41d543c0affa6680fd07d282',
	'CCUsername' => 'flatbeta',
	'CCPassword' => 'Beta123',
	'CCGeneralListID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/1',
	'CCPendingID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/4',
	'CCSoldID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/5',
	'CCRegisterNotActiveID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/2',
	'CCActiveID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/3',
	'CCNotifyChangeID' =>'http://api.constantcontact.com/ws/customers/flatbeta/lists/6',
	'CCTempID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/38',
	'CCTempSoldID' => 'http://api.constantcontact.com/ws/customers/flatbeta/lists/39',*/
    ),
);
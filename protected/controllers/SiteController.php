<?php

class SiteController extends Controller
{
	public $layout='//layouts/column1b';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
		//}
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->layout='column1a';
		$this->pageTitle='Free Real Estate listing, Flat Rate MLS, Florida MLS, Discount';
                Yii::app()->clientScript->registerMetaTag('Flat rate MLS offer free real estate listing, Florida MLS, Flat Fee MLS and Listing on MLS. List my home at discount listing services', 'description');
		Yii::app()->clientScript->registerMetaTag('Free Real Estate listing, Flat Rate MLS, Florida MLS, Flat Fee MLS, List my Home, MLS Listing, Listing on MLS, Multiple Listing Service, For Sale by Owner, Discount Real Estate, Flat Rate MLS', 'keywords');
		$this->render('index',array('model'=>$model));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                                ob_start();
				$headers="From: {$model->email}\r\nReply-To: {$model->email}\r\nContent-type: text/html; charset=iso-8859-1\r\n";
				mail(Yii::app()->params['contactUsEmail'],$model->subject,"From: {$model->name}<br/><br/>Message:<br/>" . $model->body,$headers);
				
				$headers="From: " . Yii::app()->params['contactUsEmail'] . "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
				$message = "<p>You has send an email to us at http://flatratelist.com.<br/> Thank you for contacting us.<br/> We will respond to you as soon as possible.</p>";
                                if(mail($model->email, "Confirmation Feedback", $message, $headers)){
                                    Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				}
                                else{
                                    echo "not send";
                                }
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the broker page
	 */
	public function actionBroker()
	{
		$model=new BrokerForm;
		$checked = isset($_POST['notify']) ? TRUE : FALSE;
		
		if(isset($_POST['BrokerForm']))
		{
			$model->attributes=$_POST['BrokerForm'];
			if($model->validate())
			{
				if(isset($_POST['notify'])){
					Yii::import('application.models.CC.*');
					$ct = new ConstantContact(
						Yii::app()->params['CCAuthType'], 
						Yii::app()->params['CCAPIKey'], 
						Yii::app()->params['CCUsername'], 
						Yii::app()->params['CCPassword']
					);
					
					$lists = $ct->getLists();
					
					$link = '';
					foreach($lists['lists'] as $list){
						if($list->id === Yii::app()->params['CCNotifyChangeID'])
							$link = $list->id;
					}
					
					if(!empty($link)){
						$search = $ct->searchContactsByEmail($model->email);
						
						$params = array();
						$params['status'] = 'Active';
						$params['emailType'] = 'HTML';
						$params['emailAddress'] = $model->email;
						$params['firstName'] = $profile->firstname;
						$params['optInSource'] = 'ACTION_BY_CONTACT';
						$params['lists'] = $link;
						
						$newContact = new Contact($params);
						$ct->addContact($newContact);
					}
				}
				$headers="From: {$model->email}\r\nReply-To: {$model->email}\r\nContent-type: text/html; charset=iso-8859-1\r\n";
				mail(Yii::app()->params['askBrokerEmail'],$model->subject,"From: {$model->name}<br/><br/>Message:<br/>" . $model->body,$headers);
				Yii::app()->user->setFlash('broker','Thank you for asking us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('broker',array('model'=>$model, 'checked'=>$checked));
	}
	
	public function actionReqUpdate($id, $type){
		Yii::import('application.modules.listing.models.*');
		$model = new RequestChangesForm;
		
		$subject = array(
			""=>"Select a subject...", 
			"Request Changes Data" => "Request Changes Data",
			"Mark as Pending" => "Mark as Pending",
			"Mark as Sold" => "Mark as Sold");
		
		if(isset($_POST['RequestChangesForm'])){
			$model->attributes = $_POST['RequestChangesForm'];
			if($model->validate()){
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['mlsUpdateReqEmail'], $model->subject, $model->body,$headers);
				Yii::app()->user->setFlash('reqChangeSubmit', 'We will update your changes as soon as possible.');
				$this->refresh();
			}
		}else{
			if(strtoupper($type) == "MLS"){
				$listing = Mls::model()->findByPk($id);
				$model->body = "Please make a changes with this details.\nID : {$listing->id}\nAddress : {$listing->address}\n";
			}else if(strtoupper($type) == "VACANT"){
				$listing = Land::model()->findByPk($id);
				$model->body = "Please make a changes with this details.\nID : {$listing->id}\nAddress : {$listing->street_name}\n";
			}	
		}
		
		$this->render('reqUpdate', array(
			'model'=>$model,
			'subject' => $subject,
		));
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/*public function actionFaq(){
		$this->layout = 'column1a';
		$this->render('faq');
	}*/
	
	public function actionNews(){
		$this->layout = 'column1a';
		$this->render('news');
	}
	
	public function actionGetNews(){
		$session = curl_init("http://feeds.feedburner.com/floridarealtors");
		curl_setopt($session, CURLOPT_HEADER, FALSE);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
		$xml = curl_exec($session);
		echo $xml;
		Yii::app()->end();
	}
	
	public function actionAbout(){
		$this->layout = 'column1a';
		$this->render('about');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionCount(){
		
	}
	
	public function actionFeedback()
	{
		$model=new Feedback;
		
		if(isset($_POST['Feedback']))
		{
			$model->attributes=$_POST['Feedback'];
			if($model->validate())
			{
				$model->save();
				$headers="From: {$model->email}\r\nReply-To: {$model->email}\r\nContent-type: text/html; charset=iso-8859-1\r\n";
				mail(Yii::app()->params['contactUsEmail'],$model->subject,"From: {$model->name}<br/><br/>Message:<br/>" . $model->body,$headers);
				
				$headers="From: " . Yii::app()->params['contactUsEmail'] . "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
				$message = "<p>You has send an email to us at http://flatratelist.com.<br/> Thank you for contacting us.<br/> We will respond to you as soon as possible.</p>";
				mail($model->email, "Confirmation Feedback", $message, $headers);
				
				Yii::app()->user->setFlash('feedback','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('feedback',array('model'=>$model));
	}
	
	public function actionManageFeedback(){
		$model = new Feedback;
		
		$this->render('manageFeedback', array('model'=>$model));
	}
	
	public function actionEditFeedback($id){
		$model = FeedbackChild::model()->findByPk($id);
		if(isset($_POST['FeedbackChild'])){
			$model->attributes = $_POST['FeedbackChild'];
			if($model->validate()){
				$model->save();
				$this->redirect(array("/site/viewFeedback/id/" . $model->parent_id));
			}
		}
		$this->render("editFeedback", array('model'=>$model));
	}
	
	public function actionViewFeedback($id){
		$model = new FeedbackChild;
		$feedback = Feedback::model()->findByPk($id);
		
		if(isset($_POST['FeedbackChild'])){
			$model->attributes = $_POST['FeedbackChild'];
			if($model->validate()){
				$model->save();
				if(Yii::app()->user->isAdmin()){
					$headers="From: " . Yii::app()->params['contactUsEmail'] . "\r\nReply-To: " . Yii::app()->params['contactUsEmail'] . "\r\nContent-type: text/html; charset=iso-8859-1\r\n";
					mail($feedback->email,$model->subject,"From: {$feeback->name}<br/><br/>Message:<br/>" . $model->body,$headers);
				}else{
					$headers="From: " . $feedback->email . "\r\nReply-To: {$feedback->email}\r\nContent-type: text/html; charset=iso-8859-1\r\n";
					mail(Yii::app()->params['contactUsEmail'],$model->subject,"From: Administrator<br/><br/>Message:<br/>" . $model->body,$headers);
				}
				$this->redirect(array('/site/viewFeedback/id/' . $model->parent_id));
			}
		}
		$this->render('viewFeedback', array('id'=>$id, 'model'=>$model, 'feedback'=>$feedback));
	}
	
	public function actionSolved($id){
		$model = Feedback::model()->findByPk($id);
		$model->solved = 1;
		if($model->save(false))
			$this->redirect(array('/site/manageFeedback'));
	}

    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
                    //'rights',
            );
    }
	
	public function actioncontrolPanel(){
            if(! Yii::app()->user->isGuest){
		$this->layout = 'column1a';
		$this->render('controlpanel');
            }else{
                throw new CHttpException(403,'You are not authorized to access this page.');
            }
	}
        
        public function actionjacksonSigns(){
            if(! Yii::app()->user->isGuest){
		$this->layout = 'column1a';
		$this->render('jacksonsigns');
            }else{
                throw new CHttpException(403,'You are not authorized to access this page.');
            }
	}
        public function actionSurveyFreeListing(){
                $model = User::model()->findByPk(Yii::app()->user->id);
                if(isset($model->status) && $model->status==1){
                    if($model->free_listing == 1){ //Check if it is a new user. Old user has free_listing = 0
                        
                        if(isset($_POST['User'])){
                            $model->free_listing = $_POST['User']['free_listing'];
                            $model->save();
                            // Destroying the state so that user wont be able to get back.
                            $this->redirect("controlpanel");
                               
                        }
                        $this->render("surveyFreeListing", array('model'=>$model));
                    }
                    else{
                        $this->redirect('controlpanel');
                    }
                }
                else{
                    $this->redirect(Yii::app()->baseUrl);
                }
	}
        public function actionFreeListingSuccess(){
            $this->render('freeListingSuccess');
        }
        
        
        
}

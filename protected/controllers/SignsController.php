<?php

class SignsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1b';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','paypal','statusUpdate'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','buySign','jacksonbuys','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Signs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Signs']))
		{
			$model->attributes=$_POST['Signs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idsigns));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Signs']))
		{
			$model->attributes=$_POST['Signs'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idsigns));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Signs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Signs']))
			$model->attributes=$_GET['Signs'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Signs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Signs']))
			$model->attributes=$_GET['Signs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Signs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='signs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
         * Buy jackson's sign
         */
        public function actionbuySign(){
            if(! Yii::app()->user->isGuest){
                $user = User::model()->findByPk(Yii::app()->user->id);
                $model = New Signs();
                //echo('<pre>');print_r($_POST);die();
                if(isset($_POST['stripeToken'])){
                    $model->transaction_id = $_POST['stripeToken'];
                    $model->saddress = $_POST['stripeShippingAddressLine1'];
                    $model->scity = $_POST['stripeShippingAddressCity'];
                    $model->scountry = $_POST['stripeShippingAddressCountry'];
                    $model->szipcode = $_POST['stripeShippingAddressZip'];
                    $model->bname = $_POST['stripeBillingName'];
                    $model->sname = $_POST['stripeShippingName'];
                    $model->baddress = $_POST['stripeBillingAddressLine1'];
                    $model->bcity = $_POST['stripeBillingAddressCity'];
                    $model->bzip = $_POST['stripeBillingAddressZip'];
                    $model->bcountry = $_POST['stripeBillingAddressCountry'];
                    $model->iduser = $user->id;
                    $model->status = 0;
                    
                    if($model->save()){
                            require_once(Yii::getPathOfAlias('ext').'/..'."/lib/stripe/lib/Stripe.php");
                            Stripe::setApiKey("sk_live_AeBNRoXM9OVHdjXC1H21FzW5");

                            // Get the credit card details submitted by the form
                            $token = $_POST['stripeToken'];

                            // Create the charge on Stripe's servers - this will charge the user's card
                            try {
                            $charge = Stripe_Charge::create(array(
                              "amount" =>3500, // amount in cents, again
                              "currency" => "usd",
                              "card" => $token,
                              "description" => "Jackson's Signs")
                            );
                                $item = array();
                                Flatrate::completeJacksonPayment($model, $_POST['userid'],$amount='25000');
                                Yii::app()->user->setFlash('success', "Thank you! Your payment is complete. Please check the status of your order.");
                                $this->redirect(array('site/jacksonsigns'));

                            } catch(Stripe_CardError $e) {
                              // The card has been declined
                                 Yii::app()->user->setFlash('error', "There was an issue with the payment. Please try again.");
                                $this->redirect(array('site/jacksonsigns'));
                            }
                    }
                }
                $this->render("buysign", array('model'=>$model));
            }else{
                $this->redirect(array('user/login'));
            }
        }
        
        /**
         * paypal ipn 
         */
        public function actionpaypal(){
                $fx = fopen("test2.txt", 'w');
		fwrite($fx, "confirmed");
		fclose($fx);
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		
		// post back to PayPal system to validate
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		
		$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
			
			$post = "";
			$kv = array();
			foreach ($_POST as $key => $value) {
			 $kv[] = "$key=$value";
			}
			$post = join("\n", $kv);
		
			if (!$fp) 
			{
			// HTTP ERROR
			} else {
				fputs ($fp, $header . $req);
				while (!feof($fp)) {
					$res = fgets ($fp, 1024);
					if (strcmp ($res, "VERIFIED") == 0) 
					{
						// check the payment_status is Completed
						// check that txn_id has not been previously processed
						// check that receiver_email is your Primary PayPal email
						// check that payment_amount/payment_currency are correct
						// process payment
					} else if (strcmp ($res, "INVALID") == 0) {
						// log for manual investigation
					}
				}
			}
		fclose ($fp);
                
                try {
			if(isset($_POST['custom']) && !empty($_POST['custom']) && isset($_POST['txn_id']) && !empty($_POST['txn_id']))
			{
                            $model = Signs::model()->findByPk($_POST['custom']);
                            $user = User::model()->findByPk($model->iduser);
                            
                            
                            $model->transaction_id = $_POST['txn_id'];
                            $model->status = 1;
                            $model->idlink = sha1(mt_rand(10000,99999).time().$user->email);
                            
                            if($model->save()){
                                
                                require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
                                $mail = new PHPMailer;
                                $mail->ClearAddresses();
                                $mail->From = Yii::app()->params['adminEmail'];
                                $mail->AddAddress($user->email);
                                $mail->FromName = "Flatratelist.com";
                                $mail->Subject = "Jackson's Sign";
                                $mail->Body = "Congratulations,<br/><br>
                                        We have registered your order of Jackson's Sign and we would be delivering your order soon. Please login to your account on flatratelist.com to check current status.<br/>
                                        <br/>
                                        Regards,<br/>
                                        Flatratelist.com Team
                                ";
                                $mail->IsHTML(true);
                                $mail->Send();
                                
                                $mail = new PHPMailer;
                                $mail->ClearAddresses();
                                $mail->From = Yii::app()->params['adminEmail'];
                                $mail->AddAddress(Yii::app()->params['mlsApprovedEmail']);
                                $mail->AddAddress('art@jacksonsignshop.com');
                               // $mailer->AddAddress(Yii::app()->params['mlsApprovedEmail']);
                                $mail->FromName = "Flatratelist.com";
                                $mail->Subject = "A user (id:{$user->id}) has bought a Sign on Flatratelist.com";
                                $mail->Body = "Hello<br/>
                                        A user has bought a sign and made complete payment on flatratelist.com. <br><br>
                                        
                                        <b>User Details</b><br>
                                        First Name: {$user->profile->firstname}<br>
                                        Last Name:  {$user->profile->lastname}<br>
                                        Address:  {$model->address}<br>
										Address2:  {$model->address2}<br>
                                        City:  {$model->city}<br>
                                        State:  {$model->state}<br>
                                        Zip Code:  {$model->zipcode}<br>
                                        Phone:  {$model->phone}<br>
                                        Email:  {$user->email} <br>
                                        Paypal Transaction ID : {$model->transaction_id}<br><br>
                                        
                                        <br/>Please click on the link given below to update the status of delivery.<br/>
                                        <a href=".('http://flatratelist.com/'.$this->createUrl('signs/statusUpdate',array('k'=>$model->idlink))).">Click here</a><br/><br/>
                                        Regards,<br/>
                                        Flatratelist.com Team
                                ";
                                $mail->IsHTML(true);
                                $mail->Send();
                            }
                            
                            
                            
                        }
                } catch (Exception $e) {
    		$error = $e->getMessage();
		}
                
                $myFile = Yii::app()->params['ipnLogPath'] . "/" . date("Ymd_His") . "_" . $model->idsigns  .  ".txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $post . "\n" . "MLS ID=" . $model->id);
		fclose($fh);
		
		Yii::app()->end(); 
        }
        
        
        /**
         * delivery status update 
         */
        public function actionstatusUpdate(){
            $model = Signs::model()->findByAttributes(array('idlink'=>$_REQUEST['k']));
            if(isset($model)){
            if(isset($_POST['Signs'])){
                $model->status = $_POST['Signs']['status'];
                $model->save();
                $this->redirect(array('signs/index'));
            }
            $this->render("update", array('model'=>$model));
        }}
        
        
        /**
         * all signs bought by user
         */
        public function actionjacksonbuys(){
            if(Yii::app()->user->isAdmin()){
                $dataProvider=new CActiveDataProvider('Signs');
            }else{
            $dataProvider=new CActiveDataProvider('Signs', array(
			'criteria'=>array('condition'=>'iduser='.Yii::app()->user->id),
	    ));}
            $this->render("allbuys", array('dataProvider'=>$dataProvider));
        }
        
        
}

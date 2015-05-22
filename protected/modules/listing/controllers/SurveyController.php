<?php

class SurveyController extends RController
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
			//'rights',
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
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('like','create'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','admin','delete'),
				'users'=>Yii::app()->getModule('user')->getAdmins(),
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
	public function actionCreate($mls_id)
	{
                
		$model=new Survey;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		 if(isset($_POST['paymentdone']) && isset($_POST['stripeToken']) && isset($_POST['stripeEmail']) && $_POST['userid']){
                    require_once(Yii::getPathOfAlias('ext').'/..'."/lib/stripe/lib/Stripe.php");
                    Stripe::setApiKey("sk_live_AeBNRoXM9OVHdjXC1H21FzW5");

                    // Get the credit card details submitted by the form
                    $token = $_POST['stripeToken'];

                    // Create the charge on Stripe's servers - this will charge the user's card
                    try {
                    $charge = Stripe_Charge::create(array(
                      "amount" => 14700, // amount in cents, again
                      "currency" => "usd",
                      "card" => $token,
                      "description" => "Flatratelist.com Listing Service")
                    );
                        $item = array();
                        Flatrate::completePayment($_POST['mls_id'], $_POST['userid'], $token, $item = '147', $type='MLS');
                        
                        Yii::app()->user->setFlash('success', "Thank you! Your listing is paid now.");
                        Yii::app()->user->setState('url','listing/mls/view');
                        $this->redirect(array('survey/like', 'id' => $_POST['mls_id']));
                        
                        
                       // $this->redirect(array('mls/view', 'id' => $_POST['mls_id']));
                        
                    } catch(Stripe_CardError $e) {
                      // The card has been declined
                         Yii::app()->user->setFlash('error', "There was an issue with the payment. Please try again.");
                        $this->redirect(array('mls/view', 'id' => $_POST['mls_id']));
                    }
                }
		if(isset($_POST['Survey']))
		{
			$model->attributes=$_POST['Survey'];
			if($model->save()){

				$mls = Mls::model()->findByPk($mls_id);
				$logo = "http://flatratelist.com/themes/css/images/logo.png";
						
				require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
				$mail = new PHPMailer;
				$mail->ClearAddresses();
				$mail->From = $mls->email;
				$mail->AddAddress(Yii::app()->params['mlsApprovedEmail']);
				
			/*	$mail->AddAddress("support@wisenetware.com");*/
				// $email = split(",", Yii::app()->params['mlsApprovedEmail']);
				// foreach($email as $k => $v){
				// 	$mail->AddAddress($v, $v);
				// }
				$mail->FromName = $mls->name;
				$mail->Subject = "Survey Result";
				$mail->isHTML(true);
				$mail->Body = "
					<center>
						<div style='background: url(\"$logo\") no-repeat center center; width:720px; height:470px;'>
							<h2>Someone took a survey form after listing at flatratelist.com</h2>
							<table>
								<tr><th width='150px'>Survey ID</th><td>: {$model->id}</td></tr>
								<tr><th>MLS ID</th><td>: {$model->mls_id}</td></tr>
								<tr><th>How did you hear about us?</th><td>: {$model->hear_about}, {$model->hear_about_text}</td></tr>
								<tr><th>On a scale of 1-10 (1 being hard to use, 10 being easy to use). How easy was it for you to use the MLS listing form you just completed?</th><td>: {$model->how_easy}</td></tr>
								<tr><th>Would you refer others to use our service?</th><td>: {$model->refer_other}</td></tr>
								<tr><th>We know we are not perfect. What is one (you can give more) suggestion you would offer to make our service better for you?</th><td>: {$model->suggestion}</td></tr>
								<tr><th>Approximately how much time did it take you to complete the form?</th><td>: {$model->how_long}</td></tr>
								<tr><th>How many properties will you likely sell in a year?</th><td>: {$model->help_chat}</td></tr>
								<tr><th>What question or part of the form did you find most difficult? </th><td>: {$model->difficult_part}</td></tr>
							</table>
						</div>
					</ccenter>
				";
						
				$mail->Send();
				$this->redirect(Yii::app()->request->baseUrl.'/index.php/listing/flyer/printflyer/mls_id/' . $model->mls_id);
			}
		} else {
			$model->mls_id= $mls_id;
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        
        public function actionLike($id){
                $this->render('like');
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

		if(isset($_POST['Survey']))
		{
			$model->attributes=$_POST['Survey'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Survey');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Survey('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Survey']))
			$model->attributes=$_GET['Survey'];

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
		$model=Survey::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='survey-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

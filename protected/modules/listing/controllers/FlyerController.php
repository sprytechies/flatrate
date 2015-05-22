<?php



class FlyerController extends Controller

{

	public $defaultAction = "search";

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

			array('allow',  // allow all users to perform 'index' and 'view' actions

				'actions'=>array('flyer', 'search', 'result', 'viewList', 'print' , 'printflyer','FreeListing'),

				'users'=>array('*'),

			),

			array('allow', // allow admin user to perform 'admin' and 'delete' actions

				'actions'=>array('flyer', 'search', 'result', 'viewList', 'print' , 'printflyer'),

				'users'=>Yii::app()->getModule('user')->getAdmins(),

			),

			array('deny',  // deny all users

				'users'=>array('*'),

			),

		);

	}

	

	public function actionSearch(){

		$model=new Mls('search');

	    $model->unsetAttributes();

	    $model->scenario = 'search';

	

	    // uncomment the following code to enable ajax-based validation

	    

	    if(isset($_POST['ajax']) && $_POST['ajax']==='mls-advSearch-form')

	    {

	        echo CActiveForm::validate($model);

	        Yii::app()->end();

	    }

	  

	    $this->render('advSearch',array('model'=>$model));

	}

	

	public function actionResult(){

		$model = new Mls('search');

	       $model->unsetAttributes();

		if(isset($_POST['Mls'])){

			$model->attributes = $_POST['Mls'];

		}

		$this->render('result', array('model'=>$model));

	}

	

	public function actionViewList($id){

		$model = Mls::model()->findByPk($id);

		$model2 = new BuyerForm();

		if(isset($_POST['BuyerForm']))

		{

			$model2->attributes=$_POST['BuyerForm'];

			if($model2->validate())

			{

				$headers="From: {$model2->name}\r\nReply-To: {$model2->email}";

				mail(Yii::app()->params['adminEmail'],$model2->subject,$model2->body,$headers);

				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');

				$this->refresh();

			}

		}

		$this->render("view", array('model'=>$model, 'model2'=>$model2));

	}

	

	public function actionFlyer(){

		$mls = New Mls;

		$land = new Land;

		

		$this->render("flyer", array('mls'=>$mls, "land"=>$land));

	}

	

	public function actionPrint($type, $id){
		if($type === 'residential'){
			$model = Mls::model()->findByPk($id);
			$this->renderPartial('listingflyer', array("model"=>$model));
		}elseif($type === 'vacant'){
			$model = Land::model()->findByPk($id);
			$this->renderPartial("landflyer", array("model"=>$model));
		}
	}
	
	/**
         * print flyer before sending to payment
         */
        public function actionprintFlyer($mls_id){
            if($mls_id){
                $mls = Mls::model()->findByPk($mls_id);
                $user = User::model()->findByPk(Yii::app()->user->id);
                $status = null;
                $free = false;
                if($user->free_listing==2){
                    $free = true;
                    $allmls = Mls::model()->findAll('creator_id='.Yii::app()->user->id);
                    foreach($allmls as $record){
                        if($record->list_status=="SOLD"){
                            $status = "sold";
                            break;
                        }
                    }
                }
            }else{
                $mls = new Mls;
            }
                
                
            if(isset($_POST['paymentdone']) && isset($_POST['stripeToken']) && isset($_POST['stripeEmail']) && $_POST['userid']){
                    require_once(Yii::getPathOfAlias('ext').'/..'."/lib/stripe/lib/Stripe.php");
                    Stripe::setApiKey("sk_live_AeBNRoXM9OVHdjXC1H21FzW5");

                    // Get the credit card details submitted by the form
                    $token = $_POST['stripeToken'];

                    // Create the charge on Stripe's servers - this will charge the user's card
                    try {
                    $charge = Stripe_Charge::create(array(
                      "amount" => 14200, // amount in cents, again
                      "currency" => "usd",
                      "card" => $token,
                      "description" => "Flatratelist.com Listing Service")
                    );
                        $item = array();
                        Flatrate::completePayment($_POST['mls_id'], $_POST['userid'], $token, $item = '142', $type='MLS');
                        Yii::app()->user->setFlash('success', "Thank you! Your listing is paid now.");
                        $this->redirect(array('mls/view', 'id' => $_POST['mls_id']));
                        
                    } catch(Stripe_CardError $e) {
                      // The card has been declined
                         Yii::app()->user->setFlash('error', "There was an issue with the payment. Please try again.");
                        $this->redirect(array('mls/view', 'id' => $_POST['mls_id']));
                    }
                }
                
                         
            $this->render("printflyer", array('mls'=>$mls,'status'=>$status,'free'=>$free));
        }
        public function actionFreeListing(){
            if($_GET['mls_id']){
                $mls = Mls::model()->findByPk($_GET['mls_id']);
                $mls->list_status = "SOLD";
                $mls->save();
                
                $user = User::model()->findByPk(Yii::app()->user->id);
                $user->free_listing = 0;
                $user->save();
                Yii::app()->user->setFlash('successMsg','Thank you for your business. This listing is FREE, Tell your friends!! Would you like to submit another listing?');
                $this->redirect(Yii::app()->createUrl('site/freeListingSuccess'));
                
            }
        }

}

?>
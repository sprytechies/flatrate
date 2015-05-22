<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';
	public $layout='//layouts/column1b';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					/*if ('/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);*/
					if(Yii::app()->user->getUserPlan() == "LISTING" || Yii::app()->user->isAdmin())
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(array('/listing/flyer'));
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model,));
		} else{
			if(Yii::app()->user->getUserPlan() == "LISTING" || Yii::app()->user->isAdmin())
				$this->redirect(Yii::app()->controller->module->returnUrl);
			else
				$this->redirect(array('/listing/flyer'));
		}
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
                if($lastVisit->lastvisit==0){
                    $lastVisit->free_listing = 1;
                }
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}
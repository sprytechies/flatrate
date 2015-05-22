<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	public $layout='//layouts/column1b';
	


	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}
	/**
	 * Registration user
	 */
	public function actionRegistration() {
            $model = new RegistrationForm;
            $profile=new Profile;
            $profile->regMode = true;
		    if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->profileUrl);
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					$profile->attributes=$_POST['Profile'];
					if($model->validate()&&$profile->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=UserModule::encrypting(microtime().$model->password);
						$model->password=UserModule::encrypting($model->password);
						$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
						$model->createtime=time();
						$model->lastvisit=((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin)?time():0;
						$model->superuser=0;
						$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
						if ($model->save()) {
							$profile->user_id=$model->id;
							/*$profile->plan = empty($profile->plan) ? "LISTING" : $profile->plan;*/
							$profile->save();
							if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
								UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}
							
							if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
									$identity=new UserIdentity($model->username,$soucePassword);
									$identity->authenticate();
									Yii::app()->user->login($identity,0);
									$this->redirect(Yii::app()->controller->module->returnUrl);
							} else {
								if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
								} elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
								} elseif(Yii::app()->controller->module->loginNotActiv) {
									Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email or login."));
								} else {
									Yii::app()->user->setFlash('registration',UserModule::t("One more step is required to activate your account. An email has been sent to you at the email provided.<br/> Go to your email and follow the instructions to activate your account.<br/> Once activated, you will be able to login using the email and password you provided."));
									
									/*
									* ConstantContact API Code
									*/
									Yii::import('application.models.CC.ConstantContact');
									$ct = new ConstantContact(
										Yii::app()->params['CCAuthType'], 
										Yii::app()->params['CCAPIKey'], 
										Yii::app()->params['CCUsername'], 
										Yii::app()->params['CCPassword']
									);
									
									$lists = $ct->getLists();
									
									$link = '';
									$link2 = '';
									foreach($lists['lists'] as $list){
										if($list->id === Yii::app()->params['CCRegisterNotActiveID'])
											$link = $list->id;
										if(isset($_POST['notify'])){
											if($list->id === Yii::app()->params['CCNotifyChangeID'])
												$link2 = $list->id;
										}
									}
									
									if(!empty($link)){
										$search = $ct->searchContactsByEmail($model->email);
										
										if(!$search){
											$params = array();
											$params['status'] = 'Active';
											$params['emailType'] = 'HTML';
											$params['emailAddress'] = $model->email;
											$params['firstName'] = $profile->firstname;
											$params['lastName'] = $profile->lastname;
											$params['workPhone'] = $profile->phone;
											$params['addr1'] = $profile->billing_address;
											$params['city'] = $profile->billing_city;
											$params['stateName'] = $profile->billing_state;
											$params['postalCode'] = $profile->billing_zipcode;
											$params['customField1'] = $model->id;
											$params['optInSource'] = 'ACTION_BY_CONTACT';
											$params['lists'] = isset($_POST['notify']) ? array($link, $link2) : $link;
											
											$newContact = new Contact($params);
											$ct->addContact($newContact);
										}else{
											$contact = $ct->getContactDetails($search[0]);
											$contact->status = "Active";
											$contact->emailType = "HTML";
											$contact->optInSource = "ACTION_BY_CONTACT";
											$contact->lists = isset($_POST['notify']) ? array($link, $link2) : $link;
											
											$ct->updateContact($contact);
										}
									}
									if($profile->plan === "SILVER"){
										Yii::app()->authManager->assign('Silver', $model->id);
										if(isset($_POST['listing']))
											Yii::app()->authManager->assign('Listing', $model->id);
										$this->redirect('https://sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PHT6UU968R52S' . "&custom=" . $model->id);
									}
									elseif($profile->plan == "GOLD"){
										Yii::app()->authManager->assign('Gold', $model->id);
										if(isset($_POST['listing']))
											Yii::app()->authManager->assign('Listing', $model->id);
										$this->redirect('https://sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QQU2NQCWM9EA6' . "&custom=" . $model->id);
									}elseif(isset($_POST['listing'])){
										Yii::app()->authManager->assign('Listing', $model->id);
									}
								}
								$this->refresh();
							}
						}
					}
				}
				
				//custom - rudi
				//$profile->username = uniqid();
			    // end of custom
				$this->render('/user/registration',array('form'=>$model,'profile'=>$profile));
		    }
	}

}
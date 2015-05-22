<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';

	
	/**
	 * Activation user account
	 */
	public function actionActivation () {
		$email = $_GET['email'];
		$activkey = $_GET['activkey'];
		if ($email&&$activkey) {
			$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
			if (isset($find)&&$find->status) {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("You account is active.")));
			} elseif(isset($find->activkey) && ($find->activkey==$activkey)) {
				$find->activkey = UserModule::encrypting(microtime());
				$find->status = 1;
				$find->save();
				
				
				$auth_model = new AuthAssignment();
				$auth_model->itemname = 'Listing';
				$auth_model->userid = $find->id;
				$auth_model->bizrule = Null;
				$auth_model->data = 'N;';
				$auth_model->save();
								
				
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
				foreach($lists['lists'] as $list){
					if($list->id === Yii::app()->params['CCGeneralListID'])
						$link = $list->id;
				}
				
				if(!empty($link)){
					$search = $ct->searchContactsByEmail($email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("You account is activated. Please click " . CHtml::link('here', Yii::app()->request->baseUrl . '/index.php/user/login', array()) . " to login"  )));
			} else {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
			}
		} else {
			$this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
		}
	}

}
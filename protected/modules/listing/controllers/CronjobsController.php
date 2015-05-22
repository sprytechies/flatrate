<?php

class CronjobsController extends Controller
{
	public function actionAdmin()
	{
		Yii::import('application.models.CC.*');
		$callback = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$constantContact = new CTCTOAuth(Yii::app()->params['CCAPIKey'], Yii::app()->params['CCAPISecret'], $callback);
		
		if(!isset($_GET['oauth_verifier'])){
			$constantContact->getRequestToken();
			Yii::app()->session->add('requestToken', $constantContact->request_token->key);
			Yii::app()->session->add('requestSecret', $constantContact->request_token->secret);
			header("Location: " . $constantContact->generateAuthorizeUrl());
		}else{
			$requestToken = new OAuthToken(Yii::app()->session->get('requestToken'), Yii::app()->session->get('requestSecret'));
			$constantContact->request_token = $requestToken;
			$constantContact->username = $_GET['username'];
			$constantContact->getAccessToken($_GET['oauth_verifier']);
			
			$sessionConsumer = array(
				'key' => $constantContact->access_token->key,
			       'secret' => $constantContact->access_token->secret,
			       'username' => $constantContact->username
			);
			$dataStore = new CTCTDataStore();
			$dataStore->addUser($sessionConsumer);
		}
	}
	
	public function actionNewsletter(){
		Yii::import("application.models.CC.*");
		$constantContact = new ConstantContact("OAuth", Yii::app()->params['CCAPIKey'], Yii::app()->params['CCUsername'], Yii::app()->params['CCAPISecret']);
		
		$cp = $constantContact->getCampaigns();
		
		foreach($cp['campaigns'] as $k => $v){
			if($v->name == "Newsletter Campaign"){
				$schedule = $constantContact->scheduleCampaign($cp['campaigns'][$k], gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 minutes", strtotime(date("Y-m-d H:i:s")))));
				break;
			}
		}
		Yii::app()->end();
	}
	
	public function actionReminderPending(){
		Yii::import("application.models.CC.*");
		$constantContact = new ConstantContact("OAuth", Yii::app()->params['CCAPIKey'], Yii::app()->params['CCUsername'], Yii::app()->params['CCAPISecret']);
		
		$cp = $constantContact->getCampaigns();
		
		foreach($cp['campaigns'] as $k => $v){
			if($v->name == "A2P Reminder Campaign"){
				/*print_r($constantContact->getCampaignDetails($v));*/
				$schedule = $constantContact->scheduleCampaign($cp['campaigns'][$k], gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 minutes", strtotime(date("Y-m-d H:i:s")))));
				break;
			}
		}
		
		Yii::app()->end();
	}
	
	public function actionReminderSold(){
		Yii::import("application.models.CC.*");
		$constantContact = new ConstantContact("OAuth", Yii::app()->params['CCAPIKey'], Yii::app()->params['CCUsername'], Yii::app()->params['CCAPISecret']);
		
		$startVal = date("Y-m-d");
		$endVal = date("Y-m-d", strtotime("+7 days", strtotime(date("Y-m-d"))));
		
		$criteria = new CDbCriteria();
		$criteria->addBetweenCondition("estimated_sold", $startVal, $endVal);
		
		$model = Mls::model()->findAllByAttributes(array(), $criteria);
		
		if($model !== NULL){
			// REMOVE CONTACT FROM TEMP LIST
			$lists = $constantContact->getLists();
			foreach($lists['lists'] as $list){
				if($list->id=== Yii::app()->params['CCTempID']){
					$members = $constantContact->getListMembers($list);
					foreach($members['members'] as $member){
						$details = $constantContact->getContactDetails($member);
						foreach($details->lists as $k => $v){
							if($v === Yii::app()->params['CCTempID']){
								unset($details->lists[$k]);
								$res = $constantContact->updateContact($details);
							}
						}
					}
					break;
				}
			}
			
			// ADD NEW CONTACT TO TEMP LIST
			foreach($model as $k => $v){
				$search = $constantContact->searchContactsByEmail($v->email);
				if($search){
					$contact = $constantContact->getContactDetails($search[0]);
					$contact->fullName = $v->name;
					$contact->addr1 = $v->address;
					$contact->city = $v->city;
					$contact->stateCode = $v->state;
					$contact->postalCode = $v->zip_code;
					$contact->homePhone = $v->home_phone;
					$contact->lists[] = $list->id;
					$constantContact->updateContact($contact);
				}else{
					$contact = new Contact();
					$contact->fullName = $v->name;
					$contact->addr1 = $v->address;
					$contact->city = $v->city;
					$contact->stateCode = $v->state;
					$contact->postalCode = $v->zip_code;
					$contact->homePhone = $v->home_phone;
					$contact->lists[] = $list->id;
					$constantContact->addContact($contact);
				}
			}
			
			//SEND CAMPAIGN
			if($list->contactCount > 0){
				$cp = $constantContact->getCampaigns();
				foreach($cp['campaigns'] as $k => $v){
					if($v->name == "P2S Reminder Campaign"){
						$schedule = $constantContact->scheduleCampaign($cp['campaigns'][$k], gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 minutes", strtotime(date("Y-m-d H:i:s")))));
						break;
					}
				}				
			}
		}
		
		Yii::app()->end();
	}
	
	public function actionHasSold(){
		Yii::import("application.models.CC.*");
		$constantContact = new ConstantContact("OAuth", Yii::app()->params['CCAPIKey'], Yii::app()->params['CCUsername'], Yii::app()->params['CCAPISecret']);
		
		$lists = $constantContact->getLists();
		
		// REMOVE CONTACT IN TEMP SOLD LIST
		foreach($lists['lists'] as $list){
			if($list->id=== Yii::app()->params['CCTempSoldID']){
				$members = $constantContact->getListMembers($list);
				foreach($members['members'] as $member){
					$details = $constantContact->getContactDetails($member);
					foreach($details->lists as $k => $v){
						if($v === Yii::app()->params['CCTempSoldID']){
							unset($details->lists[$k]);
							$res = $constantContact->updateContact($details);
						}
					}
				}
				break;
			}
		}
		
		// ADD CONTACT TO TEMP SOLD LIST
		foreach($lists['lists'] as $list){
			if($list->id == Yii::app()->params["CCTempSoldID"]){
				$members = $constantContact->getListMembers($list);
				foreach($members['members'] as $member){
					$details = $constantContact->getContactDetails($member);
					$soldDate = date("Y-m-d", strtotime("+7 days", strtotime($details->customField14)));
					
					// CHECK LISTING SOLD DATE, IF EQUAL NOW DATE ADD TO TEMP SOLD LIST
					if($soldDate == date("Y-m-d")){
						unset($details->lists);
						$details->lists[0] = Yii::app()->params['CCGeneralListID'];
						$details->lists[1] = Yii::app()->params['CCTempSoldID'];
						$constantContact->updateContact($details);
					}
				}
				break;
			}
		}
		
		// SEND Campaign
		if($list->contactCount > 0){
			$cp = $constantContact->getCampaigns();
			foreach($cp['campaigns'] as $k => $v){
				if($v->name == "Thank You Campaign"){
					$schedule = $constantContact->scheduleCampaign($cp['campaigns'][$k], gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 minutes", strtotime(date("Y-m-d H:i:s")))));
					break;
				}
			}
		}
		
		Yii::app()->end();
	}
	
	public function actionImage(){
		echo mt_rand(0,10);
		/*$documents = Document::model()->findAllByAttributes(array(
				"list_type"=>"Admin",
			)
		);
		if(is_array($documents)){
			foreach($documents as $document){
				echo $document->realname;
			}
		}*/
		/*$files = array(
			'thumb_13af9ddebc80a6e3095d7bc1e95afa0d.png',
			'thumb_a01c5aa301f61161e91ed259252551ba.png',
			'thumb_b66be5f4f9718cf6987381b8357e529b.png'
		);
		
		$zip = new ZipArchive();
		$res = $zip->open(Yii::app()->params['imgUploader']['folder'] . 'test.zip', ZIPARCHIVE::CREATE);
		
		foreach($files as $file){
			$zip->addFile(Yii::app()->params['imgUploader']['folder'] . $file, $file);
		}
		
		$zip->close();
	
		require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
		$mail = new PHPMailer;
		$mail->ClearAddresses();
		$mail->From = Yii::app()->params['adminEmail'];
		$mail->AddAddress("support@wisenetware.com");
		$mail->FromName = "Flatratelist.com";
		$mail->Subject = "Listing Information";
		$mail->Body = "Here Your Listing Information. See the Attachment";
		$mail->AddAttachment('/home/flatrate/public_html/upload/test.zip', 'test.zip');
		$mail->Send();*/
/*		       echo count htmlentities(htmlspecialchars('img src="http://"tinyurl.com/7bjsdkw/t_faa2.jpg"/>'));*/
		/*Yii::import("application.models.CC.*");
		$constantContact = new ConstantContact("OAuth", Yii::app()->params['CCAPIKey'], Yii::app()->params['CCUsername'], Yii::app()->params['CCAPISecret']);
		$folders = $constantContact->getFolders();
		foreach($folders['folders'] as $folder){
			if($folder->name == "images")
				break;
		}
		$params = array(
			'name' => 'logo.png',
			'imageUrl' => 'http://beta.flatratelist.com/themes/custom/css/images/logo.png',
		);
		$image = new Image($params);
		
		$result = $constantContact->uploadImage("http://beta.flatratelist.com/themes/custom/css/images/logo.png", $folder);*/
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}

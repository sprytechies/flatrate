<?php

class DefaultController extends RController
{
	public $layout='//layouts/column1b';
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionFormPending($id, $type)
	{
		$model = Pending::model()->findByAttributes(array('listing_id'=>$id, 'listing_type'=>$type));
		
		if(!$model)
		$model=new Pending;
		
		$user = User::model()->findByPk(Yii::app()->user->id);
		
		// uncomment the following code to enable ajax-based validation
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='pending-formPending-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		
		if(isset($_POST['Pending']))
		{
			$model->attributes=$_POST['Pending'];
			if($model->validate())
			{
				$model->save();
				if($type == "MLS"){
					$mls = Mls::model()->findByPk($id);
					$mls->list_status = "PENDING";
					$mls->save();
					$listingdata = $mls;
					}elseif($type == "VACANT"){
					$vacant = Land::model()->findByPk($id);
					$vacant->land_status = "PENDING";
					$vacant->save();
					$listingdata = $vacant;
				}
				
				/*
				* ConstantContact API Code
				*/
				/*Yii::import('application.models.CC.*');
				$ct = new ConstantContact(
					Yii::app()->params['CCAuthType'], 
					Yii::app()->params['CCAPIKey'], 
					Yii::app()->params['CCUsername'], 
					Yii::app()->params['CCPassword']
				);
				
				$lists = $ct->getLists();
			
				$link = '';
				foreach($lists['lists'] as $list){
					if($list->id === Yii::app()->params['CCPendingID'])
						$link = $list->id;
				}
				
				if(!empty($link)){
					$search = $ct->searchContactsByEmail($user->email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->customField15 = $model->expected_close_date;
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}*/
				require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
				$mail = new PHPMailer;
				$mail->ClearAddresses();
				$mail->From = Yii::app()->params['adminEmail'];
				$mail->AddAddress($user->email,$user->email);
				$email = split(",", Yii::app()->params['mlsApprovedEmail']);
				foreach($email as $k => $v){
					$mail->AddBCC($v, " Person" . ($k+1));
				}
				$mail->FromName = "Flatratelist.com";
				$mail->Subject = "Information of Change Listing Status to Pending";
				$mail->IsHTML(true);
				$mail->Body = "Your updated status for the listing ".$listingdata->address.', '.$listingdata->city.', '.$listingdata->county." is given below:<br/>";
				foreach($model as $k => $v){
					$mail->Body .= "$k : $v<br/>";
				}
				$mail->Send();
				
				$this->redirect(array('/listing/mls/admin'));
			}
		}
		$this->render('formPending',array('model'=>$model));
	}
	
	public function actionFormSold($id, $type)
	{
		$model=new Sold;
		$pending = Pending::model()->findByPk(array('listing_id'=>$id, 'listing_type'=>$type));
		$user = User::model()->findByPk(Yii::app()->user->id);
		
		// uncomment the following code to enable ajax-based validation
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='sold-formSold-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		
		if(isset($_POST['Sold']))
		{
			$model->attributes=$_POST['Sold'];
			
			if($model->validate())
			{
				$model->save();
				if($type == "MLS"){
					$mls = Mls::model()->findByPk($id);
					$mls->list_status = "SOLD";
					$mls->save();
				}elseif($type == "VACANT"){
					$vacant = Land::model()->findByPk($id);
					$vacant->land_status = "SOLD";
					$vacant->save();
				}
				
				/*
				* ConstantContact API Code
				*/
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
					if($list->id === Yii::app()->params['CCSoldID'])
						$link = $list->id;
				}
				
				if(!empty($link)){
					$search = $ct->searchContactsByEmail($user->email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->customField14 = date("Y-m-d");
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				
				require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
				$mail = new PHPMailer;
				$mail->ClearAddresses();
				$mail->From = Yii::app()->params['adminEmail'];
				$mail->AddAddress($user->email,$user->email);
				$email = split(",", Yii::app()->params['mlsApprovedEmail']);
				foreach($email as $k => $v){
					$mail->AddBCC($v, " Person" . ($k+1));
				}
				$mail->FromName = "Flatratelist.com";
				$mail->Subject = "Information of Change Listing Status to Sold";
				$mail->IsHTML(true);
				$mail->Body = "Your update listing status information below:<br/>";
				foreach($model as $k => $v){
					$mail->Body .= "$k : $v<br/>";
				}
				$mail->Send();
				
				$this->redirect(array('/listing/mls/admin'));
			}
		}
		$this->render('formSold',array('model'=>$model, 'pending'=>$pending));
	}
}
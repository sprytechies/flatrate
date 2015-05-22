<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Flatrate
 *
 * @author arvind
 */
class Flatrate extends CController{
        /**
         * Call this function when payment is done.
         */
        public static function completePayment($mls_id, $user_id, $token, $amount, $type){
            $model=Mls::model()->findByPk($mls_id);
            $model->list_status = 'PAID';
            $model->paypal_trans_id = $token;
            if($model->save())
            {
                    $profile = Profile::model()->findByAttributes(array('user_id'=>$user_id));
                    $sales = new TrackSales();
                    $sales->item_name = $model->address;
                    $sales->pay = $amount;
                    $sales->payment_date = date("Y-m-d H:i:s");
                    $sales->paypal_trans_id = $token;
                    $sales->full_name = $profile->lastname . ", " . $profile->firstname;
                    $sales->listing_type = $type;
                    $sales->listing_id = $mls_id;

                    $sales->save();
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
                            if($list->id === Yii::app()->params['CCActiveID'])
                                    $link = $list->id;
                    }

                    if(!empty($link)){
                            $search = $ct->searchContactsByEmail($model->email);

                            if($search){
                                    $contact = $ct->getContactDetails($search[0]);
                                    $contact->add1 = $model->address;
                                    $contact->city = $model->city;
                                    $contact->stateCode = $model->state;
                                    $contact->postalCode = $model->zip_code;
                                    $contact->customField4 = $model->list_price;
                                    $contact->customField5 = $model->bedrooms;
                                    $contact->customField6 = $model->full_baths;
                                    $contact->customField7 = $model->sq_ft_heated;
                                    $contact->customField8 = $model->photo_1 != "" ? '<img src="http://goo.gl/xsyU2/t_' . $model->photo_1 . '"/>' : "";
                                    $contact->customField9 = $model->photo_2 != "" ? '<img src="http://goo.gl/xsyU2/t_' . $model->photo_2 . '"/>' : "";
                                    $contact->customField10 = $model->photo_3 != "" ? '<img src="http://goo.gl/xsyU2/t_' . $model->photo_3 . '"/>' : "";
                                    $contact->customfield11 = $model->photo_4 != "" ? '<img src="http://goo.gl/xsyU2/t_' . $model->photo_4 . '"/>' : "";
                                    $contact->customField12 = $model->photo_5 != "" ? '<img src="http://goo.gl/xsyU2/t_' . $model->photo_5 . '"/>' : "";
                                    $contact->optInSource = "ACTION_BY_CONTACT";
                                    $contact->customField2 = "RESIDENTIAL LISTING";
                                    $contact->lists[0] = $link;

                                    $ct->updateContact($contact);
                            }
                    }

                    /*
                    * Send Email With Attachment
                    */
                    $zip = new ZipArchive();
                    $zipDestination = Yii::app()->params['imgUploader']['folder'] . $model->id . "_" . $model->address . "_mls.zip";
                    $createZip = $zip->open($zipDestination, ZIPARCHIVE::CREATE);
                    if($createZip){
                            if(!empty($model->photo_1)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_1, $model->photo_1);
                            if(!empty($model->photo_2)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_2, $model->photo_2);
                            if(!empty($model->photo_3)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_3, $model->photo_3);
                            if(!empty($model->photo_4)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_4, $model->photo_4);
                            if(!empty($model->photo_5)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_5, $model->photo_5);
                            if(!empty($model->photo_6)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_6, $model->photo_6);
                            if(!empty($model->photo_7)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_7, $model->photo_7);
                            if(!empty($model->photo_8)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_8, $model->photo_8);
                            if(!empty($model->photo_9)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_9, $model->photo_9);
                            if(!empty($model->photo_10)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_10, $model->photo_10);
                            if(!empty($model->photo_11)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_11, $model->photo_11);
                            if(!empty($model->photo_12)) $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $model->photo_12, $model->photo_12);

                            $documents = Document::model()->findAllByAttributes(array(
                                            "user_id"=>$model->creator_id,
                                            "list_type"=>"MLS",
                                            "list_id"=>$model->id,
                                    )
                            );

                            if(is_array($documents)){
                                    foreach($documents as $document){
                                            $zip->addFile(Yii::app()->params['imgUploader']['folder'] . $document->filename, $model->realname);
                                    }
                            }

                            $zip->close();

                            require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
                            $mail = new PHPMailer;
                            $mail->ClearAddresses();
                            $mail->From = Yii::app()->params['adminEmail'];
                            $mail->AddAddress($model->email);
                            $mail->AddAddress($model->email);
                            $mail->AddAddress(Yii::app()->params['mlsApprovedEmail']);
                            
                            // $email = split(",", Yii::app()->params['mlsApprovedEmail']);
                            // foreach($email as $k => $v){
                            //         $mail->AddBCC($v, " Person" . ($k+1));
                            // }
							//$mail->AddAddress('arvind@sprytechies.com');
                            /*$mail->AddBCC("support@wisenetware.com", "Person3");*/
                            $mail->FromName = "Flatratelist.com";
                            $mail->Subject = "Listing Information";
                            $mail->Body = "Here Your Listing Information. See the Attachment";
							if(file_exists('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.pdf")){
                            $mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.pdf", $model->id . "_" . $model->address . "_mls.pdf");
							}

							if(file_exists('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.zip")){
                            $mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.zip", $model->id . "_" . $model->address . "_mls.zip");
							}

                            $log = new SendMailLog();
                            $log->mail_type = $type;
                            $log->send_date = new CDbExpression("NOW()");
                            $log->comment = "MLS ID: {$model->id}";

                            if($mail->Send()){
                                    $log->send_success = true;

                            }else{
                                    $log->send_success = false;
                            }
                            $log->save();
                    }

                                            $doc = Document::model()->findByAttributes(array('list_type'=>'admin', 'realname'=>'Sellers Disclosure.pdf'));
                    $mail = new PHPMailer;
                    $mail->ClearAddresses();
                    $mail->From = Yii::app()->params['adminEmail'];
                    //$mail->AddAddress($model->email,$model->email); changed by Sprymohit on 4/july/2014, mailed by client

					//$mail->AddAddress('arvind@sprytechies.com');
                    // $email = split(",", Yii::app()->params['mlsApprovedEmail']);
                    // foreach($email as $k => $v){
                    //         $mail->AddBCC($v, " Person" . ($k+1));
                    // }
                    //$mail->AddAddress(Yii::app()->params['mlsApprovedEmail']);
                    $mail->AddAddress($model->email);
                            
                    $mail->FromName = "Flatratelist.com";
                    $mail->Subject = "Residential Sellers Disclosure";
                    $mail->Body = "Attached with this mail is Residential Sellers Disclosure Agreement.";
                    $mail->AddAttachment('/home/flatrate/public_html/upload/'.$doc->filename);
                    $log = new SendMailLog();
                    $log->mail_type = "Residential Sellers Disclosure";
                    $log->send_date = new CDbExpression("NOW()");
                    $log->comment = "MLS ID: {$model->id}";

                    if($mail->Send()){
                            $log->send_success = true;
                    }else{
                            $log->send_success = false;
                    }
                    $log->save();	


                    Yii::import('application.modules.user.models.*');
                    $count = Mls::model()->count("creator_id=:creator_id", array(":creator_id"=> $model->creator_id));
                    if($count == 10){
                            $code = strtoupper(substr(md5(uniqid() . $model->email), 0, 5));
                            $mail = new PHPMailer;
                            $mail->ClearAddresses();
                            $mail->From = Yii::app()->params['adminEmail'];
                            $mail->AddAddress($model->email);
                            $mail->FromName = "Flatratelist.com";
                            $mail->Subject = "Promo Code free listing after Your 10th listing";
                            $mail->Body = "Use this promo code for get your free listing : " . $code;
                            $mail->Send();


                            $profiles = Profile::model()->findByPk($model->creator_id);
                            $profiles->promocode = $code;
                            $profiles->save();
                    }		
            }
        }
        
        /**
         * land payment
         */
        public static function completeLandPayment($mls_id, $user_id, $token, $amount, $type){
            $model=Land::model()->findByPk($mls_id);
            $model->land_status = 'PAID';
            $model->paypal_trans_id = $token;
            if($model->save())
            {
                    $profile = Profile::model()->findByAttributes(array('user_id'=>$user_id));
                    $sales = new TrackSales();
                    $sales->item_name =$model->house_number.' '. $model->street_name;
                    $sales->pay = $amount;
                    $sales->payment_date = date("Y-m-d H:i:s");
                    $sales->paypal_trans_id = $token;
                    $sales->full_name = $profile->lastname . ", " . $profile->firstname;$sales->listing_type = $type;
                    $sales->listing_type = $type;
                    $sales->listing_id = $mls_id;
                    
                    $sales->save();
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
                            if($list->id === Yii::app()->params['CCActiveID'])
                                    $link = $list->id;
                    }

                    if(!empty($link)){
                            $search = $ct->searchContactsByEmail($model->email);

                            if($search){
                                    $contact = $ct->getContactDetails($search[0]);
                                    $contact->add1 = $model->street_name;
                                    $contact->city = $model->city;
                                    $contact->stateCode = $model->state;
                                    $contact->postalCode = $model->zip_code;
                                    $contact->customField4 = $model->list_price;
                                    $contact->optInSource = "ACTION_BY_CONTACT";
                                    $contact->customField2 = "VACANT LAND LISTING";
                                    $contact->lists[0] = $link;

                                    $ct->updateContact($contact);
                            }
                    }

                    /*
                    * Send Email With Attachment
                    */
					require('/home/flatrate/public_html/frameworks/PHPMailer_v5.1/class.phpmailer.php');
                    $mail = new PHPMailer;
                    $mail->ClearAddresses();
                    $mail->From = Yii::app()->params['adminEmail'];
                    $mail->AddAddress($model->emails);
                   // $mail->AddAddress('arvind@sprytechies.com');
                    $mail->AddBCC(Yii::app()->params['mlsApprovedEmail']);
                    $mail->FromName = "Flatratelist.com";
                    $mail->Subject = "Vacant Land Information";
                    $mail->Body = "Here Your Vacant Land Information. See the Attachment";
                    $mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->street_name . "_land.pdf", $model->id . "_" . $model->street_name . "_land.pdf");
                    $mail->Send();	
            }
        }
        
        
        /**
         * Jackson's sign payment
         */
        public static function completeJacksonPayment($model, $userid, $amount){

                $user = User::model()->findByPk($model->iduser);
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
					$mail->ClearAddresses();
					
                    $mail = new PHPMailer;
                    $mail->ClearAddresses();
                    $mail->From = Yii::app()->params['adminEmail'];
                    // $mail->AddAddress('arvind@sprytechies.com');
					$mail->AddAddress(Yii::app()->params['mlsApprovedEmail']);
                    $mail->AddAddress('art@jacksonsignshop.com');
                    $mail->FromName = "Flatratelist.com";
                    $mail->Subject = "A user (id:{$user->id}) has bought a Sign on Flatratelist.com";
                    $mail->Body = "Hello<br/>
                            A user has bought a sign and made complete payment on flatratelist.com. <br><br>

                            <b>User Details</b><br>
                            First Name: {$user->profile->firstname}<br>
                            Last Name:  {$user->profile->lastname}<br>
                            Shipping Address:  {$model->baddress}<br>
                            Shipping City:  {$model->scity}<br>
                            Shipping Country:  {$model->scountry}<br>
                            Shipping Zip Code:  {$model->szipcode}<br>
                            Billing Address:  {$model->baddress}<br>
                            Billing City:  {$model->bcity}<br>
                            Billing Country:  {$model->bcountry}<br>
                            Billing Zip Code:  {$model->bzip}<br>
                            Phone:  {$model->phone}<br>
                            Email:  {$user->email} <br>
                            Stripe transaction code: {$model->transaction_id}<br><br>

                            <br/>Please click on the link given below to update the status of delivery.<br/>
                            <a href=".('http://flatratelist.com/'.Yii::app()->createUrl('signs/statusUpdate',array('k'=>$model->idlink))).">Click here</a><br/><br/>
                            Regards,<br/>
                            Flatratelist.com Team
                    ";
                    $mail->IsHTML(true);
                    $mail->Send();
                }




        }
}

?>

<?php

class MlsController extends Controller
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
			//'rights',
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
				'actions'=>array('ipn'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','view','update', 'delete', 'admin','upload','print','approve','cancel','success','incomplete','load','deletein','reqUpdate','pending','sold', 'populate', 'popListing', 'useCode', 'managePending', 'manageSold' ,'autosave'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','create','view','admin','delete','upload','print','approve','cancel','success','incomplete','load','deletein','reqUpdate','pending','sold', 'populate', 'popListing', 'useCode', 'status', 'managePending', 'manageSold' ,'autosave'),
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
		$model=$this->loadModel($id);
		$docs = Document::model()->findAllByAttributes(array("list_type"=>"MLS", "list_id"=>$id));
		$this->actionPrint($id, array(), TRUE);
		$this->render('view',array(
			'model'=>$model,
			'docs' => $docs,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Mls;
		$doc = new Document;
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Mls']))
		{
			if( isset($_POST['yt0']) && $_POST['yt0'] == 'Save as incomplete' )
				$model->list_status = 'INCOMPLETE';
			if( isset($_POST['yt1']) && $_POST['yt1'] == 'Save and View My Listing' )
				$model->list_status = 'COMPLETED';
				
			$model->attributes=$_POST['Mls'];
			if($model->save()){
				$dump = new ListDump();
				$dump->dump = serialize($model->attributes);
				$dump->save();
				$model->dump_id = $dump->id_list_dump;
				$model->save();
				if(isset($_POST['Document'])){
					$doc->attributes = $_POST['Document'];
					if(is_array($doc->filename)){
						foreach($doc->filename as $k => $v){
							$tempDoc = new Document;
							$tempDoc->user_id = Yii::app()->user->id;
							$tempDoc->list_type = "MLS";
							$tempDoc->list_id = $model->id;
							$tempDoc->filename = $v;
							$tempDoc->save();
						}
					}else{
						$doc->save();
                                               
					}
				}
                                 $incomplete = Incomplete::model()->findByAttributes(array('userid'=>$model->creator_id, 'address'=>$model->address));
                                                if(isset($incomplete))
                                                    $incomplete->delete();
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'doc' => $doc,
		));
	}


	public function actionCancel()
	{
		$this->render('cancel');
	}

	public function actionSuccess()
	{
		$po = array();
		foreach($_POST as $k => $v){
			$po[$k] = $v;
		}
		$this->render('success', array('pp'=>$po));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$doc = new Document;
                $attributes = array();

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Mls']))
		{
			if( isset($_POST['yt0']) && $_POST['yt0'] == 'Update as incomplete' )
				$model->list_status = 'INCOMPLETE';
			if( isset($_POST['yt1']) && $_POST['yt1'] == 'Save and View My Listing' )
				$model->list_status = 'COMPLETED';

			$model->attributes=$_POST['Mls'];
			if($model->save()){
				if(isset($_POST['Document'])){
					$doc->attributes = $_POST['Document'];
					if(is_array($doc->filename)){
						foreach($doc->filename as $k => $v){
							$tempDoc = new Document;
							$tempDoc->user_id = Yii::app()->user->id;
							$tempDoc->list_type = "MLS";
							$tempDoc->list_id = $model->id;
							$tempDoc->filename = $v;
							$tempDoc->save();
						}
					}else{
						$doc->save();
					}
                                        $incomplete = Incomplete::model()->findByAttributes(array('userid'=>$model->creator_id, 'address'=>$model->address));
                                        if(isset($incomplete))
                                            $incomplete->delete();
				}
                                
                                if( !isset($_POST['ajax'])){
                                    
                                    if($model->dump_id){
                                        $dumpmodel = ListDump::model()->findByPk($model->dump_id);
                                        $attributes = unserialize($dumpmodel->dump);
                                        $dumpmodel->dump = serialize($model->attributes);
                                        $dumpmodel->save();
                                    }else{
                                        $dumpmodel = new ListDump();
                                        $dumpmodel->dump = serialize($model->attributes);
                                        $dumpmodel->save();
                                        $model->dump_id = $dumpmodel->id_list_dump;
                                        $model->save();
                                        $attributes = $model->attributes;
                                    }
                                    
                                    
                                    $updates = $this->checkUpdates($attributes, $_POST['Mls']);
									if(!($this->checkChanges($updates))){
										$this->redirect(array('view','id'=>$model->id));
									}
                                    
                                    require('/home4/flatrate/public_html/frameworks/PHPMailer_v5.1/class.phpmailer.php');
                                    $this->actionPrint($model->id, $updates, TRUE);

                                    $mail = new PHPMailer;
                                    $mail->ClearAddresses();
                                    $mail->From = $model->email;
                                    $email = split(",", Yii::app()->params['mlsApprovedEmail']);
									//$email = split(",", 'arvind@sprytechies.com');
                                    foreach($email as $k => $v){
                                            $mail->AddAddress($v, $v);
                                    }
                                    $mail->FromName = "Flatratelist.com";
                                    $mail->Subject = "Listing Update Information";
                                    $mail->Body = "Here Listing Information:<br/>
                                            MLS ID: {$model->id}<br/>
                                            Email : {$model->email}<br/>
                                            Address : {$model->address}.<br/><br/>

                                            For more information see the attachment.
                                    ";
                                    $mail->AddAttachment('/home4/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.pdf", $model->id . "_" . $model->address . "_mls.pdf");
                                    $mail->IsHTML(true);
                                    $mail->Send(); 
                                }
				
                                
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionIncomplete()
	{
		if($_POST['incompleteID'] == 0){
                    $id = $this->checkincomplete($_POST['Mls']);
                        if($id){
                            $model = Incomplete::model()->findByPk($id);
							$model->userid = $_POST['Mls']['creator_id'];
                        }else{
                            $model = new Incomplete;
                        }
		}else{
			$model = Incomplete::model()->findByPk($_POST['incompleteID']);
		}
                
		$model->address = $_POST['Mls']['address'];
		$model->data = json_encode($_POST['Mls']);	
		if($model->save())
			echo 'Saved as incomplete';
		else
			echo 'Failed, address required';
		Yii::app()->end();
	}
	
		/**
         * checks for a incomplete listing with similar address and userid
         */
        public function checkincomplete($post){
                $incompletes = Incomplete::model()->findAllByAttributes(array('userid'=>$post['creator_id']));
                foreach($incompletes as $incomplete){
                    $data = json_decode($incomplete->data);
                    if(strtolower(trim($data->address)) == strtolower(trim($post['address']))){
                       return $incomplete->id; 
                    }
                }
                return Null;
        }
	
	   /**
         * autosave function
         */
        public function actionautoSave(){
            if( $_POST['incompleteID'] ){
                $incomplete = Incomplete::model()->findByPk($_POST['incompleteID']);
                $incomplete->address = $_POST['Mls']['address'];
                $incomplete->data = json_encode($_POST['Mls']);
                $incomplete->save();
                echo $incomplete->id;
            }elseif( $_POST['Mls']['address'] && !$_POST['incompleteID'] ){
                $incomplete = Incomplete::model()->findByAttributes(array('userid'=>$_POST['Mls']['creator_id'], 'address'=>$_POST['Mls']['address']));
                if($incomplete && isset($incomplete)){
                    $incomplete->data = json_encode($_POST['Mls']);
                    $incomplete->save();
                    echo $incomplete->id;
                }else{
                    $incomplete = new Incomplete;
                    $incomplete->userid = $_POST['Mls']['creator_id'];
                    $incomplete->address = $_POST['Mls']['address'];
                    $incomplete->data = json_encode($_POST['Mls']);
                    $incomplete->save();
                    echo $incomplete->id;
                }
            }
            Yii::app()->end();
        }

	public function actionDeletein($id)
	{
		$model = new Incomplete;
		$model = Incomplete::model()->findByPk($id);
		$model->delete();
		$this->redirect('mls/admin');
	}

	public function actionLoad($id)
	{
		Yii::app()->session->add('ic',$id);
		$this->redirect(array('mls/create'));
	}


	public function actionIpn()
	{
		$fx = fopen("test.txt", 'w');
		fwrite($fx, "TEST");
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

		$mls_id = "";
		try {
			if(isset($_POST['custom']) && !empty($_POST['custom']) && isset($_POST['txn_id']) && !empty($_POST['txn_id']))
			{
				$model=Mls::model()->ipn()->findByPk($_POST['custom']);
				$model->list_status = 'PAID';
				$model->paypal_trans_id = $_POST['txn_id'];
				if($model->save())
				{
					$sales = new TrackSales();
					$sales->item_name = $_POST['item_name'];
					$sales->pay = $_POST['mc_gross'];
					$sales->payment_date = $_POST['payment_date'];
					$sales->paypal_trans_id = $_POST['txn_id'];
					$sales->full_name = $_POST['last_name'] . ", " . $_POST['first_name'];
					$sales->listing_type = "MLS";
					$sales->listing_id = $_POST['custom'];
					
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
						$mail->AddAddress($model->email,$model->email);
						$email = split(",", Yii::app()->params['mlsApprovedEmail']);
						foreach($email as $k => $v){
							$mail->AddBCC($v, " Person" . ($k+1));
						}
						/*$mail->AddBCC("support@wisenetware.com", "Person3");*/
						$mail->FromName = "Flatratelist.com";
						$mail->Subject = "Listing Information";
						$mail->Body = "Here Your Listing Information. See the Attachment";
						$mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.pdf", $model->id . "_" . $model->address . "_mls.pdf");
						$mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->address . "_mls.zip", $model->id . "_" . $model->address . "_mls.zip");
						
						$log = new SendMailLog();
						$log->mail_type = "MLS";
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
                                        $mail->AddAddress($model->email,$model->email);
                                        $email = split(",", Yii::app()->params['mlsApprovedEmail']);
                                        foreach($email as $k => $v){
                                                $mail->AddBCC($v, " Person" . ($k+1));
                                        }
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
		} catch (Exception $e) {
    		$error = $e->getMessage();
		}

		$myFile = Yii::app()->params['ipnLogPath'] . "/" . date("Ymd_His") . "_" . $model->id  .  ".txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $post . "\n" . "MLS ID=" . $model->id);
		fclose($fh);
		
		Yii::app()->end(); 
	}

	public function actionApprove($id, $survey = FALSE)
	{
		$model=$this->loadModel($id);
		//print_r($_POST);die();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//if(isset($_POST['chkAgree']))
		//{
			if(($model->list_status == 'COMPLETED' || $model->list_status == 'APPROVED'))
			{
				$model->list_status = 'APPROVED';
				if($model->save()){
					$incomplete = Incomplete::model()->findByAttributes(array('userid'=>$model->creator_id, 'address'=>$model->address));
                                        if(isset($incomplete))
                                            $incomplete->delete();
                                        
					$this->redirect(array('/listing/survey/create/mls_id/' . $id));
						
/*					if($survey)
						$this->redirect(array('/listing/survey/create/mls_id/' . $id));
					else
						$this->redirect('https://sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HCJYN2MTFFGRA' . "&custom=" . $model->id);*/
				}
			}
		
		//} else {
		//	$model->addError('chkAgree','Please check agree to approve.');
		//}
		
		$this->render('view',array(
			'model'=>$model,'post'=>$_POST
		));
		
	}
	
	public function actionPending($id){
		$model = $this->loadModel($id);
		
		if($model->list_status == "PAID"){
			$model->list_status = "PENDING";
			$model->estimated_sold = $_POST['estimated_close_date'];
			if($model->save()){
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
					if($list->id === Yii::app()->params['CCPendingID'])
						$link = $list->id;
				}
				
				if(!empty($link)){
					$search = $ct->searchContactsByEmail($model->email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->customField15 = $_POST['estimated_sold_date'];
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				$this->redirect(array('/listing/mls/admin'));
			}
		}
	}
	
	public function actionSold($id){
		$model = $this->loadModel($id);
		
		if($model->list_status == "PENDING"){
			$model->list_status = "SOLD";
			if($model->save()){
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
					$search = $ct->searchContactsByEmail($model->email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->customField14 = date("Y-m-d");
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				$this->redirect(array('/listing/mls/admin'));
			}
		}
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
			$model=$this->loadModel($id);
			
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
		$dataProvider=new CActiveDataProvider('Mls');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
/*		$documents = Document::model()->findAllByAttributes(array(
								"user_id"=>59,
								"list_type"=>"MLS",
								"list_id"=>4,
							)
						);
						print_r($documents);
						if(is_array($documents)){
							foreach($documents as $document){
								$zip->addFile(Yii::app()->params['imgUploader']['folder'] . $document->filename, $model->realname);
							}
						}*/
						
		$model=new Mls('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mls']))
			$model->attributes=$_GET['Mls'];
			
		$model2 = new Incomplete;
	    $model2->unsetAttributes();
	  	if(Yii::app()->user->isAdmin())
			$model2 = Incomplete::model()->findAll();
		else
			$model2 = Incomplete::model()->findAll('userid=:uid' , array('uid'=>Yii::app()->user->id));

		$this->render('admin',array(
			'model'=>$model,'model2'=>$model2
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		if(Yii::app()->user->isAdmin())
		{
			$model=Mls::model()->findByPk($id);
		} else {
			$model=Mls::model()->owner()->findByPk($id);
		}
		
		//$model=Mls::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='mls-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionUpload()
	{
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            
            $uploader = new qqFileUploader(Yii::app()->params['imgUploader']['allowedExtensions'] , Yii::app()->params['imgUploader']['sizeLimit'] );
            
            $result = $uploader->handleUpload(Yii::app()->params['imgUploader']['folder']);
            $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            
            echo $result;// it's array
	}
	
	public function actionPrint($id, $updates=array() , $saveLocal=FALSE )
	{
               // print_r($updates);die();
		require(Yii::app()->basePath.'/../frameworks/tcpdf/tcpdf.php');
		$data = $this->loadModel($id);
		if(!empty($data))
		{
//			$pdf = new FPDF();
			$pdf = new TCPDF();

			$pdf->AddPage();
			$pdf->SetTitle('LISTING: ' . $data->address.','.$data->city, false);
			$pdf->SetMargins(10,10,10);

			$pdf->SetFont('helvetica','B',14);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,8,'Listing: ' . $data->address.','.$data->city,1,1,'C',true);
			
			if(!empty($data->photo_1))
			{
				$pdf->Image(Yii::app()->basePath.'/../upload/' . $data->photo_1 , 10, 20, 50, 50);  
			} else {
				$pdf->Image(Yii::app()->basePath.'/../themes/custom/css/images/photo_not_available.png', 10, 20, 50, 50);  
			}
			
			$images = array();
			for($i=1; $i<=12; $i++){
				$text = "photo_$i";
				if(!empty($data->$text) && isset($data->$text) && !is_null($data->$text))
					array_push($images, $data->$text);
			}

			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
			$pdf->SetXY(60,20);
                        
                        if(isset($updates['city']) && $updates['city'] == 1){ 
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'City: ' . $data->city,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'City: ' . $data->city,0,0);
                           
                        }
                        if(isset($updates['state']) && $updates['state'] == 1){ 
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'State: ' . $data->state,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'State: ' . $data->state,0,0);
                           
                        }
                        
                        $pdf->SetXY(60,24);
                        if(isset($updates['county']) && $updates['county'] == 1){ 
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'County: ' . $data->county,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'County: ' . $data->county,0,0);
                           
                        }
                        if(isset($updTCPDFates['zip_code']) && $updates['zip_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Zip Code: ' . $data->zip_code,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Zip Code: ' . $data->zip_code,0,1);
                        }
                        
			$pdf->SetXY(60,28);
                        if(isset($updates['unit_number']) && $updates['unit_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Unit #: ' . $data->unit_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Unit #: ' . $data->unit_number,0,0);
                        }
                        if(isset($updates['legal_subdivision_name']) && $updates['legal_subdivision_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Sub. Name: ' . strtoupper($data->legal_subdivision_name),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Sub. Name: ' . strtoupper($data->legal_subdivision_name),0,1);
                        }
			
			$pdf->SetXY(60,32);
                        if(isset($updates['home_phone']) && $updates['home_phone'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Home Phone: ' . $data->home_phone,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Home Phone: ' . $data->home_phone,0,0);
                        }
                        if(isset($updates['mobile_phone']) && $updates['mobile_phone'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Mobile Phone: ' . strtoupper($data->mobile_phone),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Mobile Phone: ' . strtoupper($data->mobile_phone),0,1);
                        }
			
			$pdf->SetXY(60,36);
                        if(isset($updates['list_price']) && $updates['list_price'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'List Price: $' . number_format($data->list_price,0),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'List Price: $' . number_format($data->list_price,0),0,0);
                        }
                        if(isset($updates['bedrooms']) && $updates['bedrooms'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Beds: ' . $data->bedrooms,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Beds: ' . $data->bedrooms,0,1);
                        }
			
			
			
			$pdf->SetXY(60,40);
                        if(isset($updates['full_baths']) && $updates['full_baths'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Baths: ' . $data->full_baths . "/" . $data->half_baths,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Baths: ' . $data->full_baths . "/" . $data->half_baths,0,0);
                        }
                        if(isset($updates['sq_ft_heated']) && $updates['sq_ft_heated'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'SqFt Heated: ' . $data->sq_ft_heated,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'SqFt Heated: ' . $data->sq_ft_heated,0,1);
                        }
			
			
			
			$pdf->SetXY(60,44);
                        if(isset($updates['private_pool_yn']) && $updates['private_pool_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Private Pool: ' . $data->private_pool_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Private Pool: ' . $data->private_pool_yn,0,0);
                        }
                        if(isset($updates['year_built']) && $updates['year_built'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Year Built: '. $data->year_built,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Year Built: '. $data->year_built,0,1);
                        }
			
			
			
			$pdf->SetXY(60,48);
                        if(isset($updates['total_acreage']) && $updates['total_acreage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Total Acreage: ' . $data->total_acreage,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Total Acreage: ' . $data->total_acreage,0,0);
                        }
                        if(isset($updates['sq_ft_heated']) && $updates['sq_ft_heated'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Total SqFt: '. $data->sq_ft_heated,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Total SqFt: '. $data->sq_ft_heated,0,1);
                        }
			
			
			
			$pdf->SetXY(60,52);
                        if(isset($updates['pets_allowed_yn']) && $updates['pets_allowed_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Pets Y/N: ' . $data->pets_allowed_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Pets Y/N: ' . $data->pets_allowed_yn,0,0);
                        }
                        if(isset($updates['construction_status']) && $updates['construction_status'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Construction Status: ' . $data->construction_status,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Construction Status: ' . $data->construction_status,0,1);
                        }
			
			
			
			$pdf->SetXY(60,56);
                        if(isset($updates['projected_completion_date']) && $updates['projected_completion_date'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Proj. Comp. Date: ' . $data->projected_completion_date,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Proj. Comp. Date: ' . $data->projected_completion_date,0,1);
                        }
                        
                        $pdf->SetXY(130,56);
                        if(isset($updates['billing_address']) && $updates['billing_address'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Billing Address: ' . $data->billing_address,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Billing Address: ' . $data->billing_address,0,1);
                        }
			
			
			$pdf->SetXY(60,60);
                        if(isset($updates['special_sale_provision']) && $updates['special_sale_provision'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Special Sale: ' . str_replace('|', ',', $data->special_sale_provision),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Special Sale: ' . str_replace('|', ',', $data->special_sale_provision),0,'L');
                        }
			
                        $pdf->SetXY(130,60);
                        if(isset($updates['billing_city']) && $updates['billing_city'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Billing City: ' . $data->billing_city,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Billing City: ' . $data->billing_city,0,1);
                        }
			
			$pdf->SetXY(60,64);
                        if(isset($updates['property_style']) && $updates['property_style'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Property: ' . str_replace('|', ',', $data->property_style),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Property: ' . str_replace('|', ',', $data->property_style),0,'L');
                        }
			
			$pdf->SetXY(130,64);
                        if(isset($updates['billing_state']) && $updates['billing_state'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Billing State: ' . $data->billing_state,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Billing State: ' . $data->billing_state,0,1);
                        }
                        
			$pdf->SetXY(60,68);
                        if(isset($updates['location_max']) && $updates['location_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Location: ' . str_replace('|', ',', $data->location_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Location: ' . str_replace('|', ',', $data->location_max),0,'L');
                        }
			
                        $pdf->SetXY(130,68);
                        if(isset($updates['billing_zip_code']) && $updates['billing_zip_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Billing Zip Code: ' . $data->billing_zip_code,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Billing Zip Code: ' . $data->billing_zip_code,0,1);
                        }
                        
                        $pdf->SetXY(170,68);
                        if(isset($updates['zip_plus']) && $updates['zip_plus'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(70,4,'Zip Plus: ' . $data->zip_plus,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(70,4,'Zip Plus: ' . $data->zip_plus,0,1);
                        }
			
			$pdf->SetXY(10,75);
                        if(isset($updates['public_remarks']) && $updates['public_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,6, $data->public_remarks,0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,20, $data->public_remarks,0,'L');
                        }
			
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Land, Site and Tax Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
                        if(isset($updates['subdivision_number']) && $updates['subdivision_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Subdivision #: ' . $data->subdivision_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Subdivision #: ' . $data->subdivision_number,0,0);
                        }
                        if(isset($updates['section']) && $updates['section'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Section: ' . $data->section,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Section: ' . $data->section,0,0);
                        }
                        if(isset($updates['block_parcel']) && $updates['block_parcel'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Block / Parcel: ' . $data->block_parcel,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Block / Parcel: ' . $data->block_parcel,0,0);
                        }
                        if(isset($updates['front_exposure']) && $updates['front_exposure'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Front Exposure: ' . $data->front_exposure,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Front Exposure: ' . $data->front_exposure,0,1);
                        }
			if(isset($updates['tax_id']) && $updates['tax_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Tax ID: ' . $data->tax_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Tax ID: ' . $data->tax_id,0,0);
                        }
                        if(isset($updates['additional_parcel_yn']) && $updates['additional_parcel_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Additional Parcel: ' . $data->additional_parcel_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Additional Parcel: ' . $data->additional_parcel_yn,0,0);
                        }
                        
                        if(isset($updates['lot_number']) && $updates['lot_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Lot #: ' . $data->lot_number,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Lot #: ' . $data->lot_number,0,1);
                        }
                        if(isset($updates['taxes']) && $updates['taxes'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Taxes: $' . number_format($data->taxes,0),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Taxes: $' . number_format($data->taxes,0),0,0);
                        }
                        if(isset($updates['tax_year']) && $updates['tax_year'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Tax Year: ' . $data->tax_year,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Tax Year: ' . $data->tax_year,0,0);
                        }
                        if(isset($updates['homestead_yn']) && $updates['homestead_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Homestead: ' . $data->homestead_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Homestead: ' . $data->homestead_yn,0,0);
                        }
                        if(isset($updates['other_exemptions_yn']) && $updates['other_exemptions_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Other Exemptions: ' . $data->other_exemptions_yn,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Other Exemptions: ' . $data->other_exemptions_yn,0,1);
                        }
			
			
			if(isset($updates['cdd_yn']) && $updates['cdd_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'CDD: ' . $data->cdd_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'CDD: ' . $data->cdd_yn,0,0);
                        }
                        if(isset($updates['annual_cdd_fee']) && $updates['annual_cdd_fee'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Annual CDD Fee: $' . number_format($data->annual_cdd_fee,0),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Annual CDD Fee: $' . number_format($data->annual_cdd_fee,0),0,0);
                        }
                        if(isset($updates['plat_book_page']) && $updates['plat_book_page'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Book/Page: ' . $data->plat_book_page,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Book/Page: ' . $data->plat_book_page,0,0);
                        }
                        if(isset($updates['complex_community_name']) && $updates['complex_community_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Comp./Com. Name: ' . $data->complex_community_name,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Comp./Com. Name: ' . $data->complex_community_name,0,1);
                        }
			
			
			if(isset($updates['building_number_floors']) && $updates['building_number_floors'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Floor #: ' . $data->building_number_floors,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Floor #: ' . $data->building_number_floors,0,0);
                        }
                        if(isset($updates['zoning']) && $updates['zoning'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Zoning: ' . $data->zoning,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Zoning: ' . $data->zoning,0,0);
                        }
                        if(isset($updates['future_land_use']) && $updates['future_land_use'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Future Land Use: ' . $data->future_land_use,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Future Land Use: ' . $data->future_land_use,0,0);
                        }
                        if(isset($updates['lot_dimensions']) && $updates['lot_dimensions'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Lot Dimesions' . $data->lot_dimensions,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Lot Dimesions' . $data->lot_dimensions,0,1);
                        }
			
			
			
			if(isset($updates['lot_size_acre']) && $updates['lot_size_acre'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Lot Size(Acres): ' . $data->lot_size_acre,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Lot Size(Acres): ' . $data->lot_size_acre,0,0);
                        }
                        if(isset($updates['lot_size_sq_ft']) && $updates['lot_size_sq_ft'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Lot Size(SqFt): ' . $data->lot_size_sq_ft,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Lot Size(SqFt): ' . $data->lot_size_sq_ft,0,0);
                        }
                        if(isset($updates['water_access_yn']) && $updates['water_access_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Water Access Y/N: ' . $data->water_access_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Water Access Y/N: ' . $data->water_access_yn,0,0);
                        }
                        if(isset($updates['water_view_yn']) && $updates['water_view_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Water View Y/N: ' . $data->water_view_yn,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Water View Y/N: ' . $data->water_view_yn,0,1);
                        }
                        if(isset($updates['water_frontage_yn']) && $updates['water_frontage_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Water Frontage Y/N: ' . $data->water_frontage_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Water Frontage Y/N: ' . $data->water_frontage_yn,0,0);
                        }
			if(isset($updates['water_view']) && $updates['water_view'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(47.5,4,'Water View: ' . str_replace('|', ',', $data->water_view),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(47.5,4,'Water View: ' . str_replace('|', ',', $data->water_view),0,1);
                        }
                        if(isset($updates['water_frontage']) && $updates['water_frontage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Water Frontage: ' . $data->water_frontage,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Water Frontage: ' . $data->water_frontage,0,0);
                        }
                        if(isset($updates['water_access']) && $updates['water_access'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Water Access: ' . $data->water_access,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Water Access: ' . $data->water_access,0,1);
                        }
                        if(isset($updates['condo_floor_number']) && $updates['condo_floor_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Condo Floor #: ' . $data->condo_floor_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Condo Floor #: ' . $data->condo_floor_number,0,0);
                        }
                        if(isset($updates['building_name_number']) && $updates['building_name_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Building Name #: ' . $data->building_name_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Building Name #: ' . $data->building_name_number,0,0);
                        }
                        if(isset($updates['floors_in_unit']) && $updates['floors_in_unit'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Floor in unit: ' . $data->floors_in_unit,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Floor in unit: ' . $data->floors_in_unit,0,0);
                        }
                        if(isset($updates['total_units']) && $updates['total_units'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Total Unit: ' . $data->total_units,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Total Unit: ' . $data->total_units,0,1);
                        }
                        if(isset($updates['millage_rate']) && $updates['millage_rate'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Millage Rate: ' . $data->millage_rate,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Millage Rate: ' . $data->millage_rate,0,0);
                        }
                        if(isset($updates['range']) && $updates['range'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Range: ' . $data->range,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Range: ' . $data->range,0,0);
                        }
                        if(isset($updates['township']) && $updates['township'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Township: ' . $data->township,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Township: ' . $data->township,0,0);
                        }
                        if(isset($updates['subdivision_section_number']) && $updates['subdivision_section_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Subdivision Section Number: ' . $data->subdivision_section_number,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Subdivision Section Number: ' . $data->subdivision_section_number,0,1);
                        }
                        if(isset($updates['total_building_sq_ft']) && $updates['total_building_sq_ft'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Total Building Sq. ft.: ' . $data->total_building_sq_ft,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Total Building Sq. ft.: ' . $data->total_building_sq_ft,0,1);
                        }
                        if(isset($updates['home_features_max']) && $updates['home_features_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(190,4,'Home Feature: ' . $data->home_features_max,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(190,4,'Home Feature: ' . $data->home_features_max,0,1);
                        }
                        if(isset($updates['legal_description']) && $updates['legal_description'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Legal Desciption: ' . $data->legal_description,0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Legal Desciption: ' . $data->legal_description,0,'L');
                        }
                        
                        if(isset($updates['lot_size_sq_ft']) && $updates['lot_size_sq_ft'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(47.5,4,'Lot Size(SqFt): ' . $data->lot_size_sq_ft,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(47.5,4,'Lot Size(SqFt): ' . $data->lot_size_sq_ft,0,0);
                        }
                        
                         if(isset($updates['financing_available_max']) && $updates['financing_available_max'] == 1){    
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Financing Available (10 Max): ' . str_replace('|', ',', $data->financing_available_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Financing Available (10 Max):' . str_replace('|', ',', $data->financing_available_max),0,'L');
                        }
                         if(isset($updates['realtor_information_max']) && $updates['realtor_information_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Realtor Information (25 Max): ' . str_replace('|', ',', $data->realtor_information_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Realtor Information (25 Max): ' . str_replace('|', ',', $data->realtor_information_max),0,'L');
                        }
                         if(isset($updates['realtor_information_confidential_max']) && $updates['realtor_information_confidential_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Realtor Information (Confidential) 7 Max:  ' . str_replace('|', ',', $data->realtor_information_confidential_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Realtor Information (Confidential) 7 Max:  ' . str_replace('|', ',', $data->realtor_information_confidential_max),0,'L');
                        }
                        
			
			
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Interior Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
                        
                        if(isset($updates['living_room']) && $updates['living_room'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Living Room: ' . $data->living_room,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Living Room: ' . $data->living_room,0,0);
                        }
                        if(isset($updates['family_room']) && $updates['family_room'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Family Room: ' . $data->family_room,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Family Room: ' . $data->family_room,0,0);
                        }
                        if(isset($updates['kitchen']) && $updates['kitchen'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Kitchen: ' . $data->kitchen,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Kitchen: ' . $data->kitchen,0,0);
                        }
                        if(isset($updates['great_room']) && $updates['great_room'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Great Room: ' . $data->great_room,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Great Room: ' . $data->great_room,0,0);
                        }
                        if(isset($updates['dining_room']) && $updates['dining_room'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Dining Room: ' . $data->dining_room,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Dining Room: ' . $data->dining_room,0,1);
                        }
			
			
			if(isset($updates['master_bedroom_size']) && $updates['master_bedroom_size'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Master Bedroom: ' . $data->master_bedroom_size,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Master Bedroom: ' . $data->master_bedroom_size,0,0);
                        }
                        if(isset($updates['study_den_dimensions']) && $updates['study_den_dimensions'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Study / Den: ' . $data->study_den_dimensions,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Study / Den: ' . $data->study_den_dimensions,0,0);
                        }
                        if(isset($updates['studio_dimensions']) && $updates['studio_dimensions'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Studio : ' . $data->studio_dimensions,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Studio : ' . $data->studio_dimensions,0,0);
                        }
                        if(isset($updates['balcony_porch_lanai']) && $updates['balcony_porch_lanai'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Balcony/Porch: ' . $data->balcony_porch_lanai,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Balcony/Porch: ' . $data->balcony_porch_lanai,0,0);
                        }
                        if(isset($updates['dinette']) && $updates['dinette'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Dinnete: ' . $data->dinette,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Dinnete: ' . $data->dinette,0,1);
                        }
			
			
			
			if(isset($updates['bedroom_2nd_size']) && $updates['bedroom_2nd_size'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'2nd Bedroom: ' . $data->bedroom_2nd_size,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'2nd Bedroom: ' . $data->bedroom_2nd_size,0,0);
                        }
                        if(isset($updates['bedroom_3rd_size']) && $updates['bedroom_3rd_size'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'3rd Bedroom: ' . $data->bedroom_3rd_size,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'3rd Bedroom: ' . $data->bedroom_3rd_size,0,0);
                        }
                        if(isset($updates['bedroom_4th_size']) && $updates['bedroom_4th_size'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'4th Bedroom: ' . $data->bedroom_4th_size,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'4th Bedroom: ' . $data->bedroom_4th_size,0,0);
                        }
                        if(isset($updates['bedroom_5th_size']) && $updates['bedroom_5th_size'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'5th Bedroom: ' . $data->bedroom_5th_size,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'5th Bedroom: ' . $data->bedroom_5th_size,0,1);
                        }
			
			
			
			
			if(isset($updates['air_conditioning_max']) && $updates['air_conditioning_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Air Cond.: ' . str_replace('|', ',', $data->air_conditioning_max),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Air Cond.: ' . str_replace('|', ',', $data->air_conditioning_max),0,0);
                        }
                        if(isset($updates['sq_ft_source']) && $updates['sq_ft_source'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Sq.Ft. Source: ' . $data->sq_ft_source,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Sq.Ft. Source: ' . $data->sq_ft_source,0,0);
                        }
                        if(isset($updates['security_system']) && $updates['security_system'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Security Sys: ' . str_replace('|', ',', $data->security_system),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Security Sys: ' . str_replace('|', ',', $data->security_system),0,0);
                        }
                        if(isset($updates['fireplace_yn']) && $updates['fireplace_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Fireplace: ' . $data->fireplace_yn,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Fireplace: ' . $data->fireplace_yn,0,1);
                        }
                        
			
			
			
			
			if(isset($updates['floor_covering_max']) && $updates['floor_covering_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(95,4,'Floor Covering: ' . str_replace('|', ',', $data->floor_covering_max),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(95,4,'Floor Covering: ' . str_replace('|', ',', $data->floor_covering_max),0,0);
                        }
                        if(isset($updates['heating_and_fuel_max']) && $updates['heating_and_fuel_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(95,4,'Heat & Fuel: ' . str_replace('|', ',', $data->heating_and_fuel_max),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(95,4,'Heat & Fuel: ' . str_replace('|', ',', $data->heating_and_fuel_max),0,1);
                        }
                        if(isset($updates['kitchen_features_max']) && $updates['kitchen_features_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(95,4,'Kitchen Features :' . str_replace('|', ',', $data->kitchen_features_max),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(95,4,'Kitchen Features :' . str_replace('|', ',', $data->kitchen_features_max),0,0);
                        }
                        if(isset($updates['master_bath_features_max']) && $updates['master_bath_features_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(95,4,'Master Bath: ' . str_replace('|',',', $data->master_bath_features_max),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(95,4,'Master Bath: ' . str_replace('|',',', $data->master_bath_features_max),0,1);
                        }
                        if(isset($updates['utilities_data_max']) && $updates['utilities_data_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(190,4,'Utilities Data: ' . str_replace('|', ',', $data->utilities_data_max),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(190,4,'Utilities Data: ' . str_replace('|', ',', $data->utilities_data_max),0,1);
                        }
                        if(isset($updates['interior_layout_max']) && $updates['interior_layout_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(190,4,'Interior Layout: ' . str_replace('|', ',', $data->interior_layout_max),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(190,4,'Interior Layout: ' . str_replace('|', ',', $data->interior_layout_max),0,1);
                        }
                        if(isset($updates['appliances_included_max']) && $updates['appliances_included_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Appliance Includes: ' . str_replace('|', ',', $data->appliances_included_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Appliance Includes: ' . str_replace('|', ',', $data->appliances_included_max),0,'L');
                        }
                        if(isset($updates['interior_features_max']) && $updates['interior_features_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Interior Features: ' . str_replace('|', ',', $data->interior_features_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Interior Features: ' . str_replace('|', ',', $data->interior_features_max),0,'L');
                        }
                        if(isset($updates['additional_rooms_max']) && $updates['additional_rooms_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Additional Room: ' . str_replace('|', ',', $data->additional_rooms_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Additional Room: ' . str_replace('|', ',', $data->additional_rooms_max),0,'L');
                        }
                        
			
			
			
			
			
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Exterior Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
                        
                        if(isset($updates['garage_carport_max']) && $updates['garage_carport_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Garage / Carport: ' . str_replace('|', ',', $data->garage_carport_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Garage / Carport: ' . str_replace('|', ',', $data->garage_carport_max),0,'L');
                        }
                        if(isset($updates['garage_dimensions']) && $updates['garage_dimensions'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Garage Dimensions: ' . str_replace('|', ',', $data->garage_dimensions),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Garage Dimensions: ' . str_replace('|', ',', $data->garage_dimensions),0,'L');
                        }
                        if(isset($updates['roof_max']) && $updates['roof_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Roof : ' . str_replace('|', ',', $data->roof_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Roof : ' . str_replace('|', ',', $data->roof_max),0,'L');
                        }
                        if(isset($updates['architectural_style_max']) && $updates['architectural_style_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Architectural Style : ' . str_replace('|', ',', $data->architectural_style_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Architectural Style : ' . str_replace('|', ',', $data->architectural_style_max),0,'L');
                        }
                        if(isset($updates['property_description']) && $updates['property_description'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Property Description: ' . str_replace('|', ',', $data->property_description),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Property Description: ' . str_replace('|', ',', $data->property_description),0,'L');
                        }
                        if(isset($updates['foundation_max']) && $updates['foundation_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Foundation (3 Max): ' . str_replace('|', ',', $data->foundation_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Foundation (3 Max): ' . str_replace('|', ',', $data->foundation_max),0,'L');
                        }
                        if(isset($updates['exterior_construction_max']) && $updates['exterior_construction_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Exterior Construction: ' . str_replace('|', ',', $data->exterior_construction_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Exterior Construction: ' . str_replace('|', ',', $data->exterior_construction_max),0,'L');
                        }
                        if(isset($updates['exterior_features_max']) && $updates['exterior_features_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Exterior Features : ' . str_replace('|', ',', $data->exterior_features_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Exterior Features : ' . str_replace('|', ',', $data->exterior_features_max),0,'L');
                        }
			
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Community Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
                        
                        if(isset($updates['community_features_max']) && $updates['community_features_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Community Features: ' . str_replace('|',',', $data->community_features_max),0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Community Features: ' . str_replace('|',',', $data->community_features_max),0,'L');
                        }
                        $housing = MLS::getOlderhousing();
                        if(isset($updates['housing_for_elders']) && $updates['housing_for_elders'] == 1){
                        $pdf->SetTextColor(255,230,0);
                        $pdf->Cell(190,4,'Housing for Older Persons : ' . $housing[$data->housing_for_elders],0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(190,4,'Housing for Older Persons : ' . $housing[$data->housing_for_elders],0,1);
                        }
                        if(isset($updates['showing_time_secure_remarks']) && $updates['showing_time_secure_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Showing Time Secure Remarks: ' . $data->showing_time_secure_remarks,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Showing Time Secure Remarks: ' . $data->showing_time_secure_remarks,0,1);
                        }
                        if(isset($updates['showing_instructions_max']) && $updates['showing_instructions_max'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Showing Instructions (16 Max): ' . $data->showing_instructions_max,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Showing Instructions (16 Max): ' . $data->showing_instructions_max,0,1);
                        }
                        if(isset($updates['virtual_tour_link']) && $updates['virtual_tour_link'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(38,4,'Virtual Tool Link: ' . $data->virtual_tour_link,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(38,4,'Virtual Tool Link: ' . $data->virtual_tour_link,0,1);
                        }
                        if(isset($updates['high_school']) && $updates['high_school'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'High School: ' . $data->high_school,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'High School: ' . $data->high_school,0,0);
                        }
                        if(isset($updates['middle_school']) && $updates['middle_school'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'Middle School: ' . $data->middle_school,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'Middle School: ' . $data->middle_school,0,0);
                        }
                        if(isset($updates['elementary_school']) && $updates['elementary_school'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'Elementary School: ' . $data->elementary_school,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'Elementary School: ' . $data->elementary_school,0,1);
                        }
                        if(isset($updates['pet_restrictions_yn']) && $updates['pet_restrictions_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Pet Restrictions: ' . $data->pet_restrictions_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Pet Restrictions: ' . $data->pet_restrictions_yn,0,0);
                        }
                        if(isset($updates['hoa_community_association']) && $updates['hoa_community_association'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'HOA/Com. Assoc: ' . $data->hoa_community_association,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'HOA/Com. Assoc: ' . $data->hoa_community_association,0,0);
                        }
                        if(isset($updates['hoa_fee']) && $updates['hoa_fee'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'HOA Fee: $' . number_format($data->hoa_fee,0),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'HOA Fee: $' . number_format($data->hoa_fee,0),0,1);
                        }
                        if(isset($updates['hoa_payment_schedule']) && $updates['hoa_payment_schedule'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'HOA Payment Schedule: ' . $data->hoa_payment_schedule,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'HOA Payment Schedule: ' . $data->hoa_payment_schedule,0,0);
                        }
                        if(isset($updates['monthly_maintainance_addition_to_hoa']) && $updates['monthly_maintainance_addition_to_hoa'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'Monthly Maintainance (Additional To HOA): ' . $data->monthly_maintainance_addition_to_hoa,0,0);	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'Monthly Maintainance (Additional To HOA): ' . $data->monthly_maintainance_addition_to_hoa,0,0);	
                        }
                        if(isset($updates['internet_yn']) && $updates['internet_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'Internet Y/N: ' . $data->internet_yn,0,1);	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'Internet Y/N: ' . $data->internet_yn,0,1);	
                        }
                         if(isset($updates['display_property_address_on_internet_yn']) && $updates['display_property_address_on_internet_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Display Property Address On Internet Y/N: ' . $data->display_property_address_on_internet_yn,0,1);	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Display Property Address On Internet Y/N: ' . $data->display_property_address_on_internet_yn,0,1);	
                        }
                         if(isset($updates['driving_direction']) && $updates['driving_direction'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Driving Direction: ' . $data->driving_direction,0,'L');	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Driving Direction: ' . $data->driving_direction,0,'L');	
                        }
                         if(isset($updates['realtor_only_remarks']) && $updates['realtor_only_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,7,'Realtor Only Remarks: ' . $data->realtor_only_remarks,0,'L');	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,7,'Realtor Only Remarks: ' . $data->realtor_only_remarks,0,'L');	
                        }
                         if(isset($updates['public_remarks']) && $updates['public_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Public Remarks: ' . $data->public_remarks,0,'L');	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Public Remarks: ' . $data->public_remarks,0,'L');	
                        }
                         if(isset($updates['pay_broker_percentage']) && $updates['pay_broker_percentage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(65,4,'Buyers Agent Compensate: ' . $data->pay_broker_percentage,0,1);	
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(65,4,'Buyers Agent Compensate: ' . $data->pay_broker_percentage,0,1);	
                        }
                          
			
			
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Photos',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
			$x = 10;
			$y = $pdf->getY();
			$y = $y+3;
			$i = 0;
			foreach($images as $k => $img){
				$i ++;
				$pdf->Image(Yii::app()->basePath.'/../upload/' . $img , $x, $y, 20, 20, '','','L');  
				$x += 25;
				if($i == 6){
					$y += 25;
					$x = 10;	
				}
			}// force print dialog

			//echo('<pre>');print_r($x);print_r(' '.$y);die();
			if($saveLocal){
				$pdf->Output(Yii::app()->basePath.'/../upload/' . $data->id . "_" . $data->address . "_mls.pdf", "F");	
			}else{
				$js .= 'print(true);';

			// set javascript
			$pdf->IncludeJS($js);
				$pdf->Output(Yii::app()->basePath.'/../upload/' . $data->id . "_" . $data->address . "_mls.pdf", "I");
			}
			
		} else {
			$pdf = new TCPDF();
			$pdf->AddPage();
			$pdf->SetFont('helvetica','B',16);
			$pdf->Cell(40,10,'No record found / Not authorized');
			$pdf->Output();
		}
	}
	
	public function actionPopulate(){
/*		require_once '/home/flatrate/public_html/development/protected/extensions/phpQuery/phpQuery.php';*/
		Yii::import('application.extensions.phpQuery.phpQuery');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_POST['url']);
	       curl_setopt($ch, CURLOPT_HEADER, 0);
	       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
	       $imapp = curl_exec($ch);      
	       curl_close($ch);
		
		switch($_POST['site']){
			case "zillow":
				$doc = phpQuery::newDocument($imapp);
				$result['address'] = $doc->find(".street-address")->html();
				$result['city'] = $doc->find(".locality")->html();
				$result['state'] = $doc->find(".region")->html();
				$result['zip_code'] = $doc->find(".postal-code")->html();
				$result['list_price'] = str_replace(",", "", substr($doc->find(".forSaleOffer .value")->html(), 1));
				
				$doc1 = $doc->find(".facts-body")->html();
				
				$pattern = array("(<td>)", "(<\/td>)");
				$replace = array("", "");
				$arr = array();
				
				preg_match_all("(<tr.*</tr>)siU", $doc1, $arr);	
				
				$result['bedrooms'] = str_replace("\n</tr>", "", preg_replace($pattern, $replace, substr($arr[0][0], strpos($arr[0][0], "<td>"))));
				
				$baths = preg_replace($pattern, $replace, substr($arr[0][1], strpos($arr[0][1], "<td>")));
				$result['full_baths'] = floor($baths);
				$result['half_baths'] = ceil(substr($baths, strpos($baths, ".")));
				
				$sqFt = str_replace(",", "", str_replace("\n</tr>", "", preg_replace($pattern, $replace, substr($arr[0][2], strpos($arr[0][2], "<td>")))));
				$result['sq_ft_heated'] = $sqFt == "--" ? 0 : $sqFt;
				
				$propStyle = str_replace("\n</tr>", "", preg_replace($pattern, $replace, substr($arr[0][4], strpos($arr[0][4], "<td>"))));
				$result['property_style'] = strpos("Home", $propStyle) ?  $propStyle : "$propStyle Home";
				$result['year_built'] = str_replace("\n</tr>", "", preg_replace($pattern, $replace, substr($arr[0][5], strpos($arr[0][5], "<td>"))));
				$result['fireplace_yn'] = str_replace("\n</tr>", "", preg_replace($pattern, $replace, substr($arr[0][9], strpos($arr[0][9], "<td>")))) == "Yes" ? "Y" : "N";	
				
				$result['public_remarks'] = $doc->find("#home-description")->getString();
				$result['elementary_school'] = $doc->find("#content noscript ul li:eq(0) a")->getString();
				$result['middle_school'] = $doc->find("#content noscript ul li:eq(1) a")->getString();
				$result['high_school'] = $doc->find("#content noscript ul li:eq(2) a")->getString();
			break;
			
			case "realestate":
				$doc = phpQuery::newDocument($imapp);
				$result['address'] = $doc->find("span.street-address")->html();
				$result['city'] = $doc->find(".locality")->html();
				$result['state'] = $doc->find(".region")->html();
				$result['zip_code'] = $doc->find(".postal-code")->html();
				$result['list_price'] = str_replace(",", "", substr(trim($doc->find(".price")->html()), 1));
				
				$regex = "/^[a-zA-Z ]*: /";
				$element = ".homefacts .squeeze .body ul li.item:eq(%d)";
				$bedrooms = $doc->find(sprintf($element, 0))->getString();
				$bedrooms = preg_replace($regex, "", $bedrooms);
				$result['bedrooms'] = $bedrooms;
				
				$fullbaths = $doc->find(sprintf($element, 1))->getString();
				$fullbaths = preg_replace($regex, "", $fullbaths);
				$result['full_baths'] = $fullbaths;
				
				$halfbaths = $doc->find(sprintf($element, 2))->getString();
				$halfbaths = preg_replace($regex, "", $halfbaths);
				$result['half_baths'] = $halfbaths;
				
				$pattern = array("(<li>)", "(<\/li>)");
				$replace = array("", "");
				$arr = array();
				
				$doc2 = $doc->find(".homefacts .squeeze .body")->html();
				
				preg_match_all("(<li.*</li>)siU", $doc2, $arr);
				$str = split("</span>", preg_replace($pattern, $replace, $arr[0][3]));
				$result['sq_ft_heated'] = str_replace(",", "", $str[1]);
				$str = split("</span>", preg_replace($pattern, $replace, $arr[0][5]));
				$result['property_style'] = $str[1];
				$str = split("</span>", preg_replace($pattern, $replace, $arr[0][6]));
				$result['county'] = $str[1];
				$str = split("</span>", preg_replace($pattern, $replace, $arr[0][7]));
				$result['year_built'] = $str[1];
				
			break;
			
			case "trulia":
				$doc = phpQuery::newDocument($imapp);
				$split = split(", ", $doc->find("h1.address")->html());
				$result['address'] = $split[0];
				$result['list_price'] = substr(str_replace(",", "", $doc->find("span.price")->html()), 1);
				$result['bedrooms'] = $doc->find("#listing_summary_module table tr:eq(2) td")->html();
				$split = split(" ", $doc->find("#listing_summary_module table tr:eq(3) td")->html());
				$result['full_baths'] = $split[0];
				$result['property_style'] = str_replace("-", " ", $doc->find("#listing_summary_module table tr:eq(4) td")->html());
				
				$split = split(" ", str_replace(",", "", $doc->find("#listing_summary_module table tr:eq(5) td")->html()));
				$result['sq_ft_heated'] = is_numeric($split[0]) ? $split[0] : "";
				$split = split(" ", str_replace(",", "", $doc->find("#listing_summary_module table tr:eq(6) td")->html()));
				$result['lot_size_sq_ft'] = is_numeric($split[0]) ? $split[0] : "";
				
				$yearbuild = $doc->find("#listing_summary_module table tr:eq(8) td")->html();
				$result['year_built'] = is_numeric($yearbuild) ? $yearbuild : "";
				$result['zip_code'] = substr($doc->find(".zipcode .legend_location_name")->html(), 4);
				$result['city'] = $doc->find(".city .legend_location_name")->html();
				/*$result['county'] = $doc->find("div div#property_features_module")->html();*/
				
				$result['tax_year'] = $doc->find("#property_taxes_info_module tr:eq(1) td:eq(0)")->html();
				$result['taxes'] = substr(str_replace(",", "", $doc->find("#property_taxes_info_module tr:eq(1) td:eq(7) span")->html()), 1);
				$result['elementary_school'] = $doc->find(".elementary-school .school-name a:eq(0)")->html();
				$result['middle_school'] = $doc->find(".middle-school .school-name a:eq(0)")->html();
				$result['high_school'] = $doc->find(".high-school .school-name a:eq(0)")->html();
			break;
			
			case "realtor":
				$doc = phpQuery::newDocument($imapp);
				echo $doc;
			break;
		}
		echo json_encode($result);
	}
	
		public function actionPopListing(){
			$res = array();
			
			if(isset($_POST['fullAdd'])){
				$fullAdd = split(", ", $_POST['fullAdd']);
				$stateZip = split(" ", $fullAdd[2]);
				
				$query = "SELECT * FROM mls WHERE address LIKE :address AND city LIKE :city AND state LIKE :state AND zip_code LIKE :zip_code";
				$cmd = Yii::app()->db->createCommand($query);
				$cmd->bindValue(":address", "%" .  $fullAdd[0] . "%", PDO::PARAM_STR);
				$cmd->bindValue(":city", "%" . $fullAdd[1] . "%", PDO::PARAM_STR);
				$cmd->bindValue(":state", "%" . $stateZip[0] . "%", PDO::PARAM_STR);
				$cmd->bindValue("zip_code", "%" . $stateZip[1] . "%", PDO::PARAM_STR);
				$res = $cmd->queryRow();
			}
		
		echo CJSON::encode($res);
		Yii::app()->end();
	}
	
	public function actionUseCode($id){
		Yii::import('application.modules.user.models.*');
		$profile = Profile::model()->findByPk(Yii::app()->user->id);
		if($profile->promocode == $_POST['code']){
			$model = Mls::model()->findByPk($id);
			$model->list_status = "PAID";
			if($model->save()){
				$profile->promocode = "";
				$profile->save();
				$arr = array("success"=>true, "message"=>"", "url"=> Yii::app()->createUrl("/listing/mls/admin"));
				echo CJSON::encode($arr);
			}
		}else if($profile->promocode == ''){
			$arr = array("success"=>false, "message"=>"You don't have a promo code");
			echo CJSON::encode($arr);
		}else{
			$arr = array("success"=>false, "message"=>"Please enter a valid promo code");
			echo CJSON::encode($arr);
		}
		Yii::app()->end();
	}
	
	public function actionStatus(){
		$model = new Mls;
		$this->render('status', array('model'=>$model));
	}
	
	public function actionManagePending(){
		$mls = new Mls;
		$this->render('managePending', array('mls'=>$mls));
	}
	
	public function actionManageSold(){
		$mls = new Mls;
		$this->render("manageSold", array('mls'=>$mls));
	}
	
/*	public function actionRand(){
		$int = rand(0, 10);
		if($int % 5 == 0)
			echo "Survey";
		else
			echo "Payment";
		echo $int;
	}*/
	
	 /**
         * checks for updates
         */
        public function checkUpdates($model, $post){
           $updates = array();
           foreach($post as $k=>$v){
			   if(is_array($post[$k])){
				   if($model[$k] != implode(" | ", $post[$k])){
					    $updates[$k] = 1;
					   }else{
                   $updates[$k] = 0;
               }
			   }
               else{ if($model[$k] != $post[$k]){
                   $updates[$k] = 1;
               }else{
                   $updates[$k] = 0;
               }
			   }
           }
         return $updates;
        }
		
		public function checkChanges($changes =array()){
		 
			foreach($changes as $key=>$value){
					if($value == 1 && $key != 'update_date' ){
						return true;
						}
				}
				return false;
			}
}


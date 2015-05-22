<?php

class LandController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'ipn'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','view','update','admin','incomplete','delete','load','deletein','approve','print','pending','sold','reqUpdate', 'upload' ,'autosave'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','create','view','update','admin','incomplete','delete','load','deletein','approve','print','pending','sold','reqUpdate', 'upload' ,'autosave'),
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
		$docs = Document::model()->findAllByAttributes(array("list_type"=>"MLS", "list_id"=>$id));
		$this->actionPrint($id, array(),TRUE);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'docs' => $docs,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Land;
		$doc = new Document;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Land']))
		{
			$model->attributes=$_POST['Land'];
			if(isset($_POST['yt0']) && (($_POST['yt0']) == 'Save as incomplete'))
			{$model->land_status = "INCOMPLETE";}
			if(isset($_POST['yt1']) && (($_POST['yt1']) == "Save and View My Listing"))
			{$model->land_status = "COMPLETED";}

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
							$tempDoc->list_type = "LAND";
							$tempDoc->list_id = $model->id;
							$tempDoc->filename = $v;
							$tempDoc->save();
						}
					}else{
						$doc->save();
					}
                                        $id = $this->checkincomplete($model->attributes);
                                        $incompleteland = IncompleteLand::model()->findByPk($id);
                                        if(isset($incompleteland))
                                            $incompleteland->delete();
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'doc' => $doc,
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
                $user_profile = User::model()->findByPk($model->creator_id);
		$doc = new Document;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Land']))
		{
                        $attributes = $model->attributes;
			$model->attributes=$_POST['Land'];
			//echo('<pre>');print_r($model->attributes);die();
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
				}
                                $id = $this->checkincomplete($model->attributes);
                                $incompleteland = IncompleteLand::model()->findByPk($id);
								if(isset($incomplete))
                                $incompleteland->delete();
								
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
								
                                $updates = $this->checkUpdates($attributes, $model->attributes);
								if(!($this->checkChanges($updates))){
										$this->redirect(array('view','id'=>$model->id));
									}
                                $this->actionPrint($model->id,$updates,  TRUE);
                                require('/home/flatrate/frameworks/PHPMailer_v5.1/class.phpmailer.php');
				
				$mail = new PHPMailer;
				$mail->ClearAddresses();
				$mail->From = $user_profile->email;
				$email = split(",", Yii::app()->params['mlsApprovedEmail']);
				foreach($email as $k => $v){
					$mail->AddAddress($v, $v);
				}
				$mail->FromName = "Flatratelist.com";
				$mail->Subject = "Land Update Information";
				$mail->Body = "Here is Land Information:<br/>
					MLS ID: {$model->id}<br/>
					Email : {$user_profile->email}<br/>
					House No. : {$model->house_number}<br/>
					Street Name : {$model->street_name}.<br/><br/>
					
					For more information see the attachment.
				";
				$mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->street_name . "_land.pdf", $model->id . "_" . $model->street_name . "_land.pdf");
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
		$dataProvider=new CActiveDataProvider('Land');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Land('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Land']))
			$model->attributes=$_GET['Land'];
			
		
		$model2 = new IncompleteLand;
		$model2->unsetAttributes();
		if(Yii::app()->user->isAdmin())
			$model2 = IncompleteLand::model()->findAll();
		else
			$model2 = IncompleteLand::model()->findAll('userid=:uid', array(':uid'=>Yii::app()->user->id));

		$this->render('admin',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
	
	public function actionIncomplete(){
		if($_POST['incompleteID'] == 0){
			$id = $this->checkincomplete($_POST['Land']);
                        if($id){
                            $model = IncompleteLand::model()->findByPk($id);
                        }else{
                            $model = new IncompleteLand;
                        }
                }
		else{
			$model = IncompleteLand::model()->findByPk($_POST['incompleteID']);
                }
		$model->userid = $_POST['Land']['creator_id'];
		$model->address = $_POST['Land']['street_name'];
		$model->data = json_encode($_POST['Land']);
		if($model->save())
			echo 'Saved as incomplete';
		else
			echo 'Failed, address required';
		Yii::app()->end();
	}
	
	   /**
         * checks for a incomplete land listing with similar address and userid
         */
        public function checkincomplete($post){
                $incompletes = IncompleteLand::model()->findAllByAttributes(array('userid'=>$post['creator_id']));
                foreach($incompletes as $incomplete){
                    $data = json_decode($incomplete->data);
                    if(strtolower(trim($data->house_number).'_'.trim($incomplete->address)) == strtolower(trim($post['house_number']).'_'.trim($post['street_name']))){
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
                $incomplete = IncompleteLand::model()->findByPk($_POST['incompleteID']);
                $incomplete->userid = $_POST['Land']['creator_id'];
                $incomplete->address = $_POST['Land']['street_name'];
                $incomplete->data = json_encode($_POST['Land']);
                $incomplete->save();
                echo $incomplete->id;
            }elseif( $_POST['Land']['street_name'] && !$_POST['incompleteID'] && $_POST['Land']['house_number']){
                $id = $this->checkincomplete($_POST['Land']);
                $incomplete = IncompleteLand::model()->findByPk($id);
                if($incomplete && isset($incomplete)){
                    $incomplete->data = json_encode($_POST['Land']);
                    $incomplete->save();
                    echo $incomplete->id;
                }else{
                    $incomplete = new IncompleteLand;
                    $incomplete->userid = $_POST['Land']['creator_id'];
                    $incomplete->address = $_POST['Land']['street_name'];
                    $incomplete->data = json_encode($_POST['Land']);
                    $incomplete->save();
                    echo $incomplete->id;
                }
            }
            Yii::app()->end();
        }
	
	public function actionLoad($id){
		Yii::app()->session->add('ic', $id);
		$this->redirect(array('land/create'));
	}
	
	public function actionDeletein($id){
		$model = IncompleteLand::model()->findByPk($id);
		$model->delete();
		$this->redirect('land/admin');
	}
	
	public function actionApprove($id){
            
		$model = $this->loadModel($id);
		if($model->land_status == "COMPLETED" || $model->land_status == "APPROVED"){
			$model->land_status = "APPROVED";
			$update = $model->updateByPk($model->id, array('land_status'=>$model->land_status));
			$id = $this->checkincomplete($model->attributes);
                        $incompleteland = IncompleteLand::model()->findByPk($id);
                        if(isset($incompleteland))$incompleteland->delete();
			if($model->land_status == "APPROVED"){
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
                                  "description" => "Flatratelist.com Land Service")
                                );
                                    $item = array();
                                    Flatrate::completelandPayment($_POST['mls_id'], $_POST['userid'], $token, $item = '147', $type='Land');
                                    
                                    Yii::app()->user->setFlash('success', "Thank you! Your listing is paid now.");
                                    Yii::app()->user->setState('url','listing/land/view');
                                    $this->redirect(array('survey/like', 'id' => $_POST['mls_id']));
                                    
                                    
//                                    Yii::app()->user->setFlash('success', "Thank you! Your land listing is paid now.");
//                                    $this->redirect(array('land/view', 'id' => $_POST['mls_id']));

                                } catch(Stripe_CardError $e) {
                                  // The card has been declined
                                     Yii::app()->user->setFlash('error', "There was an issue with the payment. Please try again.");
                                    $this->redirect(array('land/view', 'id' => $_POST['mls_id']));
                                }
                            }
			}
		}
	}
	
	public function actionPending($id){
		$model = $this->loadModel($id);
		$user = User::model()->findByPk(Yii::app()->user->id);
		
		if($model->land_status == "PAID"){
			$model->land_status = "PENDING";
			if($model->save(false)){
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
					$search = $ct->searchContactsByEmail($user->email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				$this->redirect(array('/listing/land/admin'));
			}
		}
	}
	
	public function actionSold($id){
		$model = $this->loadModel($id);
		$user = User::model()->findByPk(Yii::app()->user->id);
		
		if($model->land_status == "PENDING"){
			$model->land_status = "SOLD";
			if($model->save(false)){
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
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				$this->redirect(array('/listing/land/admin'));
			}
		}
	}
	
	public function actionSuccess(){
		$this->render("succcess");
	}
	
	public function actionCancel(){
		$this->render("cancel");
	}
	
	public function actionIpn()
	{
		$fx = fopen("test.txt", 'w');
		fwrite($fx, "TEST2");
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
				$model=Land::model()->ipn()->findByPk($_POST['custom']);
				$model->land_status = 'PAID';
				$model->paypal_trans_id = $_POST['txn_id'];
				if($model->save())
				{
					$sales = new TrackSales();
					$sales->item_name = $_POST['item_name'];
					$sales->pay = $_POST['mc_gross'];
					$sales->payment_date = $_POST['payment_date'];
					$sales->paypal_trans_id = $_POST['txn_id'];
					$sales->full_name = $_POST['last_name'] . ", " . $_POST['first_name'];
					
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
					$mail = new PHPMailer;
					$mail->ClearAddresses();
					$mail->From = Yii::app()->params['adminEmail'];
					$mail->AddAddress($model->email,$model->email);
					$mail->AddBCC(Yii::app()->params['mlsApprovedEmail']);
					$mail->FromName = "Flatratelist.com";
					$mail->Subject = "Vacant Land Information";
					$mail->Body = "Here Your Vacant Land Information. See the Attachment";
					$mail->AddAttachment('/home/flatrate/public_html/upload/' . $model->id . "_" . $model->street_name . "_land.pdf", $model->id . "_" . $model->street_name . "_land.pdf");
					$mail->Send();					
				}
			}
		} catch (Exception $e) {
    		$error = $e->getMessage();
		}

		$myFile = Yii::app()->params['ipnLogPath'] . "/" . date("Ymd_His") . "_" . $model->id  .  ".txt";
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $post . "\n" . "LAND ID=" . $model->id);
		fclose($fh);
		
		Yii::app()->end(); 
	}
	
	public function actionPrint($id, $updates =array(),  $saveLocal = false){
		require(Yii::app()->basePath.'/../frameworks/tcpdf/tcpdf.php');
		$data = $this->loadModel($id);
		if(!empty($data)){
			$temp = new stdClass();
			foreach($data as $k => $v){
				$temp->$k = str_replace(" |", ",", $v);
			}
		
			$pdf = new TCPDF();
			
			$images = array();
			for($i=1; $i<=12; $i++){
				$text = "photo_$i";
				if(!empty($data->$text) && isset($data->$text) && !is_null($data->$text))
					array_push($images, $data->$text);
			}
			
			$pdf->AddPage();
			$pdf->SetTitle('VACANT LAND: ' . $temp->street_name, FALSE);
			$pdf->SetMargins(10,10,10);
			
			$pdf->SetFont('helvetica','B',14);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,8,'Vacant Land: ' . $temp->street_name,1,1,'C', TRUE);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			if(isset($updates['list_price']) && $updates['list_price'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'List Price: ' . $temp->list_price,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'List Price: ' . $temp->list_price,0,0);
                        }
			if(isset($updates['house_number']) && $updates['house_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'House #: ' . $temp->house_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'House #: ' . $temp->house_number,0,0);
                        }
                        if(isset($updates['county']) && $updates['county'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'State: ' . $temp->county,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'State: ' . $temp->county,0,0);
                        }
                        if(isset($updates['for_lease_yn']) && $updates['for_lease_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'For Lease:' . $temp->for_lease_yn,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'For Lease:' . $temp->for_lease_yn,0,1);
                        }
                        if(isset($updates['price_per_acre']) && $updates['price_per_acre'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Price Per Acre: $' . number_format($temp->price_per_acre,2),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Price Per Acre: $' . number_format($temp->price_per_acre,2),0,0);
                        }
                        
			
			if(isset($updates['street_name']) && $updates['street_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Street Name: ' . $temp->street_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Street Name: ' . $temp->street_name,0,0);
                        }
                        if(isset($updates['zip_code']) && $updates['zip_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Zip Code: ' . $temp->zip_code,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Zip Code: ' . $temp->zip_code,0,0);
                        }
                        if(isset($updates['lease_price']) && $updates['lease_price'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Lease Price: $' . number_format($temp->lease_price),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Lease Price: $' . number_format($temp->lease_price),0,1);
                        }
                        
			
			
			if(isset($updates['street_type']) && $updates['street_type'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Street Type: ' . $temp->street_type,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Street Type: ' . $temp->street_type,0,0);
                        }
                        if(isset($updates['zip_plus']) && $updates['zip_plus'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Zip +4: ' . $temp->zip_plus,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Zip +4: ' . $temp->zip_plus,0,0);
                        }if(isset($updates['street_dir_pre']) && $updates['street_dir_pre'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Pre: ' . number_format(doubleval($temp->street_dir_pre)),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Pre: ' . number_format(doubleval($temp->street_dir_pre)),0,0);
                        }
                        if(isset($updates['street_dir_post']) && $updates['street_dir_post'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Post: ' . number_format(doubleval($temp->street_dir_post)),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Post: ' . number_format(doubleval($temp->street_dir_post)),0,1);
                        }
                        if(isset($updates['entered_where']) && $updates['entered_where'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Entered Where: ' . $temp->entered_where,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Entered Where: ' . $temp->entered_where,0,1);
                        }
                        
                        
                        
			if(isset($updates['city']) && $updates['city'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'City: ' . $temp->city,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'City: ' . $temp->city,0,0);
                        }
                        if(isset($updates['listing_date']) && $updates['listing_date'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Listing Date: ' . $temp->listing_date,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Listing Date: ' . $temp->listing_date,0,0);
                        }
                        if(isset($updates['range_price_yn']) && $updates['range_price_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Range Price: ' . $temp->range_price_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Range Price: ' . $temp->range_price_yn,0,0);
                        }
                        if(isset($updates['representation']) && $updates['representation'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Representation: ' . $temp->representation,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Representation: ' . $temp->representation,0,1);
                        }
                        
			
			if(isset($updates['state']) && $updates['state'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'State: ' . $temp->state,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'State: ' . $temp->state,0,0);
                        }
                        if(isset($updates['expiration_date']) && $updates['expiration_date'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Expiration Date: ' . $temp->expiration_date,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Expiration Date: ' . $temp->expiration_date,0,0);
                        }
                        if(isset($updates['range_list_low_price']) && $updates['range_list_low_price'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Range List Low Price: $' . number_format($temp->range_list_low_price),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Range List Low Price: $' . number_format($temp->range_list_low_price),0,0);
                        }
                        if(isset($updates['listing_price']) && $updates['listing_price'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            isset($temp->listing_price)?$pdf->Cell(50,4,'Listing Price: $' . number_format($temp->listing_price),0,1):$pdf->Cell(50,4,'Listing Price: $ ',0,1);
                        
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            isset($temp->listing_price)?$pdf->Cell(50,4,'Listing Price: $' . number_format($temp->listing_price),0,1):$pdf->Cell(50,4,'Listing Price: $ ',0,1);
                        
                        }
                        if(isset($updates['originating_board_id']) && $updates['originating_board_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Originating Board ID: ' . $temp->originating_board_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Originating Board ID: ' . $temp->originating_board_id,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
			
			
			if(isset($updates['listing_type']) && $updates['listing_type'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Listing Type: ' . $temp->listing_type,0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Listing Type: ' . $temp->listing_type,0,'L');
                        }
                        if(isset($updates['property_style']) && $updates['property_style'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Property Style: ' . $temp->property_style,0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Property Style: ' . $temp->property_style,0,'L');
                        }
                        
			
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Land, Site and Tax Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
			if(isset($updates['ownership']) && $updates['ownership'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Ownership: ' . $temp->ownership,0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Ownership: ' . $temp->ownership,0,'L');
                        }
                        if(isset($updates['cdd_yn']) && $updates['cdd_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'CDD Y/N: ' . $temp->cdd_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'CDD Y/N: ' . $temp->cdd_yn,0,0);
                        }
                        if(isset($updates['owner_name']) && $updates['owner_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            isset($temp->owner_name)?$pdf->Cell(50,4,'Owner Name: ' . $temp->owner_name,0,0):$pdf->Cell(50,4,'Owner Name: ',0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            isset($temp->owner_name)?$pdf->Cell(50,4,'Owner Name: ' . $temp->owner_name,0,0):$pdf->Cell(50,4,'Owner Name: ',0,0);
                        }
                        if(isset($updates['owner_phone']) && $updates['owner_phone'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            isset($temp->owner_phone)?$pdf->Cell(45,4,'Owner Phone: ' . number_format(doubleval($temp->owner_phone)),0,1):$pdf->Cell(50,4,'Owner Phone: ',0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            isset($temp->owner_phone)?$pdf->Cell(45,4,'Owner Phone: ' . number_format(doubleval($temp->owner_phone)),0,1):$pdf->Cell(50,4,'Owner Phone: ',0,1);
                            
                        }
                        if(isset($updates['front_exposire']) && $updates['front_exposire'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            isset($temp->front_exposire)?$pdf->Cell(45,4,'Front Exposire: ' . $temp->front_exposire,0,0):$pdf->Cell(50,4,'Front Exposire ',0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            isset($temp->front_exposire)?$pdf->Cell(45,4,'Front Exposire: ' . $temp->front_exposire,0,0):$pdf->Cell(50,4,'Front Exposire ',0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['availability']) && $updates['availability'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Availability: ' . $temp->availability,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Availability: ' . $temp->availability,0,0);
                        }
                         $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['easements']) && $updates['easements'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Easements: ' . $temp->easements,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Easements: ' . $temp->easements,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
			if(isset($updates['location']) && $updates['location'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Location: ' . $temp->location,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Location: ' . $temp->location,0,0);
                        }
                        if(isset($updates['front_footage']) && $updates['front_footage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Front Footage: ' . $temp->front_footage,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Front Footage: ' . $temp->front_footage,0,0);
                        }
                        if(isset($updates['millage_rate']) && $updates['millage_rate'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Millage Rate: ' . $temp->millage_rate,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Millage Rate: ' . $temp->millage_rate,0,0);
                        }
                        if(isset($updates['subdivision_number']) && $updates['subdivision_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Subdivision #: ' . $temp->subdivision_number,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Subdivision #: ' . $temp->subdivision_number,0,1);
                        }
                        if(isset($updates['lot_number']) && $updates['lot_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Lot #: ' . $temp->lot_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Lot #: ' . $temp->lot_number,0,0);
                        }
                        if(isset($updates['legal_description']) && $updates['legal_description'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Legal Description: ' . $temp->legal_description,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Legal Description: ' . $temp->legal_description,0,0);
                        }
                        
			
			if(isset($updates['tax_id']) && $updates['tax_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Tax ID: ' . $temp->tax_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Tax ID: ' . $temp->tax_id,0,0);
                        }
                        if(isset($updates['condo_number']) && $updates['condo_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Condo #: ' . $temp->condo_number,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Condo #: ' . $temp->condo_number,0,1);
                        }
                        if(isset($updates['lot_dimensions']) && $updates['lot_dimensions'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Lot Dimensions: ' . $temp->lot_dimensions,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Lot Dimensions: ' . $temp->lot_dimensions,0,0);
                        }
                        if(isset($updates['legal_subdivision_name']) && $updates['legal_subdivision_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Legal Subdiv. Name: ' . $temp->legal_subdivision_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Legal Subdiv. Name: ' . $temp->legal_subdivision_name,0,0);
                        }
			
			
			if(isset($updates['taxes']) && $updates['taxes'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Taxes: $' . number_format($data->taxes),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Taxes: $' . number_format($data->taxes),0,0);
                        }
                        if(isset($updates['subdivision_section_number']) && $updates['subdivision_section_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Subdiv. Section #: ' . $temp->subdivision_section_number,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Subdiv. Section #: ' . $temp->subdivision_section_number,0,1);
                        }
                        if(isset($updates['lot_size_sq_ft']) && $updates['lot_size_sq_ft'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Lot Size (Sq.Ft.): ' . $temp->lot_size_sq_ft,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Lot Size (Sq.Ft.): ' . $temp->lot_size_sq_ft,0,0 );
                        }
                        if(isset($updates['subdiv_community_name']) && $updates['subdiv_community_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Subdiv Comm. Name: ' . $temp->subdiv_community_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Subdiv Comm. Name: ' . $temp->subdiv_community_name,0,0);
                        }
			
			
			
			if(isset($updates['taxes_year']) && $updates['taxes_year'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Taxes Year: ' . $temp->taxes_year,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Taxes Year: ' . $temp->taxes_year,0,0);
                        }
                        if(isset($updates['block_parcel']) && $updates['block_parcel'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Block / Parcel: ' . $temp->block_parcel,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Block / Parcel: ' . $temp->block_parcel,0,1);
                        }
                        if(isset($updates['lot_size_acre']) && $updates['lot_size_acre'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Lot Size (Acre): ' . $temp->lot_size_acre,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Lot Size (Acre): ' . $temp->lot_size_acre,0,0);
                        }
                        if(isset($updates['complex_community_name']) && $updates['complex_community_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Complex Comm. Name: ' . $temp->complex_community_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Complex Comm. Name: ' . $temp->complex_community_name,0,0);
                        }
			
			
			
			if(isset($updates['alt_key_folio']) && $updates['alt_key_folio'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Alt/Key/Folio: ' . $temp->alt_key_folio,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Alt/Key/Folio: ' . $temp->alt_key_folio,0,0);
                        }
                        if(isset($updates['zoning_yn']) && $updates['zoning_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Zoning: ' . $temp->zoning_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Zoning: ' . isset($temp->zoning_yn),0,1);
                        }
                        if(isset($updates['auction_yn']) && $updates['auction_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Auction: ' . isset($temp->auction_yn),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Auction: ' . $temp->auction_yn,0,0);
                        }
                        if(isset($updates['road_frontage']) && $updates['road_frontage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Road Frontage: ' . $temp->road_frontage,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Road Frontage: ' . $temp->road_frontage,0,0);
                        }
			
			
			if(isset($updates['section']) && $updates['section'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Section: ' . $temp->section,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Section: ' . $temp->section,0,0);
                        }
                        if(isset($updates['zoning_compatible']) && $updates['zoning_compatible'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            isset($temp->zoning_compatible)?$pdf->Cell(50,4,'Zoning Compatible:: ' . $temp->zoning_compatible,0,1):$pdf->Cell(50,4,'Zoning Compatible: ',0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            isset($temp->zoning_compatible)?$pdf->Cell(50,4,'Zoning Compatible:: ' . $temp->zoning_compatible,0,1):$pdf->Cell(50,4,'Zoning Compatible: ',0,1);
                        }
                        if(isset($updates['plat_book_page']) && $updates['plat_book_page'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Plat Book/Page: ' . $temp->plat_book_page,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Plat Book/Page: ' . $temp->plat_book_page,0,0);
                        }
                        if(isset($updates['state_land_use_code']) && $updates['state_land_use_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'State Land Use Code: ' . $temp->state_land_use_code,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'State Land Use Code: ' . $temp->state_land_use_code,0,0);
                        }
			
			
			if(isset($updates['township']) && $updates['township'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Township: ' . $temp->township,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Township: ' . $temp->township,0,0);
                        }
                        if(isset($updates['additional_parcel_yn']) && $updates['additional_parcel_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Additional Parcel: ' . $temp->additional_parcel_yn,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Additional Parcel: ' . $temp->additional_parcel_yn,0,1);
                        }
                        if(isset($updates['future_land_use']) && $updates['future_land_use'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Future Land Use: ' . $temp->future_land_use,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Future Land Use: ' . $temp->future_land_use,0,0);
                        }
                        if(isset($updates['state_property_use_code']) && $updates['state_property_use_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'State Property Use Code: ' . $temp->state_property_use_code,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'State Property Use Code: ' . $temp->state_property_use_code,0,0);
                        }
			
			
			
			if(isset($updates['range']) && $updates['range'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Range: ' . $temp->range,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Range: ' . $temp->range,0,0);
                        }
                        if(isset($updates['number_of_additional_parcel']) && $updates['number_of_additional_parcel'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Number of Add. Parcel: ' . $temp->number_of_additional_parcel,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Number of Add. Parcel: ' . $temp->number_of_additional_parcel,0,1);
                        }
                        if(isset($updates['idx_yn']) && $updates['idx_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'IDX: ' . $temp->idx_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'IDX: ' . $temp->idx_yn,0,0);
                        }
                        if(isset($updates['county_land_use_code']) && $updates['county_land_use_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'County Land Use Code: ' . $temp->county_land_use_code,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'County Land Use Code: ' . $temp->county_land_use_code,0,0);
                        }
			
			
			if(isset($updates['water_access_yn']) && $updates['water_access_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water Access Y/N: ' . $temp->water_access_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water Access Y/N: ' . $temp->water_access_yn,0,0);
                        }
                        if(isset($updates['water_access']) && $updates['water_access'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water Access: ' . $temp->water_access,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water Access: ' . $temp->water_access,0,1);
                        }
                        if(isset($updates['water_view_yn']) && $updates['water_view_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water View Y/N: ' . $temp->water_view_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water View Y/N: ' . $temp->water_view_yn,0,0);
                        }
                        if(isset($updates['water_view']) && $updates['water_view'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Water View: ' . $temp->water_view,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Water View: ' . $temp->water_view,0,0);
                        }
                        if(isset($updates['water_frontage_yn']) && $updates['water_frontage_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water Frontage Y/N: ' . $temp->water_frontage_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water Frontage Y/N: ' . $temp->water_frontage_yn,0,0);
                        }
                        if(isset($updates['water_frontage']) && $updates['water_frontage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water Frontage: ' . $temp->water_frontage,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water Frontage: ' . $temp->water_frontage,0,1);
                        }
                        if(isset($updates['cdd_yn']) && $updates['cdd_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'CDD: ' . $temp->cdd_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'CDD: ' . $temp->cdd_yn,0,0);
                        }
                        if(isset($updates['county_property_use_code']) && $updates['county_property_use_code'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'County Property Use Code: ' . $temp->county_property_use_code,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'County Property Use Code: ' . $temp->county_property_use_code,0,0);
                        }
			if(isset($updates['water_extras_yn']) && $updates['water_extras_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water Extras Y/N: ' . $temp->water_extras_yn,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water Extras Y/N: ' . $temp->water_extras_yn,0,0);
                        }
                        if(isset($updates['water_extras']) && $updates['water_extras'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Water Extras: ' . $temp->water_extras,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Water Extras: ' . $temp->water_extras,0,1);
                        }
                        if(isset($updates['water_name']) && $updates['water_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Water Name: ' . $temp->water_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Water Name: ' . $temp->water_name,0,0);
                        }
                        if(isset($updates['water_front_feet']) && $updates['water_front_feet'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Water Front Feet: ' . $temp->water_front_feet,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Water Front Feet: ' . $temp->water_front_feet,0,0);
                        }
                        if(isset($updates['annual_cdd_fee']) && $updates['annual_cdd_fee'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Annual CDD Fee: $' . number_format(doubleval($temp->annual_cdd_fee),2),0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Annual CDD Fee: $' . number_format(doubleval($temp->annual_cdd_fee),2),0,1);
                        }
                        if(isset($updates['utilities']) && $updates['utilities'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Utilities (8 Max): ' . $temp->utilities,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Utilities (8 Max): ' . $temp->utilities,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['site_improvements']) && $updates['site_improvements'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Site Improvements (3 Max): ' . $temp->site_improvements,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Site Improvements (3 Max): ' . $temp->site_improvements,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['fences']) && $updates['fences'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Fences (3Max): ' . $temp->fences,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Fences (3Max): ' . $temp->fences,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Community Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
                        
                        if(isset($updates['community_features']) && $updates['community_features'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->MultiCell(190,4,'Community Features: ' . $temp->community_features,0,'L');
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->MultiCell(190,4,'Community Features: ' . $temp->community_features,0,'L');
                        }
                        if(isset($updates['realtor_information']) && $updates['realtor_information'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Realtor Information (25 Max):  ' . $temp->realtor_information,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Realtor Information (25 Max):  ' . $temp->realtor_information,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['financing_available']) && $updates['financing_available'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Financing Available (7 Max): ' . $temp->financing_available,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Financing Available (7 Max): ' . $temp->financing_available,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['lease_terms']) && $updates['lease_terms'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Lease Terms: ' . $temp->lease_terms,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Lease Tearms: ' . $temp->lease_terms,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['realtor_information_confidential']) && $updates['realtor_information_confidential'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Realtor Information (Confidential) (3 Max): ' . $temp->realtor_information_confidential,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Realtor Information (Confidential) (3 Max): ' . $temp->realtor_information_confidential,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['special_listing_type']) && $updates['special_listing_type'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Special Listing Type: ' . $temp->special_listing_type,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Special Listing Type: ' . $temp->special_listing_type,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['special_sale_provision']) && $updates['special_sale_provision'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Special Sale Provision: ' . $temp->special_sale_provision,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Special Sale Provision: ' . $temp->special_sale_provision,0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['virtual_tour']) && $updates['virtual_tour'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Virtual Tour: ' . $temp->virtual_tour,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Virtual Tour: ' . $temp->virtual_tour,0,0);
                        }
                        
                        if(isset($updates['hoa_fee']) && $updates['hoa_fee'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'HOA Fee: $' . number_format($temp->hoa_fee,2),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'HOA Fee: $' . number_format($temp->hoa_fee,2),0,0);
                        }
                        if(isset($updates['hoa_payment_schedule']) && $updates['hoa_payment_schedule'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'HOA Payment Schedule: ' . $temp->hoa_payment_schedule,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'HOA Payment Schedule: ' . $temp->hoa_payment_schedule,0,1);
                        }
                        if(isset($updates['hoa_community_association']) && $updates['hoa_community_association'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'HOA Community Association: ' . $temp->hoa_community_association,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'HOA Community Association: ' . isset($temp->hoa_community_association),0,0);
                        }
                        if(isset($updates['elementary_school']) && $updates['elementary_school'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Elementary School: ' . $temp->elementary_school, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Elementary School: ' . $temp->elementary_school, 0,0);
                        }
                        if(isset($updates['middle_school']) && $updates['middle_school'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Middle School: ' . $temp->middle_school,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Middle School: ' . $temp->middle_school,0,1);
                        }
                        if(isset($updates['high_school']) && $updates['high_school'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'High School: ' . $temp->high_school,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'High School: ' . $temp->high_school,0,0);
                        }
			if(isset($updates['call_center_phone_number']) && $updates['call_center_phone_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Call Center Number: ' . $temp->call_center_phone_number, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Call Center Number: ' . $temp->call_center_phone_number, 0,0);
                        }
                        if(isset($updates['internet_yn']) && $updates['internet_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Internet Y/N: ' . $temp->internet_yn, 0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Internet Y/N: ' . $temp->internet_yn, 0,1);
                        }
                        if(isset($updates['showing_time_secure_remarks']) && $updates['showing_time_secure_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Showing Time Secure Remarks: ' . $temp->showing_time_secure_remarks, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Showing Time Secure Remarks: ' . $temp->showing_time_secure_remarks, 0,0);
                        }
                        if(isset($updates['display_property_address_on_internet_yn']) && $updates['display_property_address_on_internet_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Display Address On Internet Y/N:' . $temp->display_property_address_on_internet_yn, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Display Address On Internet Y/NN: ' . $temp->display_property_address_on_internet_yn, 0,0);
                        }
                        if(isset($updates['realtor_com_yn']) && $updates['realtor_com_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Realtor.com Y/N: ' . $temp->realtor_com_yn, 0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Realtor.com Y/N: ' . $temp->realtor_com_yn, 0,1);
                        }
                        if(isset($updates['third_party_yn']) && $updates['third_party_yn'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'3rd Party Y/N: ' . $temp->third_party_yn, 0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'3rd Party Y/N: ' . $temp->third_party_yn, 0,1);
                        }
                        
                        if(isset($updates['driving_directions']) && $updates['driving_directions'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Driving Directions (255 Characters):' . $temp->driving_directions, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Driving Directions (255 Characters): ' . $temp->display_property_address_on_internet_yn, 0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['realtor_only_remarks']) && $updates['realtor_only_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Realtor Only Remarks (455 Characters):' . $temp->realtor_only_remarks, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Realtor Only Remarks (455 Characters): ' . $temp->realtor_only_remarks, 0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['public_remarks']) && $updates['public_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Public Remarks (1530 Characters):' . $temp->public_remarks, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Public Remarks (1530 Characters): ' . $temp->public_remarks, 0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
                        if(isset($updates['additional_public_remarks']) && $updates['additional_public_remarks'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(60,4,'Additional Public Remarks (1020 Characters):' . $temp->additional_public_remarks, 0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(60,4,'Additional Public Remarks (1020 Characters): ' . $temp->additional_public_remarks, 0,0);
                        }
                        $pdf->Cell(50,4,'',0,1);
			
			$pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Agent Information',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
                        if(isset($updates['agent_homepage']) && $updates['agent_homepage'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(190,4,'Agent Homepage: ' . $temp->agent_homepage,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(190,4,'Agent Homepage: ' . $temp->agent_homepage,0,1);
                        }
                        if(isset($updates['office_name']) && $updates['office_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            isset($temp->office_name)?$pdf->Cell(45,4,'Office Name: ' . $temp->office_name,0,0):$pdf->Cell(50,4,'Office Name: ',0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            isset($temp->office_name)?$pdf->Cell(45,4,'Office Name: ' . $temp->office_name,0,0):$pdf->Cell(50,4,'Office Name: ',0,0);
                        }
			
			
			if(isset($updates['agent_id']) && $updates['agent_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Agent ID: ' . $temp->agent_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Agent ID: ' . $temp->agent_id,0,0);
                        }
                        if(isset($updates['agent_email']) && $updates['agent_email'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Agent Email: ' . $temp->agent_email,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Agent Email: ' . $temp->agent_email,0,0);
                        }
                        if(isset($updates['agent_extension']) && $updates['agent_extension'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Agent Extension: ' . $temp->agent_extension,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Agent Extension: ' . $temp->agent_extension,0,1);
                        }
                        if(isset($updates['office_fax']) && $updates['office_fax'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Office Fax: ' . $temp->office_fax,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Office Fax: ' . $temp->office_fax,0,1);
                        }
                        
			
			if(isset($updates['agent_name']) && $updates['agent_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Agent Name: ' . $temp->agent_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Agent Name: ' . $temp->agent_name,0,0);
                        }
                        if(isset($updates['agent_direct_phone']) && $updates['agent_direct_phone'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Direct Phone: ' . $temp->agent_direct_phone,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Direct Phone: ' . $temp->agent_direct_phone,0,0);
                        }
                        if(isset($updates['selling_agent_id']) && $updates['selling_agent_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Selling Agent ID: ' . $temp->selling_agent_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Selling Agent ID: ' . $temp->selling_agent_id,0,0);
                        }
                        if(isset($updates['selling_agent_name']) && $updates['selling_agent_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Selling Agent Name: ' . $temp->selling_agent_name,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Selling Agent Name: ' . $temp->selling_agent_name,0,1);
                        }
			
			
			
			if(isset($updates['agent_pager_cell']) && $updates['agent_pager_cell'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Pager / Cell: ' . $temp->agent_pager_cell,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Pager / Cell: ' . $temp->agent_pager_cell,0,0);
                        }
                        if(isset($updates['agent_fax']) && $updates['agent_fax'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Agent Fax: ' . $temp->agent_fax,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Agent Fax: ' . $temp->agent_fax,0,0);
                        }
                        if(isset($updates['selling_agent2_id']) && $updates['selling_agent2_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Selling Agent 2 ID: ' . $temp->selling_agent2_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Selling Agent 2 ID: ' . $temp->selling_agent2_id,0,0);
                        }
                        if(isset($updates['selling_agent2_name']) && $updates['selling_agent2_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Selling Agent 2 Name: ' . $temp->selling_agent2_name,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Selling Agent 2 Name: ' . $temp->selling_agent2_name,0,1);
                        }
                        
			
			if(isset($updates['list_agent2_id']) && $updates['list_agent2_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'List Agent 2 ID: ' . isset($temp->list_agent2_id),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'List Agent 2 ID: ' . isset($temp->list_agent2_id),0,0);
                        }
                        if(isset($updates['sales_team_name']) && $updates['sales_team_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Sales Team Name: ' . $temp->sales_team_name,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Sales Team Name: ' . $temp->sales_team_name,0,0);
                        }
                        if(isset($updates['selling_agent2_office_id']) && $updates['selling_agent2_office_id'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Selling Agent 2 Office ID: ' . $temp->selling_agent2_office_id,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Selling Agent 2 Office ID: ' . $temp->selling_agent2_office_id,0,0);
                        }
                        if(isset($updates['selling_agent2_office_name']) && $updates['selling_agent2_office_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'Selling Agent 2 Office Name: ' . $temp->selling_agent2_office_name,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'Selling Agent 2 Office Name: ' . $temp->selling_agent2_office_name,0,1);
                        }
			
			
			if(isset($updates['list_agent2_name']) && $updates['list_agent2_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'List Agent 2 Name: ' . isset($temp->list_agent2_name),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'List Agent 2 Name: ' . isset($temp->list_agent2_name),0,0);
                        }
                        if(isset($updates['list_agent2_phone']) && $updates['list_agent2_phone'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'List Agent 2 Phone: ' . isset($temp->list_agent2_phone),0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'List Agent 2 Phone: ' . isset($temp->list_agent2_phone),0,0);
                        }
                        if(isset($updates['list_office_number']) && $updates['list_office_number'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'List Office #: ' . $temp->list_office_number,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                           $pdf->Cell(50,4,'List Office #: ' . isset($temp->list_office_number),0,0);
                        }
                        if(isset($updates['list_office2_name']) && $updates['list_office2_name'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(50,4,'List Office 2 Name: ' . $temp->list_office2_name,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(50,4,'List Office 2 Name: ' . $temp->list_office2_name,0,1);
                        }
			
			
			
			
			
			
			if(isset($updates['buyer_agent_comp']) && $updates['buyer_agent_comp'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Buyer Agent Comp: ' . $temp->buyer_agent_comp,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Buyer Agent Comp: ' . $temp->buyer_agent_comp,0,0);
                        }
                        if(isset($updates['non_rep_comp']) && $updates['non_rep_comp'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(45,4,'Non-Rep Comp: ' . $temp->non_rep_comp,0,0);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(45,4,'Non-Rep Comp: ' . $temp->non_rep_comp,0,0);
                        }
                        if(isset($updates['trans_broker_comp']) && $updates['trans_broker_comp'] == 1){
                            $pdf->SetTextColor(255,230,0);
                            $pdf->Cell(70,4,'Trans Broker Comp: ' . $temp->trans_broker_comp,0,1);
                        }else{
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Cell(70,4,'Trans Broker Comp: ' . $temp->trans_broker_comp,0,1);
                        }
                        $pdf->SetFont('helvetica', 'B', 10);
			$pdf->SetFillColor(190,190,190);
			$pdf->SetTextColor(0,0,100);
			$pdf->Cell(0,5,'Photos',1,1,'C',true);
			
			$pdf->SetFont('helvetica','B',6);
			$pdf->SetTextColor(0,0,0);
			
			$x = 10;
			$y = 255;
			$i = 0;
                        
                        if( $images && !empty($images) && is_array($images)){
                            foreach($images as $k => $img){
                                    $i ++;
                                    $pdf->Image(Yii::app()->basePath.'/../upload/' . $img , $x, $y, 20, 20, '','','L');  
                                    $x += 25;
                                    if($i == 6){
                                            $y += 25;
                                            $x = 10;	
                                    }
                            }
                        }
			
			if($saveLocal){
				$pdf->Output(Yii::app()->basePath."/../upload/" . $temp->id . "_" . $temp->street_name . "_land.pdf", "F");
			}else{
				$pdf->Output(Yii::app()->basePath."/../upload/" . $temp->id . "_" . $temp->street_name . "_land.pdf", "I");
			}
		} else {
			$pdf = new TCPDF();
			$pdf->AddPage();
			$pdf->SetFont('helvetica','B',16);
			$pdf->Cell(40,10,'No record found / Not authorized');
			$pdf->Output();
		}
	}
	
	public function actionUpload()
	{
        Yii::import("ext.EAjaxUpload.qqFileUploader");
 
        $uploader = new qqFileUploader( app()->params['imgUploader']['allowedExtensions'] , app()->params['imgUploader']['sizeLimit'] );
        $result = $uploader->handleUpload( app()->params['imgUploader']['folder'] );
        $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
        echo $result;// it's array
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
			$model=Land::model()->findByPk($id);
		} else {
			$model=Land::model()->owner()->findByPk($id);
		}
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='land-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
         * checks for updates
         */
        public function checkUpdates($model, $post){
           $updates = array();
           foreach($post as $k=>$v){
               if($model[$k] != $post[$k]){
                   $updates[$k] = 1;
               }else{
                   $updates[$k] = 0;
               }
           }
           return $updates;
        }
		
		public function checkChanges($changes){
			foreach($changes as $key=>$value){
					if($value == 1 && $key != 'update_date' ){
						return true;
						}
				}
				return false;
			}
}


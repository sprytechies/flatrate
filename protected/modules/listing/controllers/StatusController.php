<?php

class StatusController extends RController
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
			'rights',
			//'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
/*	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'updateMls', 'updateLand', 'status', 'sales'),
				'users'=>Yii::app()->getModule('user')->getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/
	
	public function actionAdmin(){
		$resident = new Mls;
		$vacant = new Land;
		$this->render('admin', array('resident'=>$resident, 'vacant'=>$vacant));
	}
	
	public function actionUpdateMls($id){
		$model = Mls::model()->findByPk($id);
			
		if(isset($_POST['Mls'])){
			$model->attributes = $_POST['Mls'];
			if($model->save()){
				Yii::import('application.models.CC.*');
				$ct = new ConstantContact(
					Yii::app()->params['CCAuthType'], 
					Yii::app()->params['CCAPIKey'], 
					Yii::app()->params['CCUsername'], 
					Yii::app()->params['CCPassword']
				);
				
				$lists = $ct->getLists();
			
				$link = '';
				
				switch($model->list_status){
					case "PAID":
						foreach($lists['lists'] as $list){
							if($list->id === Yii::app()->params['CCActiveID'])
								$link = $list->id;
						}
					break;
					case "PENDING":
						foreach($lists['lists'] as $list){
							if($list->id === Yii::app()->params['CCPendingID'])
								$link = $list->id;
						}
					break;
					case "SOLD":
						foreach($lists['lists'] as $list){
							if($list->id === Yii::app()->params['CCSoldID'])
								$link = $list->id;
						}
					break;
				}
				
				if(!empty($link)){
					$search = $ct->searchContactsByEmail($model->email);
					
					if($search){
						$contact = $ct->getContactDetails($search[0]);
						$contact->optInSource = "ACTION_BY_CONTACT";
						$contact->lists[0] = $link;
						
						$ct->updateContact($contact);
					}
				}
				
				$this->redirect(array('/listing/status/admin'));
			}
		}
		$this->render('update', array('model'=>$model, 'type'=>'mls'));
	}
	
	public function actionUpdateLand($id){
		$model = Land::model()->findByPk($id);
		
		if(isset($_POST['Land'])){
			$model->attributes = $_POST['Land'];
			if($model->save()){
				$this->redirect(array('/listing/status/admin'));
			}
		}
		$this->render('updateLand', array('model'=>$model, 'type'=>'land'));
	}
	
	public function actionSales(){
		$sales = new TrackSales;
		$this->render("sales", array('model'=>$sales));
	}
}
?>
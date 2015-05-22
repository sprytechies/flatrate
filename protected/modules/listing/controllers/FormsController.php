<?php

class FormsController extends RController
{
	public function filters()
	{
		return array(
			'rights',
			//'accessControl', // perform access control for CRUD operations
		);
	}
/*	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('download'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('upload', 'uploadTo', 'download', 'delete'),
				'users'=>Yii::app()->getModule('user')->getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/
	
	public function actionUpload(){
		$model = new Document;
		if(isset($_POST['Document'])){
			$model->attributes = $_POST['Document'];
			if(is_array($model->filename)){
				foreach($model->filename as $k => $v){
					$tempDoc = new Document;
					$tempDoc->user_id = Yii::app()->user->id;
					$tempDoc->list_type = "Admin";
					$tempDoc->list_id = "";
					$tempDoc->filename = $v;
					$tempDoc->realname = $model->realname[$k];
					$tempDoc->save();
				}
			}else{
				$model->save();
			}
			$this->redirect(array('/listing/forms/download'));
		}
		$this->render("upload", array('model'=>$model));
	}
	
	public function actionDownload(){
		$model = new Document;
		$criteria = new CDbCriteria();
		$criteria->compare('list_type', "Admin");
		
		$data = new CActiveDataProvider($model, array('criteria'=>$criteria));
		$this->render("download", array('model'=>$data));
	}
	
	public function actionUploadTo()
	{
	        Yii::import("ext.EAjaxUpload.qqFileUploader");
	 
	        $uploader = new qqFileUploader( app()->params['imgUploader']['allowedExtensions'] , app()->params['imgUploader']['sizeLimit'] );
	        $result = $uploader->handleUpload( app()->params['imgUploader']['folder'] );
	        $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
			
	        echo $result;// it's array
	}
	
	public function actionDelete($id){
		if(Yii::app()->request->isPostRequest){
			$model = Document::model()->findByPk($id)->delete();if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
}
<?php
$this->menu=array(
	array('label'=>'Download Doc', 'url'=>array('/listing/forms/download')),
	array('label'=>'Upload Doc', 'url'=>array('/listing/forms/upload'), 'visible'=>Yii::app()->user->isAdmin()),
);
?>
<h1>Upload Form Document</h1>
<?php
$form=$this->beginWidget('CActiveForm', array(
        'id'=>'mls-form',
        'enableAjaxValidation'=>true,
    )); 
      $this->widget('ext.EAjaxUpload.EAjaxUpload',
          array(
              'id'=>'uploadFile',
              'config'=>array(
                     'action'=>'/index.php/listing/forms/uploadTo',
                     'allowedExtensions'=>array("doc", "docx", "pdf"), 
                     'template'=>'<div class="qq-uploader"><div class="qq-upload-button">Upload Form</div><ul class="qq-upload-list"></ul></div>',
                     'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                     //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                     'onComplete'=>"js:function(id, fileName, responseJSON)
                          { 
			  		if((fileName.indexOf('doc') != -1) || (fileName.indexOf('docx') != -1) || (fileName.indexOf('pdf') != -1)){
						$('#docHolder').append('<input type=\"hidden\" name=\"Document[filename][]\" value=\"' + responseJSON.filename + '\" />');
						$('#docHolder').append('<input type=\"hidden\" name=\"Document[realname][]\" value=\"' + responseJSON.realname + '\" />');
						return false;
					}
                          }",
                     'messages'=>array(
                                       'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                       'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                       'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                       'emptyError'=>"{file} is empty, please select files again without it.",
                                       'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                      ),
                     'showMessage'=>"js:function(message){ alert(message); }"
                    )
      ));
?>
<div id="docHolder"></div>
<?php echo CHtml::submitButton('Save Document'); ?>
<?php $this->endWidget(); ?>
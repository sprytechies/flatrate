<script type="text/javascript">
	$(document).ready(function(){
		$(".linkReply").click(function(){
			$("#form").show("slow");
		})
	})
</script>
<div>
	<h2>View Feedback (Subject: <?php echo $feedback->subject; ?>)</h2>
	<div id="divFB">
		<table>
			<thead>
				<tr>
					<th style="width: 100px;">From</th>
					<th>: <?php echo $feedback->name . " (" . $feedback->email . ")"; ?></th>
				</tr>
				<tr>
					<th>Date and Time</th>
					<th>: <?php echo $feedback->submit_date; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><b>Message:</b></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $feedback->body; ?></td>
				</tr>
			</tbody>
			<?php if(!$feedback->solved): ?>
			<tfoot>
				<tr>
					<td colspan="2"><p align="right"><a href="#form" class="linkReply">Reply&raquo;</a></p></td>
				</tr>
			</tfoot>
			<?php endif; ?>
		</table>
	</div>
<?php
	$cfeedback = FeedbackChild::model()->findAllByAttributes(array('parent_id'=>$id));
	foreach($cfeedback as $fb):
		$user = User::model()->findByPk($fb->user_id);
		$profile = Profile::model()->findByPk($fb->user_id);
?>
	<div id="divFB" <?php if($fb->user_id != Yii::app()->user->id) echo 'class="reply"'; ?>>
		<table>
			<thead>
				<tr>
					<th style="width: 100px;">Subject</th>
					<th>: <?php echo $fb->subject; ?></th>
				</tr>
				<tr>
					<th>From</th>
					<th>: <?php echo $profile->firstname . " (" . $user->email . ")"; ?></th>
				</tr>
				<tr>
					<th>Date and Time</th>
					<th>: <?php echo $fb->submit_date; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><b>Message:</b></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $fb->body; ?></td>
				</tr>
			</tbody>
			<?php if(!$feedback->solved): ?>
			<tfoot>
				<tr>
					<td colspan="2">
						<p align="right">
						<?php if($fb->user_id == Yii::app()->user->id): ?>
							<a href="/index.php/site/editFeedback/id/<?php echo $fb->id; ?>">Edit</a> | 
						<?php endif; ?>
						<a href="#form" class="linkReply">Reply&raquo;</a>
						</p>
					</td>
				</tr>
			</tfoot>
			<?php endif; ?>
		</table>
	</div>
<?php
	endforeach;
	
	if(!$feedback->solved) :
		echo CHtml::openTag('div') . CHtml::openTag('h4');
		echo "If your problem is solved, please click ";
		echo CHtml::submitButton("Set as Solved", array('submit'=>'/index.php/site/solved/id/' . $id));
		echo CHtml::closeTag('h4') . CHtml::closeTag('div') . "<br/>";
	else :
		echo "<h4>This problem already solved</h4>";
	endif;
?>

<div class="form" id="form" style="display:none;">
<h3>Reply</h3>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-feedback-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject', array('value'=> 'Re: ' . $feedback->subject)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body', array('cols'=>'50', 'rows'=>'5')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'user_id', array('value'=>Yii::app()->user->id)); ?>
		<?php echo $form->hiddenField($model, 'parent_id', array('value'=> $id)); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>
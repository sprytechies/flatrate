<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $submit_date
 * @property integer $solved
 * @property integer $priority
 */
class Feedback extends CActiveRecord
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Feedback the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, subject, body, priority', 'required'),
			array('user_id, priority', 'numerical', 'integerOnly'=>true),
			array('name, email, subject', 'length', 'max'=>50),
			array('submit_date, solved', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			array('id, user_id, name, email, subject, body, submit_date, solved, priority', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Name',
			'email' => 'Email',
			'subject' => 'Subject',
			'body' => 'Body',
			'submit_date' => 'Submit Date',
			'solved' => 'Solved',
			'priority' => 'Priority',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		if(Yii::app()->user->isAdmin())
			$criteria->compare('user_id', $this->user_id);
		else
			$criteria->compare('user_id', Yii::app()->user->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('submit_date',$this->submit_date,true);
		$criteria->compare('priority',$this->priority);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            )
		));
	}
	
	public function PriorityAllias($prio, $solved){
		if($solved)
			$extra = "<font color='green'><strong> (Solved)</strong></font>";
			
		switch($prio){
			case 1:
				return "<font color='#808080'>Low</font>$extra"; break;
			case 2:
				return "<font color='#ff8000'>Medium</font>$extra"; break;
			case 3:
				return "<font color='#ff0000'>High</font>$extra"; break;
		}
	}
}
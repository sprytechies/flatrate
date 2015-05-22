<?php

/**
 * This is the model class for table "CTCTAccessToken".
 *
 * The followings are the available columns in table 'CTCTAccessToken':
 * @property string $username
 * @property string $key
 * @property string $secret
 */
class CTCTAccessToken extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CTCTAccessToken the static model class
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
		return 'CTCTAccessToken';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, key, secret', 'required'),
			array('username, key, secret', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, key, secret', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'key' => 'Key',
			'secret' => 'Secret',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('secret',$this->secret,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
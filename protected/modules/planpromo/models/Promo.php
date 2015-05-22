<?php

/**
 * This is the model class for table "promo".
 *
 * The followings are the available columns in table 'promo':
 * @property integer $id
 * @property string $promo_code
 * @property string $promo_name
 * @property string $disc_amount
 * @property string $disc_type
 * @property string $start_date
 * @property string $end_data
 * @property string $plans
 * @property integer $publish
 */
class Promo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Promo the static model class
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
		return 'promo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('promo_code, promo_name, disc_amount, disc_type, plans, publish', 'required'), //, start_date, end_data
			array('publish', 'numerical', 'integerOnly'=>true),
			array('promo_code', 'length', 'max'=>10),
			array('promo_name', 'length', 'max'=>50),
			array('disc_amount', 'length', 'max'=>15),
			array('disc_type', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, promo_code, promo_name, disc_amount, disc_type, start_date, end_data, plans, publish', 'safe', 'on'=>'search'),
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
			'promo_code' => 'Promo Code',
			'promo_name' => 'Promo Name',
			'disc_amount' => 'Disc Amount',
			'disc_type' => 'Disc Type',
			'start_date' => 'Start Date',
			'end_data' => 'End Data',
			'plans' => 'Plans',
			'publish' => 'Publish',
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
		$criteria->compare('promo_code',$this->promo_code,true);
		$criteria->compare('promo_name',$this->promo_name,true);
		$criteria->compare('disc_amount',$this->disc_amount,true);
		$criteria->compare('disc_type',$this->disc_type,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_data',$this->end_data,true);
		$criteria->compare('plans',$this->plans,true);
		$criteria->compare('publish',$this->publish);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
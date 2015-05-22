<?php

/**
 * This is the model class for table "plan".
 *
 * The followings are the available columns in table 'plan':
 * @property integer $id
 * @property string $plan_code
 * @property string $plan_name
 * @property string $price
 * @property string $trial_price
 */
class Plan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Plan the static model class
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
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('plan_code, plan_name, price', 'required'),
			array('plan_code', 'length', 'max'=>10),
			array('plan_name', 'length', 'max'=>50),
			array('price, trial_price', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, plan_code, plan_name, price, trial_price', 'safe', 'on'=>'search'),
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
			'plan_code' => 'Plan Code',
			'plan_name' => 'Plan Name',
			'price' => 'Price',
			'trial_price' => 'Trial Price',
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
		$criteria->compare('plan_code',$this->plan_code,true);
		$criteria->compare('plan_name',$this->plan_name,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('trial_price',$this->trial_price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getPlans(){
		$plans = Plan::model()->findAll();
		$array = array(''=>'Select a plan');
		foreach($plans as $k => $v){
			$array[$v['plan_code']] = $v['plan_name'];
		}
		return $array;
	}
}
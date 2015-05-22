<?php

/**
 * This is the model class for table "track_sales".
 *
 * The followings are the available columns in table 'track_sales':
 * @property integer $id
 * @property string $item_name
 * @property double $pay
 * @property string $payment_date
 * @property string $paypal_trans_id
 * @property string $full_name
 */
class TrackSales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TrackSales the static model class
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
		return 'track_sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pay', 'numerical'),
			array('item_name, paypal_trans_id', 'length', 'max'=>50),
			array('listing_id', 'numerical', 'integerOnly'=>true),
			array('full_name', 'length', 'max'=>100),
			array('listing_type', 'length', 'max'=>20),
			array('payment_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_name, pay, payment_date, paypal_trans_id, full_name', 'safe', 'on'=>'search'),
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
			'item_name' => 'Item Name',
			'pay' => 'Pay',
			'payment_date' => 'Payment Date',
			'paypal_trans_id' => 'Paypal Trans',
			'full_name' => 'Full Name',
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
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('pay',$this->pay);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('paypal_trans_id',$this->paypal_trans_id,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('listing_type', $this->listing_type, true);
		$criteria->compare('listing_id', $this->listing_id, true);
/*		if($this->listing_type == "MLS")
			$criteria->join = "LEFT JOIN mls ON mls.id = listing_id";
		elseif($this->listing_type == "VACANT")
			$criteria->join = "LEFT JOIN land ON land.id = listing_id";
*/
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
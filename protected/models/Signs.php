<?php

/**
 * This is the model class for table "signs".
 *
 * The followings are the available columns in table 'signs':
 * @property integer $idsigns
 * @property integer $iduser
 * @property string $created_date
 * @property string $transaction_id
 * @property integer $status
 * @property string $idlink
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $phone
 */
class Signs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Signs the static model class
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
		return 'signs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iduser, scity, scountry, szipcode', 'required'),
			array('iduser, status', 'numerical', 'integerOnly'=>true),
			array('transaction_id', 'length', 'max'=>32),
			array('idlink, scity', 'length', 'max'=>64),
			array('scountry', 'length', 'max'=>20),
			array('szipcode,bzip', 'length', 'max'=>15),
			array('phone', 'length', 'max'=>20),
			array('saddress', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idsigns, iduser, created_date, transaction_id, status, idlink, saddress, scity, scountry, szipcode, phone', 'safe', 'on'=>'search'),
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
			'idsigns' => 'Idsigns',
			'iduser' => 'Iduser',
			'created_date' => 'Created Date',
			'transaction_id' => 'Transaction',
			'status' => 'Status',
			'idlink' => 'Idlink',
			'saddress' => 'Address',
			'scity' => 'Shipping City',
			'scountry' => 'Shipping Country',
			'szipcode' => 'Shipping Zip Code',
			'baddress' => 'Billing Address',
			'bcity' => 'Billing City',
			'bstate' => 'Billing State',
			'bzip' => 'Billing Zip Code',
			'bcountry' => 'Billing Country',
			'phone' => 'Phone',
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

		$criteria->compare('idsigns',$this->idsigns);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('idlink',$this->idlink,true);
		$criteria->compare('saddress',$this->saddress,true);
		$criteria->compare('scity',$this->city,true);
		$criteria->compare('scountry',$this->state,true);
		$criteria->compare('szipcode',$this->zipcode,true);
		$criteria->compare('phone',$this->phone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function behaviors(){
	return array(
		'CTimestampBehavior' => array(
			'class' => 'zii.behaviors.CTimestampBehavior',
			'createAttribute' => 'created_date',
			'updateAttribute' => 'updated_date',
		)
	);
        }
        
        public function status($value){
            $status = array('1'=>'In Process', '2'=>'Delivery Sent', '3'=>'Delivered');
            return $status['$value'];
        }
}
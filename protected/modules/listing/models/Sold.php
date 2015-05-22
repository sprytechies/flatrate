<?php

/**
 * This is the model class for table "Sold".
 *
 * The followings are the available columns in table 'Sold':
 * @property integer $listing_id
 * @property string $listing_type
 * @property string $selling_agent_id
 * @property string $sold_date
 * @property double $sold_price
 * @property string $sold_terms
 * @property string $seller_paid_buyer_costs
 */
class Sold extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Sold the static model class
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
		return 'Sold';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id, listing_type, selling_agent_id, sold_date, sold_price, sold_terms, seller_paid_buyer_costs', 'required'),
			array('listing_id', 'numerical', 'integerOnly'=>true),
			array('sold_price', 'numerical'),
			array('listing_type', 'length', 'max'=>10),
			array('selling_agent_id, sold_terms', 'length', 'max'=>50),
			array('seller_paid_buyer_costs', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('listing_id, listing_type, selling_agent_id, sold_date, sold_price, sold_terms, seller_paid_buyer_costs', 'safe', 'on'=>'search'),
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
			'listing_id' => 'Listing',
			'listing_type' => 'Listing Type',
			'selling_agent_id' => 'Selling Agent',
			'sold_date' => 'Sold Date',
			'sold_price' => 'Sold Price',
			'sold_terms' => 'Sold Terms',
			'seller_paid_buyer_costs' => 'Seller Paid Buyer Costs',
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

		$criteria->compare('listing_id',$this->listing_id);
		$criteria->compare('listing_type',$this->listing_type,true);
		$criteria->compare('selling_agent_id',$this->selling_agent_id,true);
		$criteria->compare('sold_date',$this->sold_date,true);
		$criteria->compare('sold_price',$this->sold_price);
		$criteria->compare('sold_terms',$this->sold_terms,true);
		$criteria->compare('seller_paid_buyer_costs',$this->seller_paid_buyer_costs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getSoldTerms(){
		return array(
			''=>"Select a Sold Terms...",
			'2nd Mortgage'=>'2nd Mortgage',
			'All Cash'=>'All Cash',
			'ARM'=>'ARM',
			'Assume Conventional'=>'Assume Conventional',
			'Assume FHA/VA'=>'Assume FHA/VA',
			'Assume Private'=>'Assume Private',
			'Balloon Mortgage'=>'Balloon Mortgage',
			'Combination'=>'Combination',
			'Deed Agreement'=>'Deed Agreement',
			'Lease Option/Purchase'=>'Lease Option/Purchase',
			'New Conventional'=>'New Conventional',
			'New FHA'=>'New FHA',
			'New Private'=>'New Private',
			'New VA'=>'New VA',
			'Not Applicable'=>'Not Applicable',
			'Other'=>'Other',
			'Tampa Assumable'=>'Tampa Assumable',
			'Wrap-Around'=>'Wrap-Around'
		);
	}
	
	public function beforeSave(){
		$this->sold_date = date("Y-m-d", strtotime($this->sold_date));
		
		return true;
	}
}
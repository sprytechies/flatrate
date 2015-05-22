<?php

/**
 * This is the model class for table "pending".
 *
 * The followings are the available columns in table 'pending':
 * @property integer $listing_id
 * @property string $listing_type
 * @property string $contract_date
 * @property string $contract_status
 * @property string $expected_close_date
 */
class Pending extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Pending the static model class
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
		return 'pending';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id, listing_type, contract_status, expected_close_date, selling_agent_id, sold_date, sold_price, sold_terms, seller_paid_buyer_costs', 'required'),
			array('listing_id', 'numerical', 'integerOnly'=>true),
			array('listing_type', 'length', 'max'=>10),
			array('contract_status', 'length', 'max'=>50),
            array('selling_agent_id, sold_terms', 'length', 'max'=>50),
			array('seller_paid_buyer_costs,sold_price', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('listing_id, listing_type, contract_date, contract_status, expected_close_date,selling_agent_id, sold_date, sold_price, sold_terms, seller_paid_buyer_costs', 'safe', 'on'=>'search'),
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
			'contract_date' => 'Contract Date',
			'contract_status' => 'Contract Status',
			'expected_close_date' => 'Expected Closing Date',
            'selling_agent_id' => 'Selling Agent and Company they work with',
			'sold_date' => 'Sold Date',
			'sold_price' => 'Sold Price',
			'sold_terms' => 'Sold Terms',
			'seller_paid_buyer_costs' => 'How much, if any, are you going to pay towards the Buyers closing costs or cash back at closing?',
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
		$criteria->compare('contract_date',$this->contract_date,true);
		$criteria->compare('contract_status',$this->contract_status,true);
		$criteria->compare('expected_close_date',$this->expected_close_date,true);
                $criteria->compare('selling_agent_id',$this->selling_agent_id,true);
		$criteria->compare('sold_date',$this->sold_date,true);
		$criteria->compare('sold_price',$this->sold_price);
		$criteria->compare('sold_terms',$this->sold_terms,true);
		$criteria->compare('seller_paid_buyer_costs',$this->seller_paid_buyer_costs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getContractStatus(){
		return array(
			''=>'Select Contract Status...',
			'Back-ups Requested'=>'Back-ups Requested',
			'Financing'=>'Financing',
			'Inspections'=>'Inspections',
			'Kick Out Clause'=>'Kick Out Clause',
			'No Contingency'=>'No Contingency',
			'Other'=>'Other',
			'Pending 3rd Party Approval'=>'Pending 3rd Party Approval',
			'Right of 1st Refusal'=>'Right of 1st Refusal',
		);
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
	
	public function primaryKey(){
		return array('listing_id', 'listing_type');
	}
	
	public function beforeSave(){
		$this->contract_date = date("Y-m-d", strtotime($this->contract_date));
		$this->expected_close_date = date("Y-m-d", strtotime($this->expected_close_date));
                $this->sold_date = date("Y-m-d", strtotime($this->sold_date));
		
		return true;
	}
	
	protected function afterFind ()
    {
            // convert to display format
			$this->expected_close_date = Yii::app()->dateFormatter->format('yyyy-MM-dd', CDateTimeParser::parse($this->expected_close_date, 'yyyy-MM-dd'));
			$this->sold_date = Yii::app()->dateFormatter->format('yyyy-MM-dd', CDateTimeParser::parse($this->sold_date, 'yyyy-MM-dd'));

        parent::afterFind ();
    }
}
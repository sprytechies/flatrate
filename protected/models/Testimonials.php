<?php

/**
 * This is the model class for table "testimonials".
 *
 * The followings are the available columns in table 'testimonials':
 * @property integer $idtestimonial
 * @property string $cdate
 * @property string $mdate
 * @property string $testimonial
 * @property string $client
 * @property string $designation
 * @property string $company
 */
class Testimonials extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Testimonials the static model class
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
		return 'testimonials';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cdate', 'length', 'max'=>20),
			array('client, designation, company', 'length', 'max'=>256),
			array('mdate, testimonial', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idtestimonial, cdate, mdate, testimonial, client, designation, company', 'safe', 'on'=>'search'),
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
			'idtestimonial' => 'Idtestimonial',
			'cdate' => 'Cdate',
			'mdate' => 'Mdate',
			'testimonial' => 'Testimonial',
			'client' => 'Client',
			'designation' => 'Designation',
			'company' => 'Company',
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

		$criteria->compare('idtestimonial',$this->idtestimonial);
		$criteria->compare('cdate',$this->cdate,true);
		$criteria->compare('mdate',$this->mdate,true);
		$criteria->compare('testimonial',$this->testimonial,true);
		$criteria->compare('client',$this->client,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('company',$this->company,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'sort'=>array(
                            'defaultOrder'=>'idtestimonial DESC',
                            )
		));
	}
}
<?php

/**
 * This is the model class for table "list_dump".
 *
 * The followings are the available columns in table 'list_dump':
 * @property integer $id_list_dump
 * @property string $dump
 */
class ListDump extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ListDump the static model class
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
		return 'list_dump';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dump', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_list_dump, dump', 'safe', 'on'=>'search'),
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
			'id_list_dump' => 'Id List Dump',
			'dump' => 'Dump',
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

		$criteria->compare('id_list_dump',$this->id_list_dump);
		$criteria->compare('dump',$this->dump,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
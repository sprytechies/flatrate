<?php

/**
 * This is the model class for table "survey".
 *
 * The followings are the available columns in table 'survey':
 * @property integer $id
 * @property integer $mls_id
 * @property string $hear_about
 * @property string $hear_about_text
 * @property integer $how_easy
 * @property string $refer_other
 * @property string $suggestion
 * @property string $how_long
 * @property string $help_chat
 * @property string $difficult_part
 */
class Survey extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Survey the static model class
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
		return 'survey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mls_id, hear_about, how_easy, refer_other, suggestion, how_long, help_chat, difficult_part', 'required'),
			array('mls_id, how_easy', 'numerical', 'integerOnly'=>true),
			array('hear_about, hear_about_text, how_long, help_chat', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mls_id, hear_about, hear_about_text, how_easy, refer_other, suggestion, how_long, help_chat, difficult_part', 'safe', 'on'=>'search'),
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
			'mls_id' => 'MLS ID',
			'hear_about' => 'How did you hear about us?',
			'hear_about_text' => 'Remark',
			'how_easy' => 'On a scale of 1-10 (1 being hard to use, 10 being easy to use). How easy was it for you to use the MLS listing form you just completed?',
			'refer_other' => 'Would you refer others to use our service?',
			'suggestion' => 'We know we are not perfect. What is one (you can give more) suggestion you would offer to make our service better for you?',
			'how_long' => 'Approximately how much time did it take you to complete the form?',
			'help_chat' => 'How many properties will you likely sell in a year?',
			'difficult_part' => 'What question or part of the form did you find most difficult?',
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
		$criteria->compare('mls_id',$this->mls_id);
		$criteria->compare('hear_about',$this->hear_about,true);
		$criteria->compare('hear_about_text',$this->hear_about_text,true);
		$criteria->compare('how_easy',$this->how_easy);
		$criteria->compare('refer_other',$this->refer_other,true);
		$criteria->compare('suggestion',$this->suggestion,true);
		$criteria->compare('how_long',$this->how_long,true);
		$criteria->compare('help_chat',$this->help_chat,true);
		$criteria->compare('difficult_part',$this->difficult_part,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'sort'=>array(
                            'defaultOrder'=>'id DESC',
                            )
		));
	}
}
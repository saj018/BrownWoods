<?php

/**
 * This is the model class for table "userpropertytype".
 *
 * The followings are the available columns in table 'userpropertytype':
 * @property integer $UserPropertyTypeID
 * @property string $UserPropertyType
 * @property integer $IsActive
 *
 * The followings are the available model relations:
 * @property Userproperty[] $userproperties
 */
class Userpropertytype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userpropertytype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserPropertyType, IsActive', 'required'),
			array('IsActive', 'numerical', 'integerOnly'=>true),
			array('UserPropertyType', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('UserPropertyTypeID, UserPropertyType, IsActive', 'safe', 'on'=>'search'),
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
			'userproperties' => array(self::HAS_MANY, 'Userproperty', 'UserPropertyTypeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserPropertyTypeID' => 'User Property Type',
			'UserPropertyType' => 'User Property Type',
			'IsActive' => 'Is Active',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('UserPropertyTypeID',$this->UserPropertyTypeID);
		$criteria->compare('UserPropertyType',$this->UserPropertyType,true);
		$criteria->compare('IsActive',$this->IsActive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userpropertytype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $UserID
 * @property integer $UserTypeID
 * @property string $FirstName
 * @property string $LastName
 * @property integer $TelephoneNumber
 * @property integer $Email
 * @property string $Password
 * @property string $City
 * @property string $Province
 * @property string $Country
 * @property integer $IsActive
 *
 * The followings are the available model relations:
 * @property Userproperty[] $userproperties
 * @property Usertype $userType
 * @property Userproperty[] $userproperties1
 */
class User extends CActiveRecord
{
	public $disabledItems;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserTypeID, FirstName, LastName, TelephoneNumber, Username, Password, City, Province, Country, IsActive', 'required'),
			array('UserTypeID, TelephoneNumber, IsActive', 'numerical', 'integerOnly'=>true),
			array('FirstName, LastName, Password, City, Province, Country', 'length', 'max'=>100),
            array('TelephoneNumber', 'length','min'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('UserID, UserTypeID, FirstName, LastName, TelephoneNumber, Email, Password, City, Province, Country, IsActive', 'safe', 'on'=>'search'),
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
			'userproperties' => array(self::MANY_MANY, 'Userproperty', 'bid(UserID, UserPropertyID)'),
			'userType' => array(self::BELONGS_TO, 'Usertype', 'UserTypeID'),
			'userproperties1' => array(self::HAS_MANY, 'Userproperty', 'UserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserID' => 'User',     
			'UserTypeID' => 'User Type',
			'FirstName' => 'First Name',
			'LastName' => 'Last Name',
			'TelephoneNumber' => 'Telephone Number',
			'Email' => 'Email',
			'Password' => 'Password',
			'City' => 'City',
			'Province' => 'Province',
			'Country' => 'Country',
			'IsActive' => 'Is Active',
			'disabledItems' => 'Disable Items',
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
        $criteria->condition = (Yii::app()->user->isStaff())? 'UserTypeID!=1' :'';
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('TelephoneNumber',$this->TelephoneNumber);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('Country',$this->Country,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

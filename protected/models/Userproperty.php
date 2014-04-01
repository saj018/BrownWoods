<?php

/**
 * This is the model class for table "userproperty".
 *
 * The followings are the available columns in table 'userproperty':
 * @property integer $UserPropertyID
 * @property integer $UserID
 * @property integer $Bedroom
 * @property integer $Bathroom
 * @property integer $UserPropertyTypeID
 * @property integer $SquareFootage
 * @property integer $Price
 * @property string $City
 * @property string $Country
 * @property string $Province
 * @property string $Address
 * @property string $AdditionalInformation
 * @property integer $IsActive
 *
 * The followings are the available model relations:
 * @property User[] $users
 * @property User $user
 * @property Userpropertytype $userPropertyType
 */
class Userproperty extends CActiveRecord
{
	private $pictures;
    public $fullname;
    public $userPropertyTypeName;
	function setFirstPicture($value) {
		$this->pictures = $value;
	}
	function getFirstPicture() {
		return $this->pictures;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userproperty';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, Bedroom, Bathroom, UserPropertyTypeID, SquareFootage, Price, City, Country, Province, Address, IsActive', 'required'),
			array('UserID, Bedroom, Bathroom, UserPropertyTypeID, SquareFootage, Price, IsActive', 'numerical', 'integerOnly'=>true),
			array('City, Country, Province', 'length', 'max'=>100),
			array('Address, AdditionalInformation', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('UserPropertyID, UserID, Bedroom, Bathroom, UserPropertyTypeID, SquareFootage, Price, City, Country, Province, Address, AdditionalInformation, IsActive', 'safe', 'on'=>'search'),
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
			'users' => array(self::MANY_MANY, 'User', 'bid(UserPropertyID, UserID)'),
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'userPropertyType' => array(self::BELONGS_TO, 'Userpropertytype', 'UserPropertyTypeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'UserPropertyID' => 'User Property',
			'UserID' => 'User',
            'fullname'=>'FullName',
            'userPropertyTypeName'=>'Property Type',            
			'Bedroom' => 'Bedroom',
			'Bathroom' => 'Bathroom',
			'UserPropertyTypeID' => 'User Property Type',
			'SquareFootage' => 'Square Footage',
			'Price' => 'Price',
			'City' => 'City',
			'Country' => 'Country',
			'Province' => 'Province',
			'Address' => 'Address',
			'AdditionalInformation' => 'Additional Information',
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

		$criteria->compare('UserPropertyID',$this->UserPropertyID);
		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('Bedroom',$this->Bedroom);
		$criteria->compare('Bathroom',$this->Bathroom);
		$criteria->compare('UserPropertyTypeID',$this->UserPropertyTypeID);
		$criteria->compare('SquareFootage',$this->SquareFootage);
		$criteria->compare('Price',$this->Price);
		$criteria->compare('City',$this->City,true);
		$criteria->compare('Country',$this->Country,true);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('AdditionalInformation',$this->AdditionalInformation,true);
		$criteria->compare('IsActive',$this->IsActive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Userproperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

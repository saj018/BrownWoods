<?php

class BiddedUser extends CFormModel{
	
	public $userID;
	public $firstName;
	public $lastName;
	public $price;
	public $isSold;

	public function attributeLabels()
	{
		return array(
			'userID' => 'UserID',
			'firstName' => 'FirstName',
			'lastName' => 'LastName',
			'price' => 'Price',
			'isSold' => 'IsSold',

			
			);
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('bid', 'required'),
			array('bid', 'numerical', 'integerOnly'=>true, 'message'=>'Should be a number')
		);*/
	}

}

?>

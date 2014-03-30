<?php

class PropertyDetail extends CFormModel{
    public $userid;
	public $userpropertyid;
	public $bedroom;
	public $bathroom;
	public $price;
	public $address;
	public $country;
	public $city;
	public $province;
	public $additionalInformation;
	public $showwishlist;
	public $bid;

    public function attributeLabels()
    {
        return array(
            'userid'=>'UserID',
			'userpropertyid' => 'UserPropertyID',
			'bedroom' => 'Bedroom',
			'bathroom' => 'Bathroom',
			'price' => 'Price',
			'address' => 'Address',
			'country' => 'Country',
			'city' => 'City',
			'province' => 'Province',
			'additionalinformation' => 'Additional Information',
			'showwishlist'=>'ShowWishList',
			'showbid'=>'ShowBid',
			'bid'=>'Bid',
			
        );
    }
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bid', 'required'),
			array('bid', 'numerical', 'integerOnly'=>true, 'message'=>'Should be a number')
		);
	}

}

?>

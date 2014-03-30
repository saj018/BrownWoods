<?php

class CustomSearch extends CFormModel{
	
	public $searchtext;


    public function attributeLabels()
    {
        return array(
			'searchtext' => 'Search',
        );
    }
	
	public function rules()
	{
		return array(
			// searchtext
			array('searchtext', 'required'),
		);
	}

}

?>

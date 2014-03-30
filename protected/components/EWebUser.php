<?php
class EWebUser extends CWebUser{
 
    protected $_model;
 
    function isAdmin(){
        $user = $this->loadUser();
        if ($user)
           return $user->UserTypeID==LevelLookUp::ADMIN;
        return false;
    }
	function isGuest(){
		return $this->getIsGuest();
	}
	function isBuyer(){
		$user = $this->loadUser();
		if ($user)
			return $user->UserTypeID==LevelLookUp::BUYER;
		return false;
	}
	function isVendor(){
		$user = $this->loadUser();
		if ($user)
			return $user->UserTypeID==LevelLookUp::VENDOR;
		return false;
	}
    function isStaff(){
        $user = $this->loadUser();
		if ($user)
			return $user->UserTypeID==LevelLookUp::STAFF;
		return false;
    }
 
    // Load user model.
    protected function loadUser()
    {
        if ( $this->_model === null  && !$this->isGuest()) {
                $this->_model = User::model()->findByPk( $this->id );
			$userID = $this->_model->UserID;
        }
        return $this->_model;
    }
	public function getUserID(){
		$user = $this->loadUser();
		if ($user)
			return  $user->UserID;
		return -1;
	}
}
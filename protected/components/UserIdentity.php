<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $username = strtolower($this->username);
        $password = strtolower($this->password);
        // from database... change to suite your authentication criteria
        // -- Nope, I wont include mine --
        $user = User::model()->find('LOWER(Username)=? AND LOWER(Password)=?', array($username, $password));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        //else if(!$user->validatePassword($this->password))
            //$this->errorCode = self::ERROR_PASSWORD_INVALID;
        else{
            // successful login
            $this->_id = $user->UserID;
            $this->username = $user->Username;
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }
    public function getId()
    {
        return $this->_id;
    }
}
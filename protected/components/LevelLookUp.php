<?php
class LevelLookUp{
	
	  const ADMIN  = 1;
      const BUYER = 2;
	  const VENDOR = 3;
      const STAFF = 4;
      // For CGridView, CListView Purposes
      public static function getLabel( $level ){
		if($level == self::BUYER)
             return 'Buyer';
          if($level == self::ADMIN)
             return 'Administrator';
		if($level == self::VENDOR)
			return 'Vendor';
        if($level == self::STAFF)
			return 'Staff';
          return false;
      }
      // for dropdown lists purposes
      public static function getLevelList(){
		return array(
			self::BUYER=>'Buyer',
			self::ADMIN=>'Administrator',
			self::VENDOR=>'Vendor',
            self::STAFF=>'Staff');
    }
}
<?php

class WishlistController extends Controller
{
	public function actionIndex()
	{
		$userPropertyModel = Userproperty::model()->findAllBySql("SELECT UserProperty.* FROM WishList INNER JOIN UserProperty ON WishList.UserPropertyID = UserProperty.UserPropertyID INNER JOIN User ON WishList.UserID = User.UserID WHERE WishList.UserID =:uID", array(":uID"=>Yii::app()->user->id));
		$userPropertyPictures = new Picture();
        if(!(empty($userPropertyModel))){
    		foreach($userPropertyModel as &$userProperty){
    			$criteria = new CDbCriteria;
    			$criteria->select = '*';
    			$criteria->condition = 'UserPropertyID=:upid LIMIT 1';
    			$criteria->params = array(':upid'=>$userProperty->UserPropertyID);
    			//If there are pictures
    			$userProperty->setFirstPicture($userPropertyPictures->findAll($criteria));
    			
    		}
        }
        else{
            Yii::app()->user->setFlash('information', 'There are no properties in your wishlist');
        }
		
		$this->render('index', 
			array('userPropertyModel'=>$userPropertyModel, 		
				'userPropertyPictures'=>$userPropertyPictures)
		);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
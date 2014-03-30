<?php

class PropertyDetailController extends Controller
{
	
	public function actionIndex($item)
	{
		$userPropertyModel = new Userproperty();
		$userPropertyDetails = new PropertyDetail();
		$userPropertyPictures = new Picture();
		$wishList = new Wishlist();
		$bid = new Bid();
		$biddedUser = array();

		
		$userPropertyID = $item;
		//Get the user property based on the item passed
		$userPropertyModel = $userPropertyModel->findByPk($item);
		
		//Set the data to the property details model 
        $userPropertyDetails->userid = $userPropertyModel->UserID;
		$userPropertyDetails->userpropertyid = $userPropertyModel->UserPropertyID;
		$userPropertyDetails->bedroom = $userPropertyModel->Bedroom;
		$userPropertyDetails->bathroom = $userPropertyModel->Bathroom;
		$userPropertyDetails->price = $userPropertyModel->Price;
		$userPropertyDetails->address = $userPropertyModel->Address;
		$userPropertyDetails->country = $userPropertyModel->Country;
		$userPropertyDetails->city = $userPropertyModel->City;
		$userPropertyDetails->province = $userPropertyModel->Province;
		$userPropertyDetails->additionalInformation = $userPropertyModel->AdditionalInformation;
		$userPropertyDetails->showwishlist = false;
		
		//Get the picture and set it
		$criteria = new CDbCriteria;
		$criteria->select = '*';
		$criteria->condition = 'UserPropertyID=:upid';
		$criteria->params = array(':upid'=>$userPropertyModel->UserPropertyID);
		$userPropertyPictures = $userPropertyPictures->findAll($criteria);
		
		$queryUserAlreadyAddedToWishList = $wishList->findAllBySql("SELECT * FROM Wishlist WHERE UserID=:uID AND UserPropertyID=:uPropID",array(":uID"=>Yii::app()->user->id, ":uPropID"=>$item));
        $user = User::model()->findAllBySql("SELECT User.UserID, User.FirstName, User.LastName FROM bid INNER JOIN UserProperty ON bid.UserPropertyID = UserProperty.UserPropertyID INNER JOIN User ON bid.UserID = User.UserID WHERE UserProperty.UserPropertyID = :uPropID", array(":uPropID"=>$item));
		$biddedData = Bid::model()->findAllBySql("SELECT bid.Price, bid.IsSold FROM bid INNER JOIN UserProperty ON bid.UserPropertyID = UserProperty.UserPropertyID INNER JOIN User ON bid.UserID = User.UserID WHERE UserProperty.UserPropertyID = :uPropID", array(":uPropID"=>$item));
		if(!(Yii::app()->user->isGuest)){
			if(Yii::app()->user->isVendor() || Yii::app()->user->isAdmin()){

				for($i=0; $i<count($user); $i++){
					$bidUser =  new BiddedUser();
					$bidUser->userID = $user[$i]->UserID;
					$bidUser->firstName = $user[$i]->FirstName;
					$bidUser->lastName = $user[$i]->LastName;
					$bidUser->price = $biddedData[$i]->Price;
					$bidUser->isSold = $biddedData[$i]->IsSold;
					$biddedUser[$i] = $bidUser;
				}
			}
            if(Yii::app()->user->isBuyer()){
            	for($i=0; $i<count($user); $i++){
            	  if($user[$i]->UserID == Yii::app()->user->id){
    					$bidUser =  new BiddedUser();
    					$bidUser->userID = $user[$i]->UserID;
    					$bidUser->firstName = $user[$i]->FirstName;
    					$bidUser->lastName = $user[$i]->LastName;
    					$bidUser->price = $biddedData[$i]->Price;
    					$bidUser->isSold = $biddedData[$i]->IsSold;
    					$biddedUser[$i] = $bidUser;
                    }
				}
            }
			if(!$queryUserAlreadyAddedToWishList){
				
				$userPropertyDetails->showwishlist = true;
			}
		}
		
		
		$this->render('index', array('userPropertyModelDetails'=>$userPropertyDetails, 'userPropertyPictures'=> $userPropertyPictures, 'biddedUser'=>$biddedUser));
	}
	
	public function actionWishlist($item)
	{
		$wishList = new Wishlist();
				
		$wishList->UserID = Yii::app()->user->id;
		$wishList->UserPropertyID = $item;
		if($wishList->save()){
			Yii::app()->user->setFlash('success', 'Property was added to wishlist');
		}
		else{
			Yii::app()->user->setFlash('error', 'Failed to add property to wishlist');
		}

		
		$this->actionIndex($item);		

	}
	public function actionCreate($item){
		$propertyDetail =  new PropertyDetail();
		$bid =  new Bid();
		$userID = Yii::app()->user->id;
		
		if(isset($_POST["PropertyDetail"])){
			if($_POST["PropertyDetail"]["bid"]){
				$propertyDetail->bid = $_POST["PropertyDetail"]["bid"];
				if($propertyDetail->validate()){
					
					
					//Check if record already exists
					$queryUserPropertyBid = Bid::model()->findBySql("SELECT * FROM Bid WHERE UserID=:uID AND UserPropertyID=:uPropID",array(":uID"=>$userID, ":uPropID"=>$item));
					$bid->UserID = $userID;
					$bid->UserPropertyID = $item;
					$bid->IsSold = 0;	
					
					$bid->Price = $propertyDetail->bid;
			
					if($queryUserPropertyBid==null){	
											
						
						if($bid->save()){
							Yii::app()->user->setFlash('success', 'Bid was successfully added');
						}
						else{
							Yii::app()->user->setFlash('error', 'Failed to add bid');
						}
					}
					else{					
						$queryUserPropertyBid->Price = $bid->Price;
						if($queryUserPropertyBid->saveAttributes(array('Price'))){
							Yii::app()->user->setFlash('success', 'Bid was successfully updated');
						}
						else{
							Yii::app()->user->setFlash('error', 'Failed to update bid');
						}
					}
				}
				else{
					Yii::app()->user->setFlash('error', $propertyDetail->getError("bid"));
				}
			}
			else{
				
				Yii::app()->user->setFlash('error', $propertyDetail->getError("bid"));
			}
			$this->actionIndex($item);	
		}
	}
	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer $id the ID of the model to be loaded
	* @return User the loaded model
	* @throws CHttpException
	*/
	public function loadModel($id)
	{
		$model=Bid::model()->findBySql("SELECT * FROM Bid WHERE UserID=:uID", array(":uID"=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('index','view'),
					'users'=>array('*'),
					//'users'=>array('admin')
					),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('create','update'),
					'users'=>array('@'),
					'expression'=>'$user->isBuyer()',
					//'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isVendor() ? '$user->isVendor()' : (Yii::app()->user->isBuyer() ? '$user->isBuyer()':'')) : '$user->isAdmin()'),
					),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('admin','delete'),
					//'users'=>array('admin')
					),
				array('deny',  // deny all users
					'users'=>array('*'),
					),
				
				);
				
	}
	
}
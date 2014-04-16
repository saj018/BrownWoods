<?php

class UserpropertyController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
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
				'actions'=>array('index','view','filterpropertiesbyusertype','myproperty'),
					'users'=>array('@'),
					//'users'=>array('admin')	
			),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('create','update'),
					'users'=>array('@'),
				
					),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				//'users'=>array('admin'),
					'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isStaff() ? '$user->isStaff()' : '') : '$user->isAdmin()'),
					),
				array('deny',  // deny all users
					'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{ 
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$userPropertyModel=new Userproperty();
		$userPropertyTypeModel = new Userpropertytype();
		$userAddedPictures = new Picture();
		
		
		$userPropertyTypeModel = $userPropertyTypeModel->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($userModel);
		$userPropertyModel->UserID = Yii::app()->user->id;

		if(isset($_POST['Userproperty']))
		{ 
			$userPropertyModel->attributes=$_POST['Userproperty'];
            
			if($userPropertyModel->save()){
				if(!(empty($_FILES['files']['name'][0]))){	
					$directory = Yii::getPathOfAlias('webroot') .'/images/'.$userPropertyModel->UserPropertyID;
					$createDir  = mkdir($directory, 0700);
					if($createDir){
						foreach($_FILES['files']['name'] as $key => $filename)
						{
							$userUploadedPictures = new Picture();
							$userUploadedPictures->PictureUrl = $filename;
							$userUploadedPictures->UserPropertyID = $userPropertyModel->UserPropertyID;
							$userUploadedPictures->IsActive = 1;
							if($userUploadedPictures->save()){					
								$bool = move_uploaded_file($_FILES['files']['tmp_name'][$key], $directory . '/' . $filename);
								if(!$bool){
									Yii::app()->user->setFlash('error', 'Failed to upload property');
                                    return;
								}
								Yii::app()->user->setFlash('success', 'Property was added successfully');
                            
							}
                            else{
                                Yii::app()->user->setFlash('error', 'Failed to upload property');
                            }
						}	
					}
					else{
						Yii::app()->user->setFlash('error', 'Failed to create directory. Creation of property failed');
					}		
				}
                Yii::app()->user->setFlash('success', 'Property was added successfully');
			}
            else{
              Yii::app()->user->setFlash('error', 'Failed to create property');
            }
            
		}

		$this->render('create',array(
			'userPropertyModel'=>$userPropertyModel,
			'userPropertyTypeModel'=>$userPropertyTypeModel,
			'userAddedPictures'=>$userAddedPictures
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		
		$userPropertyModel=$this->loadModel($id);
		$userPropertyTypeModel = new Userpropertytype();
		$userAddedPictures = new Picture();
		
		$userPropertyID = $userPropertyModel->UserPropertyID;
		
		$userPropertyTypeModel = $userPropertyTypeModel->findAll();
		$criteria = new CDbCriteria;
		$criteria->select = '*';
		$criteria->condition = 'UserPropertyID=:upid';
		$criteria->params = array(':upid'=>$userPropertyModel->UserPropertyID);
		
		//If there are pictures
		$criteriaArray  = $userAddedPictures->findAll($criteria);
		if(!(empty($criteriaArray))){	
			$userAddedPictures = $userAddedPictures->findAll($criteria);
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Userproperty']))
		{
			$userPropertyModel->attributes=$_POST['Userproperty'];
			if($userPropertyModel->save())
				$this->redirect(array('view','id'=>$userPropertyModel->UserPropertyID));
		}

		$this->render('update',array(
			'userPropertyModel'=>$userPropertyModel,
			'userPropertyTypeModel'=>$userPropertyTypeModel,
			'userAddedPictures'=>$userAddedPictures
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

          $dataProvider =  new CActiveDataProvider('Userproperty');
          $userProperty =  null;
          $userTypes = null;          
     
        if(Yii::app()->user->isVendor() || Yii::app()->user->isBuyer()){
        	$userProperty = Userproperty::model()->findAllBySql("SELECT * FROM UserProperty INNER JOIN User ON UserProperty.UserID = User.UserID INNER JOIN UserType ON User.UserTypeID = UserType.UserTypeID WHERE UserProperty.UserID = :uID", array(":uID"=>Yii::app()->user->id));
            foreach($userProperty as &$value){
                $value->fullname =  $this->GetFullName($value);
                $value->userPropertyTypeName = $this->GetPropertyType($value);
            }
            $dataProvider->data = $userProperty;
        }
        if(Yii::app()->user->isAdmin()){
            $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:buyerID", array(":adminID"=>1, ":buyerID"=>2));
            $userProperty = Userproperty::model()->findAllBySql("SELECT * FROM UserProperty INNER JOIN User ON UserProperty.UserID = User.UserID INNER JOIN UserType ON User.UserTypeID = UserType.UserTypeID");
            foreach($userProperty as &$value){
                $value->fullname =  $this->GetFullName($value);
                $value->userPropertyTypeName = $this->GetPropertyType($value);
            }
            $dataProvider->data = $userProperty;
           
        }
        if(Yii::app()->user->isStaff()){
            $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:buyerID AND UserTypeID!=:staffID", array(":adminID"=>1, ":buyerID"=>2, ":staffID"=>4));
            $userProperty = Userproperty::model()->findAllBySql("SELECT * FROM UserProperty INNER JOIN User ON UserProperty.UserID = User.UserID INNER JOIN UserType ON User.UserTypeID = UserType.UserTypeID WHERE UserType.UserTypeID != :uTypeID", array(":uTypeID"=>1));
            foreach($userProperty as &$value){
                $value->fullname =  $this->GetFullName($value);
                $value->userPropertyTypeName = $this->GetPropertyType($value);          
            }
            $dataProvider->data = $userProperty;
        
        }

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'typesToLoad'=>$userTypes,            
            'filteredType'=>'',            
		));
	}
    public function actionMyProperty(){
        $dataProvider =  new CActiveDataProvider('Userproperty');
        $userProperty = Userproperty::model()->findAllBySql("SELECT * FROM UserProperty INNER JOIN User ON UserProperty.UserID = User.UserID INNER JOIN UserType ON User.UserTypeID = UserType.UserTypeID WHERE UserProperty.UserID = :uID", array(":uID"=>Yii::app()->user->id));
        $dataProvider->data = $userProperty;
        $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:buyerID AND UserTypeID!=:staffID", array(":adminID"=>1, ":buyerID"=>2, ":staffID"=>4));
         foreach($userProperty as &$value){
            $value->fullname =  $this->GetFullName($value);
            $value->userPropertyTypeName = $this->GetPropertyType($value);         
        }
		$this->render('myproperty',array(
			'dataProvider'=>$dataProvider,
		));
    }

    public function actionFilterPropertiesByUserType(){

        $dataProvider =  new CActiveDataProvider('Userproperty');
        $userType = $_POST["UserTypeID"];
        $userProperty = Userproperty::model()->findAllBySql("SELECT * FROM UserProperty INNER JOIN User ON UserProperty.UserID = User.UserID INNER JOIN UserType ON User.UserTypeID = UserType.UserTypeID WHERE UserType.UserTypeID = :uTypeID", array(":uTypeID"=>$userType));
        $userTypes = null;          
       
        $dataProvider->data = $userProperty;
        
        if(Yii::app()->user->isStaff()){ 
                $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:buyerID AND UserTypeID!=:staffID", array(":adminID"=>1, ":buyerID"=>2, ":staffID"=>4));
                 foreach($userProperty as &$value){
                    $value->fullname =  $this->GetFullName($value);
                    $value->userPropertyTypeName = $this->GetPropertyType($value);         
                }
          
            $dataProvider->data = $userProperty;
                
        }
        if(Yii::app()->user->isAdmin()){
          
                $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:buyerID", array(":adminID"=>1, ":buyerID"=>2));          
                 foreach($userProperty as &$value){
                    $value->fullname =  $this->GetFullName($value);
                    $value->userPropertyTypeName = $this->GetPropertyType($value);
                }
            
            
            $dataProvider->data = $userProperty;
        }
       $this->render('index',array(
			'dataProvider'=>$dataProvider,
            'typesToLoad'=>$userTypes,
            'filteredType'=>$userType,
		));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Userproperty('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Userproperty']))
       
			$model->attributes=$_GET['Userproperty'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    public function GetFullName($value){
        $user = User::model()->findAllBySql("SELECT FirstName, LastName FROM User WHERE UserID =:uID ", array(":uID"=>$value->UserID));
        return $user[0]->FirstName . " " . $user[0]->LastName; 
    }
    public function GetPropertyType($value){
         $userTypeName = Userpropertytype::model()->findAllBySql("SELECT UserPropertyType FROM UserPropertyType INNER JOIN UserProperty ON UserProperty.UserPropertyTypeID = UserPropertyType.UserPropertyTypeID WHERE UserProperty.UserPropertyID=:uPID", array(":uPID"=>$value->UserPropertyID));
         return $userTypeName[0]->UserPropertyType;
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Userproperty the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Userproperty::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Userproperty $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='userproperty-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

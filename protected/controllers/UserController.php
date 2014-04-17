<?php

class UserController extends Controller
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
				'actions'=>array('create'),
                'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isStaff() ? '$user->isStaff()' : (Yii::app()->user->isGuest() ? '$user->isGuest()' : '')) : '$user->isAdmin()')					
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'filterusersbyusertype', 'myprofile'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
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
		$user=new User;
		$userTypes = new Usertype();
		$userTypes = $userTypes->findAllBySql("SELECT * FROM Usertype");
        $typesToLoad = array();
        if(Yii::app()->user->isGuest){
            $typesToLoad[0] = $userTypes[1];
            $typesToLoad[1] = $userTypes[2];
        }	
        else if(Yii::app()->user->isAdmin()){
            
            $typesToLoad[0] = $userTypes[1];
            $typesToLoad[1] = $userTypes[2];
            $typesToLoad[2] = $userTypes[3];
        }
        else if(Yii::app()->user->isStaff()){
            
            $typesToLoad[0] = $userTypes[1];
            $typesToLoad[1] = $userTypes[2];
        }	

			// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['User']))
		{
			$user->attributes=$_POST['User'];
			if($user->save()){
				$this->redirect(array('view','id'=>$user->UserID));
            }
            else{
                Yii::app()->user->setFlash('error', 'Failed to save');
            }
		}

		$this->render('create',array(
			'model'=>$user,
			'model1'=>$typesToLoad	
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model1 = new Usertype();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->disabledItems = true;
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save()){
				$this->redirect(array('view','id'=>$model->UserID));
            }
            else{
                Yii::app()->user->setFlash('error', 'Failed to update');
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'model1'=>$model1
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
		$dataProvider=new CActiveDataProvider('User');
        $userTypes = null;
	   if(Yii::app()->user->isStaff()){
            $dataProvider->criteria = array(
				'condition'=>'UserID=' . Yii::app()->user->id,
			); 
            $dataProvider->criteria = array(
                'condition'=>'UserTypeID!=1',
            ); 
            $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID  AND UserTypeID!=:staffID", array(":adminID"=>1, ":staffID"=>4));          
        }
        if(Yii::app()->user->isAdmin()){
            $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID", array(":adminID"=>1));
        }
        if(Yii::app()->user->isVendor() || Yii::app()->user->isBuyer()){
        	$dataProvider->criteria = array(
			 'condition'=>'UserID=' . Yii::app()->user->id,
			);	
        }
		$this->render('index',array(
			'dataProvider'=>$dataProvider,            
            'typesToLoad'=>$userTypes,
            'filteredType'=>'',         
		));
	}
 public function actionFilterUsersByUserType(){

        $dataProvider =  new CActiveDataProvider('User');
        $userType = $_POST["UserTypeID"];
        $user = User::model()->findAllBySql("SELECT * FROM User INNER JOIN UserType ON User.UserTypeID = UserType.UserTypeID WHERE UserType.UserTypeID = :uTypeID", array(":uTypeID"=>$userType));
        $userTypes = null;          
       
        $dataProvider->data = $user;
        
        if(Yii::app()->user->isStaff()){ 
           $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:staffID", array(":adminID"=>1, ":staffID"=>4));
           $dataProvider->data = $user;
                
        }
        if(Yii::app()->user->isAdmin()){
          
          $userTypes = UserType::model()->findAllBySql("SELECT * FROM UserType WHERE UserTypeID!=:adminID AND UserTypeID!=:buyerID", array(":adminID"=>1, ":buyerID"=>2));          
          $dataProvider->data = $user;
        }
       $this->render('index',array(
			'dataProvider'=>$dataProvider,
            'typesToLoad'=>$userTypes,
            'filteredType'=>$userType,
		));
    }
     public function actionMyProfile(){
        $dataProvider =  new CActiveDataProvider('User');
        $dataProvider->criteria = array(
			 'condition'=>'UserID=' . Yii::app()->user->id,
			);
		$this->render('myprofile',array(
			'dataProvider'=>$dataProvider,
		));
    }
    
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
    
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

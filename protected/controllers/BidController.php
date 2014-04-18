<?php

class BidController extends Controller
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
			
                array('allow',
                          'actions'=>array('userbids'),
                          'users'=>array('@'),
                          'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isStaff() ? '$user->isStaff()':'') : '$user->isAdmin()')  
                    
                        ), 
                 array('allow',
                          'actions'=>array('mybids'),
                          'users'=>array('@'),
                          'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isStaff() ? '$user->isStaff()':(Yii::app()->user->isBuyer() ? '$user->isBuyer()':'')) : '$user->isAdmin()')  
                    
                        ), 
    			array('allow',  // allow all users to perform 'index' and 'view' actions
    					'actions'=>array('searchbids'),
    					'users'=>array('@'),				
    					'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isVendor() ? '$user->isVendor()' : (Yii::app()->user->isBuyer() ? '$user->isBuyer()':(Yii::app()->user->isStaff() ? '$user->isStaff()':''))) : '$user->isAdmin()')
    					
    					),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('index', 'view'),
					'users'=>array('@'),
					'expression'=>(!(Yii::app()->user->isAdmin()) ? (Yii::app()->user->isVendor() ? '$user->isVendor()' : (Yii::app()->user->isBuyer() ? '$user->isBuyer()':(Yii::app()->user->isStaff() ? '$user->isStaff()':''))) : '$user->isAdmin()')
					),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('admin','delete'),
					'users'=>array('admin'),
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
/*	public function actionCreate()
	{
		$model=new Bid;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bid']))
		{
			$model->attributes=$_POST['Bid'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->UserID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
/*	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bid']))
		{
			$model->attributes=$_POST['Bid'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->UserID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
/*	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}*/

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//$dataProvider=new CActiveDataProvider('Bid');
		$userPropertyModel =  new Userproperty();
		$userPropertyPictures = new Picture();
		$customSearchModel = new CustomSearch();		
		$userPropertyPictures = new Picture();
        //
		if(Yii::app()->user->isVendor()){
			
			$userPropertyModel = $userPropertyModel->findAllBySql("SELECT UserProperty.* FROM UserProperty INNER JOIN Bid ON UserProperty.UserPropertyID = Bid.UserPropertyID WHERE UserProperty.UserID =:uID", array(":uID"=>Yii::app()->user->id));

		}        
		else if(Yii::app()->user->isBuyer()){
			$userPropertyModel = $userPropertyModel->findAllBySql("SELECT * FROM UserProperty INNER JOIN  Bid ON UserProperty.UserPropertyID = Bid.UserPropertyID WHERE Bid.UserID = :uID",array(":uID"=>Yii::app()->user->id));
		}
        else if(Yii::app()->user->isAdmin()){
            $userPropertyModel = $userPropertyModel->findAllBySql("SELECT UserProperty.* FROM UserProperty INNER JOIN User ON UserProperty.UserID = User.UserID INNER JOIN Bid ON UserProperty.UserPropertyID = Bid.UserPropertyID");
        }
        else if(Yii::app()->user->isStaff()){
            $userPropertyModel = $userPropertyModel->findAllBySql("SELECT * FROM UserProperty INNER JOIN  Bid ON UserProperty.UserPropertyID = Bid.UserPropertyID WHERE Bid.UserID = :uID",array(":uID"=>Yii::app()->user->id));
        }
         if(!(empty($userPropertyModel[0]))){
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
            if(Yii::app()->user->isAdmin() || Yii::app()->user->isStaff()){
                Yii::app()->user->setFlash('information', 'There are no bids');
            }
            else if(Yii::app()->user->isVendor()){
                Yii::app()->user->setFlash('information', 'There are no bids made by users yet');
            }
            else if(Yii::app()->user->isBuyer()){
                Yii::app()->user->setFlash('information', 'There are no approved bids by users yet');
            }
        }
		
		/*$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		$this->render('index',array(
			'userPropertyModel'=>$userPropertyModel,
			'customSearchModel'=>$customSearchModel,			
			'userPropertyPictures'=>$userPropertyPictures,	
			));
	}

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
		$model=new Bid('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bid']))
			$model->attributes=$_GET['Bid'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/
    
    public function actionMybids(){
    	$userPropertyModel = new Userproperty();
    	$userPropertyPictures = new Picture();
    	$customSearchModel = new CustomSearch();
    	
    	//Build the query for searching
    	$userPropertyCriteria = new CDbCriteria;				
    	$userPropertyCriteria->select = '*';
        $userPropertyCriteria->alias = 'Property';
        $userPropertyCriteria->join = 'INNER JOIN Bid ON Bid.UserPropertyID = Property.UserPropertyID INNER JOIN User ON Bid.UserID = User.UserID';
        
    	$userPropertyCriteria->condition = "Bid.UserID = :uID";
    	$userPropertyCriteria->params = array(':uID'=> Yii::app()->user->id);
    
    	//Get the userproperties based on the criteria
    	$userPropertyModel = $userPropertyModel->findAll($userPropertyCriteria);
    	
    	$properties = array();
    	foreach($userPropertyModel as &$userProperty){
    		
    		$pictureCriteria = new CDbCriteria;
    		
    		$pictureCriteria->select = '*';
    		$pictureCriteria->condition = 'UserPropertyID=:upid LIMIT 1';
    		$pictureCriteria->params = array(':upid'=>$userProperty->UserPropertyID);			
    		
    		//If there are pictures
    		$userProperty->setFirstPicture($userPropertyPictures->findAll($pictureCriteria));			
    		
    	}
    	
    	$this->render('index', array(
    		'userPropertyModel'=>$userPropertyModel,
    		'userPropertyPictures'=>$userPropertyPictures,				
    		'customSearchModel'=>$customSearchModel
    		));
    }
	public function actionUserbids(){
	   	$userPropertyModel = new Userproperty();
    	$userPropertyPictures = new Picture();
    	$customSearchModel = new CustomSearch();
    	
    	//Build the query for searching
    	$userPropertyCriteria = new CDbCriteria;				
    	$userPropertyCriteria->select = '*';
        $userPropertyCriteria->alias = 'Property';
        
        $userPropertyCriteria->join = 'INNER JOIN Bid ON Bid.UserPropertyID = Property.UserPropertyID INNER JOIN User ON Bid.UserID = User.UserID';
        if(Yii::app()->user->isAdmin()){
        	$userPropertyCriteria->condition = "Bid.UserID !=:uID AND User.UserTypeID !=:uTypeID";
        	$userPropertyCriteria->params = array(':uID'=> Yii::app()->user->id, 'uTypeID'=> 1);
        }
        if(Yii::app()->user->isStaff()){
            $userPropertyCriteria->condition = "Bid.UserID !=:uID AND User.UserTypeID !=:uTypeID";
        	$userPropertyCriteria->params = array(':uID'=> Yii::app()->user->id, 'uTypeID'=> 4);
        }
        
         
    
    	//Get the userproperties based on the criteria
    	$userPropertyModel = $userPropertyModel->findAll($userPropertyCriteria);
    	
    	$properties = array();
    	foreach($userPropertyModel as &$userProperty){
    		
    		$pictureCriteria = new CDbCriteria;
    		
    		$pictureCriteria->select = '*';
    		$pictureCriteria->condition = 'UserPropertyID=:upid LIMIT 1';
    		$pictureCriteria->params = array(':upid'=>$userProperty->UserPropertyID);			
    		
    		//If there are pictures
    		$userProperty->setFirstPicture($userPropertyPictures->findAll($pictureCriteria));			
    		
    	}
    	
    	$this->render('index', array(
    		'userPropertyModel'=>$userPropertyModel,
    		'userPropertyPictures'=>$userPropertyPictures,				
    		'customSearchModel'=>$customSearchModel
    		));
		
	}
	public function actionSearchbids()
	{
		
		if(isset($_POST['CustomSearch']))
		{
			//text to search
			$itemToSearch = $_POST["CustomSearch"]["searchtext"];	
			
			$userPropertyModel = new Userproperty();
			$userPropertyPictures = new Picture();
			$customSearchModel = new CustomSearch();
			
			//Build the query for searching
			$userPropertyCriteria = new CDbCriteria;				
			$userPropertyCriteria->select = '*';
			$userPropertyCriteria->condition = "((Province LIKE :province) OR (Country LIKE :country)  OR (Address LIKE :address) OR (City LIKE :city) OR (AdditionalInformation LIKE :additionalInfo)  )";
			$userPropertyCriteria->params = array(':province'=> "%$itemToSearch%", ':country'=> "%$itemToSearch%", ':address'=> "%$itemToSearch%", ':city'=>"%$itemToSearch%", ':additionalInfo'=>"%$itemToSearch%");

			//Get the userproperties based on the criteria
			$userPropertyModel = $userPropertyModel->findAll($userPropertyCriteria);
			
			$properties = array();
			foreach($userPropertyModel as &$userProperty){
				
				$pictureCriteria = new CDbCriteria;
				
				$pictureCriteria->select = '*';
				$pictureCriteria->condition = 'UserPropertyID=:upid LIMIT 1';
				$pictureCriteria->params = array(':upid'=>$userProperty->UserPropertyID);			
				
				//If there are pictures
				$userProperty->setFirstPicture($userPropertyPictures->findAll($pictureCriteria));			
				
			}
			
			$this->render('index', array(
				'userPropertyModel'=>$userPropertyModel,
				'userPropertyPictures'=>$userPropertyPictures,				
				'customSearchModel'=>$customSearchModel
				));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Bid the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Bid::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Bid $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bid-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

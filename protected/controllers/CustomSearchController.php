<?php

class CustomSearchController extends Controller{
	public function actionCoolForm()
	{
		$model = new CustomSearch();
		if(isset($_POST['CustomSearch'])){
			$model->attributes = $_POST['CustomSearch'];
			if($model->validate()){
				// Do whatever you want to do here.
			}
		}

		$this->render('someview',array('model'=>$model));
	}
}

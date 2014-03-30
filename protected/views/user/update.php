<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->UserID=>array('view','id'=>$model->UserID),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->UserID)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<div class="page-name">
<h1>Update Profile(s)</h1></div>

<?php $this->renderPartial('_form', array('model'=>$model, 'model1'=>$model1)); ?>
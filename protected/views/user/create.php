<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<div class="page-name">
<h1>Create User</h1></div>

<?php $this->renderPartial('_form', array('model'=>$model, 'model1'=>$model1)); ?>
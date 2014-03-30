<?php
/* @var $this UserpropertyController */
/* @var $model Userproperty */

$this->breadcrumbs=array(
	'Properties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Properties', 'url'=>array('index')),
	array('label'=>'Manage Properties', 'url'=>array('admin')),
);
?>
<div class="page-name">
<h1>Create Property</h1></div>

<?php $this->renderPartial('_form', array('userPropertyModel'=>$userPropertyModel,'userPropertyTypeModel'=>$userPropertyTypeModel, 'userAddedPictures'=>$userAddedPictures)); ?>
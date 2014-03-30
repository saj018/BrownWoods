<?php
/* @var $this UserpropertyController */
/* @var $model Userproperty */

$this->breadcrumbs=array(
	'Userproperties'=>array('index'),
	$userPropertyModel->UserPropertyID=>array('view','id'=>$userPropertyModel->UserPropertyID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index')),
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'View Peoperty', 'url'=>array('view', 'id'=>$userPropertyModel->UserPropertyID)),
	array('label'=>'Manage Property', 'url'=>array('admin')),
);
?>

<h1>Update Property <?php echo $userPropertyModel->UserPropertyID; ?></h1>

<?php $this->renderPartial('_form', array('userPropertyModel'=>$userPropertyModel,'userPropertyTypeModel'=>$userPropertyTypeModel, 'userAddedPictures'=>$userAddedPictures)); ?>
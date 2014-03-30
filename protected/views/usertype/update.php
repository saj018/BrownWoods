<?php
/* @var $this UsertypeController */
/* @var $model Usertype */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	$model->UserTypeID=>array('view','id'=>$model->UserTypeID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Usertype', 'url'=>array('index')),
	array('label'=>'Create Usertype', 'url'=>array('create')),
	array('label'=>'View Usertype', 'url'=>array('view', 'id'=>$model->UserTypeID)),
	array('label'=>'Manage Usertype', 'url'=>array('admin')),
);
?>

<h1>Update Usertype <?php echo $model->UserTypeID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
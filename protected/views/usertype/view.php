<?php
/* @var $this UsertypeController */
/* @var $model Usertype */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	$model->UserTypeID,
);

$this->menu=array(
	array('label'=>'List Usertype', 'url'=>array('index')),
	array('label'=>'Create Usertype', 'url'=>array('create')),
	array('label'=>'Update Usertype', 'url'=>array('update', 'id'=>$model->UserTypeID)),
	array('label'=>'Delete Usertype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->UserTypeID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usertype', 'url'=>array('admin')),
);
?>

<h1>View Usertype #<?php echo $model->UserTypeID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'UserTypeID',
		'UserType',
		'IsActive',
	),
)); ?>

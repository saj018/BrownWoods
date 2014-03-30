<?php
/* @var $this UserpropertyController */
/* @var $model Userproperty */

$this->breadcrumbs=array(
	'Userproperties'=>array('index'),
	$model->UserPropertyID,
);

$this->menu=array(
	array('label'=>'List Properties', 'url'=>array('index')),
	array('label'=>'Create Properties', 'url'=>array('create')),
	array('label'=>'Update Properties', 'url'=>array('update', 'id'=>$model->UserPropertyID)),
	array('label'=>'Delete Properties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->UserPropertyID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Properties', 'url'=>array('admin')),
);
?>

<h1>View Userproperty #<?php echo $model->UserPropertyID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'UserPropertyID',
		'UserID',
		'Bedroom',
		'Bathroom',
		'UserPropertyTypeID',
		'SquareFootage',
		'Price',
		'City',
		'Country',
		'Province',
		'Address',
		'AdditionalInformation',
		'IsActive',
	),
)); ?>

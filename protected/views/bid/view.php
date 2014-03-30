<?php
/* @var $this BidController */
/* @var $model Bid */

$this->breadcrumbs=array(
	'Bids'=>array('index'),
	$model->UserID,
);

$this->menu=array(
	array('label'=>'List Bid', 'url'=>array('index')),
	array('label'=>'Create Bid', 'url'=>array('create')),
	array('label'=>'Update Bid', 'url'=>array('update', 'id'=>$model->UserID)),
	array('label'=>'Delete Bid', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->UserID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bid', 'url'=>array('admin')),
);
?>

<h1>View Bid #<?php echo $model->UserID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'UserID',
		'UserPropertyID',
		'Price',
		'IsSold',
	),
)); ?>

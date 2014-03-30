<?php
/* @var $this BidController */
/* @var $model Bid */

$this->breadcrumbs=array(
	'Bids'=>array('index'),
	$model->UserID=>array('view','id'=>$model->UserID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bid', 'url'=>array('index')),
	array('label'=>'Create Bid', 'url'=>array('create')),
	array('label'=>'View Bid', 'url'=>array('view', 'id'=>$model->UserID)),
	array('label'=>'Manage Bid', 'url'=>array('admin')),
);
?>

<h1>Update Bid <?php echo $model->UserID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
/* @var $this BidController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bids',
);

$this->menu=array(
	array('label'=>'User Bid', 'url'=>array('userbids')),
	array('label'=>'My Bids', 'url'=>array('mybids')),
);
?>

<h1>Bids</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ ?>

<?php 
require_once('Search.php');
require_once('PropertyTable.php');
?>



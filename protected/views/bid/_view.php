<?php
/* @var $this BidController */
/* @var $data Bid */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->UserID), array('view', 'id'=>$data->UserID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserPropertyID')); ?>:</b>
	<?php echo CHtml::encode($data->UserPropertyID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Price')); ?>:</b>
	<?php echo CHtml::encode($data->Price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsSold')); ?>:</b>
	<?php echo CHtml::encode($data->IsSold); ?>
	<br />


</div>
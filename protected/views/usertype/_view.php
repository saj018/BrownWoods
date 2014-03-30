<?php
/* @var $this UsertypeController */
/* @var $data Usertype */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserTypeID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->UserTypeID), array('view', 'id'=>$data->UserTypeID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserType')); ?>:</b>
	<?php echo CHtml::encode($data->UserType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />


</div>
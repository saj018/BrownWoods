<?php
/* @var $this UserpropertyController */
/* @var $data Userproperty */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserPropertyID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->UserPropertyID), array('view', 'id'=>$data->UserPropertyID)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('FullName')); ?>:</b>
	<?php echo CHtml::encode($data->fullname); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bedroom')); ?>:</b>
	<?php echo CHtml::encode($data->Bedroom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bathroom')); ?>:</b>
	<?php echo CHtml::encode($data->Bathroom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserPropertyTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->UserPropertyTypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SquareFootage')); ?>:</b>
	<?php echo CHtml::encode($data->SquareFootage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Price')); ?>:</b>
	<?php echo CHtml::encode($data->Price); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('City')); ?>:</b>
	<?php echo CHtml::encode($data->City); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Country')); ?>:</b>
	<?php echo CHtml::encode($data->Country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Province')); ?>:</b>
	<?php echo CHtml::encode($data->Province); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AdditionalInformation')); ?>:</b>
	<?php echo CHtml::encode($data->AdditionalInformation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />

	*/ ?>

</div>
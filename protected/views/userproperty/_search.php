<?php
/* @var $this UserpropertyController */
/* @var $model Userproperty */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'UserPropertyID'); ?>
		<?php echo $form->textField($model,'UserPropertyID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Bedroom'); ?>
		<?php echo $form->textField($model,'Bedroom'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Bathroom'); ?>
		<?php echo $form->textField($model,'Bathroom'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserPropertyTypeID'); ?>
		<?php echo $form->textField($model,'UserPropertyTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SquareFootage'); ?>
		<?php echo $form->textField($model,'SquareFootage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Price'); ?>
		<?php echo $form->textField($model,'Price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Province'); ?>
		<?php echo $form->textField($model,'Province',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AdditionalInformation'); ?>
		<?php echo $form->textField($model,'AdditionalInformation',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsActive'); ?>
		<?php echo $form->textField($model,'IsActive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
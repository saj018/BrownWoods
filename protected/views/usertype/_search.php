<?php
/* @var $this UsertypeController */
/* @var $model Usertype */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'UserTypeID'); ?>
		<?php echo $form->textField($model,'UserTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserType'); ?>
		<?php echo $form->textField($model,'UserType',array('size'=>60,'maxlength'=>100)); ?>
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
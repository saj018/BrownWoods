<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<?php echo $form->label($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>60,'maxlength'=>100,'class'=>'form-text-box')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>60,'maxlength'=>100,'class'=>'form-text-box')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TelephoneNumber'); ?>
		<?php echo $form->textField($model,'TelephoneNumber', array('class'=>'form-text-box')); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Province'); ?>
		<?php echo $form->textField($model,'Province',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Country'); ?>
		<?php echo $form->textField($model,'Country',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
	</div>


	<div class="row buttons right">
		<?php echo CHtml::submitButton('Search', array('class'=>'button')); ?>
	</div>
    <div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
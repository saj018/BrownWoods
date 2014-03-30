<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="page-name">
<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>
</div>

<div class="form login-wrapper">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<small><?php echo $form->label($model,'rememberMe'); ?></small>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row right">
		<?php echo CHtml::submitButton('Login', array('class'=>'button')); ?>
	</div>
	<div class="clear"></div>

<?php $this->endWidget(); ?>

</div>
<div class="login-image right">

</div><!-- form -->



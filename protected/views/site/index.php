<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="paragraph-section">
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>


<p><?php echo CHtml::encode(Yii::app()->name); ?> established in 1983 to serve our customers seeking real estate from all over the world.</p>
</div>
<?php 
	require_once('Search.php');
	require_once('PropertyTable.php');
?>



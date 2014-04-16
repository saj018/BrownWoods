<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
    array('label'=>'My Profile', 'url'=>array('myprofile')),
);
?>
<div class="page-name">
<h1>Users</h1>
<form id="frmUserType" method="POST">
<?php if(!(Yii::app()->user->isVendor() || Yii::app()->user->isBuyer()))echo "<div>Filter users by user types:</div>" . CHtml::dropDownList("UserTypeID", "", CHtml::listData($typesToLoad, 'UserTypeID', 'UserType'),array('empty' => 'Select a user type','onChange' => 'submit','submit' => array('user/filterusersbyusertype'), 'options'=>array($filteredType=>array('selected'=>true))))?><div></div>
</form>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

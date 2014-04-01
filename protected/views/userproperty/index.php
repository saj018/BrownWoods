<?php
/* @var $this UserpropertyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'List Properties',
);

$this->menu=array(
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'Manage Property', 'url'=>array('admin')),
    array('label'=>'My Property', 'url'=>array('myproperty')),
);
?>
<div class="page-name">
<h1>List Properties</h1>
<form id="frmUserType" method="POST">
<?php if(!(Yii::app()->user->isVendor()))echo "<div>Filter properties by user types:</div>" . CHtml::dropDownList("UserTypeID", "", CHtml::listData($typesToLoad, 'UserTypeID', 'UserType'),array('empty' => 'Select a user type','onChange' => 'submit','submit' => array('userproperty/filterpropertiesbyusertype'), 'options'=>array($filteredType=>array('selected'=>true))))?><div></div>
</form>
</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

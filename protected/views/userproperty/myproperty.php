<?php
/* @var $this UserpropertyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'My Properties',
);

$this->menu=array(
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'Manage Property', 'url'=>array('admin')),
    array('label'=>'List Property', 'url'=>array('index')),
);
?>
<div class="page-name">
<h1>My Properties</h1>

</div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

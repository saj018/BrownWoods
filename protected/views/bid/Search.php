<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
				'validateOnSubmit'=>true,
				),
)); ?>

<div class="search-table">

<div class="field-label"><?php echo $form->labelEx($customSearchModel,'searchtext'); ?></div>
<div class="field-data"><?php echo $form->textField($customSearchModel,'searchtext', array('class'=>'medium-text-box')); ?><br /><small><em>(type in any keywords to search)</em></small></div>
<div class="clear"></div>

<div class="right"><?php echo CHtml::submitButton('Search', array('submit'=>'index.php?r=bid/searchbids', 'class'=>'button')); ?></div>
<div class="clear"></div>

</div>

<?php $this->endWidget(); ?>

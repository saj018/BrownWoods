<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
				),
			
)); ?>

<div class="property-details">
<?php 
if(Yii::app()->user->hasFlash('error')) {
	echo "<div class='flash-error'>" . Yii::app()->user->getFlash('error'). "</div>";
}
else if(Yii::app()->user->hasFlash('success')){
	echo "<div class='flash-success'>" . Yii::app()->user->getFlash('success'). "</div>";
}?>
<div>
<?php 
if($biddedUser){
	$tableDiv = "<div class='bid-approve-table'>";
	$tableDiv.="<div class='header-column'>First Name</div>";
	$tableDiv.="<div class='header-column'>Last Name</div>";
	$tableDiv.="<div class='header-column'>Price</div>";

	$tableDiv.="<div class='clear'></div>";
	foreach ($biddedUser as &$bidUser) {
		$tableDiv.="<div class='body-column'>" . $bidUser->firstName . "</div>";
		$tableDiv.="<div class='body-column'>" . $bidUser->lastName . "</div>";
		$tableDiv.="<div class='body-column'>" . $bidUser->price . "</div>";

        if(!(Yii::app()->user->isBuyer())){
		  $tableDiv.="<div class='body-column-last'>" . CHtml::submitButton('Sell',  array('class'=>'button')) . "</div>";
        }
        else{
            $propertyStatus = ($bidUser->isSold == 1 ? (($bidUser->userID == Yii::app()->user->id)? 'Accepted':'Sold') : 'Not Sold'); 
            $tableDiv.="<div class='body-column-last'><div class='" . str_replace(' ','',$propertyStatus). "'>" . $propertyStatus. "</div></div>";
        }
		$tableDiv.="<div class='clear'></div>";
	}
	$tableDiv .= "</div>";
	echo $tableDiv;
}
?></div>
<div class="column-left">
<div class="banner">
<?php

$priceElement = "<div class='price'>$" . $userPropertyModelDetails->price . "</div>";
$priceElement .= "<div class='clear'></div>";

echo $priceElement;
?>
<ul>
<?php
if(!(empty($userPropertyPictures))){
    foreach($userPropertyPictures as &$pic){
        if(!(empty($pic->PictureUrl))){
    	   echo '<li><a href="#"><img style="width:400px; height:400px" src="images/'. $userPropertyModelDetails->userpropertyid . '/' . $pic->PictureUrl . '"/></a></li>';
        }
        else{
            echo '<li><a href="#"><img style="width:400px; height:400px" src="images/noimagelarge.jpg"/></a></li>';
        }
    }
}
else{
    echo '<li><a href="#"><img style="width:400px; height:400px" src="images/noimagelarge.jpg"/></a></li>';
}

?>
			</ul>
		</div>
</div>
<div class="column-right">
<div class="property-details-section">
<?php 
$wishListElement = '';

$button = CHtml::submitButton('Add to Wishlist', array('submit'=>'index.php?r=propertydetail/wishlist&item=' .$userPropertyModelDetails->userpropertyid , 'class'=>'button')); 



$propertyDetails = "<div class='field-label'>Bedroom(s):</div><div class='field-data'>". $userPropertyModelDetails->bedroom . "</div>";
$propertyDetails .= "<div class='clear'></div>";
$propertyDetails .= "<hr/>";
$propertyDetails .= "<div class='field-label'>Bathroom(s):</div><div class='field-data'>" . $userPropertyModelDetails->bathroom . "</div>";
$propertyDetails .= "<div class='clear'></div>";
$propertyDetails .= "<hr/>";
$propertyDetails .= "<div class='field-label'>Country:</div><div class='field-data'>" . $userPropertyModelDetails->country . "</div>";
$propertyDetails .= "<div class='clear'></div>";
$propertyDetails .= "<hr/>";
$propertyDetails .= "<div class='field-label'>City:</div><div class='field-data'>" . $userPropertyModelDetails->city . "</div>";
$propertyDetails .= "<div class='clear'></div>";
$propertyDetails .= "<hr/>";
$propertyDetails .= "<div class='field-label'>State/Province:</div><div class='field-data'>" . $userPropertyModelDetails->province . "</div>";
$propertyDetails .= "<div class='clear'></div>";

$bidElement = "<div class='bid-section'>";
if(!(Yii::app()->user->isGuest())){
	
	$wishListElement .= "<div class='right'>";
	if($userPropertyModelDetails->showwishlist && !($userPropertyModelDetails->userid == Yii::app()->user->id)){
		$wishListElement .= $button;
	}
	$wishListElement .= "</div>";
	$wishListElement .= "<div class='clear'></div>";
	
	if(!(Yii::app()->user->isVendor())){
		$bidElement .= "<div class='bid-label'>" . $form->labelEx($userPropertyModelDetails,'bid') . "</div>";
		$bidElement .= $form->textField($userPropertyModelDetails,'bid', array("class"=>"large-text-box"));
		$bidElement .=  $form->error($userPropertyModelDetails,'bid');
		$bidElement .= CHtml::submitButton('Save', array('submit'=>'index.php?r=propertydetail/create&item=' .$userPropertyModelDetails->userpropertyid , 'class'=>'button')); 
	}
}
$bidElement .= "</div>";
echo $wishListElement . $propertyDetails . $bidElement;

?>

</div>
</div>
<div class="clear"></div>
</div>
<div class="property-details-section-bottom">
<?php
$propertyDetailsBottom = "<div class='field-label'>Address:</div><div class='field-data'>" .$userPropertyModelDetails->address . "</div>";
$propertyDetailsBottom .= "<div class='field-label'>Addtional Information:</div><div  class='field-data'>" .$userPropertyModelDetails->additionalInformation . "</div>";
echo $propertyDetailsBottom;
 ?>
</div>


<?php $this->endWidget(); ?>
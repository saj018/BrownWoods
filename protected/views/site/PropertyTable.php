<?php

$properties =  '<table><tr>';
$properties .=  '<th>Pictures</th><th>PropertyID</th><th>Bedroom</th><th>Bathroom</th><th>Square Footage</th><th>Price</th><th>City</th><th>State/Province</th><th>Country</th></tr>';

foreach($userPropertyModel as &$userProperty){

	$properties .= '<tr>';
	$properties .= '<td>';	
	$pictures = $userProperty->getFirstPicture();
    if(!(empty($pictures))){
    	foreach($pictures as &$pic){
    	   if(!(empty($pic->PictureUrl))){
    		  $properties .= '<img style="width:100px; height:100px" src="images/'. $userProperty->UserPropertyID . '/' . $pic->PictureUrl . '"/>';
            }
            else{
               $properties .= '<img style="width:100px; height:100px" src="images/noimage.jpg"/>'; 
            }
    	}
    }
    else{
        $properties .= '<img style="width:100px; height:100px" src="images/noimage.jpg"/>'; 
    }
    

	$properties .= '</td>';
	$properties .= '<td><a href="' . Yii::app()->createUrl('propertydetail/index', array('item'=> $userProperty->UserPropertyID)) . '">' . $userProperty->UserPropertyID . '</a></td>';
	$properties .= '<td>' . $userProperty->Bedroom . '</td>';	
	$properties .= '<td>' . $userProperty->Bathroom . '</td>';	
	$properties .= '<td>' . $userProperty->SquareFootage . '</td>';	
	$properties .= '<td>' . $userProperty->Price. '</td>';
	$properties .= '<td>' . $userProperty->City. '</td>';		
	$properties .= '<td>' . $userProperty->Province. '</td>';
	$properties .= '<td>' . $userProperty->Country. '</td>';
	
	$properties .=  '</tr>';
}
$properties .=  '</table>';
echo $properties;

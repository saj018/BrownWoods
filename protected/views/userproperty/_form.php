<?php
/* @var $this UserpropertyController */
/* @var $model Userproperty */
/* @var $form CActiveForm */
?>

<div class="form">
<?php 
if(Yii::app()->user->hasFlash('error')) {
	echo "<div class='flash-error'>" . Yii::app()->user->getFlash('error') . "</div>";
}
else if(Yii::app()->user->hasFlash('success')){
	echo "<div class='flash-success'>" . Yii::app()->user->getFlash('success') . "</div>";
    
}?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'userproperty-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
				'enctype' => 'multipart/form-data',
				),
	
)); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($userPropertyModel); ?>

	<div class="row">
	
		<?php echo $form->labelEx($userPropertyModel,'Bedroom'); ?>
		<?php echo $form->textField($userPropertyModel,'Bedroom', array('class'=>'form-text-box')); ?>
		<?php echo $form->error($userPropertyModel,'Bedroom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'Bathroom'); ?>
		<?php echo $form->textField($userPropertyModel,'Bathroom', array('class'=>'form-text-box')); ?>
		<?php echo $form->error($userPropertyModel,'Bathroom'); ?>
	</div>


<div class="row">
		<?php 
			$builtArray = array();
		foreach ($userPropertyTypeModel as $m1){
				$builtArray[$m1->UserPropertyTypeID] = $m1->UserPropertyType;
			}
		?>
		<?php echo $form->labelEx($userPropertyModel,'UserPropertyTypeID'); ?>

		<?php echo $form->dropDownList($userPropertyModel, 'UserPropertyTypeID', array($builtArray), array('class'=>'form-text-box'));?>

	</div>
	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'SquareFootage'); ?>
		<?php echo $form->textField($userPropertyModel,'SquareFootage', array('class'=>'form-text-box')); ?> <em>Please enter in Square feet</em>
		<?php echo $form->error($userPropertyModel,'SquareFootage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'Price'); ?>
		<?php echo $form->textField($userPropertyModel,'Price', array('class'=>'form-text-box')); ?>
		<?php echo $form->error($userPropertyModel,'Price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'City'); ?>
		<?php echo $form->textField($userPropertyModel,'City',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
		<?php echo $form->error($userPropertyModel,'City'); ?>
	</div>

	<div class="row">
		<?php echo $form->error($userPropertyModel,'Country'); ?>
		
		<?php 
			$builtArray = $countries = array(
	'AD' => 'Andorra',
	'AE' => 'United Arab Emirates',
	'AF' => 'Afghanistan',
	'AG' => 'Antigua &amp; Barbuda',
	'AI' => 'Anguilla',
	'AL' => 'Albania',
	'AM' => 'Armenia',
	'AN' => 'Netherlands Antilles',
	'AO' => 'Angola',
	'AQ' => 'Antarctica',
	'AR' => 'Argentina',
	'AS' => 'American Samoa',
	'AT' => 'Austria',
	'AU' => 'Australia',
	'AW' => 'Aruba',
	'AZ' => 'Azerbaijan',
	'BA' => 'Bosnia and Herzegovina',
	'BB' => 'Barbados',
	'BD' => 'Bangladesh',
	'BE' => 'Belgium',
	'BF' => 'Burkina Faso',
	'BG' => 'Bulgaria',
	'BH' => 'Bahrain',
	'BI' => 'Burundi',
	'BJ' => 'Benin',
	'BM' => 'Bermuda',
	'BN' => 'Brunei Darussalam',
	'BO' => 'Bolivia',
	'BR' => 'Brazil',
	'BS' => 'Bahama',
	'BT' => 'Bhutan',
	'BU' => 'Burma (no longer exists)',
	'BV' => 'Bouvet Island',
	'BW' => 'Botswana',
	'BY' => 'Belarus',
	'BZ' => 'Belize',
	'CA' => 'Canada',
	'CC' => 'Cocos (Keeling) Islands',
	'CF' => 'Central African Republic',
	'CG' => 'Congo',
	'CH' => 'Switzerland',
	'CI' => 'Côte D\'ivoire (Ivory Coast)',
	'CK' => 'Cook Iislands',
	'CL' => 'Chile',
	'CM' => 'Cameroon',
	'CN' => 'China',
	'CO' => 'Colombia',
	'CR' => 'Costa Rica',
	'CS' => 'Czechoslovakia (no longer exists)',
	'CU' => 'Cuba',
	'CV' => 'Cape Verde',
	'CX' => 'Christmas Island',
	'CY' => 'Cyprus',
	'CZ' => 'Czech Republic',
	'DD' => 'German Democratic Republic (no longer exists)',
	'DE' => 'Germany',
	'DJ' => 'Djibouti',
	'DK' => 'Denmark',
	'DM' => 'Dominica',
	'DO' => 'Dominican Republic',
	'DZ' => 'Algeria',
	'EC' => 'Ecuador',
	'EE' => 'Estonia',
	'EG' => 'Egypt',
	'EH' => 'Western Sahara',
	'ER' => 'Eritrea',
	'ES' => 'Spain',
	'ET' => 'Ethiopia',
	'FI' => 'Finland',
	'FJ' => 'Fiji',
	'FK' => 'Falkland Islands (Malvinas)',
	'FM' => 'Micronesia',
	'FO' => 'Faroe Islands',
	'FR' => 'France',
	'FX' => 'France, Metropolitan',
	'GA' => 'Gabon',
	'GB' => 'United Kingdom (Great Britain)',
	'GD' => 'Grenada',
	'GE' => 'Georgia',
	'GF' => 'French Guiana',
	'GH' => 'Ghana',
	'GI' => 'Gibraltar',
	'GL' => 'Greenland',
	'GM' => 'Gambia',
	'GN' => 'Guinea',
	'GP' => 'Guadeloupe',
	'GQ' => 'Equatorial Guinea',
	'GR' => 'Greece',
	'GS' => 'South Georgia and the South Sandwich Islands',
	'GT' => 'Guatemala',
	'GU' => 'Guam',
	'GW' => 'Guinea-Bissau',
	'GY' => 'Guyana',
	'HK' => 'Hong Kong',
	'HM' => 'Heard &amp; McDonald Islands',
	'HN' => 'Honduras',
	'HR' => 'Croatia',
	'HT' => 'Haiti',
	'HU' => 'Hungary',
	'ID' => 'Indonesia',
	'IE' => 'Ireland',
	'IL' => 'Israel',
	'IN' => 'India',
	'IO' => 'British Indian Ocean Territory',
	'IQ' => 'Iraq',
	'IR' => 'Islamic Republic of Iran',
	'IS' => 'Iceland',
	'IT' => 'Italy',
	'JM' => 'Jamaica',
	'JO' => 'Jordan',
	'JP' => 'Japan',
	'KE' => 'Kenya',
	'KG' => 'Kyrgyzstan',
	'KH' => 'Cambodia',
	'KI' => 'Kiribati',
	'KM' => 'Comoros',
	'KN' => 'St. Kitts and Nevis',
	'KP' => 'Korea, Democratic People\'s Republic of',
	'KR' => 'Korea, Republic of',
	'KW' => 'Kuwait',
	'KY' => 'Cayman Islands',
	'KZ' => 'Kazakhstan',
	'LA' => 'Lao People\'s Democratic Republic',
	'LB' => 'Lebanon',
	'LC' => 'Saint Lucia',
	'LI' => 'Liechtenstein',
	'LK' => 'Sri Lanka',
	'LR' => 'Liberia',
	'LS' => 'Lesotho',
	'LT' => 'Lithuania',
	'LU' => 'Luxembourg',
	'LV' => 'Latvia',
	'LY' => 'Libyan Arab Jamahiriya',
	'MA' => 'Morocco',
	'MC' => 'Monaco',
	'MD' => 'Moldova, Republic of',
	'MG' => 'Madagascar',
	'MH' => 'Marshall Islands',
	'ML' => 'Mali',
	'MN' => 'Mongolia',
	'MM' => 'Myanmar',
	'MO' => 'Macau',
	'MP' => 'Northern Mariana Islands',
	'MQ' => 'Martinique',
	'MR' => 'Mauritania',
	'MS' => 'Monserrat',
	'MT' => 'Malta',
	'MU' => 'Mauritius',
	'MV' => 'Maldives',
	'MW' => 'Malawi',
	'MX' => 'Mexico',
	'MY' => 'Malaysia',
	'MZ' => 'Mozambique',
	'NA' => 'Namibia',
	'NC' => 'New Caledonia',
	'NE' => 'Niger',
	'NF' => 'Norfolk Island',
	'NG' => 'Nigeria',
	'NI' => 'Nicaragua',
	'NL' => 'Netherlands',
	'NO' => 'Norway',
	'NP' => 'Nepal',
	'NR' => 'Nauru',
	'NT' => 'Neutral Zone (no longer exists)',
	'NU' => 'Niue',
	'NZ' => 'New Zealand',
	'OM' => 'Oman',
	'PA' => 'Panama',
	'PE' => 'Peru',
	'PF' => 'French Polynesia',
	'PG' => 'Papua New Guinea',
	'PH' => 'Philippines',
	'PK' => 'Pakistan',
	'PL' => 'Poland',
	'PM' => 'St. Pierre &amp; Miquelon',
	'PN' => 'Pitcairn',
	'PR' => 'Puerto Rico',
	'PT' => 'Portugal',
	'PW' => 'Palau',
	'PY' => 'Paraguay',
	'QA' => 'Qatar',
	'RE' => 'Réunion',
	'RO' => 'Romania',
	'RU' => 'Russian Federation',
	'RW' => 'Rwanda',
	'SA' => 'Saudi Arabia',
	'SB' => 'Solomon Islands',
	'SC' => 'Seychelles',
	'SD' => 'Sudan',
	'SE' => 'Sweden',
	'SG' => 'Singapore',
	'SH' => 'St. Helena',
	'SI' => 'Slovenia',
	'SJ' => 'Svalbard &amp; Jan Mayen Islands',
	'SK' => 'Slovakia',
	'SL' => 'Sierra Leone',
	'SM' => 'San Marino',
	'SN' => 'Senegal',
	'SO' => 'Somalia',
	'SR' => 'Suriname',
	'ST' => 'Sao Tome &amp; Principe',
	'SU' => 'Union of Soviet Socialist Republics (no longer exists)',
	'SV' => 'El Salvador',
	'SY' => 'Syrian Arab Republic',
	'SZ' => 'Swaziland',
	'TC' => 'Turks &amp; Caicos Islands',
	'TD' => 'Chad',
	'TF' => 'French Southern Territories',
	'TG' => 'Togo',
	'TH' => 'Thailand',
	'TJ' => 'Tajikistan',
	'TK' => 'Tokelau',
	'TM' => 'Turkmenistan',
	'TN' => 'Tunisia',
	'TO' => 'Tonga',
	'TP' => 'East Timor',
	'TR' => 'Turkey',
	'TT' => 'Trinidad &amp; Tobago',
	'TV' => 'Tuvalu',
	'TW' => 'Taiwan, Province of China',
	'TZ' => 'Tanzania, United Republic of',
	'UA' => 'Ukraine',
	'UG' => 'Uganda',
	'UM' => 'United States Minor Outlying Islands',
	'US' => 'United States of America',
	'UY' => 'Uruguay',
	'UZ' => 'Uzbekistan',
	'VA' => 'Vatican City State (Holy See)',
	'VC' => 'St. Vincent &amp; the Grenadines',
	'VE' => 'Venezuela',
	'VG' => 'British Virgin Islands',
	'VI' => 'United States Virgin Islands',
	'VN' => 'Viet Nam',
	'VU' => 'Vanuatu',
	'WF' => 'Wallis &amp; Futuna Islands',
	'WS' => 'Samoa',
	'YD' => 'Democratic Yemen (no longer exists)',
	'YE' => 'Yemen',
	'YT' => 'Mayotte',
	'YU' => 'Yugoslavia',
	'ZA' => 'South Africa',
	'ZM' => 'Zambia',
	'ZR' => 'Zaire',
	'ZW' => 'Zimbabwe'
);
		?>
		<?php echo $form->labelEx($userPropertyModel,'Country', array('class'=>'form-label')); ?>

		<?php echo $form->dropDownList($userPropertyModel, 'Country', array($builtArray), array('class'=>'form-text-box'));?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'Province/State'); ?>
		<?php echo $form->textField($userPropertyModel,'Province',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
		<?php echo $form->error($userPropertyModel,'Province'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'Address'); ?>
		<?php echo $form->textArea($userPropertyModel,'Address',array('size'=>60,'maxlength'=>300, 'rows'=>8, 'cols'=>44, 'class'=>'form-text-area')); ?>
		<?php echo $form->error($userPropertyModel,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($userPropertyModel,'AdditionalInformation'); ?>
		<?php echo $form->textArea($userPropertyModel,'AdditionalInformation',array('size'=>60,'rows'=>8, 'cols'=>44, 'maxlength'=>300, 'class'=>'form-text-area')); ?><em>Please enter keywords for searchablity. The more descriptive the keywords are the user will find the property</em>
	</div>
	<div class="row">
		<?php echo (!(empty($userAddedPictures[0]))) ?  $form->labelEx($userAddedPictures[0],'PictureUrl'): $form->labelEx($userAddedPictures,'PictureUrl');
		
		if(Yii::app()->controller->action->id == 'create'){
			$this->widget('CMultiFileUpload', array(
				'model'=>$userAddedPictures,
				'attribute'=>'photos',
				'accept'=>'jpg|gif|png',
				'denied'=>'File is not allowed',
				'max'=>6, // max 10 files	
				'name'=>'files',			
						
				));
		}
		else if(Yii::app()->controller->action->id == 'update'){
			if(!(empty($userAddedPictures[0]))){
			     $count = count($userAddedPictures) + 2;
				$this->widget('CMultiFileUpload', array(
					'model'=>$userAddedPictures[0],
					'attribute'=>'photos',
					'accept'=>'jpg|gif|png',
					'denied'=>'File is not allowed',
					'max'=>6, // max 10 files				
					
					));
				$tbl = "<table style='border:1px solid green' cellpadding='0' cellspacing='0'>
					<tr><th colspan='" . $count ."'>Pictures</th></tr>
					<tr>";
				foreach ($userAddedPictures as &$value) {
					$tbl.="<td><input type='hidden' value='" . $value->PictureID."'/></td>";
					$tbl.="<td>" . $value->PictureUrl."</td>";
				}
				
				$tbl.="</tr>
			</table>";
				echo $tbl;
			}
			else{
				$this->widget('CMultiFileUpload', array(
					'model'=>$userAddedPictures,
					'attribute'=>'photos',
					'accept'=>'jpg|gif|png',
					'denied'=>'File is not allowed',
					'max'=>6, // max 10 files				
					
					));
			}
			
		}
		?>
	</div>

	 <div class="row">
		<?php echo $form->hiddenField($userPropertyModel,'IsActive',array('value'=>1)); ?>
	</div>

	<div class="row right">
		<?php echo CHtml::submitButton($userPropertyModel->isNewRecord ? 'Create' : 'Save', array('class'=>'button')); ?>
	</div>
	<div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->
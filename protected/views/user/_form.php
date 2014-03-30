<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
/* @var $model1 Usertype */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);?>

	<div class="row">
	
	
		<?php if(!$model->disabledItems){echo $form->labelEx($model,'UserTypeID');}?>
		<?php if(!$model->disabledItems){echo $form->dropDownList($model, 'UserTypeID',  CHtml::listData($model1, 'UserTypeID', 'UserType'), array('class'=>'form-text-box'));}?>
	
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'FirstName');?>
		<?php echo $form->textField($model,'FirstName',array('size'=>60,'maxlength'=>100,'class'=>'form-text-box')); ?>
		<?php echo $form->error($model,'FirstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
		<?php echo $form->error($model,'LastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TelephoneNumber'); ?>
		<?php echo $form->textField($model,'TelephoneNumber', array('class'=>'form-text-box')); ?>
		<?php echo $form->error($model,'TelephoneNumber'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'Username', array('class'=>'form-text-box', 'disabled'=>$model->disabledItems)); ?>
		<?php echo $form->error($model,'Username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
		<?php echo $form->error($model,'Password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'City'); ?>
		<?php echo $form->textField($model,'City',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
		<?php echo $form->error($model,'City'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Province'); ?>
		<?php echo $form->textField($model,'Province',array('size'=>60,'maxlength'=>100, 'class'=>'form-text-box')); ?>
		<?php echo $form->error($model,'Province'); ?>
	</div>

	<div class="row">
	<?php echo $form->error($model,'Country'); ?>
		
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
		<?php echo $form->labelEx($model,'Country'); ?>

		<?php echo $form->dropDownList($model, 'Country', array($builtArray),  array('class'=>'form-text-box'));?>

	</div>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'IsActive'); ?>
		<?php echo $form->textField($model,'IsActive'); ?>
		<?php echo $form->error($model,'IsActive'); ?>
	</div> -->

	<div class="row right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',  array('class'=>'button')); ?>
	</div>
	<div class="clear"></div>

<?php $this->endWidget(); ?>

</div><!-- form -->
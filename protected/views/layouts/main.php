<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
<link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<?php
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->baseUrl.'/js/unslider.min.js'
	);
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->baseUrl.'/js/custom.js'
	);
?>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="background-image:url('http://www.wallpaper4me.com/images/wallpapers/onceadoorway-518718.jpeg')">

<div class="container" id="page">

	<div id="header">
		<div id="logo"><div><?php echo CHtml::encode(Yii::app()->name); ?></div><div class="motto"><?php echo CHtml::encode(Yii::app()->params->motto);?></div></div>
		
	</div><!-- header -->

	<div id="mainmenu">

		<?php 
		
		if(!(Yii::app()->user->isGuest))
		{
			
			if(Yii::app()->user->isVendor()){
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
								array('label'=>'Home', 'url'=>array('/site/index')),

								array('label'=>'Wishlist', 'url'=>array('/wishlist/index')),
								array('label'=>'Property', 'url'=>array('/userproperty/create')),
								array('label'=>'Bids', 'url'=>array('/bid/index')),
								array('label'=>'Profile', 'url'=>array('/user/index')),

								array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
								),
							)); 
			}
			else if(Yii::app()->user->isBuyer()){
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
								array('label'=>'Home', 'url'=>array('/site/index')),
								array('label'=>'Wishlist', 'url'=>array('/wishlist/index')),
								array('label'=>'Profile', 'url'=>array('/user/index')),
								array('label'=>'Bids', 'url'=>array('/bid/index')),
								array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),

								),
							)); 
				
			}
			else if(Yii::app()->user->isAdmin() || Yii::app()->user->isStaff()){
				$this->widget('zii.widgets.CMenu',array(
					'items'=>array(
								array('label'=>'Home', 'url'=>array('/site/index')),
								array('label'=>'Wishlist', 'url'=>array('/wishlist/index')),
								array('label'=>'Property', 'url'=>array('/userproperty/create')),
								//Admin
								array('label'=>'Profile', 'url'=>array('/user/index')),
								array('label'=>'Bids', 'url'=>array('/bid/index')),
								array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),

								),
							)); 
				
			}
			
		}
		else{
			$this->widget('zii.widgets.CMenu',array(
				'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Register', 'url'=>array('/user/create')),
							//Admin

							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

							),
					)); 
			}
?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

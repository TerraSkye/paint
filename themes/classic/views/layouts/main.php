<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="nl"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="nl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<base href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="images/touch-icon-iphone.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="images/touch-icon-ipad-retina.png" />
	<meta name="msapplication-TileImage" content="images/touch-icon-ipad-retina.png"/>
	<meta name="msapplication-TileColor" content="#FFFFFF"/>
	<meta name="application-name" content="<?php echo Yii::app()->name ?>" />
</head>

<body>
	<?php $this->renderPartial('//layouts/body', array('content' => $content)); ?>
</body>
</html>
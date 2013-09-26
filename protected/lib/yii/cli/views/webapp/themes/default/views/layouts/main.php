<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="nl" xml:lang="nl">
	<head>
		<base href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/"/>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="nl"/>
		<meta name="keywords" content="Student of the year, verkiezing"/>
		<meta name="description" content="Welke mannelijke en vrouwelijke student combineren intelligentie, ambitie, mediageniekheid & een knap uiterlijk? De tiende editie van de Student of the Year verkiezing is gestart. Stem mee!" />
		<meta name="copyright" content="All4Students B.V."/>
	</head>
	<body>
		<?php $this->renderPartial('//layouts/body', array('content'=>$content)); ?>
	</body>
</html>

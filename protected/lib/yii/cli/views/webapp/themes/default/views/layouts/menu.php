<nav>
<?php
$this->widget('zii.widgets.CMenu', array(
	'id' => 'leftmenu',
	'activeCssClass' => 'activated',
    'activateItems' => true,
	'items' => array(
		// Important: you need to specify url as 'controller/action',
		// not just as 'controller' even if default acion is used.
		array('label' => 'Home', 'url' => Yii::app()->request->getBaseUrl(true), 'active' => Yii::app()->controller->route == 'site/index'),
		array('label' => 'Nieuws', 'url' => array('/site/news')),
		array('label' => 'Deelnemers', 'url' => array('/contest/profile/index')),
		array('label' => 'Stemmen', 'url' => array('/contest/vote/index')),
        array('label' => 'Ranglijst', 'url' => array('/contest/ranking/index')),
		array('label' => 'Prijzen', 'url' => array('/site/rewards')),
	),
));
?>
</nav>

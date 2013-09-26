<?php
class Controller extends CommonController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias("application.assets"));
		Yii::app()->clientScript->registerCssFile("$assetsUrl/css/style.css");
		Yii::app()->clientScript->registerScriptFile("$assetsUrl/js/simplyscroll.js");
		Yii::app()->clientScript->registerScriptFile("$assetsUrl/js/headerslider.js");
	}

}
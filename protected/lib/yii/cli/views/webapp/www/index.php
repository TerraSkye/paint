<?php

$_dir = dirname(__FILE__);
$dev = isset($_SERVER["HTTP_HOST"]) && preg_match("/.dev$/", $_SERVER["HTTP_HOST"]);
if ($dev)
	define("YII_DEBUG", true);
else
	define("YII_DEBUG", false);
require(dirname(__FILE__) . '/../../../common/lib/yii/YiiBase.php');
class Yii extends YiiBase {
	/**
	 * @static
	 * @return CWebApplication
	 */
	public static function app() {
		return parent::app();
	}
}
if ($dev) {
	if (!file_exists("$_dir/../config/main-local.php"))
		throw new Exception("No local config file found, please create: " . realpath("$_dir/../config") . "/main-local.php");
	$config = CMap::mergeArray(require_once "$_dir/../config/main.php", require_once "$_dir/../config/main-local.php");
} else {
	$config = require_once "$_dir/../config/main.php";
}
if (YII_DEBUG) {
	// specify how many levels of call stack should be shown in each log message
	defined("YII_TRACE_LEVEL") or define("YII_TRACE_LEVEL", 3);
}
unset($_dir);


$app = Yii::createWebApplication($config);
$app->run();

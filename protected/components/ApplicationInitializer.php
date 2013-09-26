<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 5-3-13
 * Time: 14:08
 * To change this template use File | Settings | File Templates.
 */
class ApplicationInitializer extends CComponent
{
    public static function publish()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            Yii::app()->assetManager->publishArray(Yii::app()->params['configurations']['assets']);
        }
    }

}

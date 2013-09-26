<?php
class AssetManager extends CAssetManager
{

    public function publish($path, $hashByName = false, $level = -1, $forceCopy = null)
    {
        if ($forceCopy === null)
            $forceCopy = YII_DEBUG;

        Yii::log($path,CLogger::LEVEL_TRACE,'AssetManager');
        return parent::publish($path, $hashByName, $level, $forceCopy);
    }

    public function publishArray(array $array)
    {
        foreach ($array as $type => $data) {
            foreach ($data as $files) {
                $assetUrl = $this->publish(Yii::getPathOfAlias(key($data)));
                foreach ($files as $file) {
                    if ($type === 'js')
                        Yii::app()->clientScript->registerScriptFile("$assetUrl/$file");
                    elseif ($type === 'css')
                        Yii::app()->clientScript->registerCssFile("$assetUrl/$file");
                }
            }
        }
    }
}

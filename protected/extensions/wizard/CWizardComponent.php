<?php
/**
 * User: Sjoerd
 * Date: 28-3-13
 * Time: 16:18
 */
class CWizardComponent extends CApplicationComponent
{



    public function init()
    {
        // Register the bootstrap path alias.
        if (Yii::getPathOfAlias('wizard') === false)
            Yii::setPathOfAlias('wizard', realpath(dirname(__FILE__)));

        Yii::import('wizard.actions.*');
        Yii::import('wizard.components.*');
        Yii::import('wizard.models.*');
		Yii::import('wizard.widgets.*');

        parent::init();
    }

    /**
     * Returns the extension version number.
     * @return string the version
     */
    public function getVersion()
    {
        return '1.0.1';
    }


}

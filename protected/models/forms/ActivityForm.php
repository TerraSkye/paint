<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class ActivityForm extends CFormModel
{


    public $activity;


    public function rules()
    {
        return array(
            array("activity", "required")
        );
    }


    public function generateAttributeLabel($name)
    {
        if (strpos($name, "Activity[") !== false)
            return "";
        return parent::generateAttributeLabel($name);
    }

}

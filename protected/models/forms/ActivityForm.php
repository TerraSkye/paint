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


    private  $_activity;


    public function rules()
    {
        return array(
            array("activity", "required")
        );
    }


    public function setActivity($data){
        foreach($data as $activity => $value){

            if(!empty($value)){
                $this->_activity[$activity] = $value;
            }
        }
    }

    public function getActivity(){
        return $this->_activity;
    }


    public function afterValidate(){
    }


    public function attributeNames(){
        return array('activity');
    }

    public function generateAttributeLabel($name)
    {
        if (strpos($name, "activity[") !== false)
            return "";
        return parent::generateAttributeLabel($name);
    }

}

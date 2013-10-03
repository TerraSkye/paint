<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class Basic extends CFormModel
{


    public $date_of_birth;
    public $is_female;
    public $education;



    public function rules()
    {
        return array(
            array("test", "required")
        );
    }

    public function getQuestion(){
        return Question::model()->findByPk(1);
    }



    public function getGenderOptions(){
        return array(
            1 => "Vrouw",
            0 => "Man"
        );
    }
}
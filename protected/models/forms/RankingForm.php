<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class RankingForm extends CFormModel
{


    public $ranking;



    public function rules()
    {
        return array(
            array("ranking", "required")
        );
    }


    public function getScale()
    {
        return array(
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        );
    }

    public function attributeLabels() {
        return array(
            'test' => 'Weinig',
        );
    }

    public function getQuestion(){
        return Question::model()->findByPk(1);
    }

    public function getQuestion2(){
        return Question::model()->findByPk(2);
    }
}
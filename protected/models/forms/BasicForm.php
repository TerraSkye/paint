<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class BasicForm extends CFormModel
{


    public $test;



    public function rules()
    {
        return array(
            array("test", "required")
        );
    }


    public function getScale()
    {
        return array(
            1 => "Weinig",
            2 => "minder dan Gemiddeld",
            3 => "Gemiddled",
            4 => "Meer dan Gemiddeld",
            5 => "Veel",
        );
    }

    public function attributeLabels() {
        return array(
            'test' => "
Natuurlijk bestaat er niet zoiets als ‘de gemiddelde Nederlander’. Maar als u uzelf vergelijkt met wat andere mensen van kunst weten, in hoeverre bent u dan onder gemiddeld of bovengemiddeld?",
        );
    }

    public function getQuestion(){
        return Question::model()->findByPk(1);
    }

    public function getQuestion2(){
        return Question::model()->findByPk(2);
    }
}
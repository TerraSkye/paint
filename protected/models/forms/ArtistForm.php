<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 3-10-13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */

class ArtistForm extends CFormModel{


    public $artist;

    public function rules()
    {
        return array(
            array("artist", "required")
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
            6 => 6,
            -1 => -1
        );

    }

    public function attributeNames(){
        return array('artist');
    }
}
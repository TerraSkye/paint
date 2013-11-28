<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 3-10-13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */

class ArtistForm extends CFormModel{


    private  $_artist =array();

    public function rules()
    {
        return array(
            array("artist", "required")
        );
    }



    public function setArtist($data){
        foreach(Artist::model()->findAll() as $artist){
            $this->_artist[$artist->primaryKey] = isset($data[$artist->primaryKey]) ? intval($data[$artist->primaryKey]) : -1;
        }
    }

    public function getArtist(){
        return $this->_artist;
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
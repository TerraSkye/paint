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


    public $ranking = array();



    public function rules()
    {
        return array(
            array("ranking", "required")
        );
    }



    public function attributeLabels() {
        return array(
            'ranking' => 'Weinig',
        );
    }


	public function attributeNames(){
		return array('ranking');
	}

}
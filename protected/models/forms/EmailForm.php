<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class EmailForm extends CFormModel
{


    public $emailAdress;



    public function rules()
    {
        return array(
            array("emailAdress", "safe")
        );
    }



    public function attributeLabels() {
        return array(
            'emailAdress' => 'Email',
        );
    }


	public function attributeNames(){
		return array('emailAdress');
	}

}
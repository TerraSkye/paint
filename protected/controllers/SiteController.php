<?php

class SiteController extends CController
{


	public function init()
	{
		$this->layout = '//layouts/OneColumn';
		parent::init();
	}


    public function actionIndex(){
        $this->render('index');
    }


}
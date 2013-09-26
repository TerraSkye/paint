<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 15-5-13
 * Time: 15:27
 * To change this template use File | Settings | File Templates.
 */

Yii::import('common.widgets.bootstrap.*');
class WizardForm extends TbActiveForm
{


	public $model;


	public function init()
	{
		parent::init();
		$this->render('form', array('model' => $this->model));
	}
}
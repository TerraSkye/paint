<?php

/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 16-8-12
 * Time: 8:21
 * To change this template use File | Settings | File Templates.
 * @property CWizardController $controller
 */
class CWizardAction extends CAction implements IWizardAction
{

	public $label;
	public $view;
	public $assets = array();

	protected $_data = array();




    public function publishAssets(){
        Yii::app()->assetManager->publishArray($this->assets);
    }
	public function getData()
	{
		return $this->_data;
	}

	public function setData(array $data)
	{
		$this->_data = $data;
	}

	public function post()
	{
		foreach ($_POST as $k => $v)
			$this->_data[$k] = $v;
	}

	public function finalize()
	{
		/* nothing to do here, move along */
	}

	public function run()
	{
		if (Yii::app()->request->isAjaxRequest)
			$this->controller->renderPartial($this->view, $this->data);
		else {
           $this->publishAssets();
			$this->controller->render($this->view, $this->data);
		}
	}

	/**
	 * @param mixed $actions
	 * @return string next action
	 */
	public function getNextAction($actions)
	{
		if(!($actions instanceof CMap))
			$actions = new CMap($actions);
		$idx = array_search($this->id, $actions->keys);

		if ($idx !== false && isset($actions->keys[$idx + 1])) {
			$nextKey = $actions->keys[$idx + 1];

			if(in_array('IWizardAction', class_implements($actions[$nextKey]['class'])))
				return $nextKey;
			else
				return null;
		} else {
			return null;
		}
	}

	/**
	 * @param mixed $actions
	 * @return string previous action
	 */
	public function getPreviousAction($actions)
	{
		if(!($actions instanceof CMap))
			$actions = new CMap($actions);
		$idx = array_search($this->id, $actions->keys);

		if ($idx !== false && isset($actions->keys[$idx - 1])) {
			$previousKey = $actions->keys[$idx - 1];
			if(in_array('IWizardAction', class_implements($actions[$previousKey]['class'])))
				return $previousKey;
			else
				return null;
		} else {
			return null;
		}
	}

	public function validate()
	{
		return !empty($this->_data);
	}
}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 16-8-12
 * Time: 8:21
 * To change this template use File | Settings | File Templates.
 *
 * @property $instance CModel
 */
class CWizardModelAction extends CWizardAction
{

	public $view = '//wizard/index';
	public $model;
	private $_instance;

	/**
	 * @return string class name of model
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * @return CModel the instance of the model
	 */
	/**
	 * @return CModel the instance of the model
	 */
	public function getInstance()
	{
		if (is_null($this->_instance)) {
			$class = $this->getModel();
			if (($offset = strpos($class, '('))) {
				$scenario = substr($class, $offset + 1, strpos($class, ')') - $offset - 1);
				$class = substr($class, 0, $offset);
			}
			$this->_instance = new $class(@$scenario);
		}
		return $this->_instance;
	}

	/**
	 * Handle post data
	 */
	public function post()
	{
		$this->instance->attributes = Yii::app()->request->getPost(get_class($this->instance),array());
	}

	/**
	 * @
	 */
	public function getData()
	{
		return $this->instance->attributes;
	}

	public function setData(array $data)
	{
		$this->instance->attributes = $data;
	}

	public function run()
	{
		if (Yii::app()->request->isAjaxRequest)
			$this->controller->renderPartial($this->view, array('model' => $this->instance, 'action' => $this));
		else {
			$this->publishAssets();
			$this->controller->render($this->view, array('model' => $this->instance, 'action' => $this));
		}
	}

	public function finalize()
	{
		return true;
	}

	public function validate()
	{
		return $this->instance->validate();
	}

	/**
	 * @return bool
	 * @throws CDbException
	 */
	protected function save()
	{
		foreach (func_get_args() as $model) {
			if (!$model->save())
				throw new CDbException('could not save [' . get_class($model) . ' ] with error :' . json_encode($model->errors));
		}
		return true;
	}
}
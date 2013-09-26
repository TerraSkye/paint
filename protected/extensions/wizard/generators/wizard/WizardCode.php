<?php

class WizardCode extends CCodeModel
{
	public $modelAttributes;
	public $action;
	public $baseActionClass = 'CWizardAction';
	public $actionPath = 'application.actions';
	public $view;
	public $model;
	public $modelPath = 'application.models';
	public $baseModelClass = 'CFormModel';


	public function rules()
	{
		return array_merge(parent::rules(), array(
			array('modelAttributes, baseModelClass, baseActionClass', 'required'),
			array('action', 'actionValidator'),
			array('model', 'modelValidator'),
			array('view', 'viewValidator'),
		));
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'action' => 'Wizard Action ID',
			'baseActionClass' => 'Base action Class',
			'model' => 'Model Id',
			'view' => 'allias to view + viewname',
			'baseModelClass' => 'Base model class',
			'modelAttributes' => 'Form attributes (comma separated)',

		));
	}

	public function actionValidator($attribute, $params)
	{
		if (strlen($this->$attribute)) {
			$path = Yii::getPathOfAlias($this->actionPath);
			if (is_file("$path/$this->action.php")) {
				$this->addError($attribute, 'Action already exists');
			}
		}
	}

	public function modelValidator($attribute, $params)
	{
		if (strlen($this->$attribute)) {
			$path = Yii::getPathOfAlias($this->modelPath);
		if (is_file("$path/$this->model.php")) {
				$this->addError($attribute, 'Model already exists');
			}
		}
	}

	public function viewValidator($attribute, $params)
	{
		if (strlen($this->$attribute)) {
			$path = Yii::getPathOfAlias($this->view);
			if (is_file("$path.php")) {
				$this->addError($attribute, 'View already exists');
			}
		}
	}

	public function prepare()
	{


		$this->files = array();
		$templatePath = $this->templatePath;

		if (strlen($this->action)) {
			$this->files[] = new CCodeFile(
				Yii::getPathOfAlias($this->actionPath).DIRECTORY_SEPARATOR.'CWizard'.ucfirst($this->action).'.php',
				$this->render($templatePath . '/action.php')
			);
		}
		if (strlen($this->model)) {
			$this->files[] = new CCodeFile(
				Yii::getPathOfAlias($this->modelPath).DIRECTORY_SEPARATOR.$this->model.'.php',
				$this->render($templatePath . '/model.php')
			);
		}
		if (strlen($this->view)) {
			$this->files[] = new CCodeFile(
				Yii::getPathOfAlias($this->view).'.php',
				$this->render($templatePath . '/view.php')
			);
		}
	}


	public function requiredTemplates()
	{
		return array(
			'action.php',
			'view.php',
			'model.php',
		);
	}

	public function getControllerClass()
	{
		if (($pos = strrpos($this->controller, '/')) !== false)
			return ucfirst(substr($this->controller, $pos + 1)) . 'Controller';
		else
			return ucfirst($this->controller) . 'Controller';
	}

	public function getModule()
	{
		if (($pos = strpos($this->controller, '/')) !== false) {
			$id = substr($this->controller, 0, $pos);
			if (($module = Yii::app()->getModule($id)) !== null)
				return $module;
		}
		return Yii::app();
	}

	public function getControllerID()
	{
		if ($this->getModule() !== Yii::app())
			$id = substr($this->controller, strpos($this->controller, '/') + 1);
		else
			$id = $this->controller;
		if (($pos = strrpos($id, '/')) !== false)
			$id[$pos + 1] = strtolower($id[$pos + 1]);
		else
			$id[0] = strtolower($id[0]);
		return $id;
	}

	public function getUniqueControllerID()
	{
		$id = $this->controller;
		if (($pos = strrpos($id, '/')) !== false)
			$id[$pos + 1] = strtolower($id[$pos + 1]);
		else
			$id[0] = strtolower($id[0]);
		return $id;
	}

	public function getControllerFile()
	{
		$module = $this->getModule();
		$id = $this->getControllerID();
		if (($pos = strrpos($id, '/')) !== false)
			$id[$pos + 1] = strtoupper($id[$pos + 1]);
		else
			$id[0] = strtoupper($id[0]);
		return $module->getControllerPath() . '/' . $id . 'Controller.php';
	}

	public function getViewFile($action)
	{
		$module = $this->getModule();
		return $module->getViewPath() . '/' . $this->getControllerID() . '/' . $action . '.php';
	}


}
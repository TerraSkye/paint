<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 27-5-13
 * Time: 10:41
 * To change this template use File | Settings | File Templates.
 */
Yii::import('common.lib.yii.gii.generators.controller.ControllerCode');
class WizardAIOCode extends ControllerCode {


	public $view;
	private $_formAttributes;
	public $fields;



	/**
	 * Prepares the code files to be generated.
	 * This is the main method that child classes should implement. It should contain the logic
	 * that populates the {@link files} property with a list of code files to be generated.
	 */
	public function prepare()
	{
		$templatePath=$this->templatePath;
		foreach($this->fields as $action => $attributes)
		{
			$this->files[]=new CCodeFile(
				$this->getViewFile($action),
				$this->render($templatePath.'/summary.php', array('action'=>$action,'fields' => $attributes))
			);
			$this->files[]=new CCodeFile(
				$this->getViewFile(substr($action,1)),
				$this->render($templatePath.'/view.php', array('action'=>$action,'fields' => $attributes))
			);
			$this->files[]=new CCodeFile(
				$this->getModelFile(substr($action,1)),
				$this->render($templatePath.'/model.php', array('action'=>$action,'fields' => $attributes))
			);
		}
	}

	public function rules()
	{
		return array(
			array('controller, actions, baseClass', 'filter', 'filter'=>'trim'),
			array('controller, baseClass,formAttributes ', 'required'),
			array('controller', 'match', 'pattern'=>'/^\w+[\w+\\/]*$/', 'message'=>'{attribute} should only contain word characters and slashes.'),
			array('actions', 'match', 'pattern'=>'/^\w+[\w\s,]*$/', 'message'=>'{attribute} should only contain word characters, spaces and commas.'),
			array('baseClass', 'match', 'pattern'=>'/^[a-zA-Z_]\w*$/', 'message'=>'{attribute} should only contain word characters.'),
			array('baseClass', 'validateReservedWord', 'skipOnError'=>true),
			array('baseClass, actions', 'sticky'),
		);
	}



	public function setFormAttributes($value){

		foreach(explode("\n",$value) as $dataString){
			$attributes = explode(",",$dataString);
			$action = array_shift($attributes);
			$this->fields[$action] = array_map("trim",$attributes);
		}
		$this->_formAttributes = $value;
	}

	public function getFormAttributes(){


		return $this->_formAttributes;
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'baseClass'=>'Base Class',
			'controller'=>'View Path',
			'actions'=>'Action IDs',
		));
	}

	public function attributeNames()
	{
		$class = new ReflectionClass(get_class($this));
		$names = array();
		foreach ($class->getProperties() as $property) {
			$name = $property->getName();
			$method = ucfirst(substr($name, 1));
			if ($property->isPrivate() && !$property->isStatic()) {
				if (substr_count($name, '_', 0, 1) && $class->hasMethod("get$method") && $class->hasMethod("set$method"))
					$names[] = substr($name, 1);
			}
		}
		return CMap::mergeArray(parent::attributeNames(), $names);
	}


	public function getModelFile($action)
	{
		$module=$this->getModule();
		return $module->getViewPath().'/models/'.ucfirst($action).'.php';
	}



}
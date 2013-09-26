<?php
class TbControlGroup extends CWidget
{

	/**
	 * @var $model CModel Model to use for active labels and fields
	 */
	public $model;
	/**
	 * @var $attribute string Model attribute to create a control group for
	 */
	public $attribute;
	/**
	 * @var $field string Html field, optional
	 */
	public $field = null;
	/**
	 * @var $displayErrors boolean Display errors
	 */
	public $displayErrors = TRUE;

	public function init()
	{
		$class = 'control-group' . ($this->model->hasErrors($this->attribute) ? ' error' : '');
		echo CHtml::openTag('div', array('class' => $class)) .
		CHtml::activeLabelEx($this->model, $this->attribute, array('class' => 'control-label')) .
		CHtml::openTag('div', array('class' => 'controls')) .
		$this->field;
	}

	public function run()
	{
		if($this->displayErrors)
			echo CHtml::error($this->model, $this->attribute, array('class' => 'help-inline'));
		echo '</div></div>';
	}

}

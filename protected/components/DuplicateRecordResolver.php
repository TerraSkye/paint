<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Richard
 * Date: 27/05/13
 * Time: 15:50
 *
 * When this behaviour is called it will check against existing records to prevent
 * inserting duplicate records. This is used in addresses, phonenumbers, studies etc.
 */


class DuplicateRecordResolver extends CActiveRecordBehavior
{

	private $_foundAttributes = array();
	private $matchingAttributes = array();

	public function afterFind($event)
	{
		$this->_foundAttributes = $this->removeAttributes($this->getOwner()->attributes);
		parent::afterFind($event);
	}

	public function saveWithChecks($attributes = null)
	{

		if ($attributes !== null) {
			$this->getOwner()->setAttributes($attributes);
		}
		if ($this->removeAttributes($this->getOwner()->attributes) == $this->_foundAttributes)
			return;
		$newModel = $this->resolve();

		if (!$newModel->hasErrors()) {
			$this->getOwner()->setPrimaryKey($newModel->primaryKey);
			$this->getOwner()->setIsNewRecord(false);
			$this->getOwner()->refresh();
		} else
			$this->getOwner()->addErrors($newModel->getErrors());
		return !$newModel->hasErrors();
	}


	public function resolve()
	{
		$ownerName = get_class($this->getOwner());

		$existingModel = $this->getOwner()->findByAttributes($this->removeAttributes($this->getOwner()->attributes));

		if (is_null($existingModel)) {
			$existingModel = $ownerName::newModel();
			$existingModel->attributes = $this->getOwner()->attributes;
			$existingModel->save();


		}
		return $existingModel;
	}

	private function removeAttributes($attributes)
	{
		$newAttributes = array();
		foreach ($this->matchingAttributes as $attribute)
			$newAttributes[$attribute] = $attributes[$attribute];
		return $newAttributes;
	}

	public function setMatchingAttributes($value)
	{
		if (is_string($value)) {
			$this->matchingAttributes = preg_split('/[\s,]+/', $value, -1, PREG_SPLIT_NO_EMPTY);
		} else if (is_array($value)) {
			$this->matchingAttributes = $value;
		} else {
			throw new CException("unexpected value" . json_encode($value));
		}
	}

	public function getMatchingAttributes()
	{
		return $this->matchingAttributes;
	}

	/**
	 * @return ActiveRecord
	 */
	public function getOwner()
	{
		return parent::getOwner();
	}
}
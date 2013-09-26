<?php

/**
 * This is the model class for table "wizard_log".
 *
 * The followings are the available columns in table 'wizard_log':
 * @property integer $wizard_log_id
 * @property string $action_id
 * @property integer $wizard_session_id
 * @property string $create_date
 * @property string $data
 * @property string $action_next_id
 *
 * @property CWizardSession $session
 */
class CWizardLog extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CWizardLog the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return CWizardLog the new model class
	 */
	public static function newModel($scenario = 'insert', $className = __CLASS__)
	{
		return parent::newModel($scenario, $className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_wizard_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wizard_session_id', 'numerical', 'integerOnly' => true),
			array('action_id', 'length', 'max' => 50),
			array('data_encoded', 'length', 'max' => 1073741823),
			array('create_date,next_action_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('wizard_log_id, action_id,next_action_id, wizard_session_id, create_date, data', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'session' => array(self::BELONGS_TO, 'CWizardSession', 'wizard_session_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wizard_log_id' => 'Wizard Log',
			'action_id' => 'Action',
			'wizard_session_id' => 'Wizard Session',
			'create_date' => 'Create Date',
			'data_encoded' => 'Data',
			'next_action_id' => 'Next WizardAction'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('wizard_log_id', $this->wizard_log_id);
		$criteria->compare('action_id', $this->action_id, true);
		$criteria->compare('wizard_session_id', $this->wizard_session_id);
		$criteria->compare('create_date', $this->create_date, true);
		$criteria->compare('data', $this->data, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function forSession(CWizardSession $session)
	{
		$join = ' inner join ( ' .
			' select action_id, max(wizard_log_id) as wizard_log_id ' .
			' from yii_wizard_log where wizard_session_id = :session_id ' .
			' group by action_id ) recent ' .
			' on recent.wizard_log_id=t.wizard_log_id';
		$this->getDbCriteria()->mergeWith(array(
			'join' => $join,
			'params' => array(':session_id' => $session->wizard_session_id),
			'order' => sprintf('%s.wizard_log_id asc', $this->getTableAlias(false, false)),
		));
		return $this;
	}

	public function byAction(IWizardAction $action)
	{
		$this->getDbCriteria()->mergeWith(array(
			'condition' => sprintf('%s.action_id = :action_id', $this->getTableAlias(false, false)),
			'params' => array(':action_id' => $action->getId()),
		));
		return $this;
	}

	public function setData($data)
	{
		$this->data_encoded = json_encode($data);
	}

	public function getData()
	{
		return json_decode($this->data_encoded, true);
	}

	public function add(IWizardAction $action)
	{
		if (!($model = CWizardSession::model()->findByAttributes(array('session_id' => Yii::app()->session->get("wizard-{$action->controller->uniqueId}"))))) {
			var_dump($model, $action->id, Yii::app()->session->get("wizard-{$action->controller->uniqueId}", null), 'error');
			Yii::app()->end();
		}
		$this->wizard_session_id = CWizardSession::model()->findByAttributes(array('session_id' => Yii::app()->session->get("wizard-{$action->controller->uniqueId}")))->wizard_session_id;
		$this->action_id = $action->getId();
		$this->data = $action->getData();
		$this->next_action_id = $action->getNextAction(new CMap(Yii::app()->controller->actions()));
		if ($this->save())
			return $this;
	}

}

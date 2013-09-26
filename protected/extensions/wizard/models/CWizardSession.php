<?php

/**
 * This is the model class for table "wizard_session".
 *
 * The followings are the available columns in table 'wizard_session':
 * @property integer $wizard_session_id
 * @property string $session_id
 * @property string $wizard_id
 * @property string $ip
 * @property string $create_date
 *
 * @property CWizardLog[] $logs
 */
class CWizardSession extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CWizardSession the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return CWizardSession the new model class
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
		return 'yii_wizard_session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, wizard_id, ip', 'length', 'max' => 50),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('wizard_session_id, session_id, wizard_id, ip, create_date', 'safe', 'on' => 'search'),
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
			'logs' => array(self::HAS_MANY, 'CWizardLog', 'wizard_session_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wizard_session_id' => 'Wizard Session',
			'session_id' => 'Session',
			'wizard_id' => 'Wizard',
			'ip' => 'Ip',
			'create_date' => 'Create Date',
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

		$criteria->compare('wizard_session_id', $this->wizard_session_id);
		$criteria->compare('session_id', $this->session_id, true);
		$criteria->compare('wizard_id', $this->wizard_id, true);
		$criteria->compare('ip', $this->ip, true);
		$criteria->compare('create_date', $this->create_date, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}

<?php

/**
 * This is the model class for table "contact_activity".
 *
 * The followings are the available columns in table 'contact_activity':
 * @property integer $contact_id
 * @property integer $activity_id
 * @property string $create_date
 */
class ContactActivity extends ActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactActivity the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return ContactActivity the new model class
	 */
	public static function newModel($scenario = 'insert', $className=__CLASS__) {
		return parent::newModel($scenario, $className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'contact_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_id, activity_id, create_date', 'required'),
			array('contact_id, activity_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_id, activity_id, create_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'contact_id' => 'Contact',
			'activity_id' => 'Activity',
			'create_date' => 'Create Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('activity_id',$this->activity_id);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
}

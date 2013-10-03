<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $contact_id
 * @property string $date_of_birth
 * @property integer $is_female
 * @property integer $education_id
 * @property integer $knowledge_base
 * @property string $create_date
 */
class Contact extends ActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return Contact the new model class
	 */
	public static function newModel($scenario = 'insert', $className=__CLASS__) {
		return parent::newModel($scenario, $className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_of_birth, is_female, education_id, knowledge_base, create_date', 'required'),
			array('is_female, education_id, knowledge_base', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_id, date_of_birth, is_female, education_id, knowledge_base, create_date', 'safe', 'on'=>'search'),
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
			'date_of_birth' => 'Date Of Birth',
			'is_female' => 'Is Female',
			'education_id' => 'Education',
			'knowledge_base' => 'Knowledge Base',
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
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('is_female',$this->is_female);
		$criteria->compare('education_id',$this->education_id);
		$criteria->compare('knowledge_base',$this->knowledge_base);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
}

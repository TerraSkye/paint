<?php

/**
 * This is the model class for table "contact_painting".
 *
 * The followings are the available columns in table 'contact_painting':
 * @property integer $contact_id
 * @property integer $painting_id
 * @property integer $weight
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property Painting $painting
 */
class ContactPainting extends ActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactPainting the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return ContactPainting the new model class
	 */
	public static function newModel($scenario = 'insert', $className=__CLASS__) {
		return parent::newModel($scenario, $className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'contact_painting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_id, painting_id, weight, create_date', 'required'),
			array('contact_id, painting_id, weight', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_id, painting_id, weight, create_date', 'safe', 'on'=>'search'),
		);
	}


	public function behaviors()
	{
		return array_merge(parent::behaviors(), array(
			'DuplicateRecordResolver' => array(
				'class' => 'application.components.DuplicateRecordResolver',
				'matchingAttributes' => "contact_id,painting_id",
			),
		));
	}


	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'painting' => array(self::BELONGS_TO, 'Painting', 'painting_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'contact_id' => 'Contact',
			'painting_id' => 'Painting',
			'weight' => 'Weight',
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
		$criteria->compare('painting_id',$this->painting_id);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
}

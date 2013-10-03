<?php

/**
 * This is the model class for table "painting".
 *
 * The followings are the available columns in table 'painting':
 * @property integer $painting_id
 * @property string $value
 * @property string $file_path
 * @property string $create_date
 *
 * The followings are the available model relations:
 * @property ContactPainting[] $contactPaintings
 */
class Painting extends ActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return Painting the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return Painting the new model class
	 */
	public static function newModel($scenario = 'insert', $className=__CLASS__) {
		return parent::newModel($scenario, $className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'painting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value, file_path, create_date', 'required'),
			array('value, file_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('painting_id, value, file_path, create_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'contactPaintings' => array(self::HAS_MANY, 'ContactPainting', 'painting_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'painting_id' => 'Painting',
			'value' => 'Value',
			'file_path' => 'File Path',
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

		$criteria->compare('painting_id',$this->painting_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('file_path',$this->file_path,true);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
}

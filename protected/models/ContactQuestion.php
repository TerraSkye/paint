<?php

/**
 * This is the model class for table "contact_question".
 *
 * The followings are the available columns in table 'contact_question':
 * @property integer $contact_id
 * @property integer $question_id
 * @property integer $option_id
 * @property string $create_date
 */
class ContactQuestion extends ActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @return ContactQuestion the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Returns a new model of the specified AR class.
	 * @return ContactQuestion the new model class
	 */
	public static function newModel($scenario = 'insert', $className=__CLASS__) {
		return parent::newModel($scenario, $className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'contact_question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_id, question_id, option_id, create_date', 'required'),
			array('contact_id, question_id, option_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_id, question_id, option_id, create_date', 'safe', 'on'=>'search'),
		);
	}

    public function behaviors()
    {
        return array_merge(parent::behaviors(), array(
            'DuplicateRecordResolver' => array(
                'class' => 'application.components.DuplicateRecordResolver',
                'matchingAttributes' => 'contact_id, question_id'
            )
        ));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'question' => array(self::BELONGS_TO,'Question','question_id'),
            'option' => array(self::BELONGS_TO,'Option','option_id'),
            'contact' => array(self::BELONGS_TO,'Contact','contact_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'contact_id' => 'Contact',
			'question_id' => 'Question',
			'option_id' => 'Option',
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
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function __toString(){
        if($this->option !== null)
        return $this->option->value;
        return "$this->option_id";
    }

    public function __toInt(){
        return CPropertyValue::ensureInteger($this->option_id);
    }
}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class BasicForm extends CFormModel
{

    public $test;

    private $_question = array();


	private $_option = array();

	public function getOption()
	{
		return $this->_option;
	}

	public function setOption($value)
	{
		foreach ($value as $option_id => $answer)
			$this->_option[$option_id] = $answer;
	}


    public function setQuestion($value)
    {
        foreach ($value as $question_id => $answer)
            $this->_question[$question_id] = $answer;
    }



	public function getQuestion()
	{
		return $this->_question;
	}


    public function rules()
    {
        return array(
            array("test,question", "required"),
            array("option", "safe"),
        );
    }


	public function afterValidate(){

	}
    public function getScale()
    {
        return array(
            1 => "Weinig",
            2 => "minder dan Gemiddeld",
            3 => "Gemiddled",
            4 => "Meer dan Gemiddeld",
            5 => "Veel",
        );
    }

    public function attributeLabels()
    {
        return array(
            'test' => "Natuurlijk bestaat er niet zoiets als ‘de gemiddelde Nederlander’.
            Maar als u uzelf vergelijkt met wat andere mensen van kunst weten, in hoeverre
            bent u dan onder gemiddeld of bovengemiddeld?",
        );
    }

    public function getQuestionData()
    {
        return array(Question::model()->findByPk(1), Question::model()->findByPk(2));
    }

    public function attributeNames(){
        return array('test','question','option');
    }

}
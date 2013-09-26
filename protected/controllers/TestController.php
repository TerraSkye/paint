<?php

class TestController extends CWizardController
{



    public function init(){
        $this->layout = '//layouts/OneColumn';
        parent::init();
    }


    public function actions(){
        $actions = array(
            'ranking' => array(
                'class' => 'CWizardModelAction',
                'model' => 'RankingForm',
                'view' => '_ranking',
            ),
            'answers' => array(
                'class' => 'CWizardModelAction',
                'model' => 'RankingForm',
                'view' => '_answer',
            ),
            'interests' => array(//transaction
                'class' => 'CWizardModelAction',
                'model' => 'RankingForm',
                'view' => '_interest',
            ),
         );
        return $actions;
    }


}
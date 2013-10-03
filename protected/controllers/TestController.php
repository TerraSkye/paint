<?php

class TestController extends CWizardController
{



    public function init(){
        $this->layout = '//layouts/OneColumn';
        parent::init();
    }


    public function actions(){
        $actions = array(
            'basic' => array(
                'class' => 'CWizardModelAction',
                'model' => 'RankingForm',
                'view' => '_ranking',
            ),
            'answers' => array(
                'class' => 'CWizardModelAction',
                'model' => 'ActivityForm',
                'view' => '_answer',
            ),
            'artist' => array(//transaction
                'class' => 'CWizardModelAction',
                'model' => 'ArtistForm',
                'view' => '_interest',
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
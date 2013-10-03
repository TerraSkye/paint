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
                'model' => 'BasicForm',
                'view' => '_basic',
            ),
            'activity' => array(
                'class' => 'CWizardModelAction',
                'model' => 'ActivityForm',
                'view' => '_activity',
            ),
            'artist' => array(//transaction
                'class' => 'CWizardModelAction',
                'model' => 'ArtistForm',
                'view' => '_artist',
            ),
            'ranking' => array(//transaction
                'class' => 'CWizardModelAction',
                'model' => 'RankingForm',
                'view' => '_ranking',
            ),
            'contact' => array(//transaction
                'class' => 'CWizardModelAction',
                'model' => 'ContactForm',
                'view' => '_contact',
            ),
         );
        return $actions;
    }


}
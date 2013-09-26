<?php

class SiteController extends CommonSiteController {


    public function init() {
		$this->layout = 'main';
	}
	
	public function actionIndex() {
		$this->render('index');
	}

	public function actionNews() {
		$this->render('news');
	}
	
	public function actionRewards() {
		$this->render('rewards');
	}
    
    public function actionTerms() {
        $this->render('terms');
    }
}

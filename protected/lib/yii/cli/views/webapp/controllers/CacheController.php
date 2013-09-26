<?php
class CacheController extends Controller {

    public function actionFlush() {
        Yii::app()->cache->flush();
        echo 'done';
    }

}
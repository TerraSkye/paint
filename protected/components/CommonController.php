<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Serenity
 * Date: 19-3-13
 * Time: 12:40
 * To change this template use File | Settings | File Templates.
 */
class CommonController extends Controller
{

    public $breadCrumbs = array();
    public $menu = array();

    public function beforeAction($action)
    {
       /* if (Yii::app()->user->isGuest) {
            $this->redirect(array('/contact/login'));
        }*/
        return parent::beforeAction($action);
    }


    public function renderPartial($view, $data = array(), $return = false, $processOutput = false)
    {
        if ($data instanceof CModel) {
            $data = array('model' => $data);
        }
        return parent::renderPartial($view, $data, $return, $processOutput);
    }


    public function render($view, $data = array(), $return = false)
    {
        if ($data instanceof CModel) {
            $data = array('model' => $data);
        }
        return parent::render($view, $data, $return);
    }

}

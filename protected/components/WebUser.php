<?php
/**
 * @property Contact $model
 */


class WebUser extends CWebUser
{


    /**
     * @var string
     */
    public $userModelName;

    /**
     * The web user model used to get user information
     * @var CActiveRecord
     */
    private $model;


    /**
     * The web user model used to get user information
     * @return CActiveRecord
     */
    public function getModel()
    {
        $m = $this->userModelName;
        if ($this->model === null)
            $this->model = $m::model()->findByPk($this->id);
        return $this->model;
    }

}
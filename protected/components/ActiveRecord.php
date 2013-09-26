<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 9-11-12
 * Time: 19:41
 * To change this template use File | Settings | File Templates.
 * @property CDbExpression timestampExpression
 */
class ActiveRecord extends CActiveRecord
{

    const DATE_FORMAT = "Y-m-d H:i:s";

    public function onBeforeValidate($event)
    {
        if ($this->getIsNewRecord() && $this->hasAttribute('create_date'))
            $this->create_date = $this->timestampExpression;

        if ($this->getIsNewRecord() && $this->hasAttribute('created_by_user'))
            $this->created_by_user = Yii::app()->user->id;

        parent::onBeforeValidate($event);
    }

    public function onBeforeSave($event)
    {
        if (!$this->getIsNewRecord() && $this->hasAttribute('modify_date')) {
            $this->modify_date =$this->timestampExpression;
            parent::onBeforeValidate($event);
        }
    }



    public function delete(){
        if($this->hasAttribute('delete_date')){
            $this->delete_date = $this->timestampExpression;
            $this->save();
            return true;
        }
        return parent::delete();
    }

    public static function newModel($scenario = 'insert', $className = __CLASS__) {
        return new $className($scenario);
    }


    public function __toString(){
        if($this->hasAttribute('value'))
            return $this->getAttribute('value');
        return parent::__toString();
    }

    /**
     * Met Yii kan je ook deze methode uitvoeren:
     * ActiveRecord::newModel()->setAttributes($attributes)->save();
     * Met deze methode kan je chainen(er vanuitgaande dat alles gevalideerd is uiteraard)
     */
    public function saveWithAttributes($attributes = array()) {
        foreach($attributes as $attribute => $value) {
            if ($this->hasAttribute($attribute)) {
                $this->$attribute = $value;
            }
        }
        if ($this->save())
            return $this;
        else {
            return false;
        }
    }






    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => ($this->hasAttribute('create_date') ? 'create_date' : null),
                'updateAttribute' => ($this->hasAttribute('modify_date') ? 'modify_date' : null),
                'timestampExpression' => $this->timestampExpression,
            ),
            'DateTimeBehavior' => array(
                'class' => 'application.components.DateTimeBehavior'
            ),
        );
    }

    /**
     * It should be noted that this method does not do all that in terms of
     * finding the correct server version.
     **/
    public function getTimestampExpression() {
        if (Yii::app()->db->driverName == 'dblib' || Yii::app()->db->driverName == 'mssql')
            return self::$_mssqlTimestampExpression;
        elseif (substr(Yii::app()->db->driverName, 0, 5) == 'mysql')
            return new CDbExpression("now()");
        else
            return 'gmdate(' . self::DATE_FORMAT . ')';
    }

    protected function query($criteria,$all=false)
    {
        $this->beforeFind();
        $this->applyScopes($criteria);
        if(empty($criteria->with))
        {
            if(!$all)
                $criteria->limit=1;
            $command=$this->getCommandBuilder()->createFindCommand($this->getTableSchema(),$criteria);
            return $all ? $this->populateRecords($command->queryAll(), true, $criteria->index) : $this->populateRecord($command->queryRow());
        }
        else
        {
            $finder=new CActiveFinder($this,$criteria->with);
            return $finder->query($criteria,$all);
        }
    }

}


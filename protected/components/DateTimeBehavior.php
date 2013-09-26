<?php

class CDateTime extends DateTime {

    public function __toString() {
        return $this->format('Y-m-d H:i:s');
    }


}

class DateTimeBehavior extends CActiveRecordBehavior {
    private static $tz;
    private static $fmt = 'Y-m-d H:i:s';

    public function __construct() {
        if(is_null(self::$tz))
            self::$tz = new DateTimeZone('UTC');
    }

    private static function isdtc($dbType) {
        // this behavior only works for datetime2
        return $dbType == 'datetime';
    }

    private static function dti($value) {
        return (is_null($value) or strlen($value) == 0) ? null :
            new CDateTime($value, self::$tz);
    }

    private static function dtv($datetime) {
        if($datetime instanceof DateTime) {
            $datetime->setTimeZone(self::$tz);
            return $datetime->format(self::$fmt);
        } 
        return $datetime;
    }

    public function afterFind($event) {
        foreach($event->sender->tableSchema->columns as $name => $column) {
            if(!self::isdtc($column->dbType)) continue;
            $value = $event->sender->getAttribute($name);
            $event->sender->setAttribute($name, self::dti($value));
        }
    }

    public function beforeSave($event) {
        foreach($event->sender->tableSchema->columns as $name => $column) {
            if(!self::isdtc($column->dbType)) continue;
            $value = $event->sender->getAttribute($name);
            $event->sender->setAttribute($name, self::dtv($value));
        }
    }
}
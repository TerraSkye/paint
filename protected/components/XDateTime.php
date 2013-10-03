<?php
class XDateTime extends DateTime
{

    public function __toString()
    {
        return $this->format('Y-m-d H:i:s.u');
    }

    public static function createFromString($string)
    {
        return self::createFromFormat('Y-m-d H:i:s.u', date('Y-m-d H:i:s.00', strtotime($string)));
    }

    public static function createFromFormat($format, $time, $timezone = null)
    {
        $dateTime = parent::createFromFormat($format, $time);
        return $dateTime;
        /*
        $XDatetime = new self;
		$XDatetime->setTimestamp($dateTime->getTimestamp());
		return $XDatetime; */
    }

}

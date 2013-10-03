<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Sjoerd
 * Date: 24-9-13
 * Time: 9:05
 * To change this template use File | Settings | File Templates.
 */

class ContactForm extends CFormModel
{

    private static $_names;

    private $_date_of_birth;
    public $is_female;
    public $education_id;


    public function rules()
    {
        return array(
            array("education_id,date_of_birth,education_id", "required")
        );
    }

    public function getQuestion()
    {
        return Question::model()->findByPk(1);
    }


    public function setDate_of_birth($value)
    {
        $this->setDateTime(__FUNCTION__, $value);
    }

    public function getDate_of_birth()
    {
        return $this->getDateTime(__FUNCTION__);
    }


    public function getGenderOptions()
    {
        return array(
            1 => "Vrouw",
            0 => "Man"
        );
    }

    /**
     * @return array attributeNames
     */
    public function attributeNames()
    {
        $className = get_class($this);
        if (!isset(self::$_names[$className])) {
            $class = new ReflectionClass(get_class($this));
            $names = array();
            foreach ($class->getProperties() as $property) {
                $name = $property->getName();
                if ($property->isPrivate() && !$property->isStatic()) {
                    $method = ucfirst(substr($name, 1));
                    if (substr_count($name, '_', 0, 1) && $class->hasMethod("get$method") && $class->hasMethod("set$method"))
                        $names[] = substr($name, 1);
                } else if ($property->isPublic() && !$property->isStatic()) {
                    $names[] = $name;
                }
            }
            self::$_names[$className] = $names;
        }
        return self::$_names[$className];
    }


    public function attributeLabels()
    {
        return array(
            "education_id" => "Opleidings niveau",
            "date_of_birth" => "Geboorte Datum",
            "is_female" => "Geslacht"
        );
    }

    /**
     * @param $attribute
     * @param $value
     * @return array|XDateTime
     */
    public function setDateTime($attribute, $value)
    {
        $attribute = strtolower(substr($attribute, 3));

        if ($value instanceof XDateTime)
            $attribute = $value;
        elseif (is_array($value)) {
            // Only happens on POST
            if (isset($value['date']))
                $attribute = new XDateTime($value['date']);
            else {
                // Set params, defaults to 01-01-1970 00:00
                $day = isset($value['d']) ? $value['d'] : 1;
                $month = isset($value['m']) ? $value['m'] : 1;
                $year = isset($value['Y']) ? $value['Y'] : 1970;
                $hour = isset($value['H']) ? $value['H'] : 0;
                $minute = isset($value['i']) ? $value['i'] : 0;

                if (!checkdate($month, $day, $year)) {
                    $this->addError($attribute, Yii::t('text', 'Ongeldige datum opgegeven.'));
                    $attribute = $value;
                } else
                    $attribute = new XDateTime($year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $minute);
            }
        } else
            $attribute = new XDateTime($value);

        return $attribute;
    }

    /**
     * @param $attribute
     * @param null $default
     * @return array|XDateTime
     */
    public function getDateTime($attribute, $default = null)
    {
        // Only happens on invalid date
        if (is_array($attribute))
            return $attribute;

        if ($attribute instanceof XDateTime)
            $dateTime = $attribute;
        elseif ($default instanceof XDateTime)
            $dateTime = $default; else
            $dateTime = new XDateTime($default);

        return $dateTime;
    }

}
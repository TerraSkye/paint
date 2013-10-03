<?php
/**
 * TbControlGroup class file.
 * @author Sjoerd Adema <sadema@all4students.nl>
 * @copyright Copyright &copy; All4Students 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

class TbControlGroup extends CWidget
{
    const TEXT_FIELD = 'textField';
    const PASSWORD_FIELD = 'passwordField';
    const TEXT_AREA = 'textArea';
    const DROP_DOWN = 'dropDown';
    const DATE_DROP_DOWN = 'dateDropDown';
    const RADIO_BUTTON = 'radioButton';
    const CHECK_BOX = 'checkBox';
    const SUBMIT_BUTTON = 'submitButton';
    const BUTTON = 'button';
    const FREE_TEXT = 'freeText';

    /**
     * @var CModel model Model for which the control group is build
     */
    public $model;

    /**
     * @var string label Optional label, if label is false no label will be generated
     */
    public $label = null;

    /**
     * @var string labelFor Optional 'for' attribute for the label
     */
    public $labelFor = null;

    /**
     * @var boolean required Optional, if set to false CHtml::activeLabel will be used instead of CHtml::activeLabelEx
     */
    public $required = true;

    /**
     * @var string class Optional class for the control group
     */
    public $htmlOptions = array();

    /**
     * @var string id Optional id for the control group
     */
    public $id = null;

    /**
     * @var array items to build the control group from
     */
    public $items = array();

    /**
     * @var string _errors Contains the errors from the attributes
     */
    private $_errors = array();

    /**
     * @var string _errorCss Css for the error message
     */
    private $_errorCss = 'help-block';

    /**
     * @var string _controlGroup Contains the output
     */
    private $_controlGroup;

    /**
     * @var string _controlGroupCss Complete css for the control group
     */
    private $_controlGroupCss = 'control-group row-fluid';

    /**
     * @var string _labelCss Complete css for the label
     */
    private $_labelCss = 'control-label span4';

    /**
     * @var array _labelHtmlOptions htmlOptions for the label
     */
    private $_labelHtmlOptions = array();

    /**
     * @var string _controlCss Complete css for the control
     */
    private $_controlCss = 'controls controls-row span8';

    /**
     * Initializes the widget
     */
    public function init()
    {
        // Set items to preserve pointer
        $items = $this->items;

        // Set additional control group class
        if(isset($this->htmlOptions['class']))
            $this->_controlGroupCss .= ' ' . trim($this->htmlOptions['class']);

        // Check if we have a button or submitButton
        if ($this->isSubmitButton($items) && $this) {
            $items[self::SUBMIT_BUTTON]['type'] = self::SUBMIT_BUTTON;
            if (sizeof($items) === 1)
                $this->label = false;
        }

        if ($this->isButton($items)) {
            if ($this->isSubmitButton($items))
                $items[self::SUBMIT_BUTTON]['type'] = self::SUBMIT_BUTTON;
            else
                $items[self::BUTTON]['type'] = self::BUTTON;
            // Check if we need a label
            if (sizeof($items) === 1)
                $this->label = false;
        }

        // Check if we have a freeText
        if ($this->isFreeText($items))
            $items[self::FREE_TEXT]['type'] = self::FREE_TEXT;

        // Check if we have a dateDropDown
        if ($this->isDateDropDown($items)) {
            // Set the for attr of the label
            $attribute = key($items);
            $for = key($items[$attribute]['typeOptions']['data']);
            $this->_labelHtmlOptions['for'] = CHtml::getIdByName(CHtml::resolveName($this->model, $attribute)) . '_' . $for;

            // Set error class if any
            if ($this->model->hasErrors($attribute)) {
                foreach ($items[$attribute]['typeOptions']['data'] as $key => $item) {
                    if (isset($items[$attribute]['htmlOptions'][$key]['class']))
                        $items[$attribute]['htmlOptions'][$key]['class'] .= ' error';
                    else
                        $items[$attribute]['htmlOptions'][$key]['class'] = 'error';
                }
            }

            // Set the label
            if ($this->label === null)
                $this->label = $this->model->getAttributeLabel($attribute);
        }

        //If a 'for' is specified during class instantiation, we copy it to the label options
        if(!is_null($this->labelFor))
            $this->_labelHtmlOptions['for'] = $this->labelFor;

        // Check for errors
        $this->hasErrors();

        // Set container class
        $this->htmlOptions['class'] = $this->_controlGroupCss;

        if(isset($this->id) && $this->id !== null)
            $this->htmlOptions['id'] = $this->id;

        // Build the control group container
        $this->_controlGroup = CHtml::openTag('div', $this->htmlOptions);

        // Build label
        $this->_controlGroup .= $this->buildLabel();

        // Build control container
        $this->_controlGroup .= CHtml::openTag('div', array('class' => $this->_controlCss));

        // Build control
        foreach ($items as $key => $item) {
            if ($item['type'] === self::TEXT_FIELD || $item['type'] === self::PASSWORD_FIELD || $item['type'] === self::TEXT_AREA)
                $item['htmlOptions']['placeholder'] = $this->model->getAttributeLabel($key);

            $typeOptions = isset($item['typeOptions']) ? $item['typeOptions'] : array();
            $htmlOptions = isset($item['htmlOptions']) ? $item['htmlOptions'] : array();

            $this->_controlGroup .= $this->buildControl($key, $item['type'], $htmlOptions, $typeOptions);
        }

        // Display control group
        if(!$this->isFreeText($items)) {
            echo $this->_controlGroup;
        }
    }

    /**
     * Runs the widget
     */
    public function run()
    {
        // Build error blocks if any and check for freeText
        if(strpos($this->_controlGroup, '%separator%')) {
            $controlGroupEnd = strpos($this->_controlGroup, '%separator%');
            $freeTextStart = strpos($this->_controlGroup, '%separator%') + strlen('%separator%');

            $freeText = substr($this->_controlGroup, $freeTextStart);

            $controlGroup = substr($this->_controlGroup, 0, $controlGroupEnd);

            $this->_controlGroup = $controlGroup . $this->buildErrors() . $freeText;
        }
        else
            $this->_controlGroup = $this->buildErrors();

        // Close control container
        $this->_controlGroup .= CHtml::closeTag('div');

        // Close control group
        $this->_controlGroup .= CHtml::closeTag('div');

        // Display control group
        echo $this->_controlGroup;
    }

    /**
     * Fills $this->_errors and sets error class on control group
     */
    private function hasErrors()
    {
        foreach ($this->items as $key => $item) {
            if ($this->model->hasErrors($key))
                $this->_errors[] = $key;
        }
        if (!empty($this->_errors))
            $this->_controlGroupCss .= ' error';
    }

    /**
     * @return string Complete label
     */
    private function buildLabel()
    {
        $items = $this->items;

        $label = '';
        // Check if we need label
        if ($this->label === false)
            $this->_controlCss .= ' offset4';
        // Check for custom label
        elseif ($this->label === null)
            $this->label = $this->model->getAttributeLabel(key($items));

        // Build label htmlOptions
        $this->_labelHtmlOptions['label'] = $this->label;
        $this->_labelHtmlOptions['class'] = $this->_labelCss;

        // Check if we need to change the for attr to attribute with errors
        if (!empty($this->_errors)) {
            $attribute = current($this->_errors);
            // In case of dateDropDown
            if (!isset($this->_labelHtmlOptions['for']))
                $this->_labelHtmlOptions['for'] = CHtml::getIdByName(CHtml::resolveName($this->model, $attribute));
        }

        // Check if we need activeLabel or activeLabelEx
        if ($this->required && $this->label !== false)
            $label = CHtml::activeLabelEx($this->model, key($items), $this->_labelHtmlOptions);
        elseif ($this->label !== false)
            $label = CHtml::activeLabel($this->model, key($items), $this->_labelHtmlOptions);

        return $label;
    }

    /**
     * @return string Complete error block
     */
    private function buildErrors()
    {
        $errors = '';
        // Check if we have errors
        if (!empty($this->_errors)) {
            foreach ($this->_errors as $error) {
                $errors .= CHtml::tag('div', array('class' => $this->_errorCss), $this->model->getError($error));
            }
        }
        return $errors;
    }

    /**
     * @param $attribute
     * @param $type
     * @param array $htmlOptions
     * @param array $typeOptions
     * @return string Complete control
     * @throws CException
     */
    private function buildControl($attribute, $type, array $htmlOptions, array $typeOptions)
    {
        switch ($type) {
            case self::TEXT_FIELD:
                return $this->buildTextField($this->model, $attribute, $htmlOptions);

            case self::PASSWORD_FIELD:
                return $this->buildPasswordField($this->model, $attribute, $htmlOptions);

            case self::TEXT_AREA:
                return $this->buildTextArea($this->model, $attribute, $htmlOptions, $typeOptions);

            case self::DROP_DOWN:
                if (!isset($typeOptions['data']))
                    throw new CException('No data set');
                return $this->buildDropDown($this->model, $attribute, $htmlOptions, $typeOptions['data']);

            case self::DATE_DROP_DOWN:
                if (!isset($typeOptions['data']))
                    throw new CException('No data set');
                return $this->buildDateDropDown($this->model, $attribute, $htmlOptions, $typeOptions['data']);

            case self::RADIO_BUTTON:
                if (!isset($typeOptions['data']))
                    throw new CException('No data set');
                return $this->buildRadioButton($this->model, $attribute, $htmlOptions, $typeOptions['data']);

            case self::CHECK_BOX:
                return $this->buildCheckBox($this->model, $attribute, $htmlOptions);

            case self::SUBMIT_BUTTON:
                return $this->buildSubmitButton($typeOptions, $htmlOptions);

            case self::BUTTON:
                return $this->buildButton($typeOptions, $htmlOptions);

            case self::FREE_TEXT:
                return $this->buildFreeText($typeOptions, $htmlOptions);

            default:
                throw new CException('Not a valid controlType');
        }
    }

    /**
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string textField
     */
    private function buildTextField(CModel $model, $attribute, array $htmlOptions)
    {
        $form = new TbActiveForm();
        return $form->textField($model, $attribute, $htmlOptions);
    }

    /**
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string passwordField
     */
    private function buildPasswordField(CModel $model, $attribute, array $htmlOptions)
    {
        $form = new TbActiveForm();
        return $form->passwordField($model, $attribute, $htmlOptions);
    }

    /**
     * @param CModel $model
     * @param $attribute
     * @param array $htmlOptions
     * @param array $data
     * @return string dropDownList
     */
    private function buildDropDown(CModel $model, $attribute, array $htmlOptions, array $data)
    {
        $form = new TbActiveForm();
        return $form->dropDownList($model, $attribute, $data, $htmlOptions);
    }

    /**
     * @param CModel $model
     * @param $attribute
     * @param array $htmlOptions
     * @param array $data
     * @return string dateDropDownList
     */
    private function buildDateDropDown(CModel $model, $attribute, array $htmlOptions, array $data)
    {
        // Create multiple dropDowns for a datePicker
        $control = '';

        // Easier access to the attribute
        $dateTime = $model->$attribute;

        // Check if we have an array or a DateTime
        if ($dateTime instanceof XDateTime) {
            if (isset($dateTime->date))
                $dateTime = new XDateTime($dateTime->date);

            // Convert to array
            $dateTimeArray = array(
                'd' => intval($dateTime->format('d')),
                'm' => intval($dateTime->format('m')),
                'Y' => intval($dateTime->format('Y')),
                'H' => intval($dateTime->format('H')),
                'i' => intval($dateTime->format('i'))
            );
        } else
            $dateTimeArray = $dateTime;

        foreach ($data as $key => $itemData) {
            // Build our own dropDowns to avoid overhead
            $selectHtmlOptions = array();
            if (isset($htmlOptions[$key]))
                $selectHtmlOptions = $htmlOptions[$key];

            $name = get_class($model) . '[' . $attribute . '][' . $key . ']';

            $control .= CHtml::dropDownList($name, $dateTimeArray[$key], $itemData, $selectHtmlOptions);
        }
        return $control;
    }

    /**
     *
     * @param CModel $model
     * @param $attribute
     * @param array $htmlOptions Can add radioClass for classes given to the radio buttons, e.g. inline radio buttons. Defaults to inline
     * @param array $data
     * @return string radioButtonList
     */
    private function buildRadioButton(CModel $model, $attribute, array $htmlOptions, array $data)
    {
        // Build custom radio to avoid overhead
        $form = new TbActiveForm();
        $control = '';

        // Check if we need a custom class on our label
        $labelHtmlOptions['class'] = 'radio';

        if(isset($htmlOptions['radioClass'])) {
            if($htmlOptions['radioClass'] !== false)
                $labelHtmlOptions['class'] .= ' ' . trim($htmlOptions['radioClass']);
            unset($htmlOptions['radioClass']);
        } else {
            $labelHtmlOptions['class'] .= ' inline';
        }

        foreach ($data as $key => $option) {
            // Set the id and for attr
            $for = CHtml::getIdByName(CHtml::resolveName($model, $attribute)) . '_' . $key;

            // Fill label htmlOptions
            $labelHtmlOptions['for'] = $for;

            // Fill input htmlOptions
            $inputHtmlOptions['id'] = $for;
            $inputHtmlOptions['value'] = $key;
            $inputHtmlOptions = array_merge($htmlOptions, $inputHtmlOptions);

            // Build label and control
            $control .= CHtml::openTag('label', $labelHtmlOptions);
            $control .= $form->radioButton($model, $attribute, $inputHtmlOptions);
            $control .= $option;
            $control .= CHtml::closeTag('label');
        }
        return $control;
    }


    /**
     * @param CModel $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string Complete checkBox
     */
    private function buildCheckBox(CModel $model, $attribute, array $htmlOptions)
    {
        // Build custom checkbox to avoid overhead
        $form = new TbActiveForm();
        $control = '';

        // Fill label htmlOptions
        $labelHtmlOptions['for'] = CHtml::getIdByName(CHtml::resolveName($model, $attribute));
        $labelHtmlOptions['class'] = 'checkbox';

        // Build label and control
        $control .= CHtml::openTag('label', $labelHtmlOptions);
        $control .= $form->checkBox($model, $attribute, $htmlOptions);
        $control .= $this->model->getAttributeLabel($attribute);
        $control .= CHtml::closeTag('label');
        return $control;
    }

    /**
     * @param CModel $model
     * @param $attribute
     * @param array $htmlOptions
     * @param array $typeOptions
     * @return string submitButton
     */
    private function buildTextArea(CModel $model, $attribute, array $htmlOptions, array $typeOptions)
    {
        // Build textArea with or without textArea limiter plugin
        if (isset($typeOptions['limit'])) {
            // Fill widget params
            $params = array(
                'model' => $model,
                'attribute' => $attribute,
                'limit' => $typeOptions['limit'],
                'htmlOptions' => $htmlOptions
            );

            // textArea widget
            $control = Yii::app()->controller->widget('common.widgets.textAreaLimiter.TextAreaLimiter', $params, true);
        } else {
            // CHtml textArea
            $form = new TbActiveForm();
            $control = $form->textArea($model, $attribute, $htmlOptions);
        }
        return $control;
    }

    /**
     * @param array $typeOptions
     * @param array $htmlOptions
     * @return string
     * @throws CException
     */
    private function buildSubmitButton(array $typeOptions, array $htmlOptions)
    {
        if (!isset($typeOptions))
            throw new CException('Set typeOptions for submit button!');

        // Build submitButton, this can either be ajax or normal submit button
        if (isset($typeOptions['ajaxSubmit']) && $typeOptions['ajaxSubmit'] === true) {
            // Check if we need to put a # on the update id
            if (isset($typeOptions['ajaxOptions']['update'])) {
                $update = $typeOptions['ajaxOptions']['update'];
                if (strpos($update, '#') === false)
                    $typeOptions['ajaxOptions']['update'] = '#' . $update;
            } elseif (isset($typeOptions['ajaxOptions']['replace'])) {
                $replace = $typeOptions['ajaxOptions']['replace'];
                if (strpos($replace, '#') === false)
                    $typeOptions['ajaxOptions']['replace'] = '#' . $replace;
            } else {
                throw new CException('Set ajaxOptions for submit button!');
            }
            // Build control
            $control = CHtml::ajaxSubmitButton($typeOptions['label'], $typeOptions['url'], $typeOptions['ajaxOptions'], $htmlOptions);
        } else {
            $control = CHtml::submitButton($typeOptions['label'], $htmlOptions);
        }
        return $control;
    }

    /**
     * @param array $typeOptions
     * @param Array $htmlOptions
     * @return string Complete button
     * @throws CException
     */
    private function buildButton(array $typeOptions, array $htmlOptions)
    {
        if (!isset($typeOptions))
            throw new CException('Set typeOptions for button!');

        return CHtml::htmlButton($typeOptions['label'], $htmlOptions);
    }

    /**
     * @param array $typeOptions
     * @param array $htmlOptions
     * @return string freeText
     */
    private function buildFreeText(array $typeOptions, array $htmlOptions) {
        $tag = isset($typeOptions['tag']) ? $typeOptions['tag'] : 'div';
        $content = isset($typeOptions['content']) ? $typeOptions['content'] : false;

        $control = '%separator%';
        $control .= CHtml::openTag($tag, $htmlOptions);
        if(!isset($typeOptions['encodeHtml']) || $typeOptions['encodeHtml'] === true)
            $control .= CHtml::encode($content);
        else
            $control .= $content;
        $control .= CHtml::closeTag($tag);

        return $control;
    }

    /**
     * @param array $items
     * @return bool
     */
    private function isSubmitButton(array $items)
    {
        return array_key_exists(self::SUBMIT_BUTTON, $items);
    }

    /**
     * @param array $items
     * @return bool
     */
    private function isButton(array $items)
    {
        return array_key_exists(self::SUBMIT_BUTTON, $items) || array_key_exists(self::BUTTON, $items);
    }

    /**
     * @param array $items
     * @return bool
     */
    private function isDateDropDown(array $items)
    {
        return current($items)['type'] === self::DATE_DROP_DOWN;
    }

    /**
     * @param array $items
     * @return bool
     */
    private function isFreeText(array $items) {
        return array_key_exists(self::FREE_TEXT, $items);
    }
}
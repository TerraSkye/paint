<?php
/**
 * XHtml class file.
 */

/**
 * XHtml is a custom class extending CHtml for more neat functions
 *
 * @author Sjoerd R, Sjoerd A, Thomas, Richard
 * @package common.components
 */
class XHtml extends CHtml
{
    public static function activeFileField($model, $attribute, $htmlOptions = array())
    {
        if (isset($htmlOptions['hidden'])) {
            self::resolveNameID($model, $attribute, $htmlOptions);
            return self::activeInputField('file', $model, $attribute, $htmlOptions);
        }
        return parent::activeFileField($model, $attribute, $htmlOptions);
    }


    /**
     * Get errors for a set of attributes
     * @param CModel $model Model to get errors from
     * @param mixed $attributes Attributes to get errors from. Can either be string or array
     * @param array $htmlOptions Optional HTML options
     * @return string The generated errors
     */
    public static function error($model, $attributes, $htmlOptions = array())
    {
        if (!is_array($attributes))
            return parent::error($model, $attributes, $htmlOptions);
        $html = '';
        foreach ($attributes as $attribute) {
            $html .= parent::error($model, $attribute, $htmlOptions);
        }
        return $html;
    }

    /**
     * @return array days
     */
    public static function getDayData()
    {
        $days = range(1, 31);
        return array_combine($days, $days);
    }

    /**
     * @return array month names in Dutch
     */
    public static function getMonthData()
    {
        return CLocale::getInstance('nl_NL')->getMonthNames();
    }

    /**
     * @param int $startYear The maximum age or start year
     * @param int $endYear The minimum age or end year
     * @return array years
     */
    public static function getYearData($startYear = -30, $endYear = -15)
    {
        $years = range(date('Y') + $startYear, date('Y') + $endYear);
        return array_combine($years, $years);
    }

    /**
     * @param int $start
     * @param int $end
     * @return array hours with leading zeros as value
     */
    public static function getHourData($start = 8, $end = 18)
    {
        $hours = array_combine(range($start, $end), range($start, $end));
        foreach ($hours as $key => $value) {
            $hours[$key] = sprintf('%02d', $value);
        }
        return $hours;
    }

    /**
     * @param int $interval
     * @return array minutes with interval with leading zeros as value
     */
    public static function getMinuteData($interval = 15)
    {
        $minutes = array_combine(range(0, 59, $interval), range(0, 59, $interval));
        foreach ($minutes as $key => $value) {
            $minutes[$key] = sprintf('%02d', $value);
        }
        return $minutes;
    }

    /**
     * Dump for debug purposes
     */
    public static function d()
    {
        if (!YII_DEBUG)
            throw new CException("Dump only allowed when in debug mode!");
        $args = func_get_args();
        foreach ($args as $k => $arg) {
            if (defined('STDIN')) {
                var_dump($arg);
                continue;
            }
            echo '<fieldset class="debug">
				<legend>' . ($k + 1) . '</legend>';
            CVarDumper::dump($arg, 10, true);
            echo '</fieldset>';
        }
    }

    /**
     * Dump and die - extending dump() from post #7860
     */
    public static function dump()
    {
        self::d(func_get_args());
        exit;
    }

    /**
     * Log - extending dump() from post #7860
     */
    public static function log()
    {
        if (!YII_DEBUG)
            throw new CException("Dump only allowed when in debug mode!");
        $args = func_get_args();
        foreach ($args as $k => $arg) {
            echo '<div style="width:1000px;height:200px;overflow-y:scroll;margin:auto;background:#ffffff;padding:20px;"<fieldset class="debug">
        <legend>' . ($k + 1) . '</legend>';
            CVarDumper::dump($arg, 10, true);
            echo '</fieldset></div>';
        }
    }

    /**
     * Convert the date values as generated from the date dropdown to a proper datetime value
     * @param string $text Text to truncate
     * @param int $length Max length in characters. Will find the last word and process it if it falls within the range.
     * @param string $suffix Something to append to the string if it doesn't entirely fit
     * @param boolean isHTML Is the inserted text actually HTML?
     * @return string A fitting string.
     */
    public static function truncate($text = '', $length = 100, $suffix = '&hellip;', $isHTML = true)
    {
        $i = 0;
        $tags = array();
        if ($isHTML) {
            preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
            foreach ($m as $o) {
                if ($o[0][1] - $i >= $length)
                    break;
                $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
                if ($t[0] != '/')
                    $tags[] = $t;
                elseif (end($tags) == substr($t, 1))
                    array_pop($tags);
                $i += $o[1][1] - $o[0][1];
            }
        }

        $output = substr($text, 0, $length = min(strlen($text), $length + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
        if (preg_match('/ /', $output) && strlen($text) > $length) {
            // Get everything until last space
            $one = substr($output, 0, strrpos($output, " "));
            // Get the rest
            $two = substr($output, strrpos($output, " "), (strlen($output) - strrpos($output, " ")));
        } else {
            $one = $output;
            $two = '';
        }
        // Extract all tags from the last bit
        preg_match_all('/<(.*?)>/s', $two, $tags);
        // Add suffix if needed
        if (strlen($text) > strlen($output)) {
            $one .= $suffix;
        }
        // Re-attach tags
        $output = $one . implode($tags[0]);

        return $output;
    }


    public static function purify($value, $options = array('HTML.Allowed' => ''))
    {
        $purifier = new CHtmlPurifier();
        $purifier->options = $options;
        return $purifier->purify($value);
    }

    public static function openControlGroup(CModel $model, $attribute, array $htmlOptions = array()) {
        // Check if we have a class in $htmlOptions
        if(!isset($htmlOptions['class']))
            $htmlOptions['class'] = '';

        // Set base class options
        $htmlOptions['class'] .= ' control-group row-fluid';

        // Check for errors
        if($model->hasErrors($attribute))
            $htmlOptions['class'] .= ' error';

        // Trim class for cleaner output
        $htmlOptions['class'] = trim($htmlOptions['class']);

        // Return div with appropriate classes
        return CHtml::openTag('div', $htmlOptions);
    }


    public static function closeControlGroup() {
        // Close control group
        return CHtml::closeTag('div');
    }
}
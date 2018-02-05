<?php

namespace Zablose\Navbar\Helpers;

class Html
{

    /**
     * Render a normal tag.
     *
     * @param string $name
     * @param array  $attrs
     * @param string $body
     *
     * @return string
     */
    public static function tag($name, $attrs, $body = null)
    {
        return ($name) ? '<' . $name . self::attrs($attrs) . '>' . $body . '</' . $name . '>' : '';
    }

    /**
     * Render tag's attributes to a string from the given array of key-values or values.<br/>
     * Examples: 'key="value"', 'value="value"', etc.<br/>
     * Ignore empty values even if the key is not.
     *
     * @param array $attrs
     *
     * @return string
     */
    public static function attrs($attrs)
    {
        $html = [];

        if (is_array($attrs) && count($attrs) > 0)
        {
            foreach ($attrs as $key => $value)
            {
                if (! empty($value))
                {
                    $html[] = (is_numeric($key)) ? $value . '="' . $value . '"' : $key . '="' . $value . '"';
                }
            }
        }

        return (count($html) > 0) ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Prefix or postfix string with a string.
     *
     * @param string  $string
     * @param string  $value
     * @param boolean $pre
     *
     * @return string
     */
    public static function fix($string, $value, $pre = true)
    {
        return ($string && $value) ? (($pre) ? $value . ' ' . $string : $string . ' ' . $value) : $string . $value;
    }

    /**
     * Prefix string with a string.
     *
     * @param string $string
     * @param string $value
     *
     * @return string
     */
    public static function prefix($string, $value)
    {
        return self::fix($string, $value);
    }

    /**
     * Postfix string with a string.
     *
     * @param string $string
     * @param string $value
     *
     * @return string
     */
    public static function postfix($string, $value)
    {
        return self::fix($string, $value, false);
    }

}

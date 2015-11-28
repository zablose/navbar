<?php

namespace Zablose\Navbar\Helpers;

class Html
{

    /**
     *
     * @param string $name
     * @param array $attrs
     * @param string $body
     */
    public static function tag($name, $attrs, $body = null)
    {
        return ($name) ? '<'.$name.self::attrs($attrs).'>'.$body.'</'.$name.'>' : '';
    }

    /**
     *
     * @param array $attrs
     * @return string
     */
    public static function attrs($attrs)
    {
        $html   = [];

        if (is_array($attrs) && count($attrs) > 0)
        {
            foreach ($attrs as $key => $value)
            {
                if (!empty($value))
                {
                    $html[] = (is_numeric($key)) ? $value.'="'.$value.'"' : $key.'="'.$value.'"';
                }
            }
        }

        return (count($html) > 0) ? ' '.implode(' ', $html) : '';
    }

    /**
     * Prefix or postfix string with a string.
     *
     * @param string $string
     * @param string $value
     * @param boolean $pre
     *
     * @return string
     */
    public static function fix($string, $value, $pre = true)
    {
        return ($string && $value) ? (($pre) ? $value.' '.$string : $string.' '.$value) : $string.$value;
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

<?php

namespace Zablose\Navbar\Helpers;

class Html
{
    public static function tag(string $name, array $attrs, string $body = null): string
    {
        return ($name) ? '<'.implode(' ', array_filter([$name, self::attrs($attrs)])).'>'.$body.'</'.$name.'>' : '';
    }

    /**
     * Render tag's attributes from an array to a string of 'key="value"' or 'value="value"'.
     *
     * @param  array  $attrs
     *
     * @return string
     */
    public static function attrs(array $attrs): string
    {
        $html = [];

        if (is_array($attrs) && count($attrs) > 0) {
            foreach ($attrs as $key => $value) {
                $html[] = (is_numeric($key)) ? $value.'="'.$value.'"' : $key.'="'.$value.'"';
            }
        }

        return (count($html) > 0) ? implode(' ', $html) : '';
    }

    /**
     * Prefix or postfix string with a string.
     *
     * @param  string   $string
     * @param  string   $value
     * @param  boolean  $pre
     *
     * @return string
     */
    private static function fix(string $string, string $value, bool $pre = true): string
    {
        return ($string && $value) ? (($pre) ? $value.' '.$string : $string.' '.$value) : $string.$value;
    }

    /**
     * Prefix string with a string.
     *
     * @param  string  $string
     * @param  string  $value
     *
     * @return string
     */
    public static function prefix(string $string, string $value): string
    {
        return self::fix($string, $value);
    }

    /**
     * Postfix string with a string.
     *
     * @param  string  $string
     * @param  string  $value
     *
     * @return string
     */
    public static function postfix(string $string, string $value): string
    {
        return self::fix($string, $value, false);
    }
}

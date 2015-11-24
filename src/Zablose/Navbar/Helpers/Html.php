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
        return '<'.$name.self::attrs($attrs).'>'.$body.'</'.$name.'>';
    }

    /**
     *
     * @param array $attrs
     * @return string
     */
    public static function attrs($attrs)
    {
        $html   = [];
        $prefix = '';

        if (is_array($attrs) && count($attrs) > 0)
        {
            $prefix = ' ';
            foreach ($attrs as $key => $value)
            {
                $html[] = (is_numeric($key)) ? $value.'="'.$value.'"' : $key.'="'.$value.'"';
            }
        }

        return $prefix.implode(' ', $html);
    }

}

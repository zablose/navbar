<?php declare(strict_types=1);

namespace Zablose\Navbar\Helpers;

class Html
{
    public static function tag(string $name, string $body = '', array $attrs = []): string
    {
        return ($name) ? '<'.Str::implode([$name, self::attrs($attrs)]).'>'.$body.'</'.$name.'>' : '';
    }

    /**
     * Render tag's attributes from an array to a string of 'key="value"' or 'value'.
     *
     * @param  array  $attrs
     *
     * @return string
     */
    public static function attrs(array $attrs): string
    {
        $strings = [];

        if (is_array($attrs) && count($attrs) > 0) {
            foreach (array_filter($attrs) as $key => $value) {
                $strings[] = (is_numeric($key)) ? $value : $key.'="'.$value.'"';
            }
        }

        return Str::implode($strings);
    }
}

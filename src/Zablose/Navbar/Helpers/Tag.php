<?php

namespace Zablose\Navbar\Helpers;

class Tag
{

    /**
     *
     * @param array $attrs
     * @return string
     */
    public static function attrs($attrs)
    {
        $html = [];

        if (is_array($attrs) && count($attrs) > 0)
        {
            foreach ($attrs as $key => $value)
            {
                $html[] = (is_numeric($key)) ? $value . '="' . $value . '"' : $key . '="' . $value . '"';
            }
        }

        return implode(' ', $html);
    }

}

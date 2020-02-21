<?php declare(strict_types=1);

namespace Zablose\Navbar\Helpers;

class Str
{
    public static function prefix(string $prefix, string $string): string
    {
        return implode(' ', array_filter([$prefix, $string]));
    }

    public static function postfix(string $string, string $postfix): string
    {
        return implode(' ', array_filter([$string, $postfix]));
    }
}

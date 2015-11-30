<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

abstract class NavbarEntityCore implements NavbarEntityContract
{

    use ConstructFromObjectOrArrayTrait;

    /**
     * Keep in mind that values are also used as methods names by Navbar builder.
     */
    const TYPE_BOOTSTRAP_LINK_INTERNAL = 'bootstrap_link_internal';
    const TYPE_BOOTSTRAP_LINK_EXTERNAL = 'bootstrap_link_external';
    const TYPE_BOOTSTRAP_NAVBAR        = 'bootstrap_navbar';
    const TYPE_BOOTSTRAP_DROPDOWN      = 'bootstrap_dropdown';
    const TYPE_BOOTSTRAP_HEADER        = 'bootstrap_header';
    const TYPE_BOOTSTRAP_SEPARATOR     = 'bootstrap_separator';

    /**
     * @var array
     */
    public static $custom_types = [];

    /**
     * @var array
     */
    public static $custom_group_types = [];

    /**
     * @return array
     */
    final public static function getTypes()
    {
        $types = [
            self::TYPE_BOOTSTRAP_LINK_INTERNAL,
            self::TYPE_BOOTSTRAP_LINK_EXTERNAL,
            self::TYPE_BOOTSTRAP_NAVBAR,
            self::TYPE_BOOTSTRAP_DROPDOWN,
            self::TYPE_BOOTSTRAP_HEADER,
            self::TYPE_BOOTSTRAP_SEPARATOR,
        ];

        return array_unique(array_merge($types, NavbarEntityCore::$custom_types));
    }

    /**
     * @return array
     */
    final public static function getGroupTypes()
    {
        $gtypes = [
            self::TYPE_BOOTSTRAP_NAVBAR,
            self::TYPE_BOOTSTRAP_DROPDOWN,
        ];

        return array_unique(array_merge($gtypes, NavbarEntityCore::$custom_group_types));
    }

    /**
     * @return boolean
     */
    final public function isGroup()
    {
        return in_array($this->type, NavbarEntityCore::getGroupTypes());
    }

}

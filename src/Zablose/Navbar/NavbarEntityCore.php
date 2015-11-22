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
    const TYPE_NAVBAR_LINK_RELATIVE = 'renderRelativeLink';
    const TYPE_NAVBAR_LINK_ABSOLUTE = 'renderAbsoluteLink';
    const TYPE_NAVBAR_NAVBAR        = 'renderNavbar';
    const TYPE_NAVBAR_DROPDOWN      = 'renderDropdown';
    const TYPE_NAVBAR_HEADER        = 'renderHeader';
    const TYPE_NAVBAR_SEPARATOR     = 'renderSeparator';
    const TYPE_NAVBAR_SIDEBAR       = 'renderSidebar';

    public static $custom_types       = [];
    public static $custom_group_types = [];

    final public static function getTypes()
    {
        $types = [
            self::TYPE_NAVBAR_HEADER,
            self::TYPE_NAVBAR_SEPARATOR,
            self::TYPE_NAVBAR_DROPDOWN,
            self::TYPE_NAVBAR_LINK_ABSOLUTE,
            self::TYPE_NAVBAR_LINK_RELATIVE,
            self::TYPE_NAVBAR_NAVBAR,
            self::TYPE_NAVBAR_SIDEBAR
        ];

        return array_unique(array_merge($types, NavbarEntityCore::$custom_types));
    }

    final public static function getGroupTypes()
    {
        $gtypes = [
            self::TYPE_NAVBAR_NAVBAR,
            self::TYPE_NAVBAR_DROPDOWN,
            self::TYPE_NAVBAR_SIDEBAR
        ];

        return array_unique(array_merge($gtypes, NavbarEntityCore::$custom_group_types));
    }

    final public function isGroup()
    {
        return in_array($this->type, NavbarEntityCore::getGroupTypes());
    }

}

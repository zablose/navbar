<?php

namespace App\Http\Navigation;

use Zablose\Navbar\NavbarEntityCore;

class NavbarEntity extends NavbarEntityCore
{
    public const TYPE_DROPDOWN = 'render_dropdown';
    public const TYPE_LINK = 'render_link';
    public const TYPE_LOGOUT = 'render_logout';
    public const TYPE_NAVBAR = 'render_navbar';
}

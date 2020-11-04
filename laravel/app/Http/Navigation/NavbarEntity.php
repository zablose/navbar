<?php

namespace App\Http\Navigation;

use Zablose\Navbar\NavbarEntityCore;

class NavbarEntity extends NavbarEntityCore
{
    const TYPE_DROPDOWN = 'render_dropdown';
    const TYPE_LINK     = 'render_link';
    const TYPE_LOGOUT   = 'render_logout';
    const TYPE_NAVBAR   = 'render_navbar';
}

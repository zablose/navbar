<?php

namespace Zablose\Navbar\Tests;

use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\Traits\ArrayableTrait;
use Zablose\Navbar\Traits\NavbarSettersTrait;

class NavbarEntity extends NavbarEntityCore
{
    use NavbarSettersTrait;
    use ArrayableTrait;

    const TYPE_LIST    = 'render_list';
    const TYPE_SUBLIST = 'render_sublist';
    const TYPE_LINK    = 'render_link';
}

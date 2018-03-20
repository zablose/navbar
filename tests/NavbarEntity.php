<?php

namespace Zablose\Navbar\Tests;

use Zablose\Navbar\Contracts\BootstrapConstantsContract;
use Zablose\Navbar\Contracts\BulmaConstantsContract;
use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\Traits\ArrayableTrait;
use Zablose\Navbar\Traits\NavbarSettersTrait;

class NavbarEntity extends NavbarEntityCore
    implements
    BootstrapConstantsContract,
    BulmaConstantsContract
{

    use NavbarSettersTrait;
    use ArrayableTrait;

}

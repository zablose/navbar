<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests;

use Zablose\Navbar\Contracts\ExampleRendersContract;
use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\Traits\ArrayableTrait;
use Zablose\Navbar\Traits\NavbarSettersTrait;

class NavbarEntity extends NavbarEntityCore implements ExampleRendersContract
{
    use ArrayableTrait;
    use NavbarSettersTrait;
}

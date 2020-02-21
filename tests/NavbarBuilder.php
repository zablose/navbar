<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests;

use Zablose\Navbar\NavbarBuilderCore;
use Zablose\Navbar\Traits\ExampleRendersTrait;
use Zablose\Navbar\Traits\CommonRendersTrait;

class NavbarBuilder extends NavbarBuilderCore
{
    use CommonRendersTrait;
    use ExampleRendersTrait;
}

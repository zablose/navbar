<?php

namespace Zablose\Navbar\Demo;

use Zablose\Navbar\NavbarBuilderCore;
use Zablose\Navbar\Traits\BootstrapRendersTrait;
use Zablose\Navbar\Traits\BulmaRendersTrait;
use Zablose\Navbar\Traits\CommonRendersTrait;

class NavbarBuilder extends NavbarBuilderCore
{

    use CommonRendersTrait;
    use BootstrapRendersTrait;
    use BulmaRendersTrait;

}

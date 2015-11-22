<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;
use Zablose\Navbar\Contracts\NavbarConfigContract;

class NavbarConfig implements NavbarConfigContract
{

    use ConstructFromObjectOrArrayTrait;

    /**
     * Application URL.
     *
     * @var string
     */
    public $app_url = '';

    /**
     * Target for absolute link. Default: '_blank'.
     *
     * @var string
     */
    public $absolute_link_target = '_blank';

    /**
     * Class to be used by NavbarDataProcessor to represent NavbarEntity.
     *
     * @var string
     */
    public $navbar_entity_class = NavbarEntity::class;

}

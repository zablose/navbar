<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\NavbarBuilderCore;

class NavbarBuilder extends NavbarBuilderCore
{

    /**
     *
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     *
     * @return void
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        parent::__construct($data, $config);
    }

    protected function icon(NavbarEntityContract $entity)
    {
        return ($entity->icon) ? '<span class="'.$entity->icon.'"></span> ' : '';
    }

}

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;

class NavbarElement
{

    /**
     * @var NavbarEntityCore|NavbarEntityContract
     */
    public $entity;

    /**
     * @var NavbarElement[]
     */
    public $content;

}

<?php

namespace Zablose\Navbar;

class NavbarElement
{

    const TYPE_ENTITY = 'renderElementAsEntity';
    const TYPE_GROUP  = 'renderElementAsGroup';

    /**
     * @var string
     */
    public $type;

    /**
     * @var NavbarEntityCore
     */
    public $entity;

    /**
     * @var NavbarElement[]
     */
    public $content;

}

<?php

namespace Zablose\Navbar;

class NavbarElement
{

    /**
     * Keep in mind that values are also used as methods names by Navbar builder.
     */
    const TYPE_ENTITY = 'renderElementAsEntity';
    const TYPE_GROUP  = 'renderElementAsGroup';

    /**
     * @var string
     */
    public $type;

    /**
     * @var NavbarEntity
     */
    public $entity;

    /**
     * @var NavbarElement[]
     */
    public $content;

}

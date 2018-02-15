<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

abstract class NavbarEntityCore implements NavbarEntityContract
{

    use ConstructFromObjectOrArrayTrait;

    /**
     * Unique identifier.
     *
     * @var integer
     */
    public $id;

    /**
     * Parent unique identifier.
     *
     * @var integer
     */
    public $pid = 0;

    /**
     * A filter to grab what you need in one go.
     *
     * @var string
     */
    public $filter = 'main';

    /**
     * Navbar entity type.
     *
     * @var string
     */
    public $type;

    /**
     * Is this entity represents a group element?
     *
     * @var boolean
     */
    public $group = false;

    /**
     * Tag's body content.
     *
     * @var string
     */
    public $body;

    /**
     * Tag's title attribute.
     *
     * @var string
     */
    public $title;

    /**
     * Tag's href attribute.
     *
     * @var string
     */
    public $href;

    /**
     * Is this link external or not, if it's a link entity?
     *
     * @var boolean
     */
    public $external = false;

    /**
     * Tag's class attribute.
     *
     * @var string
     */
    public $class;

    /**
     * An icon for the entity.
     *
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $attrs;

    /**
     * Role that is required to access the entity of navigation.
     *
     * @var integer|string
     */
    public $role;

    /**
     * Permission that is required to access the entity of navigation.
     *
     * @var integer|string
     */
    public $permission;

    /**
     * Navigation bar entity's position.
     *
     * @var integer
     */
    public $position = 0;

}

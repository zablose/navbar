<?php

namespace Zablose\Navbar;

use Zablose\Navbar\NavbarEntityCore;

class NavbarEntity extends NavbarEntityCore
{

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
    public $pid;

    /**
     * A unique tag for the navigation bar entities group which together represents a Navigation bar.<br/>
     * Simply a filter to grab what you need in one go.
     *
     * @var string
     */
    public $tag;

    /**
     * Navbar entity type.
     *
     * @var string
     */
    public $type;

    /**
     * Navigation bar entity title.
     *
     * @var string
     */
    public $title;

    /**
     * Navigation bar entity alt string used in tag's title attribute.
     *
     * @var string
     */
    public $alt;

    /**
     * Navbar target, or simply link's href attribute.
     *
     * @var string
     */
    public $target;

    /**
     * Navigation bar entity tag's class attribute.<br/>
     * Use it to add extra classes to the entity.
     *
     * @var string
     */
    public $class;

    /**
     * An icon for the navigation bar entity.
     *
     * @var string
     */
    public $icon;

    /**
     * Permission ID that required to access navigation bar entity.
     *
     * @var integer
     */
    public $permission_id;

    /**
     * Role ID that required to access navigation bar entity.
     *
     * @var integer
     */
    public $role_id;

    /**
     * Navigation bar entity's position.
     *
     * @var integer
     */
    public $position;

    /**
     * Check if navigation bar entity is publicly accessible.
     *
     * @return boolean
     */
    public function isPublic()
    {
        return ($this->permission_id > 0 || $this->role_id > 0) ? false : true;
    }

    /**
     * Add an extra class as a string to the navigation bar entity class attribute.
     *
     * @param string $class
     * @return string
     */
    public function addClass($class)
    {
        $this->class = ($this->class) ? $this->class . ' ' . $class : $class;
        return $this;
    }

}

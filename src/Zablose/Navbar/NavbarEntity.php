<?php

namespace Zablose\Navbar;

use Zablose\Navbar\NavbarEntityCore;

class NavbarEntity extends NavbarEntityCore
{

    public $id;
    public $pid;
    public $tag;
    public $type;
    public $title;
    public $alt;
    public $target;
    public $class;
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
    public $position;

    public function isPublic()
    {
        return ($this->permission_id > 0 || $this->role_id > 0) ? false : true;
    }

    /**
     * Add an extra class as a string to the Navbar entity class attribute.
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

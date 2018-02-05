<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

abstract class NavbarEntityCore implements NavbarEntityContract
{

    use ConstructFromObjectOrArrayTrait;

    /**
     * Keep in mind that values are also used as methods names by Navbar builder.
     */
    const TYPE_BOOTSTRAP_LINK_INTERNAL = 'bootstrap_link_internal';
    const TYPE_BOOTSTRAP_LINK_EXTERNAL = 'bootstrap_link_external';
    const TYPE_BOOTSTRAP_NAVBAR        = 'bootstrap_navbar';
    const TYPE_BOOTSTRAP_DROPDOWN      = 'bootstrap_dropdown';
    const TYPE_BOOTSTRAP_HEADER        = 'bootstrap_header';
    const TYPE_BOOTSTRAP_SEPARATOR     = 'bootstrap_separator';

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
    public $position;

    /**
     * @param integer $id
     *
     * @return $this
     */
    public function id($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param integer $pid
     *
     * @return $this
     */
    public function pid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return $this
     */
    public function group()
    {
        $this->group = true;

        return $this;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function body($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $href
     *
     * @return $this
     */
    public function href($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return $this
     */
    public function external()
    {
        $this->external = true;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

}

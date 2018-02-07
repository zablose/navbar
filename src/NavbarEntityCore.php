<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
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
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param integer $pid
     *
     * @return $this
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * @param string $filter
     *
     * @return $this
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param boolean $group
     *
     * @return $this
     */
    public function setGroup($group = true)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $href
     *
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @param boolean $external
     *
     * @return $this
     */
    public function setExternal($external = true)
    {
        $this->external = $external;

        return $this;
    }

    /**
     * @param string $class
     *
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param string|integer $role
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @param string|integer $permission
     *
     * @return $this
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @param string|integer $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Render body with or without prefix and/or postfix.
     *
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function renderBody($prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($this->body, $prefix), $postfix);
    }

    /**
     * @param string $app_url
     *
     * @return string
     */
    public function renderHref($app_url)
    {
        return $this->external ? $this->href : rtrim($app_url, '/') . '/' . ltrim(trim($this->href), '/');
    }

    /**
     * Render class with or without prefix and/or postfix.
     *
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function renderClass($prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($this->class, $prefix), $postfix);
    }

    /**
     * Render Icon.
     *
     * @return string
     */
    public function renderIcon()
    {
        return ($this->icon) ? '<span class="' . $this->icon . '"></span>' : '';
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

}

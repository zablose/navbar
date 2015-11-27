<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Helpers\Html;
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
     * A filter to grab what you need in one go.
     *
     * @var string
     */
    public $filter;

    /**
     * Navbar entity type.
     *
     * @var string
     */
    public $type;

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
     * Permission ID that required to access navigation entity.
     *
     * @var integer
     */
    public $permission_id;

    /**
     * Role ID that required to access navigation entity.
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
     * Render Class with or without prefix and postfix.
     *
     * @param string $prefix
     * @param string $postfix
     * @return string
     */
    public function renderClass($prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($this->class, $prefix), $postfix);
    }

    /**
     * Render Title with or without prefix and postfix.
     *
     * @param string $prefix
     * @param string $postfix
     * @return string
     */
    public function renderBody($prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($this->body, $prefix), $postfix);
    }

    /**
     * Render Icon.
     *
     * @return string
     */
    public function renderIcon()
    {
        return ($this->icon) ? '<span class="'.$this->icon.'"></span>' : '';
    }

}

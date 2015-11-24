<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

class NavbarConfig implements NavbarConfigContract
{

    use ConstructFromObjectOrArrayTrait;

    /**
     * Application URL.
     *
     * @var string
     */
    public $app_url = 'http://localhost';

    /**
     * Order by title 'asc' or 'desc'.
     *
     * @var string
     */
    public $titled;

    /**
     * Order by position 'asc' or 'desc'.
     *
     * @var string
     */
    public $positioned;

    /**
     * Target for absolute link. Default: '_blank'.
     *
     * @var string
     */
    public $absolute_link_target = '_blank';

    /**
     * Class to be used by NavbarDataProcessor to represent NavbarEntity.
     *
     * @var string
     */
    public $navbar_entity_class = NavbarEntity::class;

    /**
     *
     * @var string
     */
    protected $path = '/';

    /**
     *
     * @var array
     */
    protected $roles = [];

    /**
     *
     * @var array
     */
    protected $permissions = [];

    /**
     * Set or get current path.
     *
     * @param string $path
     *
     * @return NavbarConfigContract|array
     */
    public function path($path = null)
    {
        if (!$path)
        {
            return $this->path;
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Set roles as array of integers or get them.
     *
     * @param array $roles
     *
     * @return NavbarConfigContract|array
     */
    public function roles($roles = null)
    {
        if (!$roles)
        {
            return $roles;
        }

        $this->roles = (array) $roles;

        return $this;
    }

    /**
     * Set permissions as array of integers or get them.
     *
     * @param array $permissions
     *
     * @return NavbarConfigContract|array
     */
    public function permissions($permissions = null)
    {
        if (!$permissions)
        {
            return $this->permissions;
        }

        $this->permissions = (array) $permissions;

        return $this;
    }

}

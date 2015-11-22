<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarDataSetup
{

    /**
     *
     * @var \Zablose\Navbar\Contracts\NavbarDataContract
     */
    public $data;

    /**
     * Request path, used to find active Navbar.
     *
     * @var string
     */
    public $path = '/';

    /**
     * Roles as array of integer IDs.
     *
     * @var array
     */
    public $roles = [];

    /**
     * Permissions as array of integer IDs.
     *
     * @var array
     */
    public $permissions = [];

    /**
     * Navbar configuration.
     *
     * @var NavbarConfigContract
     */
    public $config;

    /**
     *
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        $this->data   = $data;
        $this->config = ($config)? : new NavbarConfig();
    }

    /**
     * Set current path.
     *
     * @param string $path
     * @return \Zablose\Navbar\NavbarDataSetup
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Set roles as array of integers.
     *
     * @param array $roles
     * @return \Zablose\Navbar\NavbarDataSetup
     */
    public function roles($roles)
    {
        $this->roles = (is_array($roles)) ? $roles : [];
        return $this;
    }

    /**
     *
     * @param array $permissions
     * @return \Zablose\Navbar\NavbarDataSetup
     */
    public function permissions($permissions)
    {
        $this->permissions = (is_array($permissions)) ? $permissions : [];
        return $this;
    }

}

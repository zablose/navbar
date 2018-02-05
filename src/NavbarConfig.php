<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

class NavbarConfig implements NavbarConfigContract
{

    use ConstructFromObjectOrArrayTrait;

    /**
     * Application's URL.
     *
     * @var string
     */
    public $app_url = '/';

    /**
     * Order by column in the database 'asc' or 'desc'.<b/>
     * Examples: 'body:asc', 'position:desc', 'id:asc'.
     *
     * @var string
     */
    public $order_by;

    /**
     * Tag's class attribute value for an active link.
     *
     * @var string
     */
    public $active_link_class = 'active';

    /**
     * Tag's target attribute value for an external link.
     *
     * @var string
     */
    public $external_link_target = '_blank';

    /**
     * Class to be used by NavbarDataProcessor to represent NavbarEntity.
     *
     * @var string
     */
    public $navbar_entity_class = NavbarEntity::class;

    /**
     * The current path of the application.
     *
     * @var string
     */
    protected $path = '/';

    /**
     * Roles of the logged user.
     *
     * @var array
     */
    protected $roles = [];

    /**
     * Permissions of the logged user.
     *
     * @var array
     */
    protected $permissions = [];

    /**
     * Set or get current path of the application.
     *
     * @param string $path
     *
     * @return NavbarConfigContract|string
     */
    public function path($path = null)
    {
        if (! $path)
        {
            return $this->path;
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Set or get roles of the logged user.
     *
     * @param array|string $roles An array of strings or integers.
     *
     * @return NavbarConfigContract|array
     */
    public function roles($roles = null)
    {
        if (! $roles)
        {
            return $this->roles;
        }

        $this->roles = (array)$roles;

        return $this;
    }

    /**
     * Set or get permissions of the logged user.
     *
     * @param array|string $permissions An array of strings or integers.
     *
     * @return NavbarConfigContract|array
     */
    public function permissions($permissions = null)
    {
        if (! $permissions)
        {
            return $this->permissions;
        }

        $this->permissions = (array)$permissions;

        return $this;
    }

}

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Tests\NavbarEntity;
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
     * Set current path of the application.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param array $roles An array of strings or integers.
     *
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @param array $permissions An array of strings or integers.
     *
     * @return $this
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * Get current path of the application.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

}

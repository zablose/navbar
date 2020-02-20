<?php declare(strict_types=1);

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Tests\NavbarEntity;

class NavbarConfig implements NavbarConfigContract
{
    public function __construct(array $config = [])
    {
        if (! empty($config)) {
            $this->app_url             = $config['app_url'];
            $this->navbar_entity_class = $config['navbar_entity_class'];
            $this->active_link_class   = $config['active_link_class'];
        }
    }

    public string $app_url = '/';

    /** Class to be used by NavbarDataProcessor to represent NavbarEntity. */
    public string $navbar_entity_class = NavbarEntity::class;

    /** CSS class to use to make link active. */
    public string $active_link_class = 'app-is-active';

    /** Current path of the application. */
    protected string $path = '/';

    /** Roles of the logged user as an array of strings. */
    protected array $roles = [];

    /** Permissions of the logged user as an array of strings. */
    protected array $permissions = [];

    public function getPath(): string
    {
        return $this->path;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function setPermissions(array $permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }
}

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Traits\ConstructFromDataArrayTrait;

abstract class NavbarEntityCore implements NavbarEntityContract
{
    use ConstructFromDataArrayTrait;

    public ?int $id = null;

    /** Parent unique identifier. */
    public int $pid = 0;

    /** Filter string, used to select an entity for rendering. */
    public string $filter = 'main';

    public string $type = '';

    /** Is it a group element? */
    public bool $group = false;

    /** Tag's body content. */
    public string $body = '';

    /** Tag's title attribute. */
    public string $title = '';

    /** Tag's href attribute. */
    public string $href = '';

    /** Is this link external or not, if it's a link entity? */
    public bool $external = false;

    /** Tag's class attribute. */
    public string $class = '';

    /** An icon for the entity. */
    public string $icon = '';

    /** Extra attributes as JSON string. */
    public string $attrs = '';

    /** Role that is required to render this entity. */
    public string $role = '';

    /** Permission that is required to render this entity. */
    public string $permission = '';

    /** Entity's position to order by. */
    public int $position = 0;
}

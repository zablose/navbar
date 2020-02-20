<?php declare(strict_types=1);

namespace Zablose\Navbar;

use stdClass;
use Zablose\Navbar\Contracts\NavbarEntityContract;

abstract class NavbarEntityCore implements NavbarEntityContract
{
    public function __construct(object $raw_entity = null)
    {
        if ($raw_entity instanceof stdClass) {
            $this->id         = (int) $raw_entity->id;
            $this->pid        = (int) $raw_entity->pid;
            $this->filter     = (string) $raw_entity->filter;
            $this->type       = (string) $raw_entity->type;
            $this->group      = (bool) $raw_entity->group;
            $this->body       = (string) $raw_entity->body;
            $this->title      = (string) $raw_entity->title;
            $this->href       = (string) $raw_entity->href;
            $this->external   = (bool) $raw_entity->external;
            $this->class      = (string) $raw_entity->class;
            $this->icon       = (string) $raw_entity->icon;
            $this->attrs      = (string) $raw_entity->attrs;
            $this->role       = (string) $raw_entity->role;
            $this->permission = (string) $raw_entity->permission;
            $this->position   = (int) $raw_entity->position;
        }
    }

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

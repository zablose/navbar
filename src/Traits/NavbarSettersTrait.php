<?php

namespace Zablose\Navbar\Traits;

trait NavbarSettersTrait
{
    private static int $next_id = 0;

    public static function resetNextId(): void
    {
        self::$next_id = 0;
    }

    public function setId(int $id = null): self
    {
        if ($id) {
            $this->id      = $id;
            self::$next_id = $id;
        } else {
            $this->id = ++self::$next_id;
        }

        $this->setPosition($this->id);

        return $this;
    }

    public function setPid(int $pid): self
    {
        $this->pid = $pid;

        return $this;
    }

    public function setFilter(string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setGroup(bool $group = true): self
    {
        $this->group = $group;

        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setHref(string $href): self
    {
        $this->href = $href;

        return $this;
    }

    public function setExternal(bool $external = true): self
    {
        $this->external = $external;

        return $this;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function setAttrs(array $attrs): self
    {
        $this->attrs = json_encode($attrs);

        return $this;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function setPermission(string $permission): self
    {
        $this->permission = $permission;

        return $this;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }
}

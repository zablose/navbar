<?php

namespace Zablose\Navbar\Traits;

trait NavbarSettersTrait
{
    private static int $next_id = 0;

    public static function resetNextId(): void
    {
        self::$next_id = 0;
    }

    /**
     * @param  int|null  $id
     *
     * @return $this
     */
    public function setId(?int $id = null)
    {
        if ($id) {
            $this->id      = $id;
            self::$next_id = $id;
        } else {
            $this->id = ++self::$next_id;
        }

        return $this;
    }

    /**
     * @param  integer  $pid
     *
     * @return $this
     */
    public function setPid(int $pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * @param  string  $filter
     *
     * @return $this
     */
    public function setFilter(string $filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @param  string  $type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  boolean  $group
     *
     * @return $this
     */
    public function setGroup(bool $group = true)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param  string  $body
     *
     * @return $this
     */
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param  string  $title
     *
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  string  $href
     *
     * @return $this
     */
    public function setHref(string $href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @param  boolean  $external
     *
     * @return $this
     */
    public function setExternal(bool $external = true)
    {
        $this->external = $external;

        return $this;
    }

    /**
     * @param  string  $class
     *
     * @return $this
     */
    public function setClass(string $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @param  string  $icon
     *
     * @return $this
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param  array  $attrs
     *
     * @return $this
     */
    public function setAttrs(array $attrs)
    {
        $this->attrs = json_encode($attrs);

        return $this;
    }

    /**
     * @param  string|integer  $role
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @param  string|integer  $permission
     *
     * @return $this
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * @param  string|integer  $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\OrderBy;

final class NavbarDataProcessor
{

    /**
     * @var NavbarRepoContract
     */
    private $repo;

    /**
     * Navbar entities.
     *
     * @var array
     */
    private $entities = [];

    /**
     * Navbar elements.
     *
     * @var array
     */
    private $elements = [];

    /**
     * @var boolean
     */
    private $filter_by_pid;

    /**
     * Navbar data configuration.
     *
     * @var NavbarConfig|NavbarConfigContract
     */
    private $config;

    /**
     * @var OrderBy
     */
    private $order_by;

    /**
     * Were data prepared or not. Used to prevent a repeat of preparation. Ignored in case of rendering by parent ID.
     *
     * @var boolean
     */
    private $prepared = false;

    /**
     * @param NavbarRepoContract                $repo
     * @param NavbarConfig|NavbarConfigContract $config
     */
    public function __construct(NavbarRepoContract $repo, NavbarConfigContract $config = null)
    {
        $this->repo     = $repo;
        $this->config   = $config ?: new NavbarConfig();
        $this->order_by = new OrderBy();
    }

    /**
     * @return NavbarConfig|NavbarConfigContract
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * Get navigation elements by filter or parent ID.
     *
     * @param string|integer $filter
     *
     * @return NavbarElement[]|NavbarElement
     */
    public function get($filter = null)
    {
        return (isset($this->elements[$filter])) ? $this->elements[$filter] : [];
    }

    /**
     * Get raw navigation entities from the database, validate them and transform to the navigation elements.
     * Filtered by filter(s) or parent ID.
     *
     * @param array|string|integer $filter Filter or parent ID.
     *
     * @return NavbarDataProcessor
     */
    public function prepare($filter = null)
    {
        if (! $this->prepared || is_integer($filter))
        {
            $this->prepared = ! is_integer($filter);

            $this->validate($this->repo->getRawNavbarEntities($filter, $this->order_by));
            $this->elements = $this->elements($this->getValidPid($filter));
        }

        return $this;
    }

    /**
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->order_by->column    = $column;
        $this->order_by->direction = $direction;

        return $this;
    }

    /**
     * @param mixed $filter
     *
     * @return integer
     */
    private function getValidPid($filter)
    {
        if ((is_int($filter) && $filter >= 0))
        {
            $this->filter_by_pid = true;

            return (int) $filter;
        }

        return 0;
    }

    /**
     * Get navigation elements from the navigation entities by parent ID.
     *
     * @param integer $pid
     *
     * @return array
     */
    private function elements($pid = 0)
    {
        $elements = [];

        $pid = (int) $pid;

        /** @var NavbarEntityCore|NavbarEntityContract $entity */
        foreach ($this->entities as $entity)
        {
            if ((int) $entity->pid === $pid)
            {
                unset($this->entities[$entity->id]);
                if ($pid === 0 && $entity->filter && ! $this->filter_by_pid)
                {
                    $elements[$entity->filter][$entity->id] = $this->element($entity);
                }
                else
                {
                    if ($this->filter_by_pid)
                    {
                        $elements[$entity->pid][$entity->id] = $this->element($entity);
                    }
                    else
                    {
                        $elements[$entity->id] = $this->element($entity);
                    }
                }
            }
        }

        $this->filter_by_pid = false;

        return $elements;
    }

    /**
     * Form navigation element.
     *
     * @param NavbarEntityCore|NavbarEntityContract $entity Navigation entity
     *
     * @return NavbarElement
     */
    private function element(NavbarEntityContract $entity)
    {
        $element         = new NavbarElement;
        $element->entity = $entity;

        if ($entity->group)
        {
            $element->content = ($this->filter_by_pid) ? [] : $this->elements($entity->id);
        }

        return $element;
    }

    /**
     * Get navigation entities by transformation from the raw entities.
     *
     * @param array $data An array of database rows.
     *
     * @return $this
     */
    private function validate($data)
    {
        $this->entities = [];

        foreach ($data as $row)
        {
            $entity = new $this->config->navbar_entity_class($row);

            if ($this->isAccessible($entity->role, $entity->permission))
            {
                $this->entities[$entity->id] = $entity;
            }
        }

        return $this;
    }

    /**
     * Check if the navigation entity is accessible by the user.
     *
     * @param integer|string $role
     * @param integer|string $permission
     *
     * @return bool
     */
    private function isAccessible($role, $permission)
    {
        return ((! $role && ! $permission) || ($this->hasRole($role) || $this->hasPermission($permission)));
    }

    /**
     * Check if the user has a role to access the navigation entity.
     *
     * @param integer|string $role
     *
     * @return bool
     */
    private function hasRole($role)
    {
        return in_array($role, $this->config->getRoles());
    }

    /**
     * Check if the user has a permission to access the navigation entity.
     *
     * @param integer|string $permission
     *
     * @return bool
     */
    private function hasPermission($permission)
    {
        return in_array($permission, $this->config->getPermissions());
    }

}

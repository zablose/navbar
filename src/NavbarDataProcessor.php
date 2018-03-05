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
     * @var NavbarConfig|NavbarConfigContract
     */
    private $config;

    /**
     * @var OrderBy
     */
    private $order_by;

    /**
     * Were data prepared or not. Used to prevent a repeat of preparation.
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
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get navigation elements by filter.
     *
     * @param string $filter
     *
     * @return array
     */
    public function getElements($filter = 'main')
    {
        if (! is_array($filter))
        {
            $filter = [$filter];
        }

        $elements = [];
        foreach ($filter as $key)
        {
            $elements = array_merge($elements, $this->elements[$key] ?? []);
        }

        return $elements;
    }

    /**
     * Get raw navigation entities from the database, validate them and transform to the navigation elements.
     * Filtered or all.
     *
     * @param array|string $filter
     *
     * @return NavbarDataProcessor
     */
    public function prepare($filter = null)
    {
        if (! $this->prepared)
        {
            $this->entities = $this->loadEntities($filter);
            $this->elements = $this->makeElements();
            $this->prepared = true;
        }

        return $this;
    }

    /**
     * Get Navbar entities by filter from the database rows.
     *
     * @param array|string $filter
     *
     * @return array
     */
    private function loadEntities($filter = null)
    {
        $entities = [];

        foreach ($this->repo->getRawNavbarEntities($filter, $this->order_by) as $row)
        {
            $entity = new $this->config->navbar_entity_class($row);

            if ($this->isAccessible($entity->role, $entity->permission))
            {
                $entities[$entity->id] = $entity;
            }
        }

        return $entities;
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
     * Make navigation elements from the navigation entities by parent.
     *
     * @param NavbarEntityCore|NavbarEntityContract $parent
     *
     * @return array
     */
    private function makeElements(NavbarEntityContract $parent = null)
    {
        $elements = [];

        $pid = $parent ? (int) $parent->id : 0;

        /** @var NavbarEntityCore|NavbarEntityContract $entity */
        foreach ($this->entities as $entity)
        {
            if ($pid === (int) $entity->pid)
            {
                if ($pid === 0)
                {
                    $elements[$entity->filter][$entity->id] = $this->makeElement($entity);
                }
                else
                {
                    $elements[$entity->id] = $this->makeElement($entity);
                }
                unset($this->entities[$entity->id]);
            }
        }

        return $elements;
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return NavbarElement
     */
    private function makeElement(NavbarEntityContract $entity)
    {
        return (new NavbarElement())->setEntity($entity)->setContent(
            $entity->group ? $this->makeElements($entity) : []
        );
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

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;

final class NavbarDataProcessor
{

    /**
     * @var NavbarDataContract
     */
    private $data;

    /**
     * Navbar entities.
     *
     * @var NavbarEntityContract[]
     */
    private $entities;

    /**
     * Navbar elements.
     *
     * @var NavbarElement[]
     */
    private $elements;

    /**
     * @var boolean
     */
    private $isFilterPid;

    /**
     * Navbar data configuration.
     *
     * @var NavbarConfigContract
     */
    public $config;

    /**
     * @param NavbarDataContract   $data
     * @param NavbarConfigContract $config
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        $this->data   = $data;
        $this->config = ($config) ?: new NavbarConfig();
    }

    /**
     * Get navigation elements by filter or parent ID.
     *
     * @param string|integer $filterOrPid
     *
     * @return NavbarElement[]|NavbarElement
     */
    public function get($filterOrPid = null)
    {
        return (isset($this->elements[$filterOrPid])) ? $this->elements[$filterOrPid] : [];
    }

    /**
     * Get raw navigation entities from the database, validate them and transform to the navigation elements.
     * Filtered by filter(s) or parent ID.
     * Ordered by 'column:direction'.
     *
     * @param array|string|integer $filterOrPid Filter or parent ID.
     * @param string               $order_by    Order by column in the database 'id:asc' or 'id:desc'.
     *
     * @return NavbarDataProcessor
     */
    public function prepare($filterOrPid = null, $order_by = null)
    {
        if (! $order_by)
        {
            $order_by = $this->config->order_by;
        }

        $this->entities = $this->validate($this->data->getRawNavbarEntities($filterOrPid, $order_by));

        $this->elements = $this->elements($this->getValidPid($filterOrPid));

        return $this;
    }

    /**
     * @param mixed $filterOrPid
     *
     * @return integer
     */
    private function getValidPid($filterOrPid)
    {
        if ((is_int($filterOrPid) && $filterOrPid >= 0))
        {
            $this->isFilterPid = true;

            return (int) $filterOrPid;
        }

        return 0;
    }

    /**
     * Get navigation elements from the navigation entities by parent ID.
     *
     * @param integer $pid
     *
     * @return NavbarElement[]
     */
    private function elements($pid = 0)
    {
        $navbars = [];

        $pid = (int) $pid;

        /** @var NavbarEntityCore|NavbarEntityContract $entity */
        foreach ($this->entities as $entity)
        {
            if ((int) $entity->pid === $pid)
            {
                unset($this->entities[$entity->id]);
                if ($pid === 0 && $entity->filter && ! $this->isFilterPid)
                {
                    $navbars[$entity->filter][$entity->id] = $this->element($entity);
                }
                else if ($this->isFilterPid)
                {
                    $navbars[$entity->pid][$entity->id] = $this->element($entity);
                }
                else
                {
                    $navbars[$entity->id] = $this->element($entity);
                }
            }
        }

        $this->isFilterPid = false;

        return $navbars;
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
        $element->type   = NavbarElement::TYPE_ENTITY;
        $element->entity = $entity;

        if ($entity->group)
        {
            $element->type    = NavbarElement::TYPE_GROUP;
            $element->content = ($this->isFilterPid) ? [] : $this->elements($entity->id);
        }

        return $element;
    }

    /**
     * Get navigation entities by transformation from the raw entities.
     *
     * @param array $raw_entities An array of raw entities.
     *
     * @return NavbarEntityContract[]
     */
    private function validate($raw_entities)
    {
        $entities = [];

        foreach ($raw_entities as $raw_entity)
        {
            $raw_object = (object) $raw_entity;

            if ($this->isAccessible($raw_object->role, $raw_object->permission))
            {
                $entities[$raw_object->id] = new $this->config->navbar_entity_class($raw_entity);
            }
        }

        return $entities;
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
        return in_array($role, $this->config->roles());
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
        return in_array($permission, $this->config->permissions());
    }

}

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\NavbarElement;
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
    private $byPid;

    /**
     * Navbar data configuration.
     *
     * @var NavbarConfigContract
     */
    public $config;

    /**
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     *
     * @return void
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        $this->data   = $data;
        $this->config = ($config) ? : new NavbarConfig();
    }

    /**
     * Get navigation elements by filter or parent ID.
     *
     * @param string|integer $filterOrPid
     *
     * @return NavbarElement[]
     */
    public function get($filterOrPid = null)
    {
        return (isset($this->elements[$filterOrPid])) ? $this->elements[$filterOrPid] : [];
    }

    /**
     * Get raw navigation entities from the database, validate them and transform to the navigation elements.<b/>
     * Filtered by filter(s) or parent ID.<b/>
     * Ordered by 'culumn:direction'.
     *
     * @param string|array|integer $filterOrPid Filter or parent ID.
     * @param string $order_by Order by column in the database 'id:asc' or 'id:desc'.
     *
     * @return NavbarDataProcessor
     */
    public function prepare($filterOrPid = null, $order_by = null)
    {
        if (!$order_by)
        {
            $order_by = $this->config->order_by;
        }

        $this->entities = $this->validate($this->data->getRawNavbarEntities($filterOrPid, $order_by));

        $this->elements = $this->elements($this->byPid($filterOrPid));

        return $this;
    }

    /**
     * @param mixed $filterOrPid
     *
     * @return integer
     */
    private function byPid($filterOrPid)
    {
        if ((is_int($filterOrPid) && $filterOrPid >= 0))
        {
            $this->byPid = true;
        }
        return $filterOrPid;
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

        $iPid = (int) $pid;

        foreach ($this->entities as $data)
        {
            if ((int) $data->pid === $iPid)
            {
                unset($this->entities[$data->id]);
                if ($iPid === 0 && $data->filter && !$this->byPid)
                {
                    $navbars[$data->filter][$data->id] = $this->element($data);
                }
                elseif ($this->byPid)
                {
                    $navbars[$data->pid][$data->id] = $this->element($data);
                }
                else
                {
                    $navbars[$data->id] = $this->element($data);
                }
            }
        }

        $this->byPid = false;

        return $navbars;
    }

    /**
     * Form navigation element.
     *
     * @param NavbarEntityContract $entity Navigation entity
     *
     * @return NavbarElement
     */
    private function element(NavbarEntityContract $entity)
    {
        $element         = new NavbarElement;
        $element->type   = NavbarElement::TYPE_ENTITY;
        $element->entity = $entity;

        if ($entity->isGroup())
        {
            $element->type    = NavbarElement::TYPE_GROUP;
            $element->content = ($this->byPid) ? [] : $this->elements($entity->id);
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
     * @return type
     */
    private function isAccessible($role, $permission)
    {
        return ((!$role && !$permission) || ($this->hasRole($role) || $this->hasPermission($permission)));
    }

    /**
     * Check if the user has a role to access the navigation entity.
     *
     * @param integer|string $role
     *
     * @return boolean
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
     * @return boolean
     */
    private function hasPermission($permission)
    {
        return in_array($permission, $this->config->permissions());
    }

}

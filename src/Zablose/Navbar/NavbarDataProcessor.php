<?php

namespace Zablose\Navbar;

use Zablose\Navbar\NavbarElement;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;

final class NavbarDataProcessor
{
    /**
     *
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
     *
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
     *
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        $this->data = $data;
        $this->config = ($config) ?: new NavbarConfig();
    }

    /**
     * Get Navbar datasets by tag.
     *
     * @param  mixed  $tagOrPid  Tag that group navbars.
     * @return NavbarElement[]
     */
    public function get($tagOrPid = null)
    {
        return (isset($this->elements[$tagOrPid])) ? $this->elements[$tagOrPid] : [];
    }

    /**
     * Get raw Navbars data from the DB. All or by tag. Ordered by title, position or model default.
     *
     * @param  mixed  $tagOrPid  Tag(s) that group navbars.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     * @return NavbarDataProcessor
     */
    public function prepare($tagOrPid = null, $titled = null, $positioned = null)
    {
        if (!$titled)
        {
            $titled = $this->config->titled;
        }

        if (!$positioned)
        {
            $positioned = $this->config->positioned;
        }

        $this->entities = $this->validate($this->data->getRawNavbarEntities($tagOrPid, $titled, $positioned));
        $this->elements = $this->elements($this->byPid($tagOrPid));

        return $this;
    }

    /**
     *
     * @param mixed $tagOrPid
     * @return int
     */
    private function byPid($tagOrPid)
    {
        if (((int) $tagOrPid > 0))
        {
            $this->byPid = true;
            return $tagOrPid;
        }
        return 0;
    }

    /**
     * Get Navbar elements by parent ID or tag.
     *
     * @param  integer  $pid
     * @param  string  $tag  Tag that group navbars.
     * @return NavbarElement[]
     */
    private function elements($pid = 0)
    {
        $navbars = [];

        foreach ($this->entities as $data)
        {
            if ($data->pid === $pid)
            {
                unset($this->entities[$data->id]);
                if ($pid === 0 && $data->tag && !$this->byPid)
                {
                    $navbars[$data->tag][$data->id] = $this->element($data);
                }
                elseif($this->byPid)
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
     * Form a Navbar element object by adding Navbar entity to it and<br/>
     * fill the content if Navbar entity is an element.
     *
     * @param  NavbarEntityContract  $entity Navbar entity
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
     * Remove all Navbars that user do not have access to and check which of them is active.
     *
     * @param array $raw_entities An array of raw entities.
     * @return \Zablose\Navbar\NavbarEntityContract[]
     */
    private function validate($raw_entities)
    {
        $entities = [];

        foreach ($raw_entities as $raw_entity)
        {
            $raw_object = (object) $raw_entity;

            if ($this->isAccessible($raw_object->role_id, $raw_object->permission_id))
            {
                $entities[$raw_object->id] = new $this->config->navbar_entity_class($raw_entity);
            }
        }

        return $entities;
    }

    /**
     * Check if the Navbar entity is accessible by the user.
     *
     * @param  integer  $role_id
     * @param  integer  $permission_id
     * @return type
     */
    private function isAccessible($role_id, $permission_id)
    {
        return ((!$role_id && !$permission_id) || ($this->hasRole($role_id) || $this->hasPermission($permission_id)));
    }

    /**
     * Check if the user has a role to access the Navbar.
     *
     * @param  integer  $role_id
     * @return boolean
     */
    private function hasRole($role_id)
    {
        return in_array($role_id, $this->config->roles());
    }

    /**
     * Check if the user has a permission to access the Navbar.
     *
     * @param  integer  $permission_id
     * @return boolean
     */
    private function hasPermission($permission_id)
    {
        return in_array($permission_id, $this->config->permissions());
    }

}

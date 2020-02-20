<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\OrderBy;

final class NavbarDataProcessor
{
    private array $elements = [];
    private array $entities = [];
    private bool $prepared = false;
    private NavbarConfigContract $config;
    private NavbarRepoContract $repo;
    private OrderBy $order_by;

    public function __construct(NavbarRepoContract $repo, NavbarConfigContract $config = null)
    {
        $this->config   = $config ?: new NavbarConfig();
        $this->order_by = new OrderBy();
        $this->repo     = $repo;
    }

    public function getConfig(): NavbarConfigContract
    {
        return $this->config;
    }

    public function getElements(array $filter = ['main']): array
    {
        $elements = [];
        foreach ($filter as $key) {
            $elements = array_merge($elements, $this->elements[$key] ?? []);
        }

        return $elements;
    }

    public function prepare(array $filter = []): self
    {
        if (! $this->prepared) {
            $this->entities = $this->loadEntities($filter);
            $this->elements = $this->makeElements();
            $this->prepared = true;
        }

        return $this;
    }

    private function loadEntities(array $filter = []): array
    {
        $entities = [];

        foreach ($this->repo->getRawNavbarEntities($filter, $this->order_by) as $row) {
            $entity = new $this->config->navbar_entity_class((array) $row);

            if ($this->isAccessible($entity->role, $entity->permission)) {
                $entities[$entity->id] = $entity;
            }
        }

        return $entities;
    }

    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $this->order_by->column    = $column;
        $this->order_by->direction = $direction;

        return $this;
    }

    private function makeElements(NavbarEntityContract $parent = null): array
    {
        $elements = [];

        $pid = $parent ? (int) $parent->id : 0;

        /** @var NavbarEntityCore $entity */
        foreach ($this->entities as $entity) {
            if ($pid === (int) $entity->pid) {
                if ($pid === 0) {
                    $elements[$entity->filter][$entity->id] = $this->makeElement($entity);
                } else {
                    $elements[$entity->id] = $this->makeElement($entity);
                }
                unset($this->entities[$entity->id]);
            }
        }

        return $elements;
    }

    private function makeElement(NavbarEntityContract $entity): NavbarElement
    {
        return (new NavbarElement())->setEntity($entity)->setContent(
            $entity->group ? $this->makeElements($entity) : []
        );
    }

    private function isAccessible(string $role, string $permission): bool
    {
        return ((! $role && ! $permission) || ($this->hasRole($role) || $this->hasPermission($permission)));
    }

    private function hasRole(string $role): bool
    {
        return in_array($role, $this->config->getRoles());
    }

    private function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->config->getPermissions());
    }
}

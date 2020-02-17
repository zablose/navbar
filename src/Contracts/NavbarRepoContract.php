<?php

namespace Zablose\Navbar\Contracts;

use Zablose\Navbar\Helpers\OrderBy;

interface NavbarRepoContract
{
    /**
     * Get an array of arrays to be used by NavbarDataProcessor to transform them into navigation entities.
     *
     * Element structure as array:
     *
     *     [
     *         'id'         => 1,
     *         'pid'        => 0,
     *         'filter'     => 'main',
     *         'type'       => 'bootstrap_navbar',
     *         'group'      => true,
     *         'body'       => '',
     *         'title'      => '',
     *         'href'       => '',
     *         'external'   => false,
     *         'class'      => 'nav navbar-nav',
     *         'icon'       => '',
     *         'attrs'      => '',
     *         'role'       => '',
     *         'permission' => '',
     *         'position'   => '',
     *     ]
     *
     * @param  array|null    $filter
     * @param  OrderBy|null  $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities(array $filter = null, OrderBy $order_by = null): array;
}

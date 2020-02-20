<?php declare(strict_types=1);

namespace Zablose\Navbar\Contracts;

use Zablose\Navbar\Helpers\OrderBy;

interface NavbarRepoContract
{
    /**
     * Get an array of rows as arrays to be used by NavbarDataProcessor to transform them into navigation entities.
     *
     * Navigation entity as array:
     *
     *     [
     *         'id'         => 1,
     *         'pid'        => 0,
     *         'filter'     => 'main',
     *         'type'       => 'render_link',
     *         'group'      => false,
     *         'body'       => 'Home',
     *         'title'      => '',
     *         'href'       => '/',
     *         'external'   => false,
     *         'class'      => 'app-link',
     *         'icon'       => 'fas fa-home',
     *         'attrs'      => '',
     *         'role'       => '',
     *         'permission' => '',
     *         'position'   => 1,
     *     ]
     *
     * @param  array    $filter
     * @param  OrderBy  $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities(array $filter, OrderBy $order_by): array;
}

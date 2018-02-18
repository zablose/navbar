<?php

namespace Zablose\Navbar\Contracts;

use Zablose\Navbar\Helpers\OrderBy;

interface NavbarRepoContract
{

    /**
     * Get an array of arrays or an array of objects to be used by NavbarDataProcessor
     * to transform to navigation entities.
     *
     * Example of an array element structure.
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
     * @param array|string|int|null $filter Filter(s) or parent ID.
     * @param OrderBy|null          $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities($filter = null, OrderBy $order_by = null);

}

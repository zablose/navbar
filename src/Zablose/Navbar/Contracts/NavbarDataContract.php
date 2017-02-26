<?php

namespace Zablose\Navbar\Contracts;

interface NavbarDataContract
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
     *         'body'       => '',
     *         'title'      => '',
     *         'href'       => '',
     *         'class'      => 'nav navbar-nav',
     *         'icon'       => '',
     *         'role'       => '',
     *         'permission' => '',
     *         'position'   => '',
     *     ]
     *
     * @param array|string|integer $filterOrPid Filter(s) or parent ID.
     * @param string               $order_by    Order by 'column:direction' like 'id:asc', 'position:desc', etc.
     *
     * @return array
     */
    public function getRawNavbarEntities($filterOrPid = null, $order_by = null);
}

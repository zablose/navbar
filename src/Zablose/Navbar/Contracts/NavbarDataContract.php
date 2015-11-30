<?php

namespace Zablose\Navbar\Contracts;

interface NavbarDataContract
{

    /**
     * Get an array of arrays or an array of objects to be used by NavbarDataProcessor<br/>
     * to transform to navigation entities.<br/>
     *
     * Example of an array element structure.<br/>
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
     * @param string|array|integer $filterOrPid Filter(s) or parent ID.
     * @param string $order_by Order by 'culumn:direction' like 'id:asc', 'position:desc', etc.
     *
     * @return array
     */
    public function getRawNavbarEntities($filterOrPid = null, $order_by = null);
}

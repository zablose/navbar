<?php

namespace Zablose\Navbar\Contracts;

interface NavbarDataContract
{

    /**
     *
     * @param  string|array|integer  $filterOrPid  Filter or parent ID.
     * @param  string  $order_by  Order by column in the database 'id:asc' or 'id:desc'.
     * @return array
     */
    public function getRawNavbarEntities($filterOrPid = null, $order_by = null);
}

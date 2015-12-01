<?php

namespace App;

use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
{

    public function getRawNavbarEntities($filterOrPid = null, $order_by = null)
    {
        $db     = new \PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'dbuser', 'password');
        $query  = 'SELECT * FROM `zablose_navbars`';
        $aWhere = [];

        if (is_string($filterOrPid))
        {
            $aWhere[] = "`filter` = '$filterOrPid'";
        }

        if (is_array($filterOrPid))
        {
            $aWhere[] = "`filter` IN ('".implode("','", $filterOrPid)."')";
        }

        if (is_integer($filterOrPid))
        {
            $aWhere[] = "`pid` = '$filterOrPid'";
        }

        if ($aWhere)
        {
            $query .= ' WHERE '.implode(' AND ', $aWhere);
        }

        if ($order_by)
        {
            $order = explode(':', $order_by);

            if (isset($order[1]) && in_array($order[1], ['asc', 'desc']))
            {
                $query .= " ORDER BY `$order[0]` ".strtoupper($order[1]);
            }
        }

        return $db->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }

}

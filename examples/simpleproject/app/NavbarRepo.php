<?php

namespace App;

use Zablose\Navbar\Contracts\NavbarRepoContract;

class NavbarRepo implements NavbarRepoContract
{

    /**
     * @var \PDO
     */
    private $db;

    public function __construct()
    {
        $dsn      = 'mysql:host=localhost;dbname=dbname;charset=utf8';
        $this->db = new \PDO($dsn, 'dbuser', 'password');
    }

    /**
     * @param array|string|int|null $filter
     * @param string|null           $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities($filter = null, $order_by = null)
    {
        $query  = 'SELECT * FROM `navbars`';
        $aWhere = [];

        if (is_string($filter))
        {
            $aWhere[] = "`filter` = '$filter'";
        }

        if (is_array($filter))
        {
            $aWhere[] = "`filter` IN ('" . implode("','", $filter) . "')";
        }

        if (is_integer($filter))
        {
            $aWhere[] = "`pid` = '$filter'";
        }

        if ($aWhere)
        {
            $query .= ' WHERE ' . implode(' AND ', $aWhere);
        }

        if ($order_by)
        {
            $order = explode(':', $order_by);

            if (isset($order[1]) && in_array($order[1], ['asc', 'desc']))
            {
                $query .= " ORDER BY `$order[0]` " . strtoupper($order[1]);
            }
        }

        return $this->db->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }

}

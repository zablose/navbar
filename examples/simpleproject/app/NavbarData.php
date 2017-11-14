<?php

namespace App;

use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
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
     * @param array|string|int|null $filter_or_pid
     * @param string|null           $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities($filter_or_pid = null, $order_by = null)
    {
        $query  = 'SELECT * FROM `navbars`';
        $aWhere = [];

        if (is_string($filter_or_pid))
        {
            $aWhere[] = "`filter` = '$filter_or_pid'";
        }

        if (is_array($filter_or_pid))
        {
            $aWhere[] = "`filter` IN ('" . implode("','", $filter_or_pid) . "')";
        }

        if (is_integer($filter_or_pid))
        {
            $aWhere[] = "`pid` = '$filter_or_pid'";
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

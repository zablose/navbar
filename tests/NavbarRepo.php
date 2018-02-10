<?php

namespace Zablose\Navbar\Tests;

use PDO;
use Zablose\Navbar\Contracts\NavbarRepoContract;

class NavbarRepo implements NavbarRepoContract
{

    /**
     * @var PDO
     */
    private $db;

    /**
     * NavbarRepo constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param array|string|int|null $filter
     * @param string|null           $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities($filter = null, $order_by = null)
    {
        $query  = 'SELECT * FROM `' . Table::NAVBARS . '`';
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

<?php

namespace Zablose\Navbar\Tests;

use PDO;
use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Helpers\OrderBy;

class NavbarRepo implements NavbarRepoContract
{

    /** @var PDO */
    private $db;

    /** @param PDO $db */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param array|string $filter
     * @param OrderBy      $order_by
     *
     * @return array
     */
    public function getRawNavbarEntities($filter = null, OrderBy $order_by = null)
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
            $query .= " ORDER BY `{$order_by->column}` " . strtoupper($order_by->direction);
        }

        return $this->db->query($query, \PDO::FETCH_ASSOC)->fetchAll();
    }

}

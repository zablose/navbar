<?php

namespace Zablose\Navbar\Tests;

use Illuminate\Database\Connection;
use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Helpers\OrderBy;

class NavbarRepo implements NavbarRepoContract
{

    /** @var Connection */
    private $db;

    /** @param Connection $db */
    public function __construct(Connection $db)
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
        $query = $this->db->table(Table::NAVBARS);

        if (is_string($filter))
        {
            $query->where('filter', $filter);
        }

        if (is_array($filter))
        {
            $query->whereIn('filter', $filter);
        }

        if ($order_by)
        {
            $query->orderBy($order_by->column, $order_by->direction);
        }

        return $query->get()->all();
    }

}

<?php

namespace Zablose\Navbar\Tests;

use Illuminate\Database\Connection;
use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Helpers\OrderBy;

class NavbarRepo implements NavbarRepoContract
{
    private Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getRawNavbarEntities(array $filter = null, OrderBy $order_by = null): array
    {
        $query = $this->db->table(Table::NAVBARS);

        if (is_string($filter)) {
            $query->where('filter', $filter);
        }

        if (is_array($filter)) {
            $query->whereIn('filter', $filter);
        }

        if ($order_by) {
            $query->orderBy($order_by->column, $order_by->direction);
        }

        return $query->get()->all();
    }
}

<?php

declare(strict_types=1);

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

    public function getRawNavbarEntities(array $filter, OrderBy $order_by): array
    {
        return $this->db->table(Table::NAVBARS)
            ->whereIn('filter', $filter)
            ->orderBy($order_by->column, $order_by->direction)
            ->get()->all();
    }
}

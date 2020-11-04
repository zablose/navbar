<?php

namespace App\Http\Navigation;

use Illuminate\Support\Facades\DB;
use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Helpers\OrderBy;

class NavbarRepo implements NavbarRepoContract
{
    public function getRawNavbarEntities(array $filter, OrderBy $order_by): array
    {
        return DB::table('navbars')
            ->whereIn('filter', $filter)
            ->orderBy($order_by->column, $order_by->direction)
            ->get()->all();
    }
}

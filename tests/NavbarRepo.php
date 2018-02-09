<?php

namespace Zablose\Navbar\Tests;

use DB;
use Illuminate\Support\Collection;
use Zablose\Navbar\Contracts\NavbarRepoContract;

class NavbarRepo implements NavbarRepoContract
{

    /**
     * @param array|string|int|null $filter
     * @param string|null           $order_by
     *
     * @return Collection
     */
    public function getRawNavbarEntities($filter = null, $order_by = null)
    {
        $query = DB::table('navbars');

        if (is_string($filter))
        {
            $query->where('filter', $filter);
        }

        if (is_array($filter))
        {
            $query->whereIn('filter', $filter);
        }

        if (is_integer($filter))
        {
            $query->where('pid', $filter);
        }

        if ($order_by)
        {
            $order = explode(':', $order_by);

            if (isset($order[1]) && in_array($order[1], ['asc', 'desc']))
            {
                $query->orderBy($order[0], $order[1]);
            }
        }

        return $query->get();
    }

}

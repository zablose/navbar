<?php

namespace Zablose\Navbar\Demo;

use DB;
use Illuminate\Support\Collection;
use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
{

    /**
     * @param array|string|int|null $filter_or_pid
     * @param string|null           $order_by
     *
     * @return Collection
     */
    public function getRawNavbarEntities($filter_or_pid = null, $order_by = null)
    {
        $query = DB::table('navbars');

        if (is_string($filter_or_pid))
        {
            $query->where('filter', $filter_or_pid);
        }

        if (is_array($filter_or_pid))
        {
            $query->whereIn('filter', $filter_or_pid);
        }

        if (is_integer($filter_or_pid))
        {
            $query->where('pid', $filter_or_pid);
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

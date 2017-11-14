<?php

namespace App\Zablose\Navbar;

use DB;
use Illuminate\Support\Collection;
use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
{

    /**
     * Get an array of arrays or an array of objects to be used by NavbarDataProcessor
     * to transform to navigation entities.
     *
     * Example of an array element structure.
     *
     *     [
     *         'id'         => 1,
     *         'pid'        => 0,
     *         'filter'     => 'main',
     *         'type'       => 'bootstrap_navbar',
     *         'body'       => '',
     *         'title'      => '',
     *         'href'       => '',
     *         'class'      => 'nav navbar-nav',
     *         'icon'       => '',
     *         'role'       => '',
     *         'permission' => '',
     *         'position'   => '',
     *     ]
     *
     * @param array|string|int|null $filter_or_pid Filter(s) or parent ID.
     * @param string|null           $order_by      Order by 'culumn:direction' like 'id:asc', 'position:desc', etc.
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

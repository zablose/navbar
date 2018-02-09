<?php

namespace App\Zablose\Navbar;

use DB;
use Illuminate\Support\Collection;
use Zablose\Navbar\Contracts\NavbarRepoContract;

class NavbarRepo implements NavbarRepoContract
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
     *         'group'      => true,
     *         'body'       => '',
     *         'title'      => '',
     *         'href'       => '',
     *         'external'   => false,
     *         'class'      => 'nav navbar-nav',
     *         'icon'       => '',
     *         'role'       => '',
     *         'permission' => '',
     *         'position'   => '',
     *     ]
     *
     * @param array|string|int|null $filter   Filter(s) or parent ID.
     * @param string|null           $order_by Order by 'culumn:direction' like 'id:asc', 'position:desc', etc.
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

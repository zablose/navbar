<?php

namespace App\Zablose\Navbar;

use DB;
use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
{

    /**
     * Get an array of arrays or an array of objects to be used by NavbarDataProcessor<br/>
     * to transform to navigation entities.<br/>
     *
     * Example of an array element structure.<br/>
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
     * @param string|array|integer $filterOrPid Filter(s) or parent ID.
     * @param string $order_by Order by 'culumn:direction' like 'id:asc', 'position:desc', etc.
     *
     * @return array
     */
    public function getRawNavbarEntities($filterOrPid = null, $order_by = null)
    {
        $query = DB::table('zablose_navbars');

        if (is_string($filterOrPid))
        {
            $query->where('filter', $filterOrPid);
        }

        if (is_array($filterOrPid))
        {
            $query->whereIn('filter', $filterOrPid);
        }

        if (is_integer($filterOrPid))
        {
            $query->where('pid', $filterOrPid);
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

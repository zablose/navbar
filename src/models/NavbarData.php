<?php

namespace App\Zablose\Navbar;

use DB;
use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
{

    /**
     *
     * @param  string|array|integer  $filterOrPid  Filter or parent ID.
     * @param  string  $order_by  Order by column in the database 'id:asc' or 'id:desc'.
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

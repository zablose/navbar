<?php

namespace App\Zablose\Navbar;

use DB;
use Zablose\Navbar\Contracts\NavbarDataContract;

class NavbarData implements NavbarDataContract
{

    /**
     *
     * @param  mixed  $tagOrPid  Tag(s) that group navbars or parent ID.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     * @return array
     */
    public function getRawNavbarEntities($tagOrPid = null, $titled = null, $positioned = null)
    {
        $query = DB::table('navbars');

        if(is_string($tagOrPid))
        {
            $query->where('tag', $tagOrPid);
        }

        if (is_array($tagOrPid))
        {
            $query->whereIn('tag', $tagOrPid);
        }

        if(is_integer($tagOrPid))
        {
            $query->where('pid', $tagOrPid);
        }

        if (in_array($titled, ['asc', 'desc']))
        {
            $query->orderBy('title', $titled);
        }

        if (in_array($positioned, ['asc', 'desc']))
        {
            $query->orderBy('position', $positioned);
        }

        return $query->get();
    }

}

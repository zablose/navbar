<?php

namespace Zablose\Navbar\Contracts;

interface NavbarDataContract
{

    /**
     *
     * @param  mixed  $tagOrPid  Tag(s) that group navbars or parent ID.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     * @return array
     */
    public function getRawNavbarEntities($tagOrPid = null, $titled = null, $positioned = null);

}

<?php

namespace Zablose\Navbar\Contracts;

interface NavbarConfigContract
{

    /**
     * Set or get current path of the application.
     *
     * @param string $path
     *
     * @return NavbarConfigContract|string
     */
    public function path($path = null);

    /**
     * Set or get roles of the logged user.
     *
     * @param array $roles An array of strings or integers.
     *
     * @return NavbarConfigContract|array
     */
    public function roles($roles = null);

    /**
     * Set or get permissions of the logged user.
     *
     * @param array $permissions An array of strings or integers.
     *
     * @return NavbarConfigContract|array
     */
    public function permissions($permissions = null);
}

<?php

namespace Zablose\Navbar\Contracts;

interface NavbarConfigContract
{

    /**
     * Set current path of the application.
     *
     * @param string $path
     *
     * @return NavbarConfigContract
     */
    public function setPath($path);

    /**
     * @param array $roles An array of strings or integers.
     *
     * @return NavbarConfigContract
     */
    public function setRoles($roles);

    /**
     * @param array $permissions An array of strings or integers.
     *
     * @return NavbarConfigContract
     */
    public function setPermissions($permissions);

    /**
     * Get current path of the application.
     *
     * @return string
     */
    public function getPath();

    /**
     * @return array
     */
    public function getRoles();

    /**
     * @return array
     */
    public function getPermissions();

}

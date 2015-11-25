<?php

namespace Zablose\Navbar\Contracts;

interface NavbarEntityContract
{

    public static function getTypes();

    public static function getGroupTypes();

    public function isGroup();

    /**
     * Render Class with or without prefix and postfix.
     *
     * @param type $prefix
     * @param type $postfix
     *
     * @return string
     */
    public function renderClass($prefix = null, $postfix = null);

    /**
     * Render Title with or without prefix and postfix.
     *
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function renderTitle($prefix = null, $postfix = null);


    /**
     * Render Icon.
     *
     * @return string
     */
    public function renderIcon();

}

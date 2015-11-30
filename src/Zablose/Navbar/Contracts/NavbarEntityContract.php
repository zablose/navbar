<?php

namespace Zablose\Navbar\Contracts;

interface NavbarEntityContract
{

    /**
     * @return array
     */
    public static function getTypes();

    /**
     * @return array
     */
    public static function getGroupTypes();

    /**
     * @return boolean
     */
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
    public function renderBody($prefix = null, $postfix = null);

    /**
     * Render Icon.
     *
     * @return string
     */
    public function renderIcon();
}

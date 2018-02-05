<?php

namespace Zablose\Navbar\Contracts;

interface NavbarEntityContract
{

    /**
     * Render Class with or without prefix and postfix.
     *
     * @param string $prefix
     * @param string $postfix
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

<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Helpers\Html;

class NavbarEntity extends NavbarEntityCore
{

    /**
     * Render body with or without prefix and/or postfix.
     *
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function renderBody($prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($this->body, $prefix), $postfix);
    }

    /**
     * Render class with or without prefix and/or postfix.
     *
     * @param string $prefix
     * @param string $postfix
     *
     * @return string
     */
    public function renderClass($prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($this->class, $prefix), $postfix);
    }

    /**
     * Render Icon.
     *
     * @return string
     */
    public function renderIcon()
    {
        return ($this->icon) ? '<span class="' . $this->icon . '"></span>' : '';
    }

}

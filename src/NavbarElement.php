<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;

class NavbarElement
{

    /** @var NavbarEntityCore|NavbarEntityContract */
    public $entity;

    /** @var array */
    public $content;

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return NavbarElement
     */
    public function setEntity(NavbarEntityContract $entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @param array $content
     *
     * @return NavbarElement
     */
    public function setContent(array $content)
    {
        $this->content = $content;

        return $this;
    }

}

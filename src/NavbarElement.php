<?php

declare(strict_types=1);

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarEntityContract;

class NavbarElement
{
    /** @var NavbarEntityCore|NavbarEntityContract */
    public NavbarEntityContract $entity;
    public array $content;

    public function setEntity(NavbarEntityContract $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

        return $this;
    }
}

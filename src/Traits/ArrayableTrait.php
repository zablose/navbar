<?php

namespace Zablose\Navbar\Traits;

trait ArrayableTrait
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}

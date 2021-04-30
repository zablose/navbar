<?php

declare(strict_types=1);

namespace Zablose\Navbar\Traits;

trait ArrayableTrait
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}

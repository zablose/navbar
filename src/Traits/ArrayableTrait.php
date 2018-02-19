<?php

namespace Zablose\Navbar\Traits;

trait ArrayableTrait
{

    /** @return array */
    public function toArray()
    {
        return get_object_vars($this);
    }

}

<?php

namespace Zablose\Navbar\Traits;

trait ConstructFromDataArrayTrait
{
    public function __construct(array $data = [])
    {
        if (count($data) > 0) {
            $attrs = get_object_vars($this);

            foreach ($attrs as $key => $null) {
                if (isset($data[$key])) {
                    $this->{$key} = $data[$key];
                }
            }
        }
    }
}

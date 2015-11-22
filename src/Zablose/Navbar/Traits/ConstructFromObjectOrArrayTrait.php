<?php

namespace Zablose\Navbar\Traits;

trait ConstructFromObjectOrArrayTrait
{

    public function __construct($data = null)
    {
        if ($data !== null)
        {
            if (is_object($data))
            {
                $data = get_object_vars($data);
            }
            $attrs = get_object_vars($this);

            foreach ($attrs as $key => $null)
            {
                if (isset($data[$key]))
                {
                    $this->$key = $data[$key];
                }
            }
        }
    }

}

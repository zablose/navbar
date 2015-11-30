<?php

namespace Zablose\Navbar\Traits;

trait ConstructFromObjectOrArrayTrait
{

    /**
     * @param array|object $data
     *
     * @return void
     */
    public function __construct($data = null)
    {
        if ($data !== null)
        {
            $data  = (array) $data;
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

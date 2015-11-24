<?php

namespace Zablose\Navbar\Contracts;

interface NavbarConfigContract
{

    public function path($path = null);

    public function roles($roles = null);

    public function permissions($permissions = null);
    
}

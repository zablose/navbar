<?php

namespace Zablose\Navbar\Contracts;

interface NavbarEntityContract
{

    public static function getTypes();

    public static function getGroupTypes();

    public function isGroup();

    public function isPublic();
    
    public function addClass($class);

}

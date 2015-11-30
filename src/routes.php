<?php

use App\Zablose\Navbar\NavbarData;
use Zablose\Navbar\NavbarBuilder;

Route::get('/zablose/navbar/demo', function ()
{
    $navbar = new NavbarBuilder(new NavbarData());
    return view('navbar::sidebar', compact('navbar'));
});

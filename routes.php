<?php

use App\Zablose\Navbar\NavbarRepo;
use Zablose\Navbar\NavbarBuilder;

Route::get('/zablose/navbar/demo', function ()
{
    $navbar = new NavbarBuilder(new NavbarRepo());
    return view('navbar::sidebar', compact('navbar'));
});

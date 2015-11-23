<?php

Route::get('/zablose/navbar/demo', function () {
    $navbar = new \Zablose\Navbar\NavbarBuilder(new App\Zablose\Navbar\NavbarData());
    return view('navbar::sidebar', compact('navbar'));
});

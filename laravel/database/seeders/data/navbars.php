<?php

use App\Http\Navigation\NavbarEntity;
use Zablose\Navbar\Traits\ArrayableTrait;
use Zablose\Navbar\Traits\NavbarSettersTrait;

class NE extends NavbarEntity
{
    use ArrayableTrait;
    use NavbarSettersTrait;
}

$navbar = (new NE())->setType(NE::TYPE_NAVBAR)->setGroup();
$dropdown = (new NE())->setType(NE::TYPE_DROPDOWN)->setGroup();
$link = (new NE())->setType(NE::TYPE_LINK);
$logout = (new NE())->setType(NE::TYPE_LOGOUT);

return [
    $navbar->setId()
        ->setClass('navbar-nav mr-auto')
        ->toArray(),
    $link->setId()->setPid($navbar->id)
        ->setClass('nav-item')
        ->setIcon('fa fa-home')
        ->setBody('Home')
        ->setHref('/home')
        ->setRole('user')
        ->toArray(),
    $link->setId()->setPid($navbar->id)
        ->setClass('nav-item')
        ->setIcon('fa fa-external-link')
        ->setBody('Laravel')
        ->setHref('https://laravel.com/')
        ->setExternal()
        ->setRole('')
        ->toArray(),

    $navbar->setId()
        ->setClass('navbar-nav navbar-right')
        ->toArray(),
    $dropdown->setId()->setPid($navbar->id)
        ->setIcon('fa fa-user')
        ->toArray(),
    $link->setId()->setPid($dropdown->id)
        ->setClass('dropdown-item')
        ->setIcon('fa fa-sign-in')
        ->setBody('Login')
        ->setHref('/login')
        ->setExternal(false)
        ->setRole('public')
        ->toArray(),
    $link->setId()
        ->setClass('dropdown-item')
        ->setIcon('fa fa-user-plus')
        ->setBody('Register')
        ->setHref('/register')
        ->toArray(),
    $logout->setId()->setPid($dropdown->id)
        ->setClass('dropdown-item')
        ->setIcon('fa fa-sign-out')
        ->setBody('Logout')
        ->setHref('/logout')
        ->setRole('user')
        ->toArray(),
];

<?php

require '../vendor/autoload.php';

$navbar = new \Zablose\Navbar\Tests\NavbarBuilder(new App\NavbarRepo());

echo $navbar->prepare(['main', 'dashboard'], 'id:asc')->render('main');
echo $navbar->render('dashboard');

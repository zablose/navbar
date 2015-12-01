<?php

require '../vendor/autoload.php';

$navbar = new \Zablose\Navbar\NavbarBuilder(new App\NavbarData());

echo $navbar->prepare(['main', 'dashboard'], 'id:asc')->render('main');
echo $navbar->render('dashboard');

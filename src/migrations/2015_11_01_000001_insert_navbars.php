<?php

use App\Navbar;
use Zablose\Navbar\NavbarEntity;
use Illuminate\Database\Migrations\Migration;

class InsertNavbars extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $navbars = [
            [
                'type' => NavbarEntity::TYPE_NAVBAR_NAVBAR, // id = 1
            ],
            [
                'pid'    => 1,
                'title'  => 'Index',
                'target' => '/',
            ],
            [
                'pid'    => 1,
                'title'  => 'Home',
                'target' => '/home',
                'icon'   => 'fa fa-home fa-lg',
            ],
            [
                'type'  => NavbarEntity::TYPE_NAVBAR_NAVBAR, // id = 4
                'class' => 'navbar-right',
            ],
            [
                'pid'   => 4, // id = 5
                'title' => 'Dropdown',
                'type'  => NavbarEntity::TYPE_NAVBAR_DROPDOWN,
                'icon'  => 'fa fa-bars fa-lg'
            ],
            [
                'pid'    => 5,
                'title'  => 'Login',
                'target' => '/auth/login',
            ],
            [
                'pid'    => 5,
                'title'  => 'Register',
                'target' => '/auth/register',
            ],
            [
                'pid'    => 5,
                'title'  => 'Logout',
                'target' => '/auth/logout',
            ],
            [
                'pid'  => 5,
                'type' => NavbarEntity::TYPE_NAVBAR_SEPARATOR,
            ],
            [
                'pid'   => 5,
                'title' => 'Links to explore',
                'type'  => NavbarEntity::TYPE_NAVBAR_HEADER,
            ],
            [
                'pid'   => 5,
                'title' => 'Dashboard',
                'alt'   => 'Admin area',
                'icon'  => 'fa fa-dashboard',
            ],
            [
                'tag'  => 'dashboard',
                'type' => NavbarEntity::TYPE_NAVBAR_SIDEBAR, // id = 12
            ],
            [
                'pid'   => 12,
                'tag'   => 'dashboard',
                'title' => 'Users',
                'icon'  => 'fa fa-book fa-fw',
            ],
            [
                'pid'    => 12,
                'tag'    => 'dashboard',
                'title'  => 'Laravel',
                'target' => 'http://laravel.com/',
                'type'   => NavbarEntity::TYPE_NAVBAR_LINK_ABSOLUTE,
                'icon'   => 'fa fa-external-link fa-fw',
            ]
        ];

        foreach ($navbars as $navbar)
        {
            Navbar::create($navbar);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('navbars')->truncate();
    }

}

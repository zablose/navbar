<?php

use App\Zablose\Navbar\Navbar;
use Zablose\Navbar\NavbarEntity;
use Illuminate\Support\Facades\DB;
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
                'pid'           => 0,
                'filter'        => 'main',
                'type'          => NavbarEntity::TYPE_BOOTSTRAP_NAVBAR, // id = 1
                'body'          => '',
                'title'         => '',
                'href'          => '',
                'class'         => '',
                'icon'          => '',
                'role_id'       => '',
                'permission_id' => '',
                'position'      => '',
            ],
            [
                'pid'    => 1,
                'filter' => 'main',
                'body'   => 'Index',
                'href'   => '/',
            ],
            [
                'pid'    => 1,
                'filter' => 'main',
                'body'   => 'Home',
                'href'   => '/home',
                'icon'   => 'fa fa-home fa-lg',
            ],
            [
                'filter' => 'main',
                'type'   => NavbarEntity::TYPE_BOOTSTRAP_NAVBAR, // id = 4
                'class'  => 'navbar-right',
            ],
            [
                'pid'    => 4, // id = 5
                'filter' => 'main',
                'type'   => NavbarEntity::TYPE_BOOTSTRAP_DROPDOWN,
                'body'   => 'Dropdown',
                'icon'   => 'fa fa-bars fa-lg'
            ],
            [
                'pid'    => 5,
                'filter' => 'main',
                'body'   => 'Login',
                'href'   => '/auth/login',
            ],
            [
                'pid'    => 5,
                'filter' => 'main',
                'body'   => 'Register',
                'href'   => '/auth/register',
            ],
            [
                'pid'    => 5,
                'filter' => 'main',
                'body'   => 'Logout',
                'href'   => '/auth/logout',
            ],
            [
                'pid'    => 5,
                'filter' => 'main',
                'type'   => NavbarEntity::TYPE_BOOTSTRAP_SEPARATOR,
            ],
            [
                'pid'    => 5,
                'filter' => 'main',
                'type'   => NavbarEntity::TYPE_BOOTSTRAP_HEADER,
                'body'   => 'Links to explore',
            ],
            [
                'pid'    => 5,
                'filter' => 'main',
                'body'   => 'Dashboard',
                'title'  => 'Admin area',
                'icon'   => 'fa fa-dashboard',
            ],
            [
                'filter' => 'dashboard',
                'type'   => NavbarEntity::TYPE_NAVBAR_NAVBAR, // id = 12
                'class'  => 'nav nav-sidebar',
            ],
            [
                'pid'    => 12,
                'filter' => 'dashboard',
                'body'   => 'Users',
                'icon'   => 'fa fa-book fa-fw',
            ],
            [
                'pid'    => 12,
                'filter' => 'dashboard',
                'type'   => NavbarEntity::TYPE_NAVBAR_LINK_ABSOLUTE,
                'body'   => 'Laravel',
                'href'   => 'http://laravel.com/',
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
        DB::table('zablose_navbars')->truncate();
    }

}

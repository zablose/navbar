<?php

use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\NavbarBuilder;
use Zablose\Navbar\NavbarConfig;
use Zablose\Navbar\NavbarEntityCore;

class NavbarBuilderTest extends PHPUnit_Framework_TestCase
{

    public function dataProviderFor_testRender()
    {
        $data[] = [
            'navbar',
            '<ul class="nav navbar-nav"></ul>',
        ];

        $data[] = [
            'dropdown',
            '<li class="dropdown">'.
            '<a id="dropdown_1" href="" class="dropdown-toggle test" data-toggle="dropdown" role="button" '.
            'aria-haspopup="true" aria-expanded="false" navbar-pid="1" navbar-container="ul"><span class="fa">'.
            '</span> Dropdown <span class="caret"></span></a>'.
            '<ul class="dropdown-menu"></ul>'.
            '</li>',
        ];

        $data[] = [
            'header',
            '<li class="dropdown-header">Header</li>',
        ];

        $data[] = [
            1,
            '<li role="separator" class="divider"></li>',
        ];

        $data[] = [
            2,
            '<ul class="nav"></ul>',
        ];

        $data[] = [
            'absolute',
            '<li title="Coding"><a href="http://laravel.com" target="_blank"><span class="fa fa-book"></span> Laravel</a></li>',
        ];

        $data[] = [
            'relative',
            '<li title="Go Home!"><a href="http://localhost/home"><span class="fa"></span> Home</a></li>',
        ];

        return $data;
    }

    /**
     * @dataProvider dataProviderFor_testRender
     *
     * @param string|integer $tagOrPid
     * @param string $expected
     */
    public function testRender($tagOrPid, $expected)
    {
        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData()))->render($tagOrPid));
    }

    public function testRenderWithRole()
    {
        $config = new NavbarConfig();
        $config->path('home');
        $config->roles([2,4,6]);
        $config->permissions([12]);

        $expected = '<li title="Go Home!" class="active">'.
            '<a href="http://localhost/home"><span class="fa"></span> Home</a></li>';

        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData(), $config))->render('role'));
    }

    public function testRenderWithPermission()
    {
        $config = new NavbarConfig();
        $config->path('user');
        $config->permissions([12]);

        $expected = '<li><a href="http://localhost/"></a></li>';

        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData(), $config))->render('permission'));
    }

    public function testRenderWithNoLinkContainerTag()
    {
        $config = new NavbarConfig([
            'link_container_tag' => '',
        ]);

        $expected = '<a href="http://localhost/"></a>';

        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData(), $config))->render('no-link-container-tag'));
    }

}

class NavbarTestData implements NavbarDataContract
{

    public function getRawNavbarEntities($tagOrPid = null, $titled = null, $positioned = null)
    {
        $data = [];

        $data['navbar'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'navbar',
            'type'          => NavbarEntityCore::TYPE_BOOTSTRAP_NAVBAR,
            'body'         => '',
            'title'           => '',
            'href'        => '',
            'class'         => '',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data['navbar'][] = [
            'id'            => 2,
            'pid'           => 1,
            'filter'           => 'navbar',
            'type'          => 'unknown',
            'body'         => '',
            'title'           => '',
            'href'        => '',
            'class'         => '',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data['dropdown'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'dropdown',
            'type'          => NavbarEntityCore::TYPE_BOOTSTRAP_DROPDOWN,
            'body'         => 'Dropdown',
            'title'           => '',
            'href'        => '',
            'class'         => 'test',
            'icon'          => 'fa',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data['header'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'header',
            'type'          => NavbarEntityCore::TYPE_BOOTSTRAP_HEADER,
            'body'         => 'Header',
            'title'           => '',
            'href'        => '',
            'class'         => '',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data[1][] = [
            'id'            => 2,
            'pid'           => 1,
            'filter'           => '',
            'type'          => NavbarEntityCore::TYPE_BOOTSTRAP_SEPARATOR,
            'body'         => '',
            'title'           => '',
            'href'        => '',
            'class'         => '',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data[2][] = [
            'id'            => 3,
            'pid'           => 2,
            'filter'           => '',
            'type'          => NavbarEntityCore::TYPE_NAVBAR_NAVBAR,
            'body'         => '',
            'title'           => '',
            'href'        => '',
            'class'         => 'nav',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data['absolute'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'absolute',
            'type'          => NavbarEntityCore::TYPE_NAVBAR_LINK_ABSOLUTE,
            'body'         => 'Laravel',
            'title'           => 'Coding',
            'href'        => 'http://laravel.com',
            'class'         => 'lar',
            'icon'          => 'fa fa-book',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data['relative'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'relative',
            'type'          => NavbarEntityCore::TYPE_NAVBAR_LINK_RELATIVE,
            'body'         => 'Home',
            'title'           => 'Go Home!',
            'href'        => '/home',
            'class'         => '',
            'icon'          => 'fa',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        $data['role'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'role',
            'type'          => NavbarEntityCore::TYPE_NAVBAR_LINK_RELATIVE,
            'body'         => 'Home',
            'title'           => 'Go Home!',
            'href'        => '/home',
            'class'         => '',
            'icon'          => 'fa',
            'role_id'       => 4,
            'permission_id' => '',
            'position'      => '',
        ];

        $data['permission'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'permission',
            'type'          => NavbarEntityCore::TYPE_NAVBAR_LINK_RELATIVE,
            'body'         => '',
            'title'           => '',
            'href'        => '',
            'class'         => '',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => 12,
            'position'      => '',
        ];

        $data['no-link-container-tag'][] = [
            'id'            => 1,
            'pid'           => 0,
            'filter'           => 'no-link-container-tag',
            'type'          => NavbarEntityCore::TYPE_NAVBAR_LINK_RELATIVE,
            'body'         => '',
            'title'           => '',
            'href'        => '',
            'class'         => '',
            'icon'          => '',
            'role_id'       => '',
            'permission_id' => '',
            'position'      => '',
        ];

        return $data[$tagOrPid];
    }

}

<?php

use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Demo\NavbarBuilder;
use Zablose\Navbar\Demo\NavbarEntity as NE;
use Zablose\Navbar\NavbarConfig;

class NavbarBuilderTest extends PHPUnit\Framework\TestCase
{

    /**
     * @return array
     */
    public function dataProviderFor_testRender()
    {
        $data[] = [
            'navbar',
            '<ul class="nav navbar-nav"></ul>',
        ];

        $data[] = [
            'dropdown',
            '<li class="dropdown">' .
            '<a id="dropdown_1" class="dropdown-toggle test" data-toggle="dropdown" role="button" ' .
            'aria-haspopup="true" aria-expanded="false" navbar-pid="1" navbar-container="ul"><span class="fa">' .
            '</span> Dropdown <span class="caret"></span></a>' .
            '<ul class="dropdown-menu"></ul>' .
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
            'external',
            '<li title="Coding"><a href="http://laravel.com" target="_blank" class="lar">' .
            '<span class="fa fa-book"></span> Laravel</a></li>',
        ];

        $data[] = [
            'relative',
            '<li title="Go Home!"><a href="/home"><span class="fa"></span> Home</a></li>',
        ];

        return $data;
    }

    /**
     * @dataProvider dataProviderFor_testRender
     *
     * @param string|integer $filterOrPid
     * @param string         $expected
     *
     * @throws Exception
     */
    public function testRender($filterOrPid, $expected)
    {
        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData()))->render($filterOrPid));
    }

    /**
     * @throws Exception
     */
    public function testRenderWithRole()
    {
        $config = new NavbarConfig();
        $config->path('home');
        $config->roles([2, 4, 6]);
        $config->permissions([12]);

        $expected = '<li title="Go Home!" class="active">' .
            '<a href="/home"><span class="fa"></span> Home</a></li>';

        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData(), $config))->render('role'));
    }

    /**
     * @throws Exception
     */
    public function testRenderWithPermission()
    {
        $config = new NavbarConfig();
        $config->path('user');
        $config->permissions([12]);

        $expected = '<li><a href="/"></a></li>';

        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData(), $config))->render('permission'));
    }

    /**
     * @throws Exception
     */
    public function testRenderToCheckIdenticalComparison()
    {
        $config = new NavbarConfig();

        $expected = '<li class="dropdown">' .
            '<a id="dropdown_1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ' .
            'aria-expanded="false" navbar-pid="1" navbar-container="ul"><span class="caret"></span></a>' .
            '<ul class="dropdown-menu">' .
            '<li role="separator" class="divider"></li>' .
            '<li><a href="/cool">Identical</a></li>' .
            '</ul></li>';

        $this->assertEquals($expected, (new NavbarBuilder(new NavbarTestData(), $config))->render('identical'));
    }

    /**
     * @throws Exception
     */
    public function testRenderWithPrepareByFilterAsArray()
    {
        $config = new NavbarConfig();

        $expected = '<li title="Go Home!"><a href="/home"><span class="fa"></span> Home</a></li>';

        $navbar = new NavbarBuilder(new NavbarTestData(), $config);

        $this->assertEquals($expected, $navbar->prepare(['identical', 'relative'])->render('relative'));
    }

    /**
     * @throws Exception
     */
    public function testRenderBulmaMenu()
    {
        $config = new NavbarConfig();

        $expected =
            '<p class="menu-label">General</p><ul class="menu-list"><li><a href="/" class="active">Home</a></li></ul>';

        $navbar = new NavbarBuilder(new NavbarTestData(), $config);

        $this->assertEquals($expected, $navbar->render('bulma'));
    }

}

class NavbarTestData implements NavbarDataContract
{

    public function getRawNavbarEntities($filter_or_pid = null, $order_by = null)
    {
        $data = [];

        $data['navbar'][] = (new NE())
            ->setId(1)
            ->setFilter('navbar')
            ->setType(NE::TYPE_BOOTSTRAP_NAVBAR)
            ->setGroup()
            ->setClass('nav navbar-nav')
            ->toArray();

        $data['navbar'][] = (new NE())
            ->setId(2)
            ->setPid(1)
            ->setFilter('navbar')
            ->setType('unknown')
            ->toArray();

        $data['dropdown'][] = (new NE())
            ->setId(1)
            ->setFilter('dropdown')
            ->setType(NE::TYPE_BOOTSTRAP_DROPDOWN)
            ->setGroup()
            ->setBody('Dropdown')
            ->setClass('test')
            ->setIcon('fa')
            ->toArray();

        $data['header'][] = (new NE())
            ->setId(1)
            ->setFilter('header')
            ->setType(NE::TYPE_BOOTSTRAP_HEADER)
            ->setBody('Header')
            ->toArray();

        $data[1][] = (new NE())
            ->setId(2)
            ->setPid(1)
            ->setFilter('')
            ->setType(NE::TYPE_BOOTSTRAP_SEPARATOR)
            ->toArray();

        $data[2][] = (new NE())
            ->setId(3)
            ->setPid(2)
            ->setFilter('')
            ->setType(NE::TYPE_BOOTSTRAP_NAVBAR)
            ->setGroup()
            ->setClass('nav')
            ->toArray();

        $data['external'][] = (new NE())
            ->setId(1)
            ->setFilter('external')
            ->setType(NE::TYPE_BOOTSTRAP_LINK)
            ->setBody('Laravel')
            ->setTitle('Coding')
            ->setHref('http://laravel.com')
            ->setExternal()
            ->setClass('lar')
            ->setIcon('fa fa-book')
            ->toArray();

        $data['relative'][] = (new NE())
            ->setId(4)
            ->setFilter('relative')
            ->setType(NE::TYPE_BOOTSTRAP_LINK)
            ->setBody('Home')
            ->setTitle('Go Home!')
            ->setHref('/home')
            ->setIcon('fa')
            ->toArray();

        $data['role'][] = (new NE())
            ->setId(1)
            ->setFilter('role')
            ->setType(NE::TYPE_BOOTSTRAP_LINK)
            ->setBody('Home')
            ->setTitle('Go Home!')
            ->setHref('/home')
            ->setIcon('fa')
            ->setRole(4)
            ->toArray();

        $data['permission'][] = (new NE())
            ->setId(1)
            ->setFilter('permission')
            ->setType(NE::TYPE_BOOTSTRAP_LINK)
            ->setPermission(12)
            ->toArray();

        $data['identical'][] = (new NE())
            ->setId(1)
            ->setFilter('identical')
            ->setType(NE::TYPE_BOOTSTRAP_DROPDOWN)
            ->setGroup()
            ->toArray();

        $data['identical'][] = (new NE())
            ->setId(2)
            ->setPid(1)
            ->setFilter('identical')
            ->setType(NE::TYPE_BOOTSTRAP_SEPARATOR)
            ->toArray();

        $data['identical'][] = (new NE())
            ->setId(3)
            ->setPid(1)
            ->setFilter('identical')
            ->setType(NE::TYPE_BOOTSTRAP_LINK)
            ->setBody('Identical')
            ->setHref('/cool')
            ->setPosition(0)
            ->toArray();

        $data['bulma'][] = (new NE())
            ->setId(1)
            ->setFilter('bulma')
            ->setType(NE::TYPE_BULMA_MENU_LABEL)
            ->setBody('General')
            ->toArray();

        $data['bulma'][] = (new NE())
            ->setId(2)
            ->setFilter('bulma')
            ->setType(NE::TYPE_BULMA_MENU_LIST)
            ->setGroup()
            ->toArray();

        $data['bulma'][] = (new NE())
            ->setId(3)
            ->setPid(2)
            ->setFilter('bulma')
            ->setType(NE::TYPE_BULMA_MENU_LIST_LINK)
            ->setBody('Home')
            ->setHref('/')
            ->toArray();

        if (is_array($filter_or_pid))
        {
            $return = [];
            foreach ($filter_or_pid as $filter)
            {
                $return = array_merge($return, $data[$filter]);
            }

            return $return;
        }

        return $data[$filter_or_pid];
    }

}

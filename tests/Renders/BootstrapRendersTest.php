<?php

namespace Zablose\Navbar\Tests\Renders;

use Zablose\Navbar\NavbarConfig;
use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Tests\Traits\DatabaseTrait;

class BootstrapRendersTest extends TestCase
{

    use DatabaseTrait;

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_navbar()
    {
        $this->insert([
            (new NE())->setId(1)->setType(NE::TYPE_BOOTSTRAP_NAVBAR)->setGroup()->setClass('nav navbar-nav')->toArray(),
        ]);

        $this->assertSame('<ul class="nav navbar-nav"></ul>', $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function ignore_unknown_entity_type()
    {
        $this->insert([
            (new NE())->setId(2)->setPid(1)->setType('unknown')->toArray(),
        ]);

        $this->assertSame('', $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_dropdown()
    {
        $this->insert([
            (new NE())->setId(1)->setType(NE::TYPE_BOOTSTRAP_DROPDOWN)->setGroup()->setBody('Dropdown')
                ->setClass('test')->setIcon('fa')->toArray(),
        ]);

        $expected =
            '<li class="dropdown">' .
            '<a id="dropdown_1" class="dropdown-toggle test" data-toggle="dropdown" role="button" ' .
            'aria-haspopup="true" aria-expanded="false" navbar-pid="1" navbar-container="ul"><span class="fa">' .
            '</span> Dropdown <span class="caret"></span></a>' .
            '<ul class="dropdown-menu"></ul>' .
            '</li>';

        $this->assertSame($expected, $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_header()
    {
        $this->insert([
            (new NE())->setId(1)->setType(NE::TYPE_BOOTSTRAP_HEADER)->setBody('Header')->toArray(),
        ]);

        $this->assertSame('<li class="dropdown-header">Header</li>', $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_separator()
    {
        $this->insert([
            (new NE())->setId(2)->setType(NE::TYPE_BOOTSTRAP_SEPARATOR)->toArray(),
        ]);

        $this->assertSame('<li role="separator" class="divider"></li>', $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_navbar_by_pid()
    {
        $this->insert([
            (new NE())->setId(2)->setPid(1)->setType(NE::TYPE_BOOTSTRAP_NAVBAR)->setGroup()->setClass('nav')->toArray(),
        ]);

        $this->assertSame('<ul class="nav"></ul>', $this->render(1));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_external_link()
    {
        $this->insert([
            (new NE())->setId(1)->setType(NE::TYPE_BOOTSTRAP_LINK)->setBody('Laravel')->setTitle('Coding')
                ->setHref('http://laravel.com')->setExternal()->setClass('lar')->setIcon('fa fa-book')->toArray(),
        ]);

        $expected = '<li title="Coding"><a href="http://laravel.com" target="_blank" rel="noopener" class="lar">' .
            '<span class="fa fa-book"></span> Laravel</a></li>';

        $this->assertSame($expected, $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_relative_link()
    {
        $this->insert([
            (new NE())->setId(1)->setType(NE::TYPE_BOOTSTRAP_LINK)->setBody('Home')->setTitle('Go Home!')
                ->setHref('/home')->setIcon('fa')->toArray(),
        ]);

        $this->assertSame(
            '<li title="Go Home!"><a href="/home"><span class="fa"></span> Home</a></li>',
            $this->render()
        );
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function prepare_with_filter_as_array_and_render()
    {
        $this->insert([
            (new NE())->setId(1)->setFilter('external')->setType(NE::TYPE_BOOTSTRAP_LINK)->setBody('Laravel')
                ->setHref('http://laravel.com')->setExternal()->toArray(),
            (new NE())->setId(2)->setFilter('relative')->setType(NE::TYPE_BOOTSTRAP_LINK)->setBody('Home')
                ->setTitle('Go Home!')->setHref('/home')->setIcon('fa')->toArray(),
        ]);

        $this->assertSame(
            '<li title="Go Home!"><a href="/home"><span class="fa"></span> Home</a></li>',
            $this->builder()->prepare(['external', 'relative'])->render('relative')
        );
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_dropdown_with_separator_and_link()
    {
        $this->insert([
            (new NE())->setId(1)->setType(NE::TYPE_BOOTSTRAP_DROPDOWN)->setGroup()->toArray(),
            (new NE())->setId(2)->setPid(1)->setType(NE::TYPE_BOOTSTRAP_SEPARATOR)->toArray(),
            (new NE())->setId(3)->setPid(1)->setType(NE::TYPE_BOOTSTRAP_LINK)->setBody('Identical')->setHref('/cool')
                ->setPosition(0)->toArray(),
        ]);

        $this->assertSame(
            '<li class="dropdown">' .
            '<a id="dropdown_1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ' .
            'aria-expanded="false" navbar-pid="1" navbar-container="ul"><span class="caret"></span></a>' .
            '<ul class="dropdown-menu">' .
            '<li role="separator" class="divider"></li>' .
            '<li><a href="/cool">Identical</a></li>' .
            '</ul></li>',
            $this->render()
        );
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_links_with_roles()
    {
        $link = (new NE())->setType(NE::TYPE_BOOTSTRAP_LINK);

        $this->insert([
            $link->setId(1)->setBody('Home')->setHref('/home')->setRole(2)->toArray(),
            $link->setId(2)->setBody('About')->setHref('/about')->setRole(4)->toArray(),
            $link->setId(3)->setBody('Forum')->setHref('/forum')->setRole(6)->toArray(),
            $link->setId(4)->setBody('Dashboard')->setHref('/dashboard')->setRole(8)->toArray(),
        ]);

        $this->assertSame(
            '<li class="active"><a href="/home">Home</a></li>' .
            '<li><a href="/about">About</a></li>' .
            '<li><a href="/forum">Forum</a></li>',
            $this->builder((new NavbarConfig())->setPath('home')->setRoles([2, 4, 6]))->render()
        );
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_links_with_permissions()
    {
        $link = (new NE())->setType(NE::TYPE_BOOTSTRAP_LINK);

        $this->insert([
            $link->setId(1)->setBody('Home')->setHref('/home')->setPermission(2)->toArray(),
            $link->setId(2)->setBody('About')->setHref('/about')->setPermission(4)->toArray(),
            $link->setId(3)->setBody('Forum')->setHref('/forum')->setPermission(6)->toArray(),
            $link->setId(4)->setBody('Dashboard')->setHref('/dashboard')->setPermission(8)->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/forum">Forum</a></li><li><a href="/dashboard">Dashboard</a></li>',
            $this->builder((new NavbarConfig())->setPath('about')->setPermissions([6, 8]))->render()
        );
    }

}

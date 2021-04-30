<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Unit\Traits;

use Zablose\Navbar\NavbarConfig;
use Zablose\Navbar\Tests\DatabaseTrait;
use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\UnitTestCase;

class BasicRendersTraitTest extends UnitTestCase
{
    use DatabaseTrait;

    /** @test */
    public function render_with_order_by_href_asc()
    {
        $list = (new NE())->setId()->setType(NE::TYPE_LIST)->setGroup()->setBody('General');
        $link = (new NE())->setPid($list->id)->setType(NE::TYPE_LINK);

        $this->insert(
            [
                $list->setHref('/about')->toArray(),
                $link->setId()->setHref('/about/terms')->toArray(),
                $link->setId()->setHref('/about/policy')->toArray(),
                $link->setId()->setHref('/about/me')->toArray(),
            ]
        );

        $this->assertSame(
            '<div class="app-label">General</div>'.
            '<ul>'.
            '<li><a href="/about/me"></a></li>'.
            '<li><a href="/about/policy"></a></li>'.
            '<li><a href="/about/terms"></a></li>'.
            '</ul>',
            $this->builder()->orderBy('href')->render()
        );
    }

    /** @test */
    public function render_with_order_by_href_desc()
    {
        $sublist = (new NE())->setId()->setType(NE::TYPE_SUBLIST)->setGroup();
        $link = (new NE())->setPid($sublist->id)->setType(NE::TYPE_LINK);

        $this->insert(
            [
                $sublist->setHref('/about')->toArray(),
                $link->setId()->setHref('/about/terms')->toArray(),
                $link->setId()->setHref('/about/policy')->toArray(),
                $link->setId()->setHref('/about/me')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/about"></a><ul>'.
            '<li><a href="/about/terms"></a></li>'.
            '<li><a href="/about/policy"></a></li>'.
            '<li><a href="/about/me"></a></li>'.
            '</ul></li>',
            $this->builder()->orderBy('href', 'desc')->render()
        );
    }

    /** @test */
    public function render_link()
    {
        $this->insert(
            [
                (new NE())->setId()->setType(NE::TYPE_LINK)->setBody('Home')->setTitle('Go Home!')
                    ->setHref('/home')->setIcon('fas fa-home')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/home" title="Go Home!">'.
            '<span class="app-icon"><i class="fas fa-home"></i></span>Home</a></li>',
            $this->render()
        );
    }

    /** @test */
    public function render_external_link()
    {
        $this->insert(
            [
                (new NE())->setId()->setType(NE::TYPE_LINK)->setBody('Laravel')->setTitle('Coding')
                    ->setHref('http://laravel.com')->setExternal()->setClass('lar')->setIcon('fas fa-book')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="http://laravel.com" title="Coding" target="_blank" rel="noopener" class="lar">'.
            '<span class="app-icon"><i class="fas fa-book"></i></span>Laravel</a></li>',
            $this->render()
        );
    }

    /** @test */
    public function render_link_with_custom_attributes()
    {
        $this->insert(
            [
                (new NE())->setId()->setType(NE::TYPE_LINK)->setAttrs(
                    [
                        '@click' => 'toggle',
                        ':class' => '{bold: isFolder}',
                        'test' => '',
                    ]
                )->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a @click="toggle" :class="{bold: isFolder}" href="/" class="app-is-active"></a></li>',
            $this->render()
        );
    }

    /** @test */
    public function ignore_elements_if_root_element_inaccessible()
    {
        $sublist = (new NE())->setType(NE::TYPE_SUBLIST)->setRole('admin')->setGroup();
        $link = (new NE())->setType(NE::TYPE_LINK)->setRole('user');

        $this->insert(
            [
                $sublist->setId()->setHref('/one')->toArray(),
                $link->setId()->setPid($sublist->id)->setHref('/two')->toArray(),
                $link->setId()->setPid(0)->setHref('/hi')->setBody('Hi')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/hi">Hi</a></li>',
            $this->builder((new NavbarConfig())->setRoles(['user']))->render()
        );
    }

    /** @test */
    public function render_with_filter()
    {
        $link = (new NE())->setType(NE::TYPE_LINK);

        $this->insert(
            [
                $link->setId()->setHref('/me')->setBody('Me')->toArray(),
                $link->setFilter('packages')->setId()->setHref('/git')->setBody('Git')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/me">Me</a></li><li><a href="/git">Git</a></li>',
            $this->render(['main', 'packages'])
        );
    }

    /** @test */
    public function render_links_with_roles()
    {
        $link = (new NE())->setType(NE::TYPE_LINK);

        $this->insert(
            [
                $link->setId()->setBody('Home')->setHref('/home')->setRole('2')->toArray(),
                $link->setId()->setBody('About')->setHref('/about')->setRole('4')->toArray(),
                $link->setId()->setBody('Forum')->setHref('/forum')->setRole('6')->toArray(),
                $link->setId()->setBody('Dashboard')->setHref('/dashboard')->setRole('admin')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/home" class="app-is-active">Home</a></li>'.
            '<li><a href="/about">About</a></li>'.
            '<li><a href="/forum">Forum</a></li>',
            $this->builder((new NavbarConfig())->setPath('home')->setRoles(['2', '4', '6']))->render()
        );
    }

    /** @test */
    public function render_links_with_permissions()
    {
        $link = (new NE())->setType(NE::TYPE_LINK);

        $this->insert(
            [
                $link->setId()->setBody('Home')->setHref('/home')->setPermission('2')->toArray(),
                $link->setId()->setBody('About')->setHref('/about')->setPermission('4')->toArray(),
                $link->setId()->setBody('Forum')->setHref('/forum')->setPermission('6')->toArray(),
                $link->setId()->setBody('Dashboard')->setHref('/dashboard')->setPermission('admin')->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/forum">Forum</a></li><li><a href="/dashboard">Dashboard</a></li>',
            $this->builder((new NavbarConfig())->setPath('about')->setPermissions(['6', 'admin']))->render()
        );
    }

    /** @test */
    public function render_links_with_positioning()
    {
        $link = (new NE())->setType(NE::TYPE_LINK);

        $this->insert(
            [
                $link->setId()->setBody('Home')->setHref('/home')->setPosition(6)->toArray(),
                $link->setId()->setBody('About')->setHref('/about')->setPosition(4)->toArray(),
                $link->setId()->setBody('Forum')->setHref('/forum')->setPosition(1)->toArray(),
            ]
        );

        $this->assertSame(
            '<li><a href="/forum">Forum</a></li>'.
            '<li><a href="/about">About</a></li>'.
            '<li><a href="/home">Home</a></li>',
            $this->render()
        );
    }
}

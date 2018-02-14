<?php

namespace Zablose\Navbar\Tests\Renders;

use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Tests\Traits\DatabaseTrait;

class CommonRendersTest extends TestCase
{

    use DatabaseTrait;

    /**
     * @test
     *
     * @throws \Exception
     */
    public function ignore_protected_methods()
    {
        $this->insert([
            (new NE())->setType('renderLink')->setBody('General')->toArray(),
        ]);

        $this->assertSame('', $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_with_order_by_href_asc()
    {
        $list = (new NE())->setId(1)->setType(NE::TYPE_BULMA_MENU_SUBLIST)->setGroup();
        $link = (new NE())->setPid($list->id)->setType(NE::TYPE_BULMA_MENU_LINK);

        $this->insert([
            $list->setHref('/about')->toArray(),
            $link->setId(2)->setHref('/about/terms')->toArray(),
            $link->setId(3)->setHref('/about/policy')->toArray(),
            $link->setId(4)->setHref('/about/me')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/about"></a><ul>'
            . '<li><a href="/about/me"></a></li>'
            . '<li><a href="/about/policy"></a></li>'
            . '<li><a href="/about/terms"></a></li>' .
            '</ul></li>',
            $this->builder()->orderBy('href')->render()
        );
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_with_order_by_href_desc()
    {
        $list = (new NE())->setId(1)->setType(NE::TYPE_BULMA_MENU_SUBLIST)->setGroup();
        $link = (new NE())->setPid($list->id)->setType(NE::TYPE_BULMA_MENU_LINK);

        $this->insert([
            $list->setHref('/about')->toArray(),
            $link->setId(2)->setHref('/about/terms')->toArray(),
            $link->setId(3)->setHref('/about/policy')->toArray(),
            $link->setId(4)->setHref('/about/me')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/about"></a><ul>'
            . '<li><a href="/about/terms"></a></li>'
            . '<li><a href="/about/policy"></a></li>'
            . '<li><a href="/about/me"></a></li>' .
            '</ul></li>',
            $this->builder()->orderBy('href', 'desc')->render()
        );
    }

}

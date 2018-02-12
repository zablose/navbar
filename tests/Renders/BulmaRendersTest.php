<?php

namespace Zablose\Navbar\Tests\Renders;

use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Tests\Traits\DatabaseTrait;

class BulmaRendersTest extends TestCase
{

    use DatabaseTrait;

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_menu_label()
    {
        $this->insert([
            (new NE())->setType(NE::TYPE_BULMA_MENU_LABEL)->setBody('General')->toArray(),
        ]);

        $this->assertSame('<p class="menu-label">General</p>', $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_menu()
    {
        $list = (new NE())->setId(1)->setType(NE::TYPE_BULMA_MENU_LIST)->setGroup();
        $link = (new NE())->setPid(1)->setType(NE::TYPE_BULMA_MENU_LIST_LINK);

        $this->insert([
            $list->toArray(),
            $link->setId(2)->setBody('Home')->setHref('/')->toArray(),
            $link->setId(3)->setBody('Company')->setHref('https://vuejs.org/')->setExternal()->toArray(),
        ]);

        $expected = '<ul class="menu-list">'
            . '<li><a href="/" class="active">Home</a></li>'
            . '<li><a href="https://vuejs.org/" target="_blank">Company</a></li>'
            . '</ul>';

        $this->assertSame($expected, $this->render());
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_menu_sublist()
    {
        $link  = (new NE())->setType(NE::TYPE_BULMA_MENU_LIST_LINK);
        $about = (new NE())->setType(NE::TYPE_BULMA_MENU_SUBLIST)->setGroup();

        $this->insert([
            $about->setId(5)->setBody('About')->setHref('/about')->toArray(),
            $link->setId(6)->setPid($about->id)->setBody('Me')->setHref('/about/me')->toArray(),
            $link->setId(7)->setPid($about->id)->setBody('Tech')->setHref('/about/tech')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/about">About</a>' .
            '<ul>'
            . '<li><a href="/about/me">Me</a></li>'
            . '<li><a href="/about/tech">Tech</a></li>' .
            '</ul>' .
            '</li>',
            $this->render()
        );
    }

}

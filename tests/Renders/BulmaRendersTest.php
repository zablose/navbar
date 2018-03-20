<?php

namespace Zablose\Navbar\Tests\Renders;

use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Tests\Traits\DatabaseTrait;

class BulmaRendersTest extends TestCase
{

    use DatabaseTrait;

    /** @test */
    public function render_menu_label()
    {
        $this->insert([
            (new NE())->setType(NE::TYPE_BULMA_MENU_LABEL)->setBody('General')->toArray(),
        ]);

        $this->assertSame('<p class="menu-label">General</p>', $this->render());
    }

    /** @test */
    public function render_menu()
    {
        $list = (new NE())->setId()->setType(NE::TYPE_BULMA_MENU_LIST)->setGroup();
        $link = (new NE())->setPid(1)->setType(NE::TYPE_BULMA_MENU_LINK);

        $this->insert([
            $list->toArray(),
            $link->setId()->setBody('Home')->setHref('/')->toArray(),
            $link->setId()->setBody('Company')->setHref('https://vuejs.org/')->setExternal()->toArray(),
        ]);

        $expected = '<ul class="menu-list">'
            . '<li><a href="/" class="is-active"><p>Home</p></a></li>'
            . '<li><a href="https://vuejs.org/" target="_blank" rel="noopener"><p>Company</p></a></li>'
            . '</ul>';

        $this->assertSame($expected, $this->render());
    }

    /** @test */
    public function render_menu_sublist()
    {
        $link  = (new NE())->setType(NE::TYPE_BULMA_MENU_LINK);
        $about = (new NE())->setType(NE::TYPE_BULMA_MENU_SUBLIST)->setGroup();

        $this->insert([
            $about->setId()->setBody('About')->setHref('/about')->toArray(),
            $link->setId()->setPid($about->id)->setBody('Me')->setHref('/about/me')->toArray(),
            $link->setId()->setPid($about->id)->setBody('Tech')->setHref('/about/tech')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/about"><p>About</p></a>' .
            '<ul>'
            . '<li><a href="/about/me"><p>Me</p></a></li>'
            . '<li><a href="/about/tech"><p>Tech</p></a></li>' .
            '</ul>' .
            '</li>',
            $this->render()
        );
    }

    /** @test */
    public function render_bulma_icon()
    {
        $this->insert([
            (new NE())->setId()->setType(NE::TYPE_BULMA_MENU_LINK)->setBody('Home')->setIcon('cogs')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/" class="is-active"><span class="icon"><i class="fas cogs"></i></span><p>Home</p></a></li>',
            $this->render()
        );
    }

}

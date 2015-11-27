<?php

use Zablose\Navbar\NavbarEntity;

class NavbarEntityTest extends PHPUnit_Framework_TestCase
{

    public function dataProviderFor_renderWithPrefixPostfix()
    {
        return [
            [ '', '', '', '' ],
            [ 'fa', '', '', 'fa' ],
            [ 'fa', '', 'fa-book', 'fa fa-book' ],
            [ '', 'fa', 'fa-book', 'fa fa-book' ],
            [ 'fa', 'active', 'fa-book', 'active fa fa-book' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_renderWithPrefixPostfix
     *
     * @param string $string
     * @param string $prefix
     * @param string $postfix
     * @param string $expected
     */
    public function testRenderWithPrefixPostfix($string, $prefix, $postfix, $expected)
    {
        $navbar = new NavbarEntity();
        $navbar->class = $string;
        $navbar->body = $string;

        $this->assertEquals($expected, $navbar->renderClass($prefix, $postfix));
        $this->assertEquals($expected, $navbar->renderBody($prefix, $postfix));
    }

    public function testRenderIcon()
    {
        $navbar = new NavbarEntity();

        $navbar->icon = 'fa fa-book';
        $this->assertEquals('<span class="fa fa-book"></span>', $navbar->renderIcon());

        $navbar->icon = '';
        $this->assertEquals('', $navbar->renderIcon());

        $navbar->icon = null;
        $this->assertEquals('', $navbar->renderIcon());
    }

}

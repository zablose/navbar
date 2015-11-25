<?php

use Zablose\Navbar\NavbarEntity;

class NavbarEntityTest extends PHPUnit_Framework_TestCase
{

    public function dataProviderFor_testIsPublic()
    {
        return [
            [ 0, 0, true ],
            [ 2, 0, false ],
            [ 3, 5, false ],
            [ 0, 4, false ],
            [ '', '', true ],
            [ null, null, true ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testIsPublic
     *
     * @param integer $role_id
     * @param integer $permission_id
     * @param boolean $expected
     */
    public function testIsPublic($role_id, $permission_id, $expected)
    {
        $navbar = new NavbarEntity([
            'role_id'       => $role_id,
            'permission_id' => $permission_id,
        ]);

        $this->assertEquals($expected, $navbar->isPublic());
    }

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
        $navbar->title = $string;

        $this->assertEquals($expected, $navbar->renderClass($prefix, $postfix));
        $this->assertEquals($expected, $navbar->renderTitle($prefix, $postfix));
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

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

    public function dataProviderFor_testPostfix()
    {
        return [
            [ '', 'active', 'active' ],
            [ 'nav navbar', 'active', 'nav navbar active' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testPostfix
     *
     * @param string $class
     * @param string $classToAdd
     * @param string $expected
     */
    public function testPostfix($class, $classToAdd, $expected)
    {
        $navbar = new NavbarEntity([
            'class'       => $class,
        ]);

        $this->assertEquals($expected, $navbar->postfix('class', $classToAdd)->class);
    }

    public function dataProviderFor_testPrefix()
    {
        return [
            [ '', 'Dropdown', 'Dropdown' ],
            [ 'Dropdown', 'Mega', 'Mega Dropdown' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testPrefix
     *
     * @param string $title
     * @param string $titleToInsert
     * @param string $expected
     */
    public function testPrefix($title, $titleToInsert, $expected)
    {
        $navbar = new NavbarEntity([
            'title'       => $title,
        ]);

        $this->assertEquals($expected, $navbar->prefix('title', $titleToInsert)->title);
    }

}

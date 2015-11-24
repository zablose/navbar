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

    public function dataProviderFor_testAddClass()
    {
        return [
            [ '', 'active', 'active' ],
            [ 'nav navbar', 'active', 'nav navbar active' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testAddClass
     *
     * @param string $class
     * @param string $classToAdd
     * @param string $expected
     */
    public function testAddClass($class, $classToAdd, $expected)
    {
        $navbar = new NavbarEntity([
            'class'       => $class,
        ]);

        $this->assertEquals($expected, $navbar->addClass($classToAdd)->class);
    }

}

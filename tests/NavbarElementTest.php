<?php

use Zablose\Navbar\NavbarElement;

class NavbarElementTest extends PHPUnit_Framework_TestCase
{

    public function dataProviderFor_testCheckAttributes()
    {
        return [
            ['type'],
            ['entity'],
            ['content'],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testCheckAttributes
     *
     * @param string $name
     */
    public function testCheckAttributes($name)
    {
        $this->assertClassHasAttribute($name, NavbarElement::class);
    }

    public function testGetTypes()
    {
        $types = [
            'renderElementAsEntity',
            'renderElementAsGroup'
        ];

        $this->assertEquals($types, NavbarElement::getTypes());
    }

}

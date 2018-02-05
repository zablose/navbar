<?php

use Zablose\Navbar\NavbarElement;

class NavbarElementTest extends PHPUnit\Framework\TestCase
{

    /**
     * @return array
     */
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
     *
     * @throws Exception
     */
    public function testCheckAttributes($name)
    {
        $this->assertClassHasAttribute($name, NavbarElement::class);
    }

}

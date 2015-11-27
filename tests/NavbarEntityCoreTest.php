<?php

use Zablose\Navbar\NavbarEntityCore;

class NavbarEntityCoreTest extends PHPUnit_Framework_TestCase
{

    public function testGetTypes()
    {
        $this->assertEquals(9, count(NavbarTestEntity::getTypes()));
    }

    public function testGetGroupTypes()
    {
        $this->assertEquals(4, count(NavbarTestEntity::getGroupTypes()));
    }

    public function testIsGroup()
    {
        $entity = new NavbarTestEntity();

        $this->assertFalse($entity->isGroup());

        $entity->type = NavbarTestEntity::TYPE_CUSTOM_NAVBAR;
        $this->assertTrue($entity->isGroup());
    }

}

class NavbarTestEntity extends NavbarEntityCore
{

    const TYPE_CUSTOM_HEADER = 'custom_header';
    const TYPE_CUSTOM_NAVBAR = 'custom_navbar';

    public $type;

    public function renderClass($prefix = null, $postfix = null)
    {

    }

    public function renderIcon()
    {

    }

    public function renderBody($prefix = null, $postfix = null)
    {

    }

}

NavbarTestEntity::$custom_types = [
    NavbarTestEntity::TYPE_CUSTOM_HEADER,
    NavbarTestEntity::TYPE_CUSTOM_NAVBAR,
];

NavbarTestEntity::$custom_group_types = [
    NavbarTestEntity::TYPE_CUSTOM_NAVBAR,
];

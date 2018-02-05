<?php

use Zablose\Navbar\NavbarEntityCore;

class NavbarEntityCoreTest extends PHPUnit\Framework\TestCase
{

    /**
     * @throws Exception
     */
    public function testGetTypes()
    {
        $this->assertEquals(8, count(NavbarTestEntity::getTypes()));
    }

    /**
     * @throws Exception
     */
    public function testGetGroupTypes()
    {
        $this->assertEquals(3, count(NavbarTestEntity::getGroupTypes()));
    }

    /**
     * @throws Exception
     */
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

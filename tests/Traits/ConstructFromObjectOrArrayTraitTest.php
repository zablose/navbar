<?php

use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

class ConstructFromObjectOrArrayTraitTest extends PHPUnit\Framework\TestCase
{

    /**
     * @var array
     */
    protected $default_attributes = [
        'id'   => TestObject::DEFAULT_ID,
        'name' => TestObject::DEFAULT_NAME,
    ];

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_updates_existing_attributes()
    {
        $this->assertSame(
            $data = ['id' => 34, 'name' => 'Bamboo'],
            get_object_vars(new TestObject($data))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_updates_existing_attribute_with_an_empty_string()
    {
        $this->assertSame(
            $data = ['id' => 67, 'name' => ''],
            get_object_vars(new TestObject($data))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_ignores_existing_attribute_if_null()
    {
        $this->assertSame(
            $this->default_attributes,
            get_object_vars(new TestObject(['id' => null]))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_constructs_from_an_object()
    {
        $this->assertSame(
            $data = ['id' => 12, 'name' => 'Zablockis'],
            get_object_vars(new TestObject((object) $data))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_ignores_null()
    {
        $this->assertSame(
            $this->default_attributes,
            get_object_vars(new TestObject(null))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_ignores_string()
    {
        $this->assertSame(
            $this->default_attributes,
            get_object_vars(new TestObject('hi'))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_ignores_integer()
    {
        $this->assertSame(
            $this->default_attributes,
            get_object_vars(new TestObject(365))
        );
    }

    /**
     * @test
     *
     * @throws Exception
     */
    public function it_ignores_not_existing_attribute()
    {
        $this->assertFalse(isset((new TestObject(['age' => 13]))->age));
    }

}

class TestObject
{

    use ConstructFromObjectOrArrayTrait;

    const DEFAULT_ID   = 4;
    const DEFAULT_NAME = 'Zablose';

    public $id = self::DEFAULT_ID;
    public $name = self::DEFAULT_NAME;

}

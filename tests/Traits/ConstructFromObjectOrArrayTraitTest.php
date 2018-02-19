<?php

namespace Zablose\Navbar\Tests\Traits;

use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

class ConstructFromObjectOrArrayTraitTest extends TestCase
{

    /** @var array */
    protected static $default_data_set;

    /** @var mixed */
    protected static $test_object_class;

    public static function setUpBeforeClass()
    {
        self::$test_object_class = new Class()
        {

            use ConstructFromObjectOrArrayTrait;

            const DEFAULT_ID   = 4;
            const DEFAULT_NAME = 'Zablose';

            public $id = self::DEFAULT_ID;
            public $name = self::DEFAULT_NAME;

        };

        self::$default_data_set = [
            'id'   => self::$test_object_class::DEFAULT_ID,
            'name' => self::$test_object_class::DEFAULT_NAME,
        ];
    }

    /**
     * @param object|array $data
     *
     * @return array
     */
    protected function getObjectVars($data)
    {
        return get_object_vars(new self::$test_object_class($data));
    }

    /** @test */
    public function update_existing_attributes()
    {
        $this->assertSame(
            $data = ['id' => 34, 'name' => 'Bamboo'],
            $this->getObjectVars($data)
        );
    }

    /** @test */
    public function update_existing_attribute_with_an_empty_string()
    {
        $this->assertSame(
            $data = ['id' => 67, 'name' => ''],
            $this->getObjectVars($data)
        );
    }

    /** @test */
    public function ignore_existing_attribute_if_null()
    {
        $this->assertSame(
            self::$default_data_set,
            $this->getObjectVars(['id' => null])
        );
    }

    /** @test */
    public function construct_from_an_object()
    {
        $this->assertSame(
            $data = ['id' => 12, 'name' => 'Zablockis'],
            $this->getObjectVars((object) $data)
        );
    }

    /** @test */
    public function ignore_null()
    {
        $this->assertSame(
            self::$default_data_set,
            $this->getObjectVars(null)
        );
    }

    /** @test */
    public function ignore_string()
    {
        $this->assertSame(
            self::$default_data_set,
            $this->getObjectVars('hi')
        );
    }

    /** @test */
    public function ignore_integer()
    {
        $this->assertSame(
            self::$default_data_set,
            $this->getObjectVars(365)
        );
    }

    /** @test */
    public function ignore_not_existing_attribute()
    {
        $this->assertFalse(isset((new self::$test_object_class(['age' => 13]))->age));
    }

}

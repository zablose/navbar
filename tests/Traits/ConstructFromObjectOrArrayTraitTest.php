<?php

class ConstructFromObjectOrArrayTraitTest extends PHPUnit\Framework\TestCase
{

    /**
     * @return array
     */
    public function dataProviderFor_test__construct()
    {
        return [
            [
                ['id' => 34, 'name' => 'Sergejs', 'title' => 'Mr'],
                ['id' => 34, 'name' => 'Sergejs'],
            ],
            [
                ['id' => 34, 'name' => 'Sergejs'],
                ['id' => 34, 'name' => 'Sergejs'],
            ],
            [
                ['id' => 23, 'name' => ''],
                ['id' => 23, 'name' => ''],
            ],
            [
                ['id' => 12],
                ['id' => 12, 'name' => 'Zablose'],
            ],
            [
                (object) ['id' => 12, 'name' => 'Zablockis'],
                ['id' => 12, 'name' => 'Zablockis'],
            ],
            [
                null,
                ['id' => 4, 'name' => 'Zablose'],
            ],
            [
                'hi',
                ['id' => 4, 'name' => 'Zablose'],
            ],
            [
                365,
                ['id' => 4, 'name' => 'Zablose'],
            ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_test__construct
     *
     * @param array|object $data
     *
     * @throws Exception
     */
    public function test__construct($data, $expected)
    {
        $this->assertEquals($expected, get_object_vars(new TestObject($data)));
    }

    /**
     * @throws Exception
     */
    public function test__constructOnEmptyObject()
    {
        $this->assertEquals([], get_object_vars(new TestEmptyObject(['id' => 13])));
    }

}

class TestObject
{

    use \Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

    public $id = 4;
    public $name = 'Zablose';

}

class TestEmptyObject
{

    use \Zablose\Navbar\Traits\ConstructFromObjectOrArrayTrait;

}

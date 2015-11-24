<?php

use Zablose\Navbar\Helpers\Tag;

class TagTest extends PHPUnit_Framework_TestCase
{

    public function dataProviderFor_testAttrs()
    {
        return [
            [ ['class' => 'active'], 'class="active"' ],
            [ ['class' => ''], 'class=""' ],
            [ ['class' => null], 'class=""' ],
            [ ['disabled'], 'disabled="disabled"' ],
            [ null, '' ],
            [ '', '' ],
            [ 2, '' ],
            [ [], '' ],
            [ 'adfgsh', '' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testAttrs
     *
     * @param array $attrs
     * @param string $expected
     */
    public function testAttrs($attrs, $expected)
    {
        $this->assertEquals($expected, Tag::attrs($attrs));
    }

}

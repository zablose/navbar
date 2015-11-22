<?php

use Zablose\Navbar\Helpers\Tag;

class TagTest extends PHPUnit_Framework_TestCase
{

    public function attrsProvider()
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
     * @dataProvider attrsProvider
     * @test
     */
    public function it_renders_tag_attributes($attrs, $expected)
    {
        $actual = Tag::attrs($attrs);
        $this->assertEquals($expected, $actual);
    }

}

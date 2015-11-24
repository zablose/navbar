<?php

use Zablose\Navbar\Helpers\Html;

class HtmlTest extends PHPUnit_Framework_TestCase
{

    public function dataProviderFor_testTag()
    {
        return [
            [ 'li', [], null, '<li></li>'],
            [ 'div', [], 'Div', '<div>Div</div>'],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testTag
     *
     * @param string $name
     * @param array $attrs
     * @param string $body
     * @param string $expected
     */
    public function testTag($name, $attrs, $body, $expected)
    {
        $this->assertEquals($expected, Html::tag($name, $attrs, $body));
    }

    public function dataProviderFor_testAttrs()
    {
        return [
            [ ['class' => 'active'], ' class="active"'],
            [ ['class' => ''], ' class=""'],
            [ ['class' => null], ' class=""'],
            [ ['disabled'], ' disabled="disabled"'],
            [ null, ''],
            [ '', ''],
            [ 2, ''],
            [ [], ''],
            [ 'adfgsh', ''],
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
        $this->assertEquals($expected, Html::attrs($attrs));
    }

}

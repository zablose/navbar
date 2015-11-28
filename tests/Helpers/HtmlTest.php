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
            [ ['class' => ''], ''],
            [ ['class' => null], ''],
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

    public function dataProviderFor_testPostfix()
    {
        return [
            [ '', 'active', 'active' ],
            [ 'nav navbar', 'active', 'nav navbar active' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testPostfix
     *
     * @param string $string
     * @param string $postfix
     * @param string $expected
     */
    public function testPostfix($string, $postfix, $expected)
    {
        $this->assertEquals($expected, Html::postfix($string, $postfix));
    }

    public function dataProviderFor_testPrefix()
    {
        return [
            [ '', 'Dropdown', 'Dropdown' ],
            [ 'Dropdown', 'Mega', 'Mega Dropdown' ],
        ];
    }

    /**
     * @dataProvider dataProviderFor_testPrefix
     *
     * @param string $string
     * @param string $prefix
     * @param string $expected
     */
    public function testPrefix($string, $prefix, $expected)
    {
        $this->assertEquals($expected, Html::prefix($string, $prefix));
    }

}

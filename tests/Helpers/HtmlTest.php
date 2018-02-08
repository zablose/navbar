<?php

namespace Zablose\Navbar\Tests\Helpers;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\Tests\TestCase;

class HtmlTest extends TestCase
{

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_tag_with_null_body()
    {
        $this->assertSame('<li></li>', Html::tag('li', [], null));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_tag_with_body()
    {
        $this->assertSame('<div>Div</div>', Html::tag('div', [], 'Div'));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_attribute_with_key_and_value()
    {
        $this->assertSame(' class="active"', Html::attrs(['class' => 'active']));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_attribute_with_value()
    {
        $this->assertSame(' disabled="disabled"', Html::attrs(['disabled']));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function ignore_attribute_with_key_and_empty_value()
    {
        $this->assertSame('', Html::attrs(['class' => '']));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function ignore_attribute_with_key_and_null_value()
    {
        $this->assertSame('', Html::attrs(['class' => null]));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function ignore_attribute_with_null_value()
    {
        $this->assertSame('', Html::attrs(null));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_attributes_from_an_empty_string()
    {
        $this->assertSame('', Html::attrs(''));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_attributes_from_an_integer()
    {
        $this->assertSame('', Html::attrs(2));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_attributes_from_a_string()
    {
        $this->assertSame('', Html::attrs('class'));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function render_attributes_from_an_empty_array()
    {
        $this->assertSame('', Html::attrs([]));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function postfix_a_string()
    {
        $this->assertSame('nav navbar active', Html::postfix('nav navbar', 'active'));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function postfix_an_empty_string()
    {
        $this->assertSame('active', Html::postfix('', 'active'));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function prefix_a_string()
    {
        $this->assertSame('Mega Dropdown', Html::prefix('Dropdown', 'Mega'));
    }

    /**
     * @test
     *
     * @throws \Exception
     */
    public function prefix_an_empty_string()
    {
        $this->assertSame('Dropdown', Html::prefix('', 'Dropdown'));
    }

}

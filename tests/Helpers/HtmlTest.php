<?php

namespace Zablose\Navbar\Tests\Helpers;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\Tests\TestCase;

class HtmlTest extends TestCase
{

    /** @test */
    public function render_tag_with_null_body()
    {
        $this->assertSame('<li></li>', Html::tag('li', [], null));
    }

    /** @test */
    public function render_tag_with_body()
    {
        $this->assertSame('<div>Div</div>', Html::tag('div', [], 'Div'));
    }

    /** @test */
    public function render_attribute_with_key_and_value()
    {
        $this->assertSame(' class="active"', Html::attrs(['class' => 'active']));
    }

    /** @test */
    public function render_attribute_with_value()
    {
        $this->assertSame(' disabled="disabled"', Html::attrs(['disabled']));
    }

    /** @test */
    public function ignore_attribute_with_key_and_empty_value()
    {
        $this->assertSame('', Html::attrs(['class' => '']));
    }

    /** @test */
    public function ignore_attribute_with_key_and_null_value()
    {
        $this->assertSame('', Html::attrs(['class' => null]));
    }

    /** @test */
    public function ignore_attribute_with_null_value()
    {
        $this->assertSame('', Html::attrs(null));
    }

    /** @test */
    public function render_attributes_from_an_empty_string()
    {
        $this->assertSame('', Html::attrs(''));
    }

    /** @test */
    public function render_attributes_from_an_integer()
    {
        $this->assertSame('', Html::attrs(2));
    }

    /** @test */
    public function render_attributes_from_a_string()
    {
        $this->assertSame('', Html::attrs('class'));
    }

    /** @test */
    public function render_attributes_from_an_empty_array()
    {
        $this->assertSame('', Html::attrs([]));
    }

    /** @test */
    public function postfix_a_string()
    {
        $this->assertSame('nav navbar active', Html::postfix('nav navbar', 'active'));
    }

    /** @test */
    public function postfix_an_empty_string()
    {
        $this->assertSame('active', Html::postfix('', 'active'));
    }

    /** @test */
    public function prefix_a_string()
    {
        $this->assertSame('Mega Dropdown', Html::prefix('Dropdown', 'Mega'));
    }

    /** @test */
    public function prefix_an_empty_string()
    {
        $this->assertSame('Dropdown', Html::prefix('', 'Dropdown'));
    }

}

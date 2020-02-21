<?php declare(strict_types=1);

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
    public function render_tag_with_attributes()
    {
        $this->assertSame('<a href="/">Link</a>', Html::tag('a', ['href' => '/'], 'Link'));
    }

    /** @test */
    public function render_attribute_with_key_and_value()
    {
        $this->assertSame('class="active"', Html::attrs(['class' => 'active']));
    }

    /** @test */
    public function render_attribute_with_value()
    {
        $this->assertSame('disabled="disabled"', Html::attrs(['disabled']));
    }

    /** @test */
    public function render_attribute_with_key_and_empty_value()
    {
        $this->assertSame('class=""', Html::attrs(['class' => '']));
    }

    /** @test */
    public function render_attribute_with_key_and_null_value()
    {
        $this->assertSame('class=""', Html::attrs(['class' => null]));
    }

    /** @test */
    public function render_attributes_from_an_empty_array_to_an_empty_string()
    {
        $this->assertSame('', Html::attrs([]));
    }
}

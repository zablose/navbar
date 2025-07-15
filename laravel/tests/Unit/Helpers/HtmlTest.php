<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Unit\Helpers;

use PHPUnit\Framework\Attributes\Test;
use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\Tests\UnitTestCase;

class HtmlTest extends UnitTestCase
{
    #[Test]
    public function render_tag_only()
    {
        $this->assertSame('<li></li>', Html::tag('li'));
    }

    #[Test]
    public function render_tag_with_body()
    {
        $this->assertSame('<div>Div</div>', Html::tag('div', 'Div'));
    }

    #[Test]
    public function render_tag_with_attribute()
    {
        $this->assertSame('<a href="/"></a>', Html::tag('a', '', ['href' => '/']));
    }

    #[Test]
    public function render_tag_with_body_and_attribute()
    {
        $this->assertSame('<a href="/">Link</a>', Html::tag('a', 'Link', ['href' => '/']));
    }

    #[Test]
    public function render_attribute_with_key_and_value()
    {
        $this->assertSame('class="active"', Html::attrs(['class' => 'active']));
    }

    #[Test]
    public function render_attribute_with_value_only()
    {
        $this->assertSame('disabled', Html::attrs(['disabled']));
    }

    #[Test]
    public function render_attribute_with_key_and_empty_value()
    {
        $this->assertSame('', Html::attrs(['class' => '']));
    }

    #[Test]
    public function render_attribute_with_key_and_null_value()
    {
        $this->assertSame('', Html::attrs(['class' => null]));
    }

    #[Test]
    public function render_attributes_from_an_empty_array_to_an_empty_string()
    {
        $this->assertSame('', Html::attrs([]));
    }

    #[Test]
    public function ignore_attribute_as_an_empty_string()
    {
        $this->assertSame('class="btn"', Html::attrs(['class' => 'btn', '']));
    }
}

<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Unit\Helpers;

use PHPUnit\Framework\Attributes\Test;
use stdClass;
use Zablose\Navbar\Helpers\Str;
use Zablose\Navbar\Tests\UnitTestCase;

class StrTest extends UnitTestCase
{
    #[Test]
    public function postfix_a_string()
    {
        $this->assertSame('btn btn-info', Str::postfix('btn', 'btn-info'));
    }

    #[Test]
    public function postfix_an_empty_string()
    {
        $this->assertSame('btn', Str::postfix('btn', ''));
    }

    #[Test]
    public function prefix_a_string()
    {
        $this->assertSame('btn-info btn', Str::prefix('btn-info', 'btn'));
    }

    #[Test]
    public function prefix_an_empty_string()
    {
        $this->assertSame('btn', Str::prefix('', 'btn'));
    }

    #[Test]
    public function implode_strings()
    {
        $this->assertSame('class="btn" disabled', Str::implode(['class="btn"', 'disabled']));
    }

    #[Test]
    public function implode_strings_only_and_ignore_empty_ones()
    {
        $this->assertSame('btn', Str::implode(['btn', '', null, false, true, new stdClass(), [], 2020]));
    }
}

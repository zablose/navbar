<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Unit\Helpers;

use stdClass;
use Zablose\Navbar\Helpers\Str;
use Zablose\Navbar\Tests\UnitTestCase;

class StrTest extends UnitTestCase
{
    /** @test */
    public function postfix_a_string()
    {
        $this->assertSame('btn btn-info', Str::postfix('btn', 'btn-info'));
    }

    /** @test */
    public function postfix_an_empty_string()
    {
        $this->assertSame('btn', Str::postfix('btn', ''));
    }

    /** @test */
    public function prefix_a_string()
    {
        $this->assertSame('btn-info btn', Str::prefix('btn-info', 'btn'));
    }

    /** @test */
    public function prefix_an_empty_string()
    {
        $this->assertSame('btn', Str::prefix('', 'btn'));
    }

    /** @test */
    public function implode_strings()
    {
        $this->assertSame('class="btn" disabled', Str::implode(['class="btn"', 'disabled']));
    }

    /** @test */
    public function implode_strings_only_and_ignore_empty_ones()
    {
        $this->assertSame('btn', Str::implode(['btn', '', null, false, true, new stdClass(), [], 2020]));
    }
}

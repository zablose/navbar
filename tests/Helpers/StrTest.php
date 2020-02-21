<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests\Helpers;

use Zablose\Navbar\Helpers\Str;
use Zablose\Navbar\Tests\TestCase;

class StrTest extends TestCase
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
}

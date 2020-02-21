<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests\Traits;

use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;

class CommonRendersTest extends TestCase
{
    use DatabaseTrait;

    /** @test */
    public function ignore_protected_methods()
    {
        $this->insert([
            (new NE())->setId()->setType('renderLink')->toArray(),
        ]);

        $this->assertSame('', $this->render());
    }

    /** @test */
    public function ignore_unknown_entity_type()
    {
        $this->insert([
            (new NE())->setId()->setType('unknown')->toArray(),
        ]);

        $this->assertSame('', $this->render());
    }
}

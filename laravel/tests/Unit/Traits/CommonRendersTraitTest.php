<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Unit\Traits;

use PHPUnit\Framework\Attributes\Test;
use Zablose\Navbar\Tests\DatabaseTrait;
use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\UnitTestCase;

class CommonRendersTraitTest extends UnitTestCase
{
    use DatabaseTrait;

    #[Test]
    public function ignore_protected_methods()
    {
        $this->insert(
            [
                (new NE())->setId()->setType('renderLink')->toArray(),
            ]
        );

        $this->assertSame('', $this->render());
    }

    #[Test]
    public function ignore_unknown_entity_type()
    {
        $this->insert(
            [
                (new NE())->setId()->setType('unknown')->toArray(),
            ]
        );

        $this->assertSame('', $this->render());
    }
}

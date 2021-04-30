<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Unit\Traits;

use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\UnitTestCase;

class NavbarSettersTraitTest extends UnitTestCase
{
    /** @test */
    public function set_id_and_reset_next_id()
    {
        $entity = (new NE())->setId(3)->setId();

        $this->assertTrue($entity->id === 4);

        NE::resetNextId();

        $entity->setId();

        $this->assertTrue($entity->id === 1);
    }

    /** @test */
    public function set_position_after_id()
    {
        $entity = (new NE())->setPosition(34)->setId();

        $this->assertTrue($entity->position === 1);

        $entity->setId()->setPosition(5);

        $this->assertTrue($entity->position === 5);
    }
}

<?php

namespace Zablose\Navbar\Tests\Renders;

use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Tests\Traits\DatabaseTrait;

class CommonRendersTest extends TestCase
{

    use DatabaseTrait;

    /**
     * @test
     *
     * @throws \Exception
     */
    public function ignore_protected_methods()
    {
        $this->insert([
            (new NE())->setType('renderLink')->setBody('General')->toArray(),
        ]);

        $this->assertSame('', $this->render());
    }

}

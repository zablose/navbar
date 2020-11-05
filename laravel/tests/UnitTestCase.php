<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests;

use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    public function tearDown(): void
    {
        NavbarEntity::resetNextId();
    }
}

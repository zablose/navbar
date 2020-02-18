<?php

namespace Zablose\Navbar\Tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function tearDown(): void
    {
        NavbarEntity::resetNextId();
    }
}

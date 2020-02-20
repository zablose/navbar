<?php declare(strict_types=1);

namespace Zablose\Navbar\Contracts;

interface NavbarConfigContract
{
    public function setPath(string $path): NavbarConfigContract;

    public function setRoles(array $roles): NavbarConfigContract;

    public function setPermissions(array $permissions): NavbarConfigContract;

    public function getPath(): string;

    public function getRoles(): array;

    public function getPermissions(): array;
}

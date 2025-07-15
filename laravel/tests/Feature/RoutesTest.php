<?php

declare(strict_types=1);

namespace Zablose\Navbar\Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Zablose\Navbar\Tests\FeatureTestCase;

class RoutesTest extends FeatureTestCase
{
    #[Test]
    public function index()
    {
        $this->get('/')->assertOk()
            ->assertSee('https://laravel.com')->assertSee('/login')->assertSee('/register')
            ->assertDontSee('/home')->assertDontSee('/logout');
    }

    #[Test]
    public function home()
    {
        $this->get('/home')->assertOk()
            ->assertSee('https://laravel.com')->assertSee('/logout')
            ->assertDontSee('/login')->assertDontSee('/register');
    }

    #[Test]
    public function login()
    {
        $this->get('/login')->assertRedirect('/home');
    }

    #[Test]
    public function register()
    {
        $this->get('/register')->assertRedirect('/home');
    }

    #[Test]
    public function logout()
    {
        $this->post('/logout')->assertRedirect('/');
    }
}

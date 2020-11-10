<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests\Feature;

use Zablose\Navbar\Tests\FeatureTestCase;

class RoutesTest extends FeatureTestCase
{
    /** @test */
    public function index()
    {
        $this->get('/')->assertOk()
            ->assertSee('https://laravel.com')->assertSee('/login')->assertSee('/register')
            ->assertDontSee('/home')->assertDontSee('/logout');
    }

    /** @test */
    public function home()
    {
        $this->get('/home')->assertOk()
            ->assertSee('https://laravel.com')->assertSee('/logout')
            ->assertDontSee('/login')->assertDontSee('/register');
    }

    /** @test */
    public function login()
    {
        $this->get('/login')->assertRedirect('/home');
    }

    /** @test */
    public function register()
    {
        $this->get('/register')->assertRedirect('/home');
    }

    /** @test */
    public function logout()
    {
        $this->post('/logout')->assertRedirect('/');
    }
}

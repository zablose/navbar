<?php declare(strict_types=1);

namespace Zablose\Navbar\Tests\Traits;

use Zablose\Navbar\Contracts\BasicRendersContract;
use Zablose\Navbar\NavbarConfig;
use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\Tests\NavbarEntity as NE;
use Zablose\Navbar\Tests\TestCase;
use Zablose\Navbar\Traits\ArrayableTrait;
use Zablose\Navbar\Traits\NavbarSettersTrait;

class NavbarConfigTest extends TestCase
{
    use DatabaseTrait;

    /** @test */
    public function render_link_with_custom_app_url()
    {
        $this->insert([
            (new NE())->setId()->setType(NE::TYPE_LINK)->setHref('/home')->setBody('Home')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/laravel/home">Home</a></li>',
            $this->builder(new NavbarConfig(['app_url' => '/laravel/']))->render()
        );
    }

    /** @test */
    public function render_link_with_custom_entity_class()
    {
        $entity = new Class() extends NavbarEntityCore implements BasicRendersContract {
            use ArrayableTrait;
            use NavbarSettersTrait;
        };

        $config = new NavbarConfig(['navbar_entity_class' => get_class($entity)]);

        $this->insert([
            (new NE())->setId()->setType($entity::TYPE_LINK)->setHref('/home')->setBody('Home')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/home">Home</a></li>',
            $this->builder($config)->render()
        );

        $this->assertStringContainsString(
            'class@anonymous',
            $this->builder($config)->getConfig()->navbar_entity_class
        );
    }

    /** @test */
    public function render_link_with_custom_active_link_class()
    {
        $this->insert([
            (new NE())->setId()->setType(NE::TYPE_LINK)->setHref('/me')->setBody('Me')->toArray(),
        ]);

        $this->assertSame(
            '<li><a href="/me" class="here-i-am">Me</a></li>',
            $this->builder((new NavbarConfig(['active_link_class' => 'here-i-am']))->setPath('/me'))->render()
        );
    }
}

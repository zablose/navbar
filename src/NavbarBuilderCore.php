<?php declare(strict_types=1);

namespace Zablose\Navbar;

use ReflectionMethod;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarRepoContract;

abstract class NavbarBuilderCore
{
    private NavbarDataProcessor $processor;

    public function __construct(NavbarRepoContract $data, NavbarConfigContract $config = null)
    {
        $this->processor = new NavbarDataProcessor($data, $config);
    }

    public function getConfig(): NavbarConfigContract
    {
        return $this->processor->getConfig();
    }

    final public function render(array $filter = ['main']): string
    {
        return $this->prepare($filter)->renderElements($this->processor->getElements($filter));
    }

    final public function prepare(array $filter = []): self
    {
        $this->processor->prepare($filter);

        return $this;
    }

    final public function orderBy(string $column, string $direction = 'asc'): self
    {
        $this->processor->orderBy($column, $direction);

        return $this;
    }

    protected function renderElement(NavbarElement $element): string
    {
        $method = $element->entity->type;

        $method_exists_and_public = (
            method_exists(get_class($this), $method)
            && (new ReflectionMethod($this, $method))->isPublic()
        );

        return $method_exists_and_public ? $this->{$method}($element) : '';
    }

    protected function renderElements(array $elements): string
    {
        $html = '';

        if (is_array($elements) && count($elements) > 0) {
            foreach ($elements as $element) {
                $html .= $this->renderElement($element);
            }
        }

        return $html;
    }

    protected function isLinkActive(NavbarElement $element): bool
    {
        return (trim($this->processor->getConfig()->getPath(), '/') === trim($element->entity->href, '/'));
    }
}

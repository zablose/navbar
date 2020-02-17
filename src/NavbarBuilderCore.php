<?php

namespace Zablose\Navbar;

use ReflectionMethod;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarRepoContract;

abstract class NavbarBuilderCore
{

    /**
     * @var NavbarDataProcessor
     */
    private $processor;

    /**
     * @param  NavbarRepoContract    $data
     * @param  NavbarConfigContract  $config
     */
    public function __construct(NavbarRepoContract $data, NavbarConfigContract $config = null)
    {
        $this->processor = new NavbarDataProcessor($data, $config);
    }

    /**
     * @return NavbarConfig|NavbarConfigContract
     */
    public function getConfig()
    {
        return $this->processor->getConfig();
    }

    final public function render(array $filter = ['main']): string
    {
        return $this->prepare($filter)->renderElements($this->processor->getElements($filter));
    }

    /**
     * Prepare navigation entities for rendering.
     *
     * @param  array|string  $filter
     *
     * @return NavbarBuilderCore
     */
    final public function prepare($filter = null)
    {
        $this->processor->prepare($filter);

        return $this;
    }

    /**
     * @param  string  $column
     * @param  string  $direction
     *
     * @return $this
     */
    final public function orderBy($column, $direction = 'asc')
    {
        $this->processor->orderBy($column, $direction);

        return $this;
    }

    /**
     * @param  array  $elements
     *
     * @return string
     */
    protected function renderElements($elements)
    {
        $html = '';

        if (is_array($elements) && count($elements) > 0) {
            foreach ($elements as $element) {
                $html .= $this->renderElement($element);
            }
        }

        return $html;
    }

    /**
     * @param  NavbarElement  $element
     *
     * @return string
     */
    protected function renderElement(NavbarElement $element)
    {
        return $this->{$this->validateMethod($this, $element->entity->type)}($element);
    }

    /**
     * Check if the entity's href attribute matches the current path of the application.
     *
     * @param  NavbarElement  $element
     *
     * @return string
     */
    protected function isActive(NavbarElement $element)
    {
        return (trim($this->processor->getConfig()->getPath(), '/') === trim($element->entity->href, '/'));
    }

    /**
     * @param  mixed   $object
     * @param  string  $method
     *
     * @return string
     */
    private function validateMethod($object, $method)
    {
        return method_exists(get_class($object), $method) && (new ReflectionMethod($object, $method))->isPublic()
            ? $method
            : 'renderEmptyString';
    }

    /**
     * Used by validateMethod() when method is invalid.
     *
     * @param  mixed  $param
     *
     * @return string
     */
    private function renderEmptyString($param = null) { return ''; }

}

<?php

namespace Zablose\Navbar;

use ReflectionMethod;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarRepoContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;

abstract class NavbarBuilderCore
{

    /**
     * @var NavbarDataProcessor
     */
    private $processor;

    /**
     * @param NavbarRepoContract   $data
     * @param NavbarConfigContract $config
     */
    public function __construct(NavbarRepoContract $data, NavbarConfigContract $config = null)
    {
        $this->processor = new NavbarDataProcessor($data, $config);
    }

    /**
     * @return NavbarConfig|NavbarConfigContract
     */
    public function config()
    {
        return $this->processor->config();
    }

    /**
     * Render navigation entities to the HTML string.
     *
     * @param array|string|integer $filter Filter or parent ID.
     *
     * @return string
     */
    final public function render($filter = 'main')
    {
        return $this->prepare($filter)->renderElements($this->processor->get($filter));
    }

    /**
     * Prepare navigation entities for rendering.
     *
     * @param array|string|integer $filter Filter or parent ID.
     *
     * @return NavbarBuilderCore
     */
    final public function prepare($filter = null)
    {
        $this->processor->prepare($filter);

        return $this;
    }

    /**
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    final public function orderBy($column, $direction = 'asc')
    {
        $this->processor->orderBy($column, $direction);

        return $this;
    }

    /**
     * @param array $elements
     *
     * @return string
     */
    protected function renderElements($elements)
    {
        $html = '';

        if (is_array($elements) && count($elements) > 0)
        {
            foreach ($elements as $element)
            {
                $html .= $this->{$element->type}($element);
            }
        }

        return $html;
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function renderElementAsEntity(NavbarElement $element)
    {
        return $this->{$this->validateMethod($this, $element->entity->type)}($element->entity);
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function renderElementAsGroup(NavbarElement $element)
    {
        return $this->{$this->validateMethod($this, $element->entity->type)}($element);
    }

    /**
     * Check if the entity's href attribute matches the current path of the application.
     *
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    protected function isActive(NavbarEntityContract $entity)
    {
        return (trim($this->processor->config()->getPath(), '/') === trim($entity->href, '/'));
    }

    /**
     * @param mixed  $object
     * @param string $method
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
     * @param mixed $param
     *
     * @return string
     */
    private function renderEmptyString($param = null) { return ''; }

}

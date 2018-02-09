<?php

namespace Zablose\Navbar;

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
     * Were data prepared or not. Used to prevent a repeat of preparation. Ignored in case of rendering by parent ID.
     *
     * @var boolean
     */
    private $prepared;

    /**
     * @var NavbarConfigContract
     */
    protected $config;

    /**
     * @param NavbarRepoContract   $data
     * @param NavbarConfigContract $config
     */
    public function __construct(NavbarRepoContract $data, NavbarConfigContract $config = null)
    {
        $this->processor = new NavbarDataProcessor($data, $config);
        $this->config    = $this->processor->config;
    }

    /**
     * Render navigation entities to the HTML string.
     *
     * @param array|string|integer $filterOrPid Filter or parent ID.
     * @param string               $order_by    Order by column in the database 'id:asc' or 'id:desc'.
     *
     * @return string
     */
    final public function render($filterOrPid, $order_by = null)
    {
        if (! $this->prepared || is_integer($filterOrPid))
        {
            $this->prepare($filterOrPid, $order_by);
        }

        return $this->renderElements($this->processor->get($filterOrPid));
    }

    /**
     * Prepare navigation entities for rendering.
     *
     * @param array|string|integer $filterOrPid Filter or parent ID.
     * @param string               $order_by    Order by column in the database 'id:asc' or 'id:desc'.
     *
     * @return NavbarBuilderCore
     */
    final public function prepare($filterOrPid = null, $order_by = null)
    {
        $this->prepared = true;

        $this->processor->prepare($filterOrPid, $order_by);

        return $this;
    }

    /**
     * @param NavbarElement[] $elements
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
                $html .= $this->{$this->validateMethod($this, $element->type)}($element);
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
        return (trim($this->config->path(), '/') === trim($entity->href, '/'));
    }

    /**
     * @param mixed  $object
     * @param string $method
     *
     * @return string
     */
    private function validateMethod($object, $method)
    {
        return method_exists(get_class($object), $method) ? $method : 'renderEmptyString';
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

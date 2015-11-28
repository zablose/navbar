<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\NavbarDataProcessor;
use Zablose\Navbar\NavbarEntityCore;

abstract class NavbarBuilderCore
{

    /**
     *
     * @var NavbarDataProcessor
     */
    private $processor;

    /**
     * Were data prepared or not. Used to prevent a repeat of preparation.
     *
     * @var boolean
     */
    private $prepared;

    /**
     *
     * @var NavbarConfigContract
     */
    protected $config;

    /**
     *
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     *
     * @return void
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        $this->processor = new NavbarDataProcessor($data, $config);
        $this->config    = $this->processor->config;
    }

    /**
     * Render navigation entities to HTML string.
     *
     * @param  string|array|integer  $filterOrPid  Filter or parent ID.
     * @param  string  $order_by  Order by column in the database 'id:asc' or 'id:desc'.
     *
     * @return string
     */
    final public function render($filterOrPid, $order_by = null)
    {
        if (!$this->prepared || is_integer($filterOrPid))
        {
            $this->prepare($filterOrPid, $order_by);
        }

        return $this->renderElements($this->processor->get($filterOrPid));
    }

    /**
     * Prepare navigation entities for rendering.
     *
     * @param  string|array|integer  $filterOrPid  Filter or parent ID.
     * @param  string  $order_by  Order by column in the database 'id:asc' or 'id:desc'.
     *
     * @return NavbarBuilder
     */
    final public function prepare($filterOrPid = null, $order_by = null)
    {
        $this->prepared = true;

        $this->processor->prepare($filterOrPid, $order_by);

        return $this;
    }

    private function validateMethod($method)
    {
        return in_array($method, $this->getValidMethods()) ? $method : 'nb_empty';
    }

    private function getValidMethods()
    {
        return array_unique(array_merge(NavbarElement::getTypes(), NavbarEntityCore::getTypes()));
    }

    /**
     *
     * @param NavbarElement[] $elements
     * @return string
     */
    protected function renderElements($elements)
    {
        $html = '';

        if (is_array($elements) && count($elements) > 0)
        {
            foreach ($elements as $element)
            {
                $html .= $this->{$this->validateMethod($element->type)}($element);
            }
        }

        return $html;
    }

    protected function renderElementAsEntity(NavbarElement $element)
    {
        return $this->{$this->validateMethod($element->entity->type)}($element->entity);
    }

    protected function renderElementAsGroup(NavbarElement $element)
    {
        return $this->{$this->validateMethod($element->entity->type)}($element);
    }

    private function nb_empty($param = null)
    {
        return '';
    }

}

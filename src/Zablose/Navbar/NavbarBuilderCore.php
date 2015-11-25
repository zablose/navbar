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
     * Render Navbars to the HTML string.
     *
     * @param  mixed  $tagOrPid  Tag that group navbars or parent ID.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     *
     * @return string
     */
    final public function render($tagOrPid, $titled = null, $positioned = null)
    {
        if (!$this->prepared || is_integer($tagOrPid))
        {
            $this->prepare($tagOrPid, $titled, $positioned);
        }

        return $this->renderElements($this->processor->get($tagOrPid));
    }

    /**
     *
     * @param  mixed  $tagOrPid  Tag(s) that group navbars or parent ID.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     *
     * @return NavbarBuilder
     */
    final public function prepare($tagOrPid = null, $titled = null, $positioned = null)
    {
        $this->prepared = true;
        $this->processor->prepare($tagOrPid, $titled, $positioned);

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

    protected function renderElementAsEntity(NavbarElement $dataset)
    {
        return $this->{$this->validateMethod($dataset->entity->type)}($dataset->entity);
    }

    protected function renderElementAsGroup(NavbarElement $dataset)
    {
        return $this->{$this->validateMethod($dataset->entity->type)}($dataset);
    }

    private function nb_empty($param = null)
    {
        return '';
    }

}

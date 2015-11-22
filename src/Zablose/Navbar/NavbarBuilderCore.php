<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Helpers\Tag;
use Zablose\Navbar\NavbarDataSetup;
use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\NavbarDataProcessor;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;

abstract class NavbarBuilderCore
{

    /**
     *
     * @var NavbarDataProcessor
     */
    protected $data;

    /**
     * Were data prepared or not. Used to prevent a repeat of preparation.
     *
     * @var boolean
     */
    protected $prepared;

    /**
     *
     * @var NavbarConfigContract
     */
    protected $config;

    /**
     *
     * @param NavbarDataContract $data
     */
    final public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        $this->data   = new NavbarDataProcessor(new NavbarDataSetup($data, $config));
        $this->config = $this->data->setup->config;
    }

    /**
     * Render Navbars to the HTML string.
     *
     * @param  mixed  $tagOrPid  Tag that group navbars or parent ID.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     * @return string
     */
    final public function render($tagOrPid, $titled = null, $positioned = null)
    {
        if (!$this->prepared || is_integer($tagOrPid))
        {
            $this->prepare($tagOrPid, $titled, $positioned);
        }
        return $this->renderElements($this->data->get($tagOrPid));
    }

    /**
     *
     * @param  mixed  $tagOrPid  Tag(s) that group navbars or parent ID.
     * @param  string  $titled  Order direction for ordering by title 'asc' or 'desc'.
     * @param  string  $positioned  Order direction for ordering by position 'asc' or 'desc'.
     * @return \Zablose\Navbar\NavbarBuilder
     */
    final public function prepare($tagOrPid = null, $titled = null, $positioned = null)
    {
        $this->prepared = true;
        $this->data->prepare($tagOrPid, $titled, $positioned);
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
    private function renderElements($elements)
    {
        $html = '';

        if (count($elements) > 0)
        {
            foreach ($elements as $element)
            {
                $html .= $this->{$this->validateMethod($element->type)}($element);
            }
        }

        return $html;
    }

    private function renderElementAsEntity(NavbarElement $dataset)
    {
        return $this->{$this->validateMethod($dataset->entity->type)}($dataset->entity);
    }

    private function renderElementAsGroup(NavbarElement $dataset)
    {
        return $this->{$this->validateMethod($dataset->entity->type)}($dataset);
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    private function renderNavbar(NavbarElement $element)
    {
        $html = '<ul class="nav navbar-nav ' . $element->entity->class . '">';

        $html .= $this->renderElements($element->content);

        $html .= '</ul>';

        return $html;
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    private function renderSidebar(NavbarElement $element)
    {
        $html = '<ul class="nav nav-sidebar ' . $element->entity->class . '">';

        $html .= $this->renderElements($element->content);

        $html .= '</ul>';

        return $html;
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    private function renderDropdown(NavbarElement $element)
    {
        $attrs = [
            'href'             => $element->entity->target,
            'class'            => implode(' ', ['dropdown-toggle', $element->entity->class]),
            'data-toggle'      => 'dropdown',
            'role'             => 'button',
            'aria-haspopup'    => 'true',
            'aria-expanded'    => 'false',
            'navbar-pid'       => $element->entity->id,
            'navbar-container' => 'ul',
        ];

        $element->entity->title .= ' <span class="caret"></span>';

        $html = '
      <li class="dropdown">
        ' . $this->a($element->entity, $attrs) . '
        <ul class="dropdown-menu">';

        $html .= $this->renderElements($element->content);

        $html .= '
        </ul>
      </li>';

        return $html;
    }

    private function renderHeader(NavbarEntityContract $entity)
    {
        return $this->li($entity->addClass('dropdown-header'));
    }

    private function renderSeparator(NavbarEntityContract $entity)
    {
        return '<li role="separator" class="divider ' . $entity->class . '"></li>';
    }

    private function renderRelativeLink(NavbarEntityContract $entity)
    {
        return $this->renderLink($entity);
    }

    private function renderAbsoluteLink(NavbarEntityContract $entity)
    {
        return $this->renderLink($entity);
    }

    private function renderLink(NavbarEntityContract $entity)
    {
        return $this->li($entity, $this->a($entity));
    }

    private function nb_empty($param = null)
    {
        return '';
    }

}

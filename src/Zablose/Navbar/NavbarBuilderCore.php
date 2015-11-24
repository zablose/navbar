<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
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
        $attrs = [
            'class' => $element->entity->prefix('class', 'nav navbar-nav')->class,
        ];

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    private function renderSidebar(NavbarElement $element)
    {
        $attrs = [
            'class' => $element->entity->prefix('class', 'nav nav-sidebar')->class,
        ];

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    private function renderDropdown(NavbarElement $element)
    {
        $attrs = [
            'id'               => 'dropdown_'.$element->entity->id,
            'href'             => $element->entity->target,
            'class'            => $element->entity->prefix('class', 'dropdown-toggle')->class,
            'data-toggle'      => 'dropdown',
            'role'             => 'button',
            'aria-haspopup'    => 'true',
            'aria-expanded'    => 'false',
            'navbar-pid'       => $element->entity->id,
            'navbar-container' => 'ul',
        ];

        $element->entity->postfix('title', '<span class="caret"></span>');

        $html = '
          <li class="dropdown">
            '.Html::tag('a', $attrs, $this->icon($element->entity).$element->entity->title).'
            <ul class="dropdown-menu">
              '.$this->renderElements($element->content).'
            </ul>
          </li>';

        return $html;
    }

    private function renderHeader(NavbarEntityContract $entity)
    {
        $attrs = [
            'class' => $entity->prefix('class', 'dropdown-header')->class,
        ];

        return Html::tag('li', $attrs, $entity->title);
    }

    private function renderSeparator(NavbarEntityContract $entity)
    {
        $attrs = [
            'class' => $entity->prefix('class', 'divider')->class,
            'role'  => 'separator',
        ];

        return Html::tag('li', $attrs);
    }

    private function renderRelativeLink(NavbarEntityContract $entity)
    {
        $attrs = [
            'href' => rtrim($this->config->app_url, '/').'/'.ltrim(trim($entity->target), '/'),
        ];

        return $this->renderLink($entity, $attrs);
    }

    private function renderAbsoluteLink(NavbarEntityContract $entity)
    {
        $attrs = [
            'href' => $entity->target,
            'target' => $this->config->absolute_link_target,
        ];

        return $this->renderLink($entity, $attrs);
    }

    private function renderLink(NavbarEntityContract $entity, $attrs = [])
    {
        $li_attrs = [];

        if ($entity->alt)
        {
            $li_attrs['title'] = $entity->alt;
        }

        if ($entity->class)
        {
            $li_attrs['class'] = $entity->class;
        }

        $body = Html::tag('a', $attrs, $this->icon($entity).$entity->title);

        return Html::tag('li', $li_attrs, $body);
    }

    private function nb_empty($param = null)
    {
        return '';
    }

}

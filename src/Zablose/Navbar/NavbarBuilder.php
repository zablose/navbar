<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarBuilderCore;

class NavbarBuilder extends NavbarBuilderCore
{

    /**
     *
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     *
     * @return void
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        parent::__construct($data, $config);
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    protected function renderNavbar(NavbarElement $element)
    {
        $attrs = [
            'class' => $element->entity->renderClass('nav navbar-nav'),
        ];

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    protected function renderSidebar(NavbarElement $element)
    {
        $attrs = [
            'class' => $element->entity->renderClass('nav nav-sidebar'),
        ];

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    protected function renderDropdown(NavbarElement $element)
    {
        $attrs = [
            'id'               => 'dropdown_'.$element->entity->id,
            'href'             => $element->entity->target,
            'class'            => $element->entity->renderClass('dropdown-toggle'),
            'data-toggle'      => 'dropdown',
            'role'             => 'button',
            'aria-haspopup'    => 'true',
            'aria-expanded'    => 'false',
            'navbar-pid'       => $element->entity->id,
            'navbar-container' => 'ul',
        ];

        $body = $element->entity->renderTitle($element->entity->renderIcon(), '<span class="caret"></span>');

        $html = '
          <li class="dropdown">
            '.Html::tag('a', $attrs, $body).'
            <ul class="dropdown-menu">
              '.$this->renderElements($element->content).'
            </ul>
          </li>';

        return $html;
    }

    protected function renderHeader(NavbarEntityContract $entity)
    {
        $attrs = [
            'class' => $entity->renderClass('dropdown-header'),
        ];

        return Html::tag('li', $attrs, $entity->title);
    }

    protected function renderSeparator(NavbarEntityContract $entity)
    {
        $attrs = [
            'role'  => 'separator',
            'class' => $entity->renderClass('divider'),
        ];

        return Html::tag('li', $attrs);
    }

    protected function renderRelativeLink(NavbarEntityContract $entity)
    {
        $attrs = [
            'href' => rtrim($this->config->app_url, '/').'/'.ltrim(trim($entity->target), '/'),
        ];

        return $this->renderLink($entity, $attrs);
    }

    protected function renderAbsoluteLink(NavbarEntityContract $entity)
    {
        $attrs = [
            'href' => $entity->target,
            'target' => $this->config->absolute_link_target,
        ];

        return $this->renderLink($entity, $attrs);
    }

    protected function renderLink(NavbarEntityContract $entity, $attrs = [])
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

        $body = Html::tag('a', $attrs, $entity->renderTitle($entity->renderIcon()));

        return Html::tag('li', $li_attrs, $body);
    }

}

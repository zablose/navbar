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
    protected function bootstrap_navbar(NavbarElement $element)
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
    protected function navbar_navbar(NavbarElement $element)
    {
        $attrs = [
            'class' => $element->entity->renderClass(),
        ];

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     *
     * @param NavbarElement $element
     * @return string
     */
    protected function bootstrap_dropdown(NavbarElement $element)
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

    protected function bootstrap_header(NavbarEntityContract $entity)
    {
        $attrs = [
            'class' => $entity->renderClass('dropdown-header'),
        ];

        return Html::tag('li', $attrs, $entity->title);
    }

    protected function bootstrap_separator(NavbarEntityContract $entity)
    {
        $attrs = [
            'role'  => 'separator',
            'class' => $entity->renderClass('divider'),
        ];

        return Html::tag('li', $attrs);
    }

    /**
     * Check if the entity related to current path.
     *
     * @param  NavbarEntityContract  $entity
     * @return string
     */
    protected function isActive(NavbarEntityContract $entity)
    {
        $isTargetInPath = stripos(trim($this->config->path(), '/'), trim($entity->target, '/')) !== false;

        return ($this->config->path() === $entity->target || $isTargetInPath);
    }

    protected function navbar_link_relative(NavbarEntityContract $entity)
    {
        $attrs = [
            'href' => rtrim($this->config->app_url, '/').'/'.ltrim(trim($entity->target), '/'),
        ];

        return $this->renderLink($entity, $attrs);
    }

    protected function navbar_link_absolute(NavbarEntityContract $entity)
    {
        $attrs = [
            'href' => $entity->target,
            'target' => $this->config->absolute_link_target,
        ];

        return $this->renderLink($entity, $attrs);
    }

    protected function renderLink(NavbarEntityContract $entity, $attrs = [])
    {

        $link = Html::tag($this->config->link_tag, $attrs, $entity->renderTitle($entity->renderIcon()));

        if ($this->config->link_container_tag)
        {
            return $this->renderLinkContainer($entity, $link);
        }

        return $link;
    }

    /**
     *
     * @param NavbarEntityContract $entity
     * @param string $body
     * @return string
     */
    protected function renderLinkContainer(NavbarEntityContract $entity, $body)
    {
        $container_attrs = [];

        if ($entity->alt)
        {
            $container_attrs['title'] = $entity->alt;
        }

        if ($this->isActive($entity))
        {
            $container_attrs['class'] = $this->config->class_for_active_link;
        }

        return Html::tag($this->config->link_container_tag, $container_attrs, $body);
    }

}

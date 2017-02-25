<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Contracts\NavbarConfigContract;
use Zablose\Navbar\Contracts\NavbarDataContract;
use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;

class NavbarBuilder extends NavbarBuilderCore
{

    /**
     * @param NavbarDataContract $data
     * @param NavbarConfigContract $config
     */
    public function __construct(NavbarDataContract $data, NavbarConfigContract $config = null)
    {
        parent::__construct($data, $config);
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function bootstrap_navbar(NavbarElement $element)
    {
        $attrs['class'] = $element->entity->class;

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function bootstrap_dropdown(NavbarElement $element)
    {
        $attrs = [
            'id'               => 'dropdown_'.$element->entity->id,
            'href'             => $element->entity->href,
            'class'            => $element->entity->renderClass('dropdown-toggle'),
            'data-toggle'      => 'dropdown',
            'role'             => 'button',
            'aria-haspopup'    => 'true',
            'aria-expanded'    => 'false',
            'navbar-pid'       => $element->entity->id,
            'navbar-container' => 'ul',
        ];

        $body = $element->entity->renderBody($element->entity->renderIcon(), '<span class="caret"></span>');

        $html = '<li class="dropdown">' .
            Html::tag('a', $attrs, $body) .
            '<ul class="dropdown-menu">' .
            $this->renderElements($element->content) .
            '</ul>' .
            '</li>';

        return $html;
    }

    /**
     * @param NavbarEntityContract $entity
     *
     * @return string
     */
    protected function bootstrap_header(NavbarEntityContract $entity)
    {
        $attrs['class'] = $entity->renderClass('dropdown-header');

        return Html::tag('li', $attrs, $entity->body);
    }

    /**
     * @param NavbarEntityContract $entity
     *
     * @return string
     */
    protected function bootstrap_separator(NavbarEntityContract $entity)
    {
        $attrs = [
            'role'  => 'separator',
            'class' => $entity->renderClass('divider'),
        ];

        return Html::tag('li', $attrs);
    }

    /**
     * Check if the entity's href attribute matches the current path of the application.
     *
     * @param NavbarEntityContract $entity
     *
     * @return string
     */
    protected function isActive(NavbarEntityContract $entity)
    {
        return (trim($this->config->path(), '/') === trim($entity->href, '/'));
    }

    /**
     * @param NavbarEntityContract $entity
     * @param array $attrs
     *
     * @return string
     */
    protected function bootstrap_link_internal(NavbarEntityContract $entity, $attrs = [])
    {
        $attrs['href'] = rtrim($this->config->app_url, '/').'/'.ltrim(trim($entity->href), '/');

        return $this->renderBootstrapLink($entity, $attrs);
    }

    /**
     * @param NavbarEntityContract $entity
     * @param array $attrs
     *
     * @return string
     */
    protected function bootstrap_link_external(NavbarEntityContract $entity, $attrs = [])
    {
        $attrs['href'] = $entity->href;
        $attrs['target'] = $this->config->external_link_target;

        return $this->renderBootstrapLink($entity, $attrs);
    }

    /**
     * @param NavbarEntityContract $entity
     * @param array $attrs
     *
     * @return string
     */
    private function renderBootstrapLink(NavbarEntityContract $entity, $attrs = [])
    {
        $attrs['class'] = $entity->class;
        $link           = Html::tag('a', $attrs, $entity->renderBody($entity->renderIcon()));

        $container_attrs['title'] = $entity->title;
        if ($this->isActive($entity))
        {
            $container_attrs['class'] = $this->config->active_link_class;
        }

        return Html::tag('li', $container_attrs, $link);
    }

}

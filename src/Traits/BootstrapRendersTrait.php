<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarElement;
use Zablose\Navbar\NavbarEntityCore;

trait BootstrapRendersTrait
{

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
            'id'               => 'dropdown_' . $element->entity->id,
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

        return
            '<li class="dropdown">' . Html::tag('a', $attrs, $body) .
            '<ul class="dropdown-menu">' . $this->renderElements($element->content) . '</ul>' .
            '</li>';
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    protected function bootstrap_header(NavbarEntityContract $entity)
    {
        $attrs['class'] = $entity->renderClass('dropdown-header');

        return Html::tag('li', $attrs, $entity->body);
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
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
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param array                                 $link_attrs
     *
     * @return string
     */
    protected function bootstrap_link(NavbarEntityContract $entity, $link_attrs = [])
    {
        $link_attrs['class'] = $entity->class;

        $attrs['title'] = $entity->title;
        if ($this->isActive($entity))
        {
            $attrs['class'] = $this->config->active_link_class;
        }

        return Html::tag('li', $attrs, $this->renderLink($entity, $link_attrs));
    }

}

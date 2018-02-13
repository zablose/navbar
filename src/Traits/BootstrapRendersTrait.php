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
    public function bootstrap_navbar(NavbarElement $element)
    {
        $attrs['class'] = $element->entity->class;

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bootstrap_dropdown(NavbarElement $element)
    {
        $attrs = [
            'id'               => 'dropdown_' . $element->entity->id,
            'href'             => $element->entity->href,
            'class'            => $this->renderClass($element->entity, 'dropdown-toggle'),
            'data-toggle'      => 'dropdown',
            'role'             => 'button',
            'aria-haspopup'    => 'true',
            'aria-expanded'    => 'false',
            'navbar-pid'       => $element->entity->id,
            'navbar-container' => 'ul',
        ];

        $body = $this->renderBody($element->entity, $this->renderIcon($element->entity), '<span class="caret"></span>');

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
    public function bootstrap_header(NavbarEntityContract $entity)
    {
        $attrs['class'] = $this->renderClass($entity, 'dropdown-header');

        return Html::tag('li', $attrs, $entity->body);
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    public function bootstrap_separator(NavbarEntityContract $entity)
    {
        $attrs = [
            'role'  => 'separator',
            'class' => $this->renderClass($entity, 'divider'),
        ];

        return Html::tag('li', $attrs);
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param array                                 $link_attrs_overwrite
     *
     * @return string
     */
    public function bootstrap_link(NavbarEntityContract $entity, $link_attrs_overwrite = [])
    {
        $attrs = [];

        if ($entity->title)
        {
            $attrs['title'] = $entity->title;
        }

        if ($this->isActive($entity))
        {
            $attrs['class'] = 'active';
        }

        return Html::tag('li', $attrs, $this->renderLink($entity, '', $link_attrs_overwrite));
    }

}

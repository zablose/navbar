<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarElement;

trait BootstrapRendersTrait
{

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bootstrap_navbar(NavbarElement $element)
    {
        $attrs = $this->getAttrs($element);

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
        $attrs = $this->getAttrs(
            $element,
            [
                'id'               => 'dropdown_' . $element->entity->id,
                'href'             => $element->entity->href,
                'class'            => $this->renderClass($element, 'dropdown-toggle'),
                'data-toggle'      => 'dropdown',
                'role'             => 'button',
                'aria-haspopup'    => 'true',
                'aria-expanded'    => 'false',
                'navbar-pid'       => $element->entity->id,
                'navbar-container' => 'ul',
            ]
        );

        $body = $this->renderBody($element, $this->renderIcon($element), '<span class="caret"></span>');

        return
            '<li class="dropdown">' . Html::tag('a', $attrs, $body) .
            '<ul class="dropdown-menu">' . $this->renderElements($element->content) . '</ul>' .
            '</li>';
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bootstrap_header(NavbarElement $element)
    {
        $attrs = $this->getAttrs($element);

        $attrs['class'] = $this->renderClass($element, 'dropdown-header');

        return Html::tag('li', $attrs, $element->entity->body);
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bootstrap_separator(NavbarElement $element)
    {
        $attrs = $this->getAttrs(
            $element,
            [
                'role'  => 'separator',
                'class' => $this->renderClass($element, 'divider'),
            ]
        );

        return Html::tag('li', $attrs);
    }

    /**
     * @param NavbarElement $element
     * @param array         $link_attrs_overwrite
     *
     * @return string
     */
    public function bootstrap_link(NavbarElement $element, $link_attrs_overwrite = [])
    {
        $attrs = [];

        if ($element->entity->title)
        {
            $attrs['title'] = $element->entity->title;
        }

        if ($this->isActive($element))
        {
            $attrs['class'] = 'active';
        }

        return Html::tag('li', $attrs, $this->renderLink($element, '', $link_attrs_overwrite));
    }

}

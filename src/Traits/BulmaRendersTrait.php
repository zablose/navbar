<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarElement;
use Zablose\Navbar\NavbarEntityCore;

trait BulmaRendersTrait
{

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    protected function bulma_menu_label(NavbarEntityContract $entity)
    {
        $attrs['class'] = $entity->renderClass('menu-label');

        return Html::tag('p', $attrs, $entity->renderBody($entity->renderIcon()));
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function bulma_menu_list(NavbarElement $element)
    {
        $attrs['class'] = $element->entity->renderClass('menu-list');

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    protected function bulma_menu_list_link(NavbarEntityContract $entity)
    {
        return Html::tag('li', [], $this->renderLink($entity));
    }

}

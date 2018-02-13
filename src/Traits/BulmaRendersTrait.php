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
    public function bulma_menu_label(NavbarEntityContract $entity)
    {
        $attrs['class'] = $this->renderClass($entity, 'menu-label');

        return Html::tag('p', $attrs, $this->renderBody($entity, $this->renderIcon($entity)));
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bulma_menu_list(NavbarElement $element)
    {
        $attrs['class'] = $this->renderClass($element->entity, 'menu-list');

        return Html::tag('ul', $attrs, $this->renderElements($element->content));
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bulma_menu_sublist(NavbarElement $element)
    {
        return Html::tag('li', [],
            $this->renderBulmaLink($element->entity) .
            Html::tag('ul', [], $this->renderElements($element->content))
        );
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    public function bulma_menu_link(NavbarEntityContract $entity)
    {

        return Html::tag('li', [], $this->renderBulmaLink($entity));
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param array                                 $attrs_overwrite
     *
     * @return string
     */
    protected function renderBulmaLink(NavbarEntityContract $entity, $attrs_overwrite = [])
    {
        return $this->renderLink($entity, 'is-active', $attrs_overwrite);
    }

}

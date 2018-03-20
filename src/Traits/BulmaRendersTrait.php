<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarElement;

trait BulmaRendersTrait
{

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bulma_menu_label(NavbarElement $element)
    {
        $attrs = $this->getAttrs($element);

        $attrs['class'] = $this->renderClass($element, 'menu-label');

        return Html::tag('p', $attrs, $element->entity->body);
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bulma_menu_list(NavbarElement $element)
    {
        $attrs = $this->getAttrs($element);

        $attrs['class'] = $this->renderClass($element, 'menu-list');

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
            $this->renderBulmaLink($element) .
            Html::tag('ul', [], $this->renderElements($element->content))
        );
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    public function bulma_menu_link(NavbarElement $element)
    {

        return Html::tag('li', [], $this->renderBulmaLink($element));
    }

    /**
     * @param NavbarElement $element
     * @param array         $attrs_overwrite
     *
     * @return string
     */
    protected function renderBulmaLink(NavbarElement $element, $attrs_overwrite = [])
    {
        return $this->renderLink($this->renderBulmaBody($element), 'is-active', $attrs_overwrite);
    }

    /**
     * Render Icon.
     *
     * @param NavbarElement $element
     *
     * @return NavbarElement
     */
    protected function renderBulmaIcon(NavbarElement $element)
    {
        $element->entity->icon = $element->entity->icon
            ? '<span class="icon"><i class="fas ' . $element->entity->icon . '"></i></span>'
            : '';

        return $element;
    }

    /**
     * @param NavbarElement $element
     *
     * @return NavbarElement
     */
    protected function renderBulmaBody(NavbarElement $element)
    {
        $this->renderBulmaIcon($element)->entity->body = $element->entity->body
            ? $element->entity->icon . '<p>' . $element->entity->body . '</p>'
            : '';

        return $element;
    }

}

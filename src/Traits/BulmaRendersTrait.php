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

        return Html::tag('p', $attrs, $this->renderBody($element, $this->renderIcon($element)));
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
        return $this->renderLink($element, 'is-active', $attrs_overwrite);
    }

}

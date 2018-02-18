<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarElement;

trait CommonRendersTrait
{

    /**
     * Render body with or without prefix and/or postfix.
     *
     * @param NavbarElement $element
     * @param string        $prefix
     * @param string        $postfix
     *
     * @return string
     */
    protected function renderBody(NavbarElement $element, $prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($element->entity->body, $prefix), $postfix);
    }

    /**
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function renderHref(NavbarElement $element)
    {
        return $element->entity->external
            ? $element->entity->href
            : rtrim($this->config()->app_url, '/') . '/' . ltrim(trim($element->entity->href), '/');
    }

    /**
     * Render class with or without prefix and/or postfix.
     *
     * @param NavbarElement $element
     * @param string        $prefix
     * @param string        $postfix
     *
     * @return string
     */
    protected function renderClass(NavbarElement $element, $prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($element->entity->class, $prefix), $postfix);
    }

    /**
     * Render Icon.
     *
     * @param NavbarElement $element
     *
     * @return string
     */
    protected function renderIcon(NavbarElement $element)
    {
        return $element->entity->icon ? '<span class="' . $element->entity->icon . '"></span>' : '';
    }

    /**
     * @param NavbarElement $element
     * @param string        $active_link_class
     * @param array         $attrs_overwrite
     *
     * @return string
     */
    protected function renderLink(NavbarElement $element, $active_link_class, $attrs_overwrite = [])
    {
        $attrs = $this->getAttrs($element);

        $attrs['href'] = $this->renderHref($element);

        if ($element->entity->external)
        {
            $attrs['target'] = '_blank';
            $attrs['rel']    = 'noopener';
        }

        if ($class = $this->renderClass($element, $this->isActive($element) ? $active_link_class : null))
        {
            $attrs['class'] = $class;
        }

        return Html::tag(
            'a',
            array_merge($attrs, $attrs_overwrite),
            $this->renderBody($element, $this->renderIcon($element))
        );
    }

    /**
     * Get custom attributes form the entity.
     *
     * @param NavbarElement $element
     * @param array         $overwrite
     *
     * @return array
     */
    protected function getAttrs(NavbarElement $element, $overwrite = [])
    {
        return array_merge($element->entity->attrs ? json_decode($element->entity->attrs, true) : [], $overwrite);
    }

}

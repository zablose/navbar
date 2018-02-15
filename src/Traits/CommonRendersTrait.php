<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarEntityCore;

trait CommonRendersTrait
{

    /**
     * Render body with or without prefix and/or postfix.
     *
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param string                                $prefix
     * @param string                                $postfix
     *
     * @return string
     */
    protected function renderBody($entity, $prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($entity->body, $prefix), $postfix);
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    protected function renderHref(NavbarEntityContract $entity)
    {
        return $entity->external
            ? $entity->href
            : rtrim($this->config()->app_url, '/') . '/' . ltrim(trim($entity->href), '/');
    }

    /**
     * Render class with or without prefix and/or postfix.
     *
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param string                                $prefix
     * @param string                                $postfix
     *
     * @return string
     */
    protected function renderClass($entity, $prefix = null, $postfix = null)
    {
        return Html::postfix(Html::prefix($entity->class, $prefix), $postfix);
    }

    /**
     * Render Icon.
     *
     * @param NavbarEntityCore|NavbarEntityContract $entity
     *
     * @return string
     */
    protected function renderIcon(NavbarEntityContract $entity)
    {
        return $entity->icon ? '<span class="' . $entity->icon . '"></span>' : '';
    }

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param string                                $active_link_class
     * @param array                                 $attrs_overwrite
     *
     * @return string
     */
    protected function renderLink(NavbarEntityContract $entity, $active_link_class, $attrs_overwrite = [])
    {
        $attrs = $this->getAttrs($entity);

        $attrs['href'] = $this->renderHref($entity);

        if ($entity->external)
        {
            $attrs['target'] = '_blank';
            $attrs['rel']    = 'noopener';
        }

        if ($class = $this->renderClass($entity, $this->isActive($entity) ? $active_link_class : null))
        {
            $attrs['class'] = $class;
        }

        return Html::tag(
            'a',
            array_merge($attrs, $attrs_overwrite),
            $this->renderBody($entity, $this->renderIcon($entity))
        );
    }

    /**
     * Get custom attributes form the entity.
     *
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param array                                 $overwrite
     *
     * @return array
     */
    protected function getAttrs(NavbarEntityContract $entity, $overwrite = [])
    {
        return array_merge($entity->attrs ? json_decode($entity->attrs, true) : [], $overwrite);
    }

}

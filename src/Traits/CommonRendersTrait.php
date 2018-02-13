<?php

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Contracts\NavbarEntityContract;
use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarEntityCore;

trait CommonRendersTrait
{

    /**
     * @param NavbarEntityCore|NavbarEntityContract $entity
     * @param array                                 $attrs_overwrite
     * @param string                                $tag_name
     *
     * @return string
     */
    protected function renderLink(NavbarEntityContract $entity, $attrs_overwrite = [], $tag_name = 'a')
    {
        $attrs['href'] = $entity->renderHref($this->config->app_url);

        if ($entity->external)
        {
            $attrs['target'] = '_blank';
            $attrs['rel']    = 'noopener';
        }

        $attrs['class'] = $this->isActive($entity)
            ? $entity->renderClass($this->config->active_link_class)
            : $entity->renderClass();

        return Html::tag($tag_name, array_merge($attrs, $attrs_overwrite), $entity->renderBody($entity->renderIcon()));
    }

}

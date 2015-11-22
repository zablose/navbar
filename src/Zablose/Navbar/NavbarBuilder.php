<?php

namespace Zablose\Navbar;

use Zablose\Navbar\Helpers\Tag;
use Zablose\Navbar\NavbarBuilderCore;
use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\Contracts\NavbarEntityContract;

class NavbarBuilder extends NavbarBuilderCore
{

    protected function li(NavbarEntityContract $entity, $content = null)
    {
        $title = ($content) ? : $this->icon($entity) . $entity->title;
        $class = ($entity->class) ? ' class="' . $entity->class . '"' : '';
        return '<li' . $class . '>' . $title . '</li>';
    }

    protected function a(NavbarEntityContract $entity, $attrs = [])
    {
        $attrs['href'] = $this->url($entity);

        if ($entity->alt)
        {
            $attrs['title'] = $entity->alt;
        }

        if ($entity->type === NavbarEntityCore::TYPE_NAVBAR_LINK_ABSOLUTE)
        {
            $attrs['target'] = $this->config->absolute_link_target;
        }

        return '<a ' . Tag::attrs($attrs) . '>' . $this->icon($entity) . $entity->title . '</a>';
    }

    protected function icon(NavbarEntityContract $entity)
    {
        return ($entity->icon) ? '<span class="' . $entity->icon . '"></span> ' : '';
    }

    protected function url(NavbarEntityContract $entity)
    {
        if ($entity->type === NavbarEntityCore::TYPE_NAVBAR_LINK_ABSOLUTE)
        {
            return $entity->target;
        }

        return rtrim($this->config->app_url, '/') . '/' . ltrim(trim($entity->target), '/');
    }

}

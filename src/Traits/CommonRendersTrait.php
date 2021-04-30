<?php

declare(strict_types=1);

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\Helpers\Str;
use Zablose\Navbar\NavbarElement;

trait CommonRendersTrait
{
    protected function renderHref(NavbarElement $element): string
    {
        return $element->entity->external
            ? $element->entity->href
            : rtrim($this->getConfig()->app_url, '/').'/'.ltrim(trim($element->entity->href), '/');
    }

    protected function renderLink(
        NavbarElement $element,
        array $attrs_overwrite = []
    ): string {
        $attrs = [
            'href' => $this->renderHref($element),
            'title' => $element->entity->title,
        ];

        if ($element->entity->external) {
            $attrs['target'] = '_blank';
            $attrs['rel'] = 'noopener';
        }

        $attrs['class'] = Str::postfix(
            $element->entity->class,
            $this->isLinkActive($element) ? $this->getConfig()->active_link_class : '',
        );

        return Html::tag(
            'a',
            $this->renderLinkBody($element),
            array_merge($this->getAttrs($element, $attrs), $attrs_overwrite)
        );
    }

    protected function renderLinkIcon(NavbarElement $element): string
    {
        return $element->entity->icon
            ? '<span class="app-icon"><i class="'.$element->entity->icon.'"></i></span>'
            : '';
    }

    protected function renderLinkBody(NavbarElement $element)
    {
        return Str::implode([$this->renderLinkIcon($element), $element->entity->body,], '');
    }

    protected function renderList(NavbarElement $element): string
    {
        $attrs = $this->getAttrs(
            $element,
            [
                'class' => $element->entity->class,
                'title' => $element->entity->title,
            ]
        );

        return Html::tag('ul', $this->renderElements($element->content), $attrs);
    }
}

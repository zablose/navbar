<?php

namespace Zablose\Navbar\Tests;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarBuilderCore;
use Zablose\Navbar\NavbarElement;
use Zablose\Navbar\Traits\CommonRendersTrait;

class NavbarBuilder extends NavbarBuilderCore
{
    use CommonRendersTrait;

    public function render_list(NavbarElement $element): string
    {
        return $this->renderLabel($element).$this->renderList($element);
    }

    public function render_sublist(NavbarElement $element): string
    {
        return Html::tag('li', [], $this->renderLink($element, ['class' => '']).$this->renderList($element));
    }

    public function render_link(NavbarElement $element): string
    {
        return Html::tag('li', [], $this->renderLink($element));
    }

    protected function renderLabel(NavbarElement $element): string
    {
        return Html::tag('div', ['class' => 'app-label'], $element->entity->body);
    }

    protected function renderList(NavbarElement $element): string
    {
        $attrs = [
            'class' => $element->entity->class,
            'title' => $element->entity->title,
        ];

        return Html::tag('ul', $this->getAttrs($element, $attrs), $this->renderElements($element->content));
    }

    protected function renderIcon(NavbarElement $element): string
    {
        return $element->entity->icon
            ? '<span class="app-icon"><i class="fas '.$element->entity->icon.'"></i></span>'
            : '';
    }

    protected function renderBody(NavbarElement $element): string
    {
        return $element->entity->body ? '<p>'.$element->entity->body.'</p>' : '';
    }
}

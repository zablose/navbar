<?php

namespace App\Http\Navigation;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\Helpers\Str;
use Zablose\Navbar\NavbarBuilderCore;
use Zablose\Navbar\NavbarElement;
use Zablose\Navbar\Traits\CommonRendersTrait;

class NavbarBuilder extends NavbarBuilderCore
{
    use CommonRendersTrait;

    public function render_navbar(NavbarElement $element): string
    {
        return Html::tag(
            'ul',
            $this->renderElements($element->content),
            $this->getAttrs($element, ['class' => $element->entity->class])
        );
    }

    public function render_dropdown(NavbarElement $element): string
    {
        $id = 'dropdown_'.$element->entity->id;

        $attrs = $this->getAttrs(
            $element,
            [
                'id' => $id,
                'type' => 'button',
                'class' => Str::prefix($element->entity->class, 'btn btn-secondary dropdown-toggle'),
                'data-toggle' => 'dropdown',
                'aria-haspopup' => 'true',
                'aria-expanded' => 'false',
            ]
        );

        return
            '<div class="dropdown">'
            .Html::tag('button', $this->renderLinkBody($element), $attrs).
            '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="'.$id.'">'
            .$this->renderElements($element->content).'</div>'.
            '</div>';
    }

    public function render_link(NavbarElement $element, array $link_attrs_overwrite = []): string
    {
        $attrs['class'] = Str::postfix(
            $element->entity->class,
            $this->isLinkActive($element) ? $this->getConfig()->active_link_class : ''
        );

        $link_attrs = array_merge(['class' => 'nav-link'], $link_attrs_overwrite);

        return Html::tag('li', $this->renderLink($element, $link_attrs), $attrs);
    }

    public function render_logout(NavbarElement $element): string
    {
        $form = Html::tag(
            'form',
            '',
            [
                'id' => 'logout-form',
                'action' => $this->renderHref($element),
                'method' => 'POST',
                'style' => 'display: none;',
            ]
        );

        return $this->render_link(
                $element,
                [
                    'onclick' => 'event.preventDefault();document.getElementById(\'logout-form\').submit();',
                ]
            ).$form;
    }

    protected function renderLinkIcon(NavbarElement $element): string
    {
        return $element->entity->icon
            ? '<i class="'.$element->entity->icon.'" aria-hidden="true" style="margin-right: 4px;"></i>'
            : '';
    }
}

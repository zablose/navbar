<?php

declare(strict_types=1);

namespace Zablose\Navbar\Traits;

use Zablose\Navbar\Helpers\Html;
use Zablose\Navbar\NavbarElement;

trait BasicRendersTrait
{
    public function render_list(NavbarElement $element): string
    {
        return $this->render_label($element).$this->renderList($element);
    }

    public function render_sublist(NavbarElement $element): string
    {
        return Html::tag('li', $this->renderLink($element).$this->renderList($element));
    }

    public function render_link(NavbarElement $element): string
    {
        return Html::tag('li', $this->renderLink($element));
    }

    protected function render_label(NavbarElement $element): string
    {
        return Html::tag('div', $element->entity->body, ['class' => 'app-label']);
    }
}

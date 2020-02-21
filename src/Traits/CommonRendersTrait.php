<?php declare(strict_types=1);

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

    protected function renderClass(NavbarElement $element, string $prefix = '', string $postfix = ''): string
    {
        return Str::postfix(Str::prefix($prefix, $element->entity->class), $postfix);
    }

    protected function renderLink(
        NavbarElement $element,
        array $attrs_overwrite = []
    ): string
    {
        $attrs = [
            'href' => $this->renderHref($element),
            'title' => $element->entity->title,
        ];

        if ($element->entity->external) {
            $attrs['target'] = '_blank';
            $attrs['rel']    = 'noopener';
        }

        $attrs['class'] = $this->renderString([
            $this->renderClass($element),
            $this->isLinkActive($element) ? $this->getConfig()->active_link_class : '',
        ]);

        $body = $this->renderString([
            $this->renderIcon($element),
            $this->renderBody($element),
        ]);

        return Html::tag('a', array_merge($this->getAttrs($element, $attrs), $attrs_overwrite), $body);
    }

    protected function getAttrs(NavbarElement $element, array $overwrite = []): array
    {
        $attrs = $element->entity->attrs
            ? array_filter(json_decode($element->entity->attrs, true))
            : [];

        return array_merge($attrs, array_filter($overwrite));
    }

    protected function renderString(array $strings, string $glue = ' '): string
    {
        return implode($glue, array_filter($strings));
    }
}

<?php

declare(strict_types=1);

namespace Zablose\Navbar\Contracts;

interface BasicRendersContract
{
    public const TYPE_LABEL = 'render_label';
    public const TYPE_LINK = 'render_link';
    public const TYPE_LIST = 'render_list';
    public const TYPE_SUBLIST = 'render_sublist';
}

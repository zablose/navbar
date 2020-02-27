<?php

use Zablose\Navbar\Contracts\BasicRendersContract;
use Zablose\Navbar\NavbarEntityCore;
use Zablose\Navbar\Traits\ArrayableTrait;
use Zablose\Navbar\Traits\NavbarSettersTrait;

class NE extends NavbarEntityCore implements BasicRendersContract
{
    use ArrayableTrait;
    use NavbarSettersTrait;
}

$label = (new NE())->setType(NE::TYPE_LABEL);
$list  = (new NE())->setType(NE::TYPE_LIST)->setGroup();
$link  = (new NE())->setType(NE::TYPE_LINK);

return [
    $label->setId()->setBody('General')->toArray(),
    $list->setId()->toArray(),
    $link->setId()->setPid($list->id)->setBody('Home')->setHref('/')->toArray(),
    $link->setId()->setPid($list->id)->setBody('Laravel')->setHref('https://laravel.com/')->setExternal()->toArray(),
];

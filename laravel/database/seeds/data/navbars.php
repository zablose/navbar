<?php

class NE extends \Zablose\Navbar\Tests\NavbarEntity
{

    use \Zablose\Navbar\Traits\NavbarSettersTrait;
    use \Zablose\Navbar\Traits\ArrayableTrait;

}

$label = (new NE())->setType(NE::TYPE_BULMA_MENU_LABEL);
$list  = (new NE())->setType(NE::TYPE_BULMA_MENU_LIST)->setGroup();
$link  = (new NE())->setType(NE::TYPE_BULMA_MENU_LINK);

return [
    $label->setId()->setBody('General')->toArray(),
    $list->setId()->toArray(),
    $link->setId()->setPid($list->id)->setBody('Home')->setHref('/')->toArray(),
    $link->setId()->setPid($list->id)->setBody('Laravel')->setHref('https://laravel.com/')->setExternal()->toArray(),
];

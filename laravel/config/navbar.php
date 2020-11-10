<?php

use App\Http\Navigation\NavbarEntity;

return [

    'app_url' => '/',

    /* Class to be used by NavbarDataProcessor to represent NavbarEntity. */
    'navbar_entity_class' => NavbarEntity::class,

    /* CSS class to use to make link active. */
    'active_link_class' => 'active',

];

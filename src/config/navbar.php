<?php

return [

    /**
     * Application URL.
     */
    'app_url' => 'http://dlite/laradocs',

    /**
     * If ordering direction is wrong the ordering will be ignored.
     *
     * Don't use them both.
     */
    'titled'     => false, // Order by title 'asc' or 'desc'.
    'positioned' => false, // Order by position 'asc' or 'desc'.

    /**
     * Target for absolute link.
     */
    'absolute_target' => '_blank',

    /**
     * Class to be used by NavbarDataProcessor to represent NavbarEntity.
     */
    'navbar_entity_class' => App\Zablose\Navbar\NavbarEntity::class

];

<?php

return [

    /*
     * Application URL.
     */
    'app_url'              => '/',

    /*
     * Order by column in the database 'asc' or 'desc'.
     * Examples: 'body:asc', 'position:desc', 'id:asc'.
     */
    'order_by'             => '',

    /*
     * Tag's class attribute value for an active link.
     */
    'active_link_class'    => 'active',

    /*
     * Tag's target attribute value for an external link.
     */
    'external_link_target' => '_blank',

    /*
     * Class to be used by NavbarDataProcessor to represent NavbarEntity.
     */
    'navbar_entity_class'  => Zablose\Navbar\Tests\NavbarEntity::class,

];

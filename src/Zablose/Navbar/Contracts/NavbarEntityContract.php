<?php

namespace Zablose\Navbar\Contracts;

interface NavbarEntityContract
{

    public static function getTypes();

    public static function getGroupTypes();

    public function isGroup();

    public function isPublic();


    /**
     * Prefix attribute with a string.
     *
     * @param string $attr Attribute name
     * @param string $value
     *
     * @return NavbarEntityContract
     */
    public function prefix($attr, $value);


    /**
     * Postfix attribute with a string.
     *
     * @param string $attr Attribute name
     * @param string $value
     *
     * @return NavbarEntityContract
     */
    public function postfix($attr, $value);

}

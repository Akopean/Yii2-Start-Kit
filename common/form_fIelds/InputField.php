<?php

namespace common\form_fields;

trait InputField
{
    private $codename = 'checkbox';


    public function __construct()
    {
        var_dump('FormItemConstructor');
    }

    public function createContent( $options)
    {
        return $this->codename;
    }
}

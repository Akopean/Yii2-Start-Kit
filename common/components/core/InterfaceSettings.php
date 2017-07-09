<?php
/**
 * Created by PhpStorm.
 * User: Agasi
 * Date: 09.07.2017
 * Time: 8:37
 */
namespace common\components\core;

interface InterfaceSettings
{
    /**
     * Get Setting Item
     * @param $key
     * @return bool|mixed
     */
    function get($key);

    /**
     * Set Setting Item
     * @param $key
     * @param $value
     */
    function set($key, $value);

    /**
     * Get All Setting Item
     * @return mixed
     */
    function getAll();

}
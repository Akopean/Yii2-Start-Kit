<?php
/**
 * Created by PhpStorm.
 * User: Agasi
 * Date: 24.07.2017
 * Time: 17:45
 */

namespace common\components\core;

interface FormItemConstructorInterface {

    public function __construct();


    public function init($type);

}
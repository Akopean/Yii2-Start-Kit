<?php
/**
 * Created by PhpStorm.
 * User: Agasi
 * Date: 24.07.2017
 * Time: 17:49
 */

namespace common\components;

use common\components\core\FormItemConstructorInterface;
use common\form_fields\InputField;

class FormItemType implements FormItemConstructorInterface
{

    use InputField;

    protected $supports = [];

    public function __construct()
    {
        var_dump('FormItemConstructor');
    }

    public function init($type)
    {
        echo $type;
    }
}

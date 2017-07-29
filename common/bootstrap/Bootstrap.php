<?php
/**
 * Created by PhpStorm.
 * User: Agasi
 * Date: 14.07.2017
 * Time: 9:47
 */

namespace common\bootstrap;

use common\components\DbSettings;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->setSingleton('Settings', DbSettings::class, ['cacheDuration' => 3600]);
    }
}
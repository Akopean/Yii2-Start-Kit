<?php

namespace common\components;

use Yii;
use yii\base\BootstrapInterface;


class ThemeBootstrap implements BootstrapInterface
{
    /**
     * /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        if (Yii::$app instanceof \yii\web\Application) {

            $url_array = explode('/', Yii::$app->request->url);
            $lang_url = isset($url_array[1]) ? $url_array[1] : null;
            Languages::setCurrent($lang_url);
        }
    }
}
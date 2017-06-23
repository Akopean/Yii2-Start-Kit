<?php

namespace common\components;

use common\models\Settings;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class DbSettings manipulates data from table  Settings
 * Get access to data (array), it is possible using  Yii::$app->settings;
 * Update Cache,  it is needed use key  from   Yii::$app->settings->cache
 */
class DbSettings extends \yii\base\Component
{
    public $cache = 'db_settings';
    public $cacheDuration = 60000;
    public $cacheDependency = null;
    protected $data = [];

    public function init()
    {
        parent::init();

        //We check up cache, set new data, if  there empty
        if (!$items = \Yii::$app->cache->get($this->cache)) {
            $items = Settings::find()->all();
            $items = ArrayHelper::map($items, 'name', 'value');
            \Yii::$app->cache->set($this->cache, $items, $this->cacheDuration, $this->cacheDependency);
        }
        $this->data = $items;
    }

    /**
     * @param $key
     * @return bool|mixed
     */
     public function get($key)
    {
        if (array_key_exists($key, $this->data)){

            return $this->data[$key];
        } else {
            return false;
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {

        $model = new Settings;

        $this->data[$key] = $value;
        $model->name = $key;
        $model->value = $value;

        $model->save();
    }

    /**
     * @param $key
     * @return bool
     */
    public function present_key($key)
    {
        if (array_key_exists($key, $this->data)){
            return true;
        } else {
            return false;
        }
    }
}
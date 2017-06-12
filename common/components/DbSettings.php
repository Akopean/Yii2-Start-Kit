<?php

namespace common\components;

use common\models\Settings;
use Yii;
use yii\base\Exception;

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
        //We check up cache, set new data, if  there empty
        if (!$items = \Yii::$app->cache->get($this->cache)) {
            $items = Settings::find()->asArray()->all();
            \Yii::$app->cache->set($this->cache, $items, $this->cacheDuration, $this->cacheDependency);
        }

        foreach ($items as $item){
            $data[$item['name']] = $item['value'];
            $this->data[$item['name']] = $item['value'];
        }

        parent::init();
    }

  public function get($key)
    {
        if (array_key_exists($key, $this->data)){

            return $this->data[$key];
        } else {
            return false;
        }
    }

    public function set($key, $value)
    {
        $model = Settings::find()->where(['name' => $key])->one();

        if (!$model)
            throw new Exception('Undefined parameter '.$key);

        $this->data[$key] = $value;
        $model->value = $value;
        $model->save();
    }

    public function add($key, $value)
    {
        $model = new Settings;

        $this->data[$key] = $value;
        $model->name = $key;
        $model->value = $value;

        $model->save();
    }


    public function present_key($key)
    {
        if (array_key_exists($key, $this->data)){
            return true;
        } else {
            return false;
        }
    }
}
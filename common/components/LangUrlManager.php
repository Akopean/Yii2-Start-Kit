<?php

namespace common\components;

use yii\web\UrlManager;

/**
 * Class LangUrlManager
 * @package common\components
 */
class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){

            $lang_url = array_search($params['lang_id'], \Yii::$app->params['lang']);
            if( $lang_url === null ){
                $lang_url = Languages::getDefaultLang();
            }
            unset($params['lang_id']);
        } else {
            $lang_url = Languages::getCurrent();
        }
       // var_dump($params);exit;
        $url = parent::createUrl($params);
        $lang_url = mb_substr($lang_url, 0, 2);

        if( $url === '/' && $lang_url !== mb_substr(\Yii::$app->params['default_lang'], 0, 2)){
            return '/'.$lang_url;
        }else{

            if($lang_url === mb_substr(\Yii::$app->params['default_lang'], 0, 2)){
                return $url;
            }
            return '/'.$lang_url.$url;
        }
    }
}

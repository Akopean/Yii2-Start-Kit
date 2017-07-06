<?php

namespace common\components;

use Yii;
use yii\base\Object;

/**

 */
class Languages extends Object
{
    //Переменная, для хранения текущего объекта языка
    static $current = null;

//Получение текущего объекта языка
    static function getCurrent()
    {
        if( self::$current === null ){

            self::$current = self::getDefaultLang();
        }

        return self::$current;
    }

    //Установка текущего объекта языка и локаль пользователя
    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);

        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current;

    }

//Получения объекта языка по умолчанию
    static function getDefaultLang()
    {
        return Yii::$app->params['default_lang'];
    }

    //Вернуть все языки
    static function getAllLang()
    {
        $lang = Yii::$app->params['lang'];

        return $lang;
    }

    //Получения объекта языка по буквенному идентификатору
    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {

            $language = array_search($url, array_flip(Yii::$app->params['lang']));

            if ( $language === false ) {
                return null;
            }else{
                return $language;
            }
        }
    }
}
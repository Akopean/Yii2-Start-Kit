<?php
/**
 * Created by PhpStorm.
 * User: Agasi
 * Date: 24.07.2017
 * Time: 19:45
 */
namespace backend\components;


use Yii;
use yii\web\UploadedFile;

class  ContentBasedOnType {

    public static function getContentBasedOnType($request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request[$row->key];

                if (isset($pass_field) && !empty($pass_field)) {
                    return  Yii::$app->getSecurity()->generatePasswordHash($request[$row->key]);
                }

                break;
            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request[$row->key];

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;

                break;
            /********** IMAGE TYPE **********/
            case 'image':
                if(!empty($request[$row->key])){
                    $value = $request[$row->key];
                    return $value;
                }
                break;
            /********** ALL OTHER TEXT TYPE **********/
            default:

                $value = $request[$row->key];
                $options = json_decode($row->details); // todo

                return $value;
        }

        return $content;
    }

}
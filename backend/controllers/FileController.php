<?php

namespace backend\controllers;

use yii\web\Controller;
use vova07\imperavi\actions\GetAction;


class FileController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => '/uploads',
                'path' => '@fronted_web/uploads',
                'type' => GetAction::TYPE_IMAGES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => '/uploads',
                'path' => '@fronted_web/uploads',
            ],
        ];
    }
}
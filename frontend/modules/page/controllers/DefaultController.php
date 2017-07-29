<?php

namespace frontend\modules\page\controllers;

use common\models\Page;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Default controller for the `pages` module
 */
class DefaultController extends Controller
{


    public function actionView($slug)
    {
        $page = $this->loadModel($slug);

        return $this->render('view', [
            'page' => $page,
            ]
        );
    }

    public function loadModel($slug)
    {
        $model = Page::find()->where(['slug' => $slug])->active()->one();
        if ($model === null)
            throw new HttpException(404, 'Запрашиваемая страница не существует.');
        return $model;
    }
}

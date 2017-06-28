<?php

namespace backend\controllers;

use common\models\Page;
use Yii;
use yii\web\Controller;


class FileManagerController extends Controller
{

    public function actionIndex()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}
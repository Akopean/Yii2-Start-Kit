<?php

namespace backend\controllers;

use common\models\Settings;
use Yii;
use yii\web\Controller;

/**
 * SettingsController implements the CRUD actions for settings model.
 */
class SettingsController extends Controller
{

    /**
     * Lists all Options models.
     * @return mixed
     */
    public function actionIndex()
    {

        if(Yii::$app->request->isPost){
            Yii::$app->cache->flush([Yii::$app->settings->cache]);
            $post = Yii::$app->request->post();
            foreach($post as $option => $value) {

                if (Yii::$app->settings->present_key($option)) {
                    Yii::$app->settings->set($option, htmlentities(trim($post[$option])));

                } elseif (!Yii::$app->settings->present_key($option) && $option[0] !== '_') {
                    Yii::$app->settings->add($option, htmlentities(trim($post[$option])));
                }
            }
        }
        return $this->render('index');
    }
}

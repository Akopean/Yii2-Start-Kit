<?php

namespace backend\controllers;

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
      Yii::$app->cache->flush([Yii::$app->settings->cache]);
        if(Yii::$app->request->isPost){
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

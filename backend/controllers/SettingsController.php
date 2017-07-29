<?php

namespace backend\controllers;

use backend\components\ContentBasedOnType;
use common\components\DbSettings;
use common\models\Settings;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * SettingsController implements the CRUD actions for settings model.
 */
class SettingsController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
        $settings =  Yii::$container->get('Settings');
        if(Yii::$app->request->isPost){
            Yii::$app->cache->flush([$settings->cache]);
            $post = Yii::$app->request->post();

            foreach($post as $option => $value) {
                if ($option[0] !== '_') {
                    $settings->set($option, htmlentities(trim($post[$option])));
                }
            }
        }
        return $this->render('index', ['settings' => $settings->getAll()]);
    }


    public function actionUpdate()
    {
        $data = [
            'message'    => '',
            'alert-type' => '',
        ];

        if (Yii::$app->request->isPost) {

            $request = Yii::$app->request->post();
            $settings = Settings::find()->all();
            unset($request["_csrf-backend"]);
            foreach ($settings as $setting) {

                $content = ContentBasedOnType::getContentBasedOnType($request, 'settings', $setting);

                if ($content === null && isset($setting->value)) {
                    $content = $setting->value;
                }

                $setting->value = $content;
                $setting->save();
            }

            $data = [
                'message'    => \Yii::t('backend', 'Success'),
                'alert-type' => 'success',
            ];
        }

        \Yii::$app->session->addFlash($data['alert-type'], $data['message'],false);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionMoveUp($id)
    {

        $setting = Settings::findOne($id);
        $swapOrder = $setting->order;

        $previousSetting = Settings::find()->where(['<', 'order', $swapOrder])->orderBy(['order' => SORT_DESC])->One();
        $data = [
            'message'    => \Yii::t('backend', 'This is already at the top of the list'),
            'alert-type' => 'danger',
        ];

        if (isset($previousSetting->order)) {
            $setting->order = $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => \Yii::t('backend', "Moved {name} order up",['name' => $setting->name]),
                'alert-type' => 'success',
            ];
        }
        \Yii::$app->session->addFlash($data['alert-type'], $data['message']);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionMoveDown($id)
    {
        $setting = Settings::findOne($id);
        $swapOrder = $setting->order;

        $previousSetting = Settings::find()->where(['>', 'order',  $swapOrder])->orderBy(['order' => SORT_ASC])->One();
        $data = [
            'message'    => \Yii::t('backend', 'This is already at the bottom of the list'),
            'alert-type' => 'danger',
        ];

        if (isset($previousSetting->order)) {
            $setting->order = $previousSetting->order == $swapOrder ? $previousSetting->order + 1 : $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => \Yii::t('backend', "Moved {name} order down",['name' => $setting->name]),
                'alert-type' => 'success',
            ];
        }
        \Yii::$app->session->addFlash($data['alert-type'], $data['message']);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {

        Settings::findOne($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Add new setting field
     * @return \yii\web\Response
     */
    public function actionStore()
    {
        $model = new Settings();

        if ($model->load(Yii::$app->request->post()) && $model->store()) {
            $data = [
                'message'    => \Yii::t('backend', 'Field {name} is Created',['name' => $model->name]),
                'alert-type' => 'success',
            ];
        } else {
            $data = [
                'message'    => Json::encode($model->getErrors()),
                'alert-type' => 'danger',
            ];
        }
        \Yii::$app->session->addFlash($data['alert-type'], $data['message'],false);
        return $this->redirect(Yii::$app->request->referrer);
    }
}

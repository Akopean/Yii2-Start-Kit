<?php

namespace backend\controllers;

use common\models\Settings;
use pendalf89\filemanager\models\Mediafile;
use Yii;
use yii\web\Request;
use yii\web\Controller;
use yii\web\UploadedFile;
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
                if ($option[0] !== '_') {
                    Yii::$app->settings->set($option, htmlentities(trim($post[$option])));
                }
            }
        }
        return $this->render('index');
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
                'message'    => \Yii::t('backend', "Moved {name} setting order up",['name' => $setting->name]),
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
            'message'    => \Yii::t('backend', 'This is already at the top of the list'),
            'alert-type' => 'danger',
        ];

        if (isset($previousSetting->order)) {

            $setting->order = $previousSetting->order;
            $setting->save();
            $previousSetting->order = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => \Yii::t('backend', "Moved {name} setting order down",['name' => $setting->name]),
                'alert-type' => 'success',
            ];
        }
        \Yii::$app->session->addFlash($data['alert-type'], $data['message']);
        return $this->redirect(Yii::$app->request->referrer);
    }

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $data = [
                'message'    => \Yii::t('backend', ' Field {name} is Created',['name' => $model->name]),
                'alert-type' => 'success',
            ];
        } else {
            $data = [
                'message'    =>  $model->errors['name'][0],
                'alert-type' => 'danger',
            ];
        }

        \Yii::$app->session->addFlash($data['alert-type'], $data['message']);
        return $this->redirect(Yii::$app->request->referrer);
    }
}

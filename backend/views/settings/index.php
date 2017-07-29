<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $settings common\components\DbSettings*/
/* @var $dataProvider yii\data\ActiveDataProvider */

\backend\assets\PropellerSelect2Asset::register($this);

$this->title = Yii::t( 'backend','Settings');
$this->params['breadcrumbs'][] = $this->title;
echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]);
?>
<div class="row">
    <div class="col-md-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= \Yii::$app->view->renderFile('@backend/views/layouts/alerts.php') ?>
        <div class="alert alert-info">
            <strong><?= Yii::t( 'backend', 'How To Use:') ?></strong>
            <p><?= Yii::t( 'backend', 'You can get the value of each setting anywhere on your site by calling')?> <code>Yii::$app->settings->get('key')</code></p>
        </div>

        <?= backend\widgets\field\FormFieldShowWidget::widget(
            [
                '_c' => 'settings',//controller
                '_m' => 'update',//action
                'model' =>  $settings,
            ]); ?>

        <?= backend\widgets\field\FormFieldWidget::widget(
            [
                '_c' => 'settings',//controller
                '_m' => 'store',//action
                'model' =>  new \common\models\Settings(),
                'fields' => [
                    'input' => 'Input',
                    'textarea' => 'TextArea',
                    'image' => 'Image',
                    'radio_btn' => 'Radio Button',
                    'code_editor' => 'Code Editor',
                    'select_dropdown' => 'Select Dropdown'
                ]
            ]); ?>
    </div>
</div>

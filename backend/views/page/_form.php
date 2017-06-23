<?php

use common\models\Page;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;

/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */

AutocompleteAsset::register($this);

$opts = Json::htmlEncode([
    'menus' => Page::getPageSource(),
    //'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>
<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeHiddenInput($model, 'parent_id', ['id' => 'parent_id']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

    <?= $model->isNewRecord ? '' : $form->field($model, 'slug')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'content')->widget(
        Imperavi::className(), [
            'settings' => [
                'minHeight' => 300,
                'buttonSource' => true,
                'pastePlainText' => true,
                'imageUpload' => Url::to(['file/image-upload']),
                'imageManagerJson' => Url::to(['file/images-get']),
                'plugins' => [
                    'clips',
                    'table',
                    'imagemanager',
                    'fullscreen'
                ]
            ]
        ]
    )?>

    <?= $form->field($model, 'status')->dropDownList([
        Page::STATUS_ACTIVE => 'Open',
        Page::STATUS_INACTIVE => 'Close',
        ],
        ['options' =>
            [
               Page::STATUS_ACTIVE => ['selected' => true]
            ]
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
